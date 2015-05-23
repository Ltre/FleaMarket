<?php
/**
 * 模块：与旧货信息相关的、具有更改性的操作。
 * 需要会话验证(详见全局过滤器)
 * @author Oriki
 * @since 2014-3-16
 */
class FleaoptAction extends ActionUtil{
	/**
	 * @shell
	 * 进入转让或求购的发布编辑页
	 * 参数：操作类型（见params）|当前旧货信息标题的编码（仅当编辑时有效）
	 * 视图要求：
	 * 		shell="pageToCreateFleaInfo"
	 * 		params="newsell/newbuy/editsell/editbuy"
	 */
	protected function pageToCreateFleaInfo($urlInfo){
		$t = $urlInfo['params'][1];
		$titlecode = $urlInfo['params'][2];
		if (get_magic_quotes_gpc())
			$t = stripslashes($t);
		$tplArgs = array(
			//class=page_content指定的正文区域内容（自定义内容）
			'page_content'	=>	'ace/fleaopt/pageToCreateFleaInfo/content.php',
			//<!-- page specific plugin scripts -->导入的js标签（包含ACE自己导入的）
			'ace_js'	=>	'ace/fleaopt/pageToCreateFleaInfo/jstag.php',	
			//<!-- page specific plugin styles -->导入的css标签（包含ACE自己导入的）
			'ace_css'	=>	'ace/fleaopt/pageToCreateFleaInfo/csstag.php',
			//<!-- inline scripts related to this page -->页内嵌入的脚本（包含ACE自身的）
			'ace_inline'=>	'ace/fleaopt/pageToCreateFleaInfo/injs.php',
			//自定义的外挂js
			'javascript'=>	'res/js/pageToCreateFleaInfo.js',	
			'action'	=>	'旧货信息操作',	//所在的模块
			'operation'	=>	('newsell'==$t||'newbuy'==$t ?'发布':'编辑').'旧货信息',	//所在的功能
			//具体模板的专用参数，结构自己定义
			'args'		=>	array(
				'optType'	=>	$t,
				'titlecode'=> $titlecode,//当前的titlecode，仅在编辑操作时才有效
			),
		);
		//如果是编辑操作
		if(false!==strpos($t,'edit')){
			$table = 'editsell'==$t ? 'sell' : 'buy';
			$rs = AiMySQL::queryEntity($table, array(0=>new AiMySQLCondition('titlecode', '=', $titlecode)));
			$r = null;
			if($rs)
				foreach ($rs as $r);
			$tplArgs['args']['record'] = $r ? $r : null;
		}
		self::setTplArgs( $tplArgs );
		require_once OTHER_TEMPLATE_DIR.'ace/tpl.php';//包含公共模板
	}
	
	
	/**
	 * @shell
	 * 发布新的旧货信息
	 * AI参数顺序：标题|旧货分类|价格|物品名|操作方式 |当前旧货信息titlecode（仅当编辑时有效）
	 * 		外带常规POST参数：details="编辑器文本" ；saveimgname='临时封面路径名'
	 */
	function publishNewFleaInfo($urlInfo){
		//执行状态采集
		$feedback = array(
			'status'=>null,
			'msg' => null,
		);
		//判断封面是否上传
		if(!isset($_POST['saveimgname'])){
			$feedback['status'] = 'NOIMAGE';
			$feedback['msg'] = '没有检测到上传的封面数据';
			die(json_encode($feedback));
		}
		//参数采集
		$p = $urlInfo['params'];
		$d = $_REQUEST['details'];
		$d = OrekiUtil::editorContentFilterToDB($d);//处理编辑器HTML文档
// 		die($d);
		//数据采集
		$title = htmlspecialchars($p[1]);//标题
		$title = str_replace('"', '\"', str_replace('\\', "/", $title));
		$fltype = intval($p[2]);//旧货分类
		$details = $d;//详情
		$name = htmlspecialchars($p[3]);//物品名
		$name = str_replace('"', '\"', str_replace('\\', "/", $name));
		$price = abs(floatval(htmlspecialchars($p[4])));//价格
		date_default_timezone_set('PRC');//设置北京时间
		$cretime = date('Y-m-d H:i:s');//发布时间
		$titlecode = sha1($title.$cretime);//标题编码
		$booklimit = FleaoptUtil::calcBookLimit($cretime);//预订期的结束时间
		$endlimit = FleaoptUtil::calcEndLimit($booklimit);//剩余交易期的结束时间
		$user = $_SESSION['user'];
		$creuser = $user->id;//发布人
		$status = 1;//状态
		$data = array(
				'title'=>$title,
				'titlecode'=>$titlecode,
				'name'=>$name,
				'fleatypefk'=>$fltype,
				'details'=>$details,
				'price'=>$price,
				'booklimit'=>$booklimit,
				'endlimit'=>$endlimit,
				'creuser'=>$creuser,
				'cretime'=>$cretime,
				'status'=>$status,
		);
		$opttype = $p[5];//旧货信息操作类型
		$record = null;
		if($opttype=='newsell'||$opttype=='newbuy'){
			if('newsell'==$opttype){
				$record = new Sell();
			}else{
				$record = new Buy();
			}
			foreach ($data as $key=>$value){
				$record->$key = $value;
			}
			if(AiMySQL::insert($record)){
				$feedback['status']='PUBSUCCESS';//发布成功
				UploadUtil::savefleaimg($record, $_POST['saveimgname']);//保存封面图
			}
			else
				$feedback['status']='PUBFAILURE';//发布失败
		}else{
			$table = 'editsell'==$opttype ? 'sell' : 'buy';
			$records = AiMySQL::queryEntity($table, array(0=>new AiMySQLCondition('titlecode', '=', $p[6])));
			foreach ($records as $record);
			if($record===null)
				$feedback['status']='NOFLEATOEDIT';//正在编辑的旧货信息不存在或被删除
			else{
				$data['id'] = $record->id;
				$data['titlecode'] = $p[6];//不改变原来的标题编码
				$newrecord = $table=='sell' ? new Sell() : new Buy();
				$newrecord->cretime = $record->cretime;
				$newrecord->booklimit = $record->booklimit;
				$newrecord->endlimit = $record->endlimit;
				foreach ($data as $key=>$value){
					if(in_array($key, array('cretime','booklimit','endlimit')))
						continue;//不修改发布日期、预约期限、结束期限
					$newrecord->$key = $value;
				}
				if(AiMySQL::update($newrecord)){
					$feedback['status']='EDITSUCCESS';//修改当前旧货信息成功
					UploadUtil::savefleaimg($newrecord, $_POST['saveimgname']);//保存封面图
				}else{
					$feedback['status']='EDITFAILURE';//无法修改当前旧货信息
				}
			}
		}
		//$record->details = html_entity_decode(htmlspecialchars_decode($record->details));//编辑器内容还原
		$feedback['content'] = $record;
		echo json_encode($feedback);//返回执行结果json
	}
	
