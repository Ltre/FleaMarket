<?php

/**
 * 与消息有关的过滤器
 * @author Oreki
 * @since 2014-5-4
 */

class MessageFilter {
	
	/**
	 * 判断是否有发送私信的权限
	 */
	public function sendPersonalLetter(){
		$p = $_SESSION['urlInfo']['params'];
		$sender = intval($p[1]);
		$userfk = $_SESSION['user']->id;
		$sql = "select * from fm_userauthority as ua, fm_authority as a where ua.authority = a.id and userfk = $userfk and a.optcode = 'FSSX'";
		if( 0 == count( TableUtil::queryCustom($sql) ) ){
			die('你没有权限发送私信，或被管理员禁止。要恢复使用，请联系有关部门');
		}
	}
	
}