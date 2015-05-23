<?php
class LoginAction extends ActionUtil{
	public function login(){
		$this->tpl();//输出默认页面
	}
	//验证用户登录信息
	public function  loginCheck($userinfo){
		$username=$userinfo['params'][1];
		$pw = sha1($userinfo['params'][2]);
		//print_r($userinfo) ;
		//var_dump($userinfo);
		$c1 = array(
				new AiMySQLCondition('username', '=', $username),
				new AiMySQLCondition('password', '=', $pw)
		);
		$c2 = array(
				new AiMySQLCondition('sid', '=', $username),
				new AiMySQLCondition('password', '=', $pw)
		);
		$rs1 = AiMySQL::queryEntity('users', $c1);
		$rs2 = AiMySQL::queryEntity('users', $c2);
		$r1 = null;
		$r2 = null;
		foreach ($rs1 as $r1);
		foreach ($rs2 as $r2);
		if(! $r1 && ! $r2){
			//用户不存在
			//$feedback['msg'] = UserUtil::generateLoginReport();
			$html="<h3>登录失败"."</h3>";
			$html .="<p>用户名或密码错误！</p>";
			print_r($html);
		}else{
			$_SESSION['user'] = $r1 ? $r1 : $r2;
			
			require_once ACTION_TEMPLATE_DIR . 'Details/detail.php';
			//return $html;
		}
		
	}  
	/**
	 * @shell
	 * 用户退出
	 */
	function user_logout($urlInfo){
		$islogout = session_destroy() ? 1 : 0;
		if($islogout==1){
			require_once ACTION_TEMPLATE_DIR . 'Login/login.php';
		}
	}
}