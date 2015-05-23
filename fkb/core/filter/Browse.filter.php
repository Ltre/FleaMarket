<?php

/**
 * 与浏览有关的过滤器，一般用于记录访问日志
 * @author Oreki
 * @since 2014-5-6
 */

class BrowseFilter{
	
	/**
	 * 按分类查询记录
	 */
	function fleatypeSearch(){
		
	}
	
	/**
	 * 按关键字搜索记录（也可记录与分类、发布人有关的关键字）
	 */
	function searchFleaAsKeyword(){
		
	}
	
	/**
	 * 查看旧货信息详情的记录
	 */
	function browseFleaDetail(){
		if(!isset($_SESSION['user']))
			return;
		$p = $_SESSION['urlInfo']['params'];
		$opt = $p[1];
		$tc = $p[2];
		$isSell = !strcasecmp($opt, 'sell');
		
		$rz = TableUtil::getEntityFromField($opt, array(new AiMySQLCondition('titlecode', '=', $tc)));
		//如果该旧货记录突然不存在了
		if(!$rz){
			BrowseAction::setTplArgs( array('status'=>'NOTFOUND') );
			require_once ACTION_TEMPLATE_DIR.'Browse/browseFleaDetail.php';
			exit;
		}
		$ar = new AccessRecord();
		$ar->init(array(
			'fleatypefk' => $rz->fleatypefk,
			'recordztype' => $isSell?'Z':'Q',
			'recordz' => $rz->id,
			'accessuserfk' => $_SESSION['user']->id,
			'accesstime' => OrekiUtil::getCurrentFormatTime(),
			'tobeuserfk' => $rz->creuser,
		));
		TableUtil::insert_with_prepare($ar);
	}
	
}