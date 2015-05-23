<?php

/**
 * 与预约有关的过滤器
 * @author Oreki
 * @since 2014-5-4
 */

class BookFilter {
	
	/**
	 * 判断是否有预约的权限
	 */
	public function addFleaBook(){
		$userfk = $_SESSION['user']->id;
		$sql = "select * from fm_userauthority as ua, fm_authority as a where ua.authority = a.id and userfk = $userfk and a.optcode = 'FQYY'";
		if( 0 == count( TableUtil::queryCustom($sql) ) ){
			die(json_encode(array(
				'status' => 'NOAUTHORITY',
				'msg' => '你没预约权限，或被管理员禁止。要想使用，请找有关部门 ￢▽￢ ',
			)));
		}
	}
	
	/**
	 * 判断是否有删除（自己的）预约的权限
	 */
	public function delBookInfo(){
		$userfk = $_SESSION['user']->id;
		$sql = "select * from fm_userauthority as ua, fm_authority as a where ua.authority = a.id and userfk = $userfk and a.optcode = 'SCYY'";
		if( 0 == count( TableUtil::queryCustom($sql) ) ){
			die(json_encode(array(
					'status' => 'NOAUTHORITY',
					'msg' => '你没权限删除该预约，或被管理员禁止。要想使用，请找有关部门 ￢▽￢ ',
			)));
		}
	}
	
	
}