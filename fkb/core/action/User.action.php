<?php
class UserAction extends ActionUtil{
	/**
	 * @shell
	 * 注册用户
	 */
	function user_register($urlInfo){
		$flag = true;
		$feedback = array(
			'duplicate'	=> array(),
			'toolong' => array(),
			'format' => array()
		);
		$p = $urlInfo['params'];
		$u = new Users();
		$u->username = $p[1];
		$u->name = $p[2];
		$u->sid = $p[3];
		$u->email = $p[4];
		$u->password = sha1($p[5]);
		$u->rolefk = UserUtil::getIdFromCommonRole();//设定普通角色
		//查询系统规则：信用度的初始值
		$u->credit = intval(RuleUtil::getRuleInitialCredit());
		//查询系统规则：个人积分初始值
		$u->score = intval(RuleUtil::getRuleInitialScore());
		//查询系统规则：个人道具空间上限初始值
		$u->toolspace = intval(RuleUtil::getRuleInitialToolspace());
		/*
		 * 收集验证信息
		 */
		if(UserUtil::isUsernameDuplicate($u->username)){
			$feedback['duplicate'][] = 'username';
			$flag = false;
		}
		if(UserUtil::isSidDuplicate($u->sid)){
			$feedback['duplicate'][] = 'sid';
			$flag = false;
		}
		if(UserUtil::isEmailDuplicate($u->email)){
			$feedback['duplicate'][] = 'email';
			$flag = false;
		}
		if(20 < strlen($p[1])){
			$feedback['toolong'][] = 'username';
			$flag = false;
		}
		if(30 < strlen($p[5])){
			$feedback['toolong'][] = 'password';
			$flag = false;
		}
		if(! UserUtil::checkSidRegular($u->sid)){
			$feedback['format'][] = 'sid';
			$flag = false;
		}
		if(! UserUtil::checkEmailRegular($u->email)){
			$feedback['format'][] = 'email';
			$flag = false;
		}
		if($flag){
			if(AiMySQL::insert($u)){
				$feedback['status'] = 'SUCCESS';//插入成功
			}else{
				$feedback['status'] = 'EXCEPTION';//插入时发生异常，可能普通角色在数据库中不存在
			}
		}else{
			$feedback['status'] = 'ILLEGAL';//各种不合法：格式、长度、重复
		}
		//printf( json_encode($feedback) );//反馈json格式处理结果
		echo( UserUtil::generateRegisterReport_acelogin($feedback) );//反馈注册报告
		//注册完成后，静默分配权限
		AuthorityUtil::initUserAuthority( 
			TableUtil::getValueFromField(
				'users', 
				'id', 
				array(
					new AiMySQLCondition('sid', '=', $u->sid)
				)
			) 
		);
	}
	
	/**
	 * @shell
	 * 用户登录
	 */
	function user_login($urlInfo){
		$feedback = array(
			'status' => null,
			'msg' => null
		);
		$u = $urlInfo['params'][1];
		$p = sha1($urlInfo['params'][2]);
		$c1 = array(
			new AiMySQLCondition('username', '=', $u),
			new AiMySQLCondition('password', '=', $p)
		);
		$c2 = array(
			new AiMySQLCondition('sid', '=', $u),
			new AiMySQLCondition('password', '=', $p)
		);
		$rs1 = AiMySQL::queryEntity('users', $c1);
		$rs2 = AiMySQL::queryEntity('users', $c2);
		$r1 = null;
		$r2 = null;
		foreach ($rs1 as $r1);
		foreach ($rs2 as $r2);
		if(! $r1 && ! $r2){
			$feedback['status'] = 'FAILURE';
			$feedback['msg'] = UserUtil::generateLoginReport_acelogin();
		}else{
			$feedback['status'] = 'SUCCESS';
			$_SESSION['user'] = $r1 ? $r1 : $r2;
			//require_once OTHER_TEMPLATE_DIR.'matrix/matrix.php';
		}
		echo json_encode($feedback);
	}
	
	/**
	 * @shell
	 * 用户退出
	 */
	function user_logout($urlInfo){
		session_unset();
		//require_once OTHER_TEMPLATE_DIR.'matrix/matrix.php';
	}
	
