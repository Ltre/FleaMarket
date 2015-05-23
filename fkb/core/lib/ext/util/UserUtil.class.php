<?php
class UserUtil {
	/**
	 * 获取“普通用户”的角色id
	 */
	static function getIdFromCommonRole(){
		$c[] = new AiMySQLCondition('rolecode', '=', 'COMMON');
		$rs = AiMySQL::queryEntity('roles', $c);
		$r = null;
		if($rs)
			foreach ($rs as $r);
		return $r ? intval($r->id) : false;
	}
	
	/**
	 * 检测字段是否重复
	 * @util
	 * @return bool 重复（true）否则（false）
	 */
	static function isXxxDuplicate($field, $value){
		$c[] = new AiMySQLCondition($field, '=', $value);
		$rs = AiMySQL::queryEntity('users',$c);
		$r = null;
		foreach($rs as $r);
		return $r ? true : false;
	}
	/**
	 * 检查用户名是否与数据库现有的重复
	 * 一般用于新增用户
	 * @invoked UserAction::user_register()
	 * @param string $username 用户名
	 * @return bool 重复（true）否则（false）
	 */
	static function isUsernameDuplicate($username){
		return self::isXxxDuplicate('username', $username);
	}
	/**
	 * 检查学号是否与数据库现有的重复
	 * 一般用于新增用户
	 * @invoked UserAction::user_register()
	 * @param string $sid 学号
	 * @return bool 重复（true）否则（false）
	 */
	static function isSidDuplicate($sid){
		return self::isXxxDuplicate('sid', $sid);
	}
	/**
	 * 检查邮箱是否与数据库现有的重复
	 * 一般用于新增用户
	 * @invoked UserAction::user_register()
	 * @param string $email 邮箱
	 * @return bool 重复（true）否则（false）
	 */
	static function isEmailDuplicate($email){
		return self::isXxxDuplicate('email', $email);
	}
	/**
	 * 正则表达式：学号
	 * @invoked UserAction::user_register()
	 * @param string $sid 学号
	 * @return bool 匹配则true，否则false
	 */
	static function checkSidRegular($sid){
		return preg_match('/\d{10}/', $sid)
			? true : false;
	}
	/**
	 * 正则表达式：邮箱
	 * @invoked UserAction::user_register()
	 * @param string $email 邮箱
	 * @return bool 匹配则true，否则false
	 */
	static function checkEmailRegular($email){
		return preg_match('/^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/', $email)
			? true : false;
	}
	/**
	 * 生成注册报告（Flate-app视图使用）
	 * @将废弃，原因是FlatApp-login视图需要外网流量才可正常加载
	 * 由generateRegisterReport_acelogin()代替
	 * @html
	 * @invoked UserAction::user_register()
	 * @param array $feedback 反馈信息的数组
	 * @return string $report 报告描述字符串
	 */
	static function generateRegisterReport($feedback){
		$report = '<h5>';
		$s = $feedback['status'];
		$report .= 'SUCCESS'==$s
			? "注册成功！" : ('EXCEPTION'==$s
				? '注册出现了异常，将尽快修复！'
					: '以下信息存在问题：<br>');
		$report .= '</h5>';
		if('SUCCESS'==$s)
			$report .= '<button>现在登录！</button>';
		foreach ($feedback['duplicate'] as $f){
			$f = 'username'==$f ? '用户名'
				: ('sid'==$f ? '学号' : '邮箱');
			$report .= '<h5>' . $f . '已存在</h5>';
		}
		foreach ($feedback['format'] as $f){
			$f = 'sid'==$f ? '学号' : '邮箱';
			$report .= '<h5>' . $f . '格式不正确</h5>';
		}
		foreach ($feedback['toolong'] as $f){
			$f = 'username'==$f ? '用户名不能超过20字符'
				: '密码不能超过30字符';
			$report .= '<h5>' . $f . '</h5>';
		}
		$html = '<div id="ai-register-rs" class="modal hide fade in" aria-hidden="false" style="display:block;">';
		$html .= '<div class="modal-header"><button type="button" class="close" data-dismiss="modal">×</button><h4>注册结果</h4></div>';
		$html .= '<div class="modal-body text-left">';
		$html .= $report;
		$html .= '</div></div>';
		return $html;
	}
	
	/**
	 * 生成注册报告（ace-login视图使用）
	 * @html
	 * @invoked UserAction::user_register()
	 * @param array $feedback 反馈信息的数组
	 * @return string $report 报告描述字符串
	 */
	static function generateRegisterReport_acelogin($feedback){
		$report = '<h5>';
		$s = $feedback['status'];
		$report .= 'SUCCESS'==$s
		? "注册成功！" : ('EXCEPTION'==$s
				? '注册出现了异常，将尽快修复！'
				: '以下信息存在问题：<br>');
		$report .= '</h5>';
		if('SUCCESS'==$s)
			$report .= '<button id="regresult">现在登录！</button>';
		foreach ($feedback['duplicate'] as $f){
			$f = 'username'==$f ? '用户名'
					: ('sid'==$f ? '学号' : '邮箱');
			$report .= '<h5>' . $f . '已存在</h5>';
		}
		foreach ($feedback['format'] as $f){
			$f = 'sid'==$f ? '学号' : '邮箱';
			$report .= '<h5>' . $f . '格式不正确</h5>';
		}
		foreach ($feedback['toolong'] as $f){
			$f = 'username'==$f ? '用户名不能超过20字符'
					: '密码不能超过30字符';
			$report .= '<h5>' . $f . '</h5>';
		}
		$html = $report;
		return $html;
	}
	
	/**
	 * 生成登录失败的报告（Flat-App视图使用）
	 * @将废弃，原因是FlatApp-login视图需要外网流量才可正常加载
	 * 由generateLoginReport_acelogin()代替
	 * @html
	 * @invoked UserAction::user_login()
	 * @return string $report 报告描述字符串
	 */
	static function generateLoginReport(){
		$html = '<div id="ai-login-rs" class="modal hide fade in" aria-hidden="false" style="display:block;">';
		$html .= '<div class="modal-header"><button type="button" class="close" data-dismiss="modal">×</button><h4>登录提示</h4></div>';
		$html .= '<div class="modal-body text-left">';
		$html .= '<h5>登录失败</h5><p>用户名/学号或密码有误</p>';
		$html .= '</div></div>';
		return $html;
	}
	
	/**
	 * 生成登录失败的报告（ace-login视图使用）
	 * @html
	 * @invoked UserAction::user_login()
	 * @return string $report 报告描述字符串
	 */
	static function generateLoginReport_acelogin(){
		$html = '<h5>登录失败</h5>';
		$html .= '<p style="font-size:16px;font-family:微软雅黑;font-weight:bold;">用户名/学号或密码有误</p>';
		return $html;
	}
	
	/**
	 * 获取用户头像链接	<br>
	 * @invoked 个人信息页调用
	 * @param int $id 用户id
	 * @return string 图片所在位置，如../public res/img/userinfo/1.jpg
	 */
	static function getUserAvatarUrl($id){
		$prefix = '../public/res/img/userinfo/';
		$null = $prefix . 'usernull.gif';
		$flag = false;
		$img = '';
		foreach (array('jpg','jpeg','png','gif') as $ext){
			$img = $prefix . $id . '.' . $ext;
			$flag = file_exists($img);
			if($flag) break;
		}
		return $flag ? $img : $null;
	}
	
}