	/**
	 * @shell
	 * 删除旧货信息
	 * 指令参数：类型(sell/buy)|标题编码
	 */
	protected function delFleaInfo($urlInfo){
		$feedback = array(
			'status' => null,
			'msg' => null,
			'deleted' => null,
		);
		$p = $urlInfo['params'];
		$opt = $p[1];
		$tc = $p[2];
		$isSell = !strcasecmp('sell', $opt);
		//$tmp = $isSell ? new Sell() : new Buy();
		$r = null;
		$rs = AiMySQL::queryEntity($opt, array(new AiMySQLCondition('titlecode', '=', $tc)));
		if($rs)
			foreach ($rs as $r);
		if(!$r){
			$feedback['status'] = 'NOTFOUND';
			$feedback['msg'] = '该条'.($isSell?'转让':'求购').'记录不存在';
		}else{
			//$tmp->id = $r->id;
			//查询有预定记录的旧货信息的id
			$ids = AiMySQL::queryCustom('select id from fm_'.$opt.' where id in ( select recordz from fm_book where booktype="'.($isSell?'Z':'Q').'" ) and id='.$r->id);
			$id = null;if($ids)foreach ($ids as $id);
			if($id){
				$feedback['status'] = 'ISBOOKED';
				$feedback['msg'] = '该旧货信息已被预订，不允许删除';
			}else{
				if(AiMySQL::delete($r)){
					$feedback['status'] = 'SUCCESS';
					$feedback['msg'] = '删除成功';
					$feedback['deleted'] = $tc;//被删除的旧货信息的标题编码
				}else{
					$feedback['status'] = 'FAILURE';
					$feedback['msg'] = '删除时发生了异常，请联系管理员';
				}
			}
		}
		print(json_encode($feedback));
	}
	
