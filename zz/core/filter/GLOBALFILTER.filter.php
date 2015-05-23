<?php
class GLOBALFILTER{
	/**
	 * 全局过滤器
	 * 首先从doFilter开始执行，
	 * 而后执行后续过滤器链doFilter_*()，“*”代表数字1,2,3,4...
	 * 过滤器链中相邻两个方法的名称的数字部分也必须相邻，
	 * 否则将在“断链”处终止过滤，直接进入后续业务。
	 * @param $urlInfo
	 */
	public static function doFilter( $urlInfo ){
		/* 这里填充全局过滤的过程，例如会话验证 */
// 		echo '全局过滤器：'.__CLASS__.'::'.__METHOD__.'()执行<br>';
		//会话不存在则转到登录页
		$subject=$_SERVER['REQUEST_URI'];
		$isset=preg_match("/(zz)+(\/.*)*/", $subject);
		if($isset){
			@$usr=$_SESSION['user'];
			if ( isset($_SESSION['user']) && $usr->rolefk==1 ){
				die(str_repeat('<br>', 6)."<center style='font-size:48px;font-weight:bold;font-family:微软雅黑;'>Ooops！！404.<br>访问的页面不存在</center>");
			}
		}
		
		if(!isset($_SESSION['user'])){
			require_once ACTION_TEMPLATE_DIR . 'Login/login.php';
			exit;//记住要终止脚本
		}
		//拦截普通用户登录后台
		else{
			$user=$_SESSION['user'];
			$sql="select u.id as uid , r.rolecode as rolecode from fm_users as u ,fm_roles as r where r.id=u.rolefk and u.id =".$user->id;
			$rolelist=AiMySQL::queryCustom($sql);
			$rolekey = $rolelist[0]['rolecode'];
		if($rolekey=="COMMON"){
			
			require_once ACTION_TEMPLATE_DIR . 'Login/login.php';
			exit;//记住要终止脚本
			}
		} 
	}
	public static function doFilter_1($urlInfo){
// 		echo '全局过滤器：'.__CLASS__.'::'.__METHOD__.'()执行<br>';
	}
	public static function doFilter_2($urlInfo){
// 		echo '全局过滤器：'.__CLASS__.'::'.__METHOD__.'()执行<br>';
	}
	public static function doFilter_3($urlInfo){
// 		echo '全局过滤器：'.__CLASS__.'::'.__METHOD__.'()执行<br>';
	}
}