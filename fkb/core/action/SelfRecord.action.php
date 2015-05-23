<?php
class SelfRecordAction extends ActionUtil {
	
	/**
	 * @shell
	 * 列出自己的转让记录
	 * AI参数顺序：结果集个数|遍历开始索引
	 * 常规POST参数：暂无
	 */
	function listSelfSell($urlInfo){
		$p = $urlInfo['params'];
		$num = intval($p[1]);//页内显示结果集数
		$start = intval($p[2]);//页内结果集开始索引
		$user = $_SESSION['user'];
		$sql = 'select *,s.id as sellid,t.name as fleatypename from fm_sell as s, fm_fleatype as t where s.fleatypefk = t.id';
		$total = AiMySQL::getNumsOfRs($sql.' and creuser='.$user->id);//数据库可查询到的总结果集数
		$records = array();//结果集
		$records = AiMySQL::queryCustomByParams(
			$sql.' and creuser = :creuser order by s.cretime desc', 
			array('creuser'=>$user->id),
			$num, $start
		);
// 		OrekiUtil::var_dump_array($records);
// 		exit;
		$tplArgs = array(
				//class=page_content指定的正文区域内容（自定义内容）
				'page_content'	=>	'ace/selfrecord/selllist/content.php',
				//<!-- page specific plugin scripts -->导入的js标签（包含ACE自己导入的）
				'ace_js'	=>	'ace/selfrecord/selllist/jstag.php',
				//<!-- page specific plugin styles -->导入的css标签（包含ACE自己导入的）
				'ace_css'	=>	'ace/selfrecord/selllist/csstag.php',
				//<!-- inline scripts related to this page -->页内嵌入的脚本（包含ACE自身的）
				'ace_inline'=>	'ace/selfrecord/selllist/injs.php',
				//自定义的外挂js
				'javascript'=>	'res/js/selfrecord/selllist.js',
				'action'	=>	'旧货信息操作',	//所在的模块
				'operation'	=>	'查看转让记录',	//所在的功能
				//具体模板的专用参数，结构自己定义
				'args'		=>	array(
						'header'	=>	array(
							'title'=>'标题','fleatypename'=>'分类','price'=>'参考价格','cretime'=>'发起时间','status'=>'状态'
						),							//表头标题
						'records'	=>	$records,	//查询结果
						'total'		=>	$total,		//数据库可查询的总结果数
						'pageOffset'=>	intval($start/$num+1),	//当前页码
						'num'		=>	$num,		//每页显示结果集数
				),
		);
		self::setTplArgs( $tplArgs );
		require_once OTHER_TEMPLATE_DIR.'ace/tpl.php';//包含公共模板
	}
	
	/**
	 * @shell
	 * 列出自己的求购记录
	 * AI参数顺序：结果集个数|遍历开始索引
	 * 常规POST参数：暂无
	 */
	function listSelfBuy($urlInfo){
		$p = $urlInfo['params'];
		$num = intval($p[1]);//页内显示结果集数
		$start = intval($p[2]);//页内结果集开始索引
		$user = $_SESSION['user'];
		$sql = 'select *,s.id as sellid,t.name as fleatypename from fm_buy as s, fm_fleatype as t where s.fleatypefk = t.id';
		$total = AiMySQL::getNumsOfRs($sql.' and creuser='.$user->id);//数据库可查询到的总结果集数
		$records = array();//结果集
		$records = AiMySQL::queryCustomByParams(
				$sql.' and creuser = :creuser order by s.cretime desc',
				array('creuser'=>$user->id),
				$num, $start
		);
		// 		OrekiUtil::var_dump_array($records);
		// 		exit;
		$tplArgs = array(
				//class=page_content指定的正文区域内容（自定义内容）
				'page_content'	=>	'ace/selfrecord/buylist/content.php',
				//<!-- page specific plugin scripts -->导入的js标签（包含ACE自己导入的）
				'ace_js'	=>	'ace/selfrecord/buylist/jstag.php',
				//<!-- page specific plugin styles -->导入的css标签（包含ACE自己导入的）
				'ace_css'	=>	'ace/selfrecord/buylist/csstag.php',
				//<!-- inline scripts related to this page -->页内嵌入的脚本（包含ACE自身的）
				'ace_inline'=>	'ace/selfrecord/buylist/injs.php',
				//自定义的外挂js
				'javascript'=>	'res/js/selfrecord/buylist.js',
				'action'	=>	'旧货信息操作',	//所在的模块
				'operation'	=>	'查看求购记录',	//所在的功能
				//具体模板的专用参数，结构自己定义
				'args'		=>	array(
						'header'	=>	array(
								'title'=>'标题','fleatypename'=>'分类','price'=>'参考价格','cretime'=>'发起时间','status'=>'状态'
						),							//表头标题
						'records'	=>	$records,	//查询结果
						'total'		=>	$total,		//数据库可查询的总结果数
						'pageOffset'=>	intval($start/$num+1),	//当前页码
						'num'		=>	$num,		//每页显示结果集数
				),
		);
		self::setTplArgs( $tplArgs );
		require_once OTHER_TEMPLATE_DIR.'ace/tpl.php';//包含公共模板
	}
	