	/**
	 * @shell
	 * @filter
	 * 获取单条旧货信息的详情
	 * 指令参数：信息类型（sell/buy）|标题编码|视图类型（self/other）|每页结果集个数|遍历开始索引
	 * 		视图类型：以查看自己的记录为视角还是以查看他人记录为视角
	 */
	protected function getFleaDetails($urlInfo){
		$feedback = array('status'=>null, 'details'=>null);	//反馈结果
		$p = $urlInfo['params'];
		$opt = $p[1];
		$tc = $p[2];
		$view = $p[3];
		$num = $p[4];
		$start = $p[5];
		$r = null;
		$rs = AiMySQL::queryEntity($opt, array(new AiMySQLCondition('titlecode', '=', $tc)));
		if($rs) foreach ($rs as $r);
		if(!$r)
			$feedback['status'] = 'NOTFOUND';	//无此记录
		else{
			$feedback['status'] = 'SUSCCESS';
			$types = AiMySQL::queryEntity('fleatype', array(new AiMySQLCondition('id', '=', intval($r->fleatypefk))));
			$t=null; if($types) foreach ($types as $t);
			if(!$t) 
				$feedback['status'] = 'FLEATYPEEXPT';	//旧货信息存在，但其旧货类型数据异常
			else
				$r->fleatypefk = $t->name;	//将旧货类型外键id替换为其类型名称（用于显示）
			$creusers = AiMySQL::queryEntity('users', array(new AiMySQLCondition('id', '=', intval($r->creuser))));
			$creuser = null; if($creusers) foreach ($creusers as $creuser);
			if(!$creuser) 
				$feedback['status'] = 'CREUSEREXPT';	//旧货信息存在，但其发布人数据异常
			else {
				$r->creuser = $creuser->username;	//将旧货信息发布人外键id替换为其用户名称
			}
			switch ($r->status){
				case 1: $r->status='现在还可预约';break;
				case 2: $r->status='已停止预约，等待结束';break;
				case 3: $r->status='无人预约，超时结束';break;
				case 4: $r->status=!strcasecmp($opt, 'sell')?'物主关闭':'买主关闭';break;
				case 5: $r->status=!strcasecmp($opt, 'sell')?'转让完成':'求购完成';break;
				case 6: $r->status='系统结束，但有未完成的交易';
			}
			$feedback['details'] = $r;	//保存旧货类型对象
		}
		$feedback['num'] = $num;
		$feedback['start'] = $start;
		self::setTplArgs($feedback);//设置反馈结果供self/other视图使用
		if(!strcasecmp('self', $view)){
			if(!strcasecmp('sell', $opt))
				require_once OTHER_TEMPLATE_DIR.'ace/selfrecord/selllist/details.php';
			else
				require_once OTHER_TEMPLATE_DIR.'ace/selfrecord/buylist/details.php';
		}else{
			echo "查看其他人的旧货记录";
		}
// 		print(json_encode($feedback));
	}
	