	/**
	 * @shell
	 * 用户密码找回
	 * 指令参数：邮箱
	 */
	function user_find($u){
		$feedback = array(
			'status' => null, //SUCCESS|NOTFOUND|EXCEPTION|FORMAT
			'tip' => '提示',
		);
		$email = $u['params'][1];
		if(! UserUtil::checkEmailRegular($email)){
			$feedback['status'] = 'FORMAT';
			$feedback['tip'] = '邮箱格式不正确';
		}else {
			$rs = AiMySQL::queryEntity('users', array(new AiMySQLCondition('email', '=', $email)));
			$r = null;
			if($rs) foreach ($rs as $r);
			if(!$r){
				$feedback['status'] = 'NOTFOUND';
				$feedback['tip'] = '该邮箱不存在';
			}else{
				$content = '你申请了找回密码服务，学号是'.$r->sid.'，用户名是'.$r->username.'<br><br>';
				$content .= '新密码：'.$r->password.'<br><br>';
				$content .= '登录后可到个人档中修改密码<br><br>';
				$content .= '<div style="float:right;"><span>Oriki开发团队<br></div>';
				
				// ============添加发送邮件的代码
				//$flag = mail($email, '找回密码服务——华软旧货市场', $content);
				$smtp = "smtp.163.com"; // SMTP邮件发送服务器
				$title = "找回密码服务——华软旧货市场"; // 邮件标题
				//$username = "qq邮箱帐户"; // SMTP用户名
				$username = "wocaonimashadansi"; // SMTP用户名
				//$passwd = "邮箱密码"; // SMTP密码
				$passwd = "wocaonimashadan"; // SMTP密码
				// $mailfrom = "qq邮箱帐户下的地址，也就是自己的QQqq邮箱地址，不能填别人的"; // 发送人
				$mailfrom = "wocaonimashadansi@163.com"; // 发送人
				$mailfrom1 = "wocaonimashadansi@scse.com.cn"; // 回复邮件人
				$rcptto = "fkb1021@163.com"; // 收件人
				$mail = $content; // 邮件正文
				$tips = null;//反馈提示
				EmailUtil::smail ( $smtp, $title, $username, $passwd, $mailfrom, $mailfrom1, $rcptto, $mail, $tips );

				//if($flag){
				if(strpos($tips, 'err_')===false){
					$feedback['status'] = 'SUCCESS';
					$feedback['tip'] = "邮件找回密码的功能还在开发中。。（新密码已发送至邮箱，请查收！）".$tips;
				}else{
					$feedback['status'] = 'EXCEPTION';
					$feedback['tip'] = '出现了异常，暂时无法找回，系统将尽快修复'.$tips;
				}
			}
		}
		print json_encode($feedback);
	}
	
	/**
	 * 修改个人信息
	 * 指令参数：用户名|邮箱|学号|？|？|？
	 * 常规POST参数：性别gender/简介summary。（特殊用法：使用前三个参数）
	 */
	function updateProfile($u){
		$feed = array(
			'status' => null,
			'msg' => null,
			'duplicate' => array(),
			'format' => array(),
		);
		$tips = null;//提示信息
		$flag = true;
		$p = $u['params'];
		$un = $p[1];
		$em = $p[2];
		$sid = $p[3];
		$gd = $_POST['gender'];
		$sm = $_POST['summary'];
		
		$user = TableUtil::getEntityFromField('users', array(new AiMySQLCondition('id', '=', $_SESSION['user']->id)));
		$user->init(array(
				'username' => $un,
				'email' => $em,
				'sid' => $sid,
				'gender' => $gd,
				'summary' => $sm,
		));
		
		//判断长度
		if(20 < strlen($un)){
			$tips .= '用户名长度超过20 . ';
			$feedback['toolong'][] = 'username';
			$flag = false;
		}
		if(35 < strlen($em)){
			$tips .= '邮箱长度超过35 . ';
			$feedback['toolong'][] = 'email';
			$flag = false;
		}
		//判断格式
		if(! UserUtil::checkSidRegular($sid)){
			$tips .= '学号必须是10位数字 . ';
			$feedback['format'][] = 'sid';
			$flag = false;
		}
		if(! UserUtil::checkEmailRegular($em)){
			$tips .= '邮箱格式错误 . ';
			$feedback['format'][] = 'email';
			$flag = false;
		}
		
		//判断用户名是否被用
		if($user->username!=$un && UserUtil::isUsernameDuplicate($un)){
			$feed['duplicate'][] = 'username';
			$tips .= '设定的用户名已存在 . ';
			$flag = false;
		}
		//判断学号是否被用
		if($user->sid!=$sid && UserUtil::isSidDuplicate($sid)){
			$tips .= '设定的学号已存在 . ';
			$feed['duplicate'][] = 'sid';
			$flag = false;
		}
		//判断邮箱是否被用
		if($user->email!=$em && UserUtil::isEmailDuplicate($em)){
			$tips .= '设定的邮箱已存在 . ';
			$feed['duplicate'][] = 'email';
			$flag = false;
		}
		
		if(!$flag){
			$feed['status'] = 'ILLEGAL';
			$feed['msg'] = $tips;
			die(json_encode($feed));
		}
		
		if(TableUtil::update_with_prepare($user)){
			$feed['status'] = 'SUCCESS';
			$feed['msg'] = '更新成功';
			$_SESSION['user'] = $user;
		}else{
			$feed['status'] = 'EXCEPTION';
			$feed['msg'] = '出现了异常，代码[CNOTUPDPROF]';
		}
		print json_encode($feed);
	}
	
	/**
	 * 修改个人密码
	 * 指令参数：？|？|？|原密码|新密码|？（特殊用法：取后三个参数中的前两个）
	 * 常规POST参数：无
	 */
	function updatePassword($u){
		$feed = array(
			'status' => null,
			'msg' => null,
		);
		$flag = true;
		$user = $_SESSION['user'];
		$p = $u['params'];
		$pass = sha1($p[4]);
		$newp = sha1($p[5]);
		if($pass != $user->password){
			$feed['status'] = 'WRONGPASS';
			$feed['msg'] = '原密码错误';
			die(json_encode($feed));
		}
		$user->password = $newp;
		if(TableUtil::update_with_prepare($user)){
			$feed['status'] = 'SUCCESS';
			$feed['msg'] = '修改成功';
		}else{
			$feed['status'] = 'WRONGPASS';
			$feed['msg'] = '修改失败，[异常代码:CNOTCHGPASS]';
		}
		print json_encode($feed);
	}
	
	
	
	
}