	/**
	 * @shell
	 * 列出自己的预订记录
	 * 指令参数：每页个数|开始索引
	 * 常规POST参数：暂无
	 */
	function listSelfBook($urlInfo){
		$p = $urlInfo['params'];
		$num = intval($p[1]);//页内显示结果集数
		$start = intval($p[2]);//页内结果集开始索引
		$user = $_SESSION['user'];
		$sql_sell = AiSQL::getSqlExpr('getBookDetail_sell').' and ( b.leftuser='.$user->id.' or b.rightuser='.$user->id.')';
		$sql_buy = AiSQL::getSqlExpr('getBookDetail_buy').' and ( b.leftuser='.$user->id.' or b.rightuser='.$user->id.')';
		$total1 = AiMySQL::getNumsOfRs($sql_sell);
		$total2 = AiMySQL::getNumsOfRs($sql_buy);
		$total = $total1 + $total2;
		$rs1 = AiMySQL::queryCustomByParams(
				$sql_sell,
				array(),
				$num, $start
		);
		$records = array();
		if($start<$total1 && $start+$num<=$total1) {
			$records = $rs1;
		}else if($start<$total1 && $start+$num>$total1){
			//echo $total.'|'.$total1.'|'.$total2.'<br>';
			foreach ($rs1 as $records[]);
			//echo "个数：".count($records).'<br>';
			foreach (AiMySQL::queryCustomByParams($sql_buy, array(), $num-count($records)) as $records[]);
			//echo "个数：".count($records).'<br>';
		}else if($start>=$total1){
			$rs2 = AiMySQL::queryCustomByParams($sql_buy, array(), $num, $start-$total1);
			$records = $rs2;
		}
		//OrekiUtil::var_dump_array($records);
		//echo "总数：".count($records);
		//exit;
		$tplArgs = array(
				//class=page_content指定的正文区域内容（自定义内容）
				'page_content'	=>	'ace/selfrecord/booklist/content.php',
				//<!-- page specific plugin scripts -->导入的js标签（包含ACE自己导入的）
				'ace_js'	=>	'ace/selfrecord/booklist/jstag.php',
				//<!-- page specific plugin styles -->导入的css标签（包含ACE自己导入的）
				'ace_css'	=>	'ace/selfrecord/booklist/csstag.php',
				//<!-- inline scripts related to this page -->页内嵌入的脚本（包含ACE自身的）
				'ace_inline'=>	'ace/selfrecord/booklist/injs.php',
				//自定义的外挂js
				'javascript'=>	'res/js/selfrecord/booklist.js',
				'action'	=>	'旧货信息操作',	//所在的模块
				'operation'	=>	'查看预约记录',	//所在的功能
				//具体模板的专用参数，结构自己定义
				'args'		=>	array(
						'header'	=>	array(
							'title'=>'预约来源','purposevalue'=>'预约目的','leftuser'=>'甲方','rightuser'=>'乙方','statusvalue'=>'状态'
						),							//表头标题
						'records'	=>	$records,	//查询结果
						'total'		=>	$total,		//数据库可查询的总结果数
						'pageOffset'=>	intval($start/$num+1),	//当前页码
						'num'		=>	$num,		//每页显示结果集数
				),
		);
		self::setTplArgs( $tplArgs );
		require_once OTHER_TEMPLATE_DIR.'ace/tpl.php';//包含公共模板
	}
	
