<?php

/**
 * 个人信息设置页相关的操作
 * @author Oriki
 * @since 2014-3-27
 */

class ProfileAction extends ActionUtil {
	
	/**
	 * @shell
	 * 显示个人信息页面
	 * 指令参数：用户id
	 */	
	public function displayProfile($urlInfo){
		$p = $urlInfo['params'];
		//$username = $p[1];
		$id = intval($p[1]);
		//$isSelf = !strcasecmp($username, $_SESSION['user']->username) ? true : false;
		$isSelf = !strcasecmp($id, $_SESSION['user']->id) ? true : false;
		$dir = $isSelf ? 'self' : 'else';
		$tplArgs = array(
				//class=page_content指定的正文区域内容（自定义内容）
				'page_content'	=>	'ace/profile/'.$dir.'/content.php',
				//<!-- page specific plugin scripts -->导入的js标签（包含ACE自己导入的）
				'ace_js'	=>	'ace/profile/'.$dir.'/jstag.php',
				//<!-- page specific plugin styles -->导入的css标签（包含ACE自己导入的）
				'ace_css'	=>	'ace/profile/'.$dir.'/csstag.php',
				//<!-- inline scripts related to this page -->页内嵌入的脚本（包含ACE自身的）
				'ace_inline'=>	'ace/profile/'.$dir.'/injs.php',
				//自定义的外挂js
				'javascript'=>	'res/js/profile/'.$dir.'.js',
				'action'	=>	'个人信息页',	//所在的模块
// 				'operation'	=>	'设置与操作',	//所在的功能
				//具体模板的专用参数，结构自己定义
				'args'		=>	array(
					//被查看个人信息的用户实体 
					'destuser' => $isSelf ? $_SESSION['user'] : TableUtil::getEntityFromField('users', array(new AiMySQLCondition('id','=',$id))),
					
				),
		);
		if($isSelf)
			$this->displaySelfProfile($p, $tplArgs);
		else 
			$this->displayElseProfile($p, $tplArgs);
		self::setTplArgs( $tplArgs );
		require_once OTHER_TEMPLATE_DIR.'ace/tpl.php';//包含公共模板
	}
	
	/**
	 * 显示自己的个人信息页面
	 * ['args']['contacts']
	 * ['args']['collects']
	 */
	private function displaySelfProfile($p, &$t){
		$t['operation'] = '设置与操作';
		$a = &$t['args'];
		//查询自己的联系人
		$rs = array();
		$rs = AiMySQL::queryCustomByParams(
			'select u.id as id, c.cretime as cretime, u.username as username from fm_contacts as c, fm_users as u where c.rightuser = u.id and leftuser = :leftuser ', 
			array(
				'leftuser'=>intval($_SESSION['user']->id)
			)
		);
		$a['contacts'] = $rs?$rs:array();//联系人二维数组，一维数字、二维（id,username,cretime）。为空时，返回空数组
		//获取自己的收藏列表
		$rs = AiMySQL::queryCustomByParams(
			AiSQL::getSqlExpr('listMyCollect'), 
			array(
				'creuser' => $_SESSION['user']->id,
			)
		);
		$a['collects'] = $rs?$rs:array(); //收藏内容二维数组
	}
	
	/**
	 * 显示他人的个人信息页面
	 */
	private function displayElseProfile($p, &$t){
		$t['operation'] = '查看他人信息';
		$a = &$t['args'];
		//获取他人的收藏列表
		$rs = AiMySQL::queryCustomByParams(
				AiSQL::getSqlExpr('listMyCollect'),
				array(
						'creuser' => intval($p[1]),
				)
		);
		$a['collects'] = $rs?$rs:array(); //收藏内容二维数组
	}
}