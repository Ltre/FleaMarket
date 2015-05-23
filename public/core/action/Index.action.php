<?php
class IndexAction extends ActionUtil {
	public function index($urlInfo){
		//ActionUtil::action('Help')->help($urlInfo);取消自动将首页设置为HELP
		
		//取消tpl()输出，直接用header()
		header('Location: ./fkb');
		return;
		
		//self::tpl();
	}
	
	/**
	 * 目前废弃，仅供实验用
	 */
	function matrix(){
		$_SESSION['matrix'] = true;//如果被请求了首页，将自动转到matrix-matrix模板，详见help.php的Action模板
	}
	
	/**
	 * 目前废弃，仅供实验用
	 */
	function unmatrix(){
		//unset($_SESSION['matrix']);
		session_destroy();
	}
}