	/**
	 * @shell
	 * 列出自己的交易记录
	 * 指令参数：每页个数|开始索引
	 * 常规POST参数：暂无
	 */
	function listSelfTrade($urlInfo){
		$p = $urlInfo['params'];
		$num = intval($p[1]);//页内显示结果集数
		$start = intval($p[2]);//页内结果集开始索引
		$user = $_SESSION['user'];
		$sql_sell = AiSQL::getSqlExpr('getTradeDetail_sell').' and ( b.leftuser='.$user->id.' or b.rightuser='.$user->id.')';
		$sql_buy = AiSQL::getSqlExpr('getTradeDetail_buy').' and ( b.leftuser='.$user->id.' or b.rightuser='.$user->id.')';
		$total1 = AiMySQL::getNumsOfRs($sql_sell);
		$total2 = AiMySQL::getNumsOfRs($sql_buy);
		$total = $total1 + $total2;
		$rs1 = AiMySQL::queryCustomByParams(
				$sql_sell,
				array(),
				$num, $start
		);
		$records = array();
		if($start<$total1 && $start+$num<=$total1) {
			$records = $rs1;
		}else if($start<$total1 && $start+$num>$total1){
			//echo $total.'|'.$total1.'|'.$total2.'<br>';
			foreach ($rs1 as $records[]);
			//echo "个数：".count($records).'<br>';
			foreach (AiMySQL::queryCustomByParams($sql_buy, array(), $num-count($records)) as $records[]);
			//echo "个数：".count($records).'<br>';
		}else if($start>=$total1){
			$rs2 = AiMySQL::queryCustomByParams($sql_buy, array(), $num, $start-$total1);
			$records = $rs2;
		}
		$tplArgs = array(
				//class=page_content指定的正文区域内容（自定义内容）
				'page_content'	=>	'ace/selfrecord/tradelist/content.php',
				//<!-- page specific plugin scripts -->导入的js标签（包含ACE自己导入的）
				'ace_js'	=>	'ace/selfrecord/tradelist/jstag.php',
				//<!-- page specific plugin styles -->导入的css标签（包含ACE自己导入的）
				'ace_css'	=>	'ace/selfrecord/tradelist/csstag.php',
				//<!-- inline scripts related to this page -->页内嵌入的脚本（包含ACE自身的）
				'ace_inline'=>	'ace/selfrecord/tradelist/injs.php',
				//自定义的外挂js
				'javascript'=>	'res/js/selfrecord/tradelist.js',
				'action'	=>	'旧货信息操作',	//所在的模块
				'operation'	=>	'查看交易记录',	//所在的功能
				//具体模板的专用参数，结构自己定义
				'args'		=>	array(
						'header'	=>	array(
								'title'=>'交易来源','tradetypevalue'=>'交易类型','leftuser'=>'甲方','rightuser'=>'乙方','statusvalue'=>'状态'
						),							//表头标题
						'records'	=>	$records,	//查询结果
						'total'		=>	$total,		//数据库可查询的总结果数
						'pageOffset'=>	intval($start/$num+1),	//当前页码
						'num'		=>	$num,		//每页显示结果集数
				),
		);
		self::setTplArgs( $tplArgs );
		require_once OTHER_TEMPLATE_DIR.'ace/tpl.php';//包含公共模板
	}
	
	
	function listSelfAppraise($urlInfo){
		
	}
	
	
	function listSelfAccessRecord($urlInfo){
		
	}
	