	/**
	 * 废弃！！
	 * @shell
	 * 列出自己的旧货记录（转让、求购、预订、交易、评价）
	 * AI参数顺序：操作方式(sell/buy/book/trade/appraise)|结果集个数|遍历开始索引
	 * 常规POST参数：暂无
	 */
	function pageToListSelfRecords($urlInfo){
		$p = $urlInfo['params'];
		$opt = $p[1];//操作指令（表名）
		$num = intval($p[2]);//页内显示结果集数
		$start = intval($p[3]);//页内结果集开始索引
		$colomns = array(
			'sell'=>array(
				'title'=>'标题','fleatype'=>'分类','price'=>'参考价格','cretime'=>'发起时间','status'=>'状态'
			),
			'buy'=>array(
				'标题','分类','参考价格','发起时间','状态'
			),
			'book'=>array(
				'booktype'=>'预约类型','title'=>'对应记录','leftuser'=>'甲方','rightuser'=>'乙方','status'=>'状态' //状态显示为：等待接受、已接受
			),
			'trade'=>array(
				'交易类型','对应记录','甲方','乙方','状态' //状态显示为：待确认（单方）、已确认（双方）。不显示零方确认的记录
			),
			'appraise'=>array(
				'交易类型','对应记录','甲方','乙方','状态' //状态显示为：待互评（单方）、已互认（已确认）。不显示零方评价的记录
			),
		);
		
		$user = $_SESSION['user'];
		$operation = null;//操作显示名
		$conditions = null;//查询条件
		$sql = null;//自定义sql（多表查询时用）
		$combination = AiMySQLCombination::COMB_AND;//条件连接方式
		$records = array();//结果集
		
		if(!strcasecmp('book', $opt)){
			if(false!==($sql=AiSQL::getSqlExpr('getBookSell'))){
				$list1 = AiMySQL::queryCustomByParams(
					AiSQL::getSqlExpr('getBookSell'), 
					array('leftuser'=>$user->id, 'rightuser'=>$user->id)
				);
				$list2 = AiMySQL::queryCustomByParams(
					AiSQL::getSqlExpr('getBookBuy'), 
					array('leftuser'=>$user->id, 'rightuser'=>$user->id)
				);
// 				OrekiUtil::var_dump_array($list1);
// 				echo str_repeat('=', 100).'<br>';
// 				OrekiUtil::var_dump_array($list2);
// 				echo str_repeat('=', 100).'<br>';
// 				$records=array_merge($list1,$list2);
// 				OrekiUtil::var_dump_array(debug_backtrace());
			}
			
		}else if(!strcasecmp('trade', $opt)){
			
		}else if(!strcasecmp('appraise', $opt)){
			
		}else if((@$isBuy=!strcasecmp('buy', $opt)) || !strcasecmp('sell', $opt)){
			$operation = $isBuy?'求购':'转让';
			$records = AiMySQL::queryEntity(
				$opt,
				array( new AiMySQLCondition('creuser', '=', $user->id) ),
				null, null, null,
				$num, $start
			);
// 			OrekiUtil::var_dump_array($records);
		}else{
			
		}
		

		$tplArgs = array(
				//class=page_content指定的正文区域内容（自定义内容）
				'page_content'	=>	'ace/fleaopt/pageToListRecords/content.php',
				//<!-- page specific plugin scripts -->导入的js标签（包含ACE自己导入的）
				'ace_js'	=>	'ace/fleaopt/pageToListRecords/jstag.php',
				//<!-- page specific plugin styles -->导入的css标签（包含ACE自己导入的）
				'ace_css'	=>	'ace/fleaopt/pageToListRecords/csstag.php',
				//<!-- inline scripts related to this page -->页内嵌入的脚本（包含ACE自身的）
				'ace_inline'=>	'ace/fleaopt/pageToListRecords/injs.php',
				//自定义的外挂js
				'javascript'=>	'res/js/pageToListRecords.js',
				'action'	=>	'旧货信息操作',	//所在的模块
				'operation'	=>	'查看'.$operation.'记录',	//所在的功能
				//具体模板的专用参数，结构自己定义
				'args'		=>	array(
						'optType'	=>	$opt,//操作类型
						'header'	=>	$colomns[$opt],//表头标题
						'records'	=>	$records,	//查询结果
				),
		);
		exit;
		self::setTplArgs( $tplArgs );
		require_once OTHER_TEMPLATE_DIR.'ace/tpl.php';//包含公共模板
	}
	
}