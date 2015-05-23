<?php
class TestAction extends ActionUtil{
	public function test(){
		$this->tpl();//输出默认页面
		/* $test = require_once ACTION_TEMPLATE_DIR. "Details/userlist.php";
		echo $test; */
	}
}