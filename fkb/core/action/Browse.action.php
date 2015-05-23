<?php
/**
 * 与浏览有关的模块，该模块只需要游客身份即可
 */
/*
 * 测试代码：
 		die(
			'<script type="text/javascript">'
			.'alert("结果集个数：'.$num.'");'
			.'</script>'
		);
 */
class BrowseAction extends ActionUtil{
	
	/**
	 * @shell
	 * 随便看看，可以按按转让、按求购
	 * 指令参数：旧货信息类型(sell/buy)|每页结果数|起始索引
	 */
	function randomSearch($urlInfo){
		$p = $urlInfo['params'];
		$type = $p[1];//sell,buy
		$num = $p[2];
		$start = $p[3];
		$flag = 0==strcasecmp($type, 'sell');
		$preSql = $flag ? AiSQL::getSqlExpr('randomSearchSell') : AiSQL::getSqlExpr('randomSearchBuy');
		$rsnum = AiMySQL::getNumsOfRs($preSql);
		//查询数据库，将结果集放到模板参数中，再使用ActionUtil::getTplArgs()即可获取参数
		$rs = AiMySQL::queryCustomByParams($preSql, array(), $num, $start);
		$tmp = 0;//临时变量，随便用
		$tpl_args = array(
			'results' => $rs,
			'optType' => $type,
			'rsnum' => $rsnum,//结果集总数
			'shell' => 'randomSearch',//当前页面所用的指令：randomSearch|fleatypeSearch|searchFleaAsKeyword
			'pagepos' => intval($start/$num)+1, //当前页码
			'pagesum' => ($tmp=intval($rsnum/$num))==($rsnum/$num) ? $tmp : $tmp+1, //总页数
			'numperpage' => $num, //每页显示数
		);
		self::tpl($tpl_args);
	}
	
	/**
	 * @shell
	 * 按旧货分类搜索
	 * 指令参数：旧货信息类型(sell/buy)|旧货分类的id|每页结果数|起始索引
	 */
	protected function fleatypeSearch($urlInfo){
		$p = $urlInfo['params'];
		$opt = $p[1];
		$type = str_replace('"', "\\\"", $p[2]);
		$type = str_replace('\\', '/', $type);
		$num = $p[3];
		$start = $p[4];
		$flag = 0==strcasecmp($opt, 'sell');
		$preSql = $flag ? AiSQL::getSqlExpr('randomSearchSell') : AiSQL::getSqlExpr('randomSearchBuy');
		$preSql .= ' and s.fleatypefk='.$type;
		$rsnum = AiMySQL::getNumsOfRs($preSql);
		$rs = AiMySQL::queryCustomByParams($preSql, array(), $num, $start);
		$tpl_args = array(
			'results' => $rs,
			'optType' => $opt,
			'fleatype' => $type,//当前旧货分类
			'rsnum' => $rsnum,//结果集总数
			'shell' => 'fleatypeSearch',//当前页面所用的指令：randomSearch|fleatypeSearch|searchFleaAsKeyword
			'pagepos' => intval($start/$num)+1, //当前页码
			//'pagesum' => intval($rsnum/$num)+1, //总页数
			'pagesum' => ($tmp=intval($rsnum/$num))==($rsnum/$num) ? $tmp : $tmp+1, //总页数
			'numperpage' => $num, //每页显示数
		);
		self::setTplArgs($tpl_args);
		//借用randomSearch模板
		require_once ACTION_TEMPLATE_DIR.'Browse/randomSearch.php';
	}

	/**
	 * @shell
	 * 按关键字搜素
	 * 指令参数：旧货信息类型(sell/buy)|关键字|每页结果数|起始索引
	 */
	protected function searchFleaAsKeyword($urlInfo){
		$p = $urlInfo['params'];
		$opt = $p[1];
		//$key = $p[2];
		$key = str_replace('"', "\\\"", $p[2]);
		$key = str_replace('\\', '/', $key);
		$num = intval($p[3]);
		$start = intval($p[4]);
		$flag = 0==strcasecmp($opt, 'sell');
		$preSql = $flag ? AiSQL::getSqlExpr('randomSearchSell') : AiSQL::getSqlExpr('randomSearchBuy');
		$preSql .= ' and ( t.name like "%'.$key.'%" or s.title like "%'.$key.'%" or s.name like "%'.$key.'%" or u.username like "%'.$key.'%"' .')';
		$rsnum = AiMySQL::getNumsOfRs($preSql);
		$rs = AiMySQL::queryCustomByParams($preSql, array(), $num, $start);
		$tpl_args = array(
				'results' => $rs,
				'optType' => $opt,
				'keyword' => $key,//当前关键字
				'rsnum' => $rsnum,//结果集总数
				'shell' => 'searchFleaAsKeyword',//当前页面所用的指令：randomSearch|fleatypeSearch|searchFleaAsKeyword
				'pagepos' => intval($start/$num)+1, //当前页码
				//'pagesum' => intval($rsnum/$num)+1, //总页数
				'pagesum' => ($tmp=intval($rsnum/$num))==($rsnum/$num) ? $tmp : $tmp+1, //总页数
				'numperpage' => $num, //每页显示数
		);
		self::setTplArgs($tpl_args);
		//借用randomSearch模板
		require_once ACTION_TEMPLATE_DIR.'Browse/randomSearch.php';
	}
	
	/**
	 * @shell
	 * @因时间关系，该功能弃做
	 * 按发布人搜索
	 * 这个不被matrix的搜索框使用，另有用途。
	 * 其先加载matrix首页，而后用搜索结果替换中间内容区。
	 * 指令参数：旧货信息类型(sell/buy)|发布人id
	 */
	function searchFleaAsCreuser($urlInfo){
		$p = $urlInfo['params'];
		$ta = array(
			'optType' => $p[1],
			'creuser' => intval($p[2]),
		);
		self::tpl($ta);
	}

	
	/**
	 * @shell
	 * @废弃？？
	 * 查看他人发布的旧货信息列表
	 * 指令参数：旧货信息类型(sell/buy)|发布人id
	 */
	function listAnotherFleaInfo($urlInfo){
		
	}
	
	/**
	 * @shell
	 * 以他人视角查看旧货明细
	 * 指令参数：旧货信息类型(sell/buy)|标题编码
	 */
	protected function browseFleaDetail($u){
		//旧货分类的查询
		//$fleatypes = AiMySQL::queryEntity('fleatype', null, AiMySQLCombination::COMB_AND, null, null, 14);//取出14个分类
		$stmt = AiMySQL::connect()->query('select id, name from fm_fleatype limit 14');
		$fleatypes = array();
		while (@$result = $stmt->fetch(PDO::FETCH_OBJ)){
			$fleatypes[] = $result;
		}
		//模板参数
		$ta = array(
			'status' => null,
			'result' => null,//查到的一条旧货记录
			'fleatypes' => $fleatypes, //旧货分类集合（左菜单）
			'optType' => null,//操作类型sell/buy
			'fleatype' => '杂货', //旧货分类，查不到时默认为杂货
			'creuser' => '匿名用户', //发布人，查不到时默认为匿名（除非系统有BUG，否则不可能有）
			//'books' => array(),//该旧货信息下对应的预订集合
			//'booknum' => 0,//该旧货信息下对应的预订条数
		);
		$p = $u['params'];
		$opt = $p[1];
		$tc = $p[2];
		$ta['optType'] = $opt;
		$rs = AiMySQL::queryEntity($opt, array(new AiMySQLCondition('titlecode', '=', $tc)));
		if($rs) foreach ($rs as $r){
			$ta['status'] = 'SUCCESS';
			$ta['result'] = $r;//旧货信息结果
			$fts = AiMySQL::queryEntity('fleatype',array(new AiMySQLCondition('id', '=', $r->fleatypefk)));
			if($fts) foreach ($fts as $ft) $ta['fleatype'] = $ft->name;//旧货分类的显示名
			$users = AiMySQL::queryEntity('users', array(new AiMySQLCondition('id', '=', $r->creuser)));
			if($users) foreach ($users as $user) $ta['creuser'] = $user->username;//发布人的显示名
		}else {
			$ta['status'] = 'NOTFOUND';
		}
		self::tpl($ta);
	}
}
			