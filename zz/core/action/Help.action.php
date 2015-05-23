<?php
class HelpAction extends ActionUtil{
	
	//测试URL指令
	public function shelltest($urlInfo){
		self::tpl(null);
	}
	
	public function help($urlInfo){
// 		var_dump($urlInfo);
		self::tpl(null);
		
	}
	
}