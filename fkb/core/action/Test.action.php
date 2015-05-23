<?php
class TestAction extends ActionUtil{
	
	/**
	 * 要执行得到正确的结果，就先在数据库中清除掉这个function所插入的数据
	 */
	public function mysql($urlInfo){
		
		$role = new Roles();
		$role->name = "first";
		$role->rolecode = 'FDJSIOFDS';
		$role->cretime = "2014-2-27 00:00:00";
		OrekiUtil::var_dump_obj($role);
		AiMySQL::insert($role);
		
		$usr = new Users();
		$usr->rolefk = 1;
		$usr->username = '显示的用户名';
		$usr->password = '这是密码';
		$usr->name = 'ABC';
		$usr->sid = '1040112346';
		$usr->email = 'hehe@scse.com.cn';
		$usr->credit = 100;
		OrekiUtil::var_dump_obj($usr);
		AiMySQL::insert($usr);
	}
	
	//测试AI专用表单登录
	public function aiFormLogin($urlInfo){
		$p = $urlInfo['params'];
		echo "\r\n用户名————" . $p[1] . "\r\n密码————" . $p[2];
	}
	
	/**
	 * 测试：AuthorityUtil.class.php
	 */
	public function testUA($u){
		print AuthorityUtil::initUserAuthority(intval($u['params'][1])) ? '分配成功' : '分配失败';
		die;
		$preSql = 'insert into fm_userauthority ( userfk,authority ) values( :userfk0,:authority0 );insert into fm_userauthority ( userfk,authority ) values( :userfk1,:authority1 );insert into fm_userauthority ( userfk,authority ) values( :userfk2,:authority2 );insert into fm_userauthority ( userfk,authority ) values( :userfk3,:authority3 );insert into fm_userauthority ( userfk,authority ) values( :userfk4,:authority4 );insert into fm_userauthority ( userfk,authority ) values( :userfk5,:authority5 );insert into fm_userauthority ( userfk,authority ) values( :userfk6,:authority6 );insert into fm_userauthority ( userfk,authority ) values( :userfk7,:authority7 );insert into fm_userauthority ( userfk,authority ) values( :userfk8,:authority8 );insert into fm_userauthority ( userfk,authority ) values( :userfk9,:authority9 );';
		// 'insert into fm_userauthority (userfk, authority) values(:userfk1,:authority1);insert into fm_userauthority (userfk, authority) values(:userfk2,:authority2);'
		$stmt = AiMySQL::connect()->prepare($preSql);
		$affect = $stmt->execute(array(
		    "userfk0"    =>    9     ,
		    "authority0"    =>    6  ,
		    "userfk1"    =>    9     ,
		    "authority1"    =>    3  ,
		    "userfk2"    =>    9     ,
		    "authority2"    =>    8  ,
		    "userfk3"    =>    9     ,
		    "authority3"    =>    7  ,
		    "userfk4"    =>    9     ,
		    "authority4"    =>    5  ,
		    "userfk5"   =>    9     ,
		    "authority5"   =>    2  ,
		    "userfk6"    =>    9     ,
		    "authority6"   =>    4  ,
		    "userfk7"    =>    9     ,
		    "authority7"   =>    1  ,
		    "userfk8"   =>    9     ,
		    "authority8"    =>    10 ,
		    "userfk9"    =>    9     ,
		    "authority9"    =>    9  ,
		));
		var_dump($affect);
	}
	
}