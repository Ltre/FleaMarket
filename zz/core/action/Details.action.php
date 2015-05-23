<?php
class DetailsAction extends ActionUtil{
	public function personal($urlinfo){
		//var_dump(AiMySQL::connect());
		$this->tpl();//输出默认页面
		
	}
	public function detail($urlinfo){
		//var_dump(AiMySQL::connect());
		$this->tpl();
	}
	public function formwork($urlinfo){
		//var_dump($urlinfo);
		$urlform = $urlinfo['params'][1];
		$userinfo = require_once ACTION_TEMPLATE_DIR."Details/".$urlform.".php";
		return  $userinfo;
	}
	public function  usertable($info){
		$args=$info['params'][1];
		
		$this->tpl($args);
	}
	
}
?>