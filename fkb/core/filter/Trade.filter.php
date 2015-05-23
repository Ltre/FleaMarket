<?php

/**
 * 与交易有关的过滤器
 * @author Oreki
 * @since 2014-5-4
 */

class TradeFilter {
	
	/**
	 * 判断是否有权限确认交易
	 */
	private function tmp(){
		$userfk = $_SESSION['user']->id;
		$sql = "select * from fm_userauthority as ua, fm_authority as a where ua.authority = a.id and userfk = $userfk and a.optcode = 'QRJY'";
		if( 0 == count( TableUtil::queryCustom($sql) ) ){
			die(json_encode(array(
					'status' => 'NOAUTHORITY',
					'msg' => '你没有权限确认交易，或被管理员禁止。要想使用，请找有关部门 ￢▽￢ ',
			)));
		}
	}
	
	
	public function affirmTrade(){
		$this->tmp();
	}
	
	public function negateTrade(){
		$this->tmp();
	}
	
}