	/**
	 * @shell
	 * 显示自己的私信记录
	 * 指令参数：查看方式（未读/已读/已发送，0/1/2）|每页个数|开始索引
	 */
	function listSelfLetter( $u ){
		$p = $u['params'];
		$opt = intval($p[1]);
		$num = intval($p[2]);
		$num = $num<0?0:$num;
		$start = intval($p[3]);
		$start = $start<0?0:$start;
		//准备查询参数
		$presql = $opt!=2 
			? AiSQL::getSqlExpr('msg/listRecvLetters')
			: AiSQL::getSqlExpr('msg/listSentLetters');
		$sqlprm['me'] = $_SESSION['user']->id;
		if($opt!=2)
			$sqlprm['isread'] = $opt;
		//计算总数
		$tmp = $opt!=2 
			? ('select*from fm_message where msgtype=2 and receiver='.$_SESSION['user']->id.' and isread='.$opt)
			: ('select*from fm_message where msgtype=2 and sender='.$_SESSION['user']->id ) ;
		$total = AiMySQL::getNumsOfRs($tmp);
		//拿到私信列表数组结构：id,title,erid,er,sendtime
		$presql .= " limit $start , $num";
		$rs = AiMySQL::queryCustomByParams($presql, $sqlprm);
		//获取自己的联系人列表：id,username
		$contacts = AiMySQL::queryCustomByParams(
			AiSQL::getSqlExpr('ctc/listMyContacts'), 
			array('me'=>$_SESSION['user']->id)
		);
		$tplArgs = array(
				//class=page_content指定的正文区域内容（自定义内容）
				'page_content'	=>	'ace/selfrecord/letterlist/content.php',
				//<!-- page specific plugin scripts -->导入的js标签（包含ACE自己导入的）
				'ace_js'	=>	'ace/selfrecord/letterlist/jstag.php',
				//<!-- page specific plugin styles -->导入的css标签（包含ACE自己导入的）
				'ace_css'	=>	'ace/selfrecord/letterlist/csstag.php',
				//<!-- inline scripts related to this page -->页内嵌入的脚本（包含ACE自身的）
				'ace_inline'=>	'ace/selfrecord/letterlist/injs.php',
				//自定义的外挂js
				'javascript'=>	'res/js/selfrecord/letterlist.js',
				'action'	=>	'个人内务处理',	//所在的模块
				'operation'	=>	'查看私信记录',	//所在的功能
				//具体模板的专用参数，结构自己定义
				'args'		=>	array(
					'tabs'		=>	array('未读','已读','已发送'), //选项卡标题
					'opt'		=>	$opt,	//查看方式
					'letters'	=>	$rs?$rs:array(),	//私信查询结果，可以直接用foreach
					'contacts'	=>	$contacts?$contacts:array(), //联系人列表
					'total'		=>	$total,		//数据库可查询的总结果数
					'num'		=>	$num,		//每页显示结果集数
					'start'		=>	$start,		//开始索引
					'end'		=>	$start+$num-1,	//结束索引
					'pagepos'	=>	intval($start/$num+1),	//当前页码
					'pagesum'	=>	intval( $total/$num + ($total%$num>0?1:0) ),	//总页数
				),
		);
		self::setTplArgs( $tplArgs );
		require_once OTHER_TEMPLATE_DIR.'ace/tpl.php';//包含公共模板
	}
	
	
	/**
	 * @shell
	 * 显示自己的提醒记录
	 * 指令参数：查看方式（未读/已读，0/1）|每页个数|开始索引
	 */
	function listSelfRemind( $u ){
		$p = $u['params'];
		$opt = intval($p[1]);
		$num = intval($p[2]);
		$num = $num<0?0:$num;
		$start = intval($p[3]);
		$start = $start<0?0:$start;
		//准备查询参数
		$presql = AiSQL::getSqlExpr('msg/listRemind');
		$sqlprm['me'] = $_SESSION['user']->id;
		$sqlprm['isread'] = $opt;
		//计算总数
		$tmp = ('select*from fm_message where msgtype in (4,5,7,8) and receiver='.$_SESSION['user']->id.' and isread='.$opt);
		$total = AiMySQL::getNumsOfRs($tmp);
		//拿到提醒列表数组结构：id,msgtype,msgtypevalue,title,receiver,isread,sendtime
		$presql .= " limit $start , $num";
		$rs = AiMySQL::queryCustomByParams($presql, $sqlprm);
		$tplArgs = array(
				//class=page_content指定的正文区域内容（自定义内容）
				'page_content'	=>	'ace/selfrecord/remindlist/content.php',
				//<!-- page specific plugin scripts -->导入的js标签（包含ACE自己导入的）
				'ace_js'	=>	'ace/selfrecord/remindlist/jstag.php',
				//<!-- page specific plugin styles -->导入的css标签（包含ACE自己导入的）
				'ace_css'	=>	'ace/selfrecord/remindlist/csstag.php',
				//<!-- inline scripts related to this page -->页内嵌入的脚本（包含ACE自身的）
				'ace_inline'=>	'ace/selfrecord/remindlist/injs.php',
				//自定义的外挂js
				'javascript'=>	'res/js/selfrecord/remindlist.js',
				'action'	=>	'个人内务处理',	//所在的模块
				'operation'	=>	'查看操作提醒',	//所在的功能
				//具体模板的专用参数，结构自己定义
				'args'		=>	array(
						'opt'		=>	$opt,	//查看方式
						'letters'	=>	$rs?$rs:array(),	//提醒查询结果，可以直接用foreach
						'total'		=>	$total,		//数据库可查询的总结果数
						'num'		=>	$num,		//每页显示结果集数
						'start'		=>	$start,		//开始索引
						'end'		=>	$start+$num-1,	//结束索引
						'pagepos'	=>	intval($start/$num+1),	//当前页码
						'pagesum'	=>	intval( $total/$num + ($total%$num>0?1:0) ),	//总页数
				),
		);
		self::setTplArgs( $tplArgs );
		require_once OTHER_TEMPLATE_DIR.'ace/tpl.php';//包含公共模板
	}
	
	
}