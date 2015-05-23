<?php
class AssignmentAction extends ActionUtil {
	
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
		$sql = 'select *,s.id as sellid,t.name as fleatypename from fm_sell as s, fm_fleatype as t where s.fleatypefk = t.id';
		$total = AiMySQL::getNumsOfRs($sql);//数据库可查询到的总结果集数
		$records = array();//结果集
		$records = AiMySQL::queryCustomByParams(
			$sql, 
			array(),
			$num, $start
		);
// 		OrekiUtil::var_dump_array($records);
// 		exit;
		$tplArgs = array(
				//class=page_content指定的正文区域内容（自定义内容）
				'page_content'	=>	'zzACE/Assignment/sell/content.php',
				//<!-- page specific plugin scripts -->导入的js标签（包含ACE自己导入的）
				'ace_js'	=>	'zzACE/Assignment/sell/jstag.php',
				//<!-- page specific plugin styles -->导入的css标签（包含ACE自己导入的）
				'ace_css'	=>	'zzACE/Assignment/sell/csstag.php',
				//<!-- inline scripts related to this page -->页内嵌入的脚本（包含ACE自身的）
				'ace_inline'=>	'zzACE/Assignment/sell/injs.php',
				//自定义的外挂js
				'javascript'=>	'res/js/selllist.js',
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
		require_once OTHER_TEMPLATE_DIR.'zzACE/acetpl.php';//包含公共模板
	}
	
	/**
	 * @shell
	 * 列出求购记录
	 * AI参数顺序：结果集个数|遍历开始索引
	 * 常规POST参数：暂无
	 */
	function listSelfBuy($urlInfo){
		$p = $urlInfo['params'];
		$num = intval($p[1]);//页内显示结果集数
		$start = intval($p[2]);//页内结果集开始索引
		$sql = 'select *,s.id as sellid,t.name as fleatypename from fm_buy as s, fm_fleatype as t where s.fleatypefk = t.id';
		$total = AiMySQL::getNumsOfRs($sql);//数据库可查询到的总结果集数
		$records = array();//结果集
		$records = AiMySQL::queryCustomByParams(
				$sql,
				array(),
				$num, $start
		);
		// 		OrekiUtil::var_dump_array($records);
		// 		exit;
		$tplArgs = array(
				//class=page_content指定的正文区域内容（自定义内容）
				'page_content'	=>	'zzACE/Assignment/buy/content.php',
				//<!-- page specific plugin scripts -->导入的js标签（包含ACE自己导入的）
				'ace_js'	=>	'zzACE/Assignment/buy/jstag.php',
				//<!-- page specific plugin styles -->导入的css标签（包含ACE自己导入的）
				'ace_css'	=>	'zzACE/Assignment/buy/csstag.php',
				//<!-- inline scripts related to this page -->页内嵌入的脚本（包含ACE自身的）
				'ace_inline'=>	'zzACE/Assignment/buy/injs.php',
				//自定义的外挂js
				'javascript'=>	'res/js/buylist.js',
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
		require_once OTHER_TEMPLATE_DIR.'zzACE/acetpl.php';//包含公共模板
	}
	
	
	
	
}