<?php
class IndexAction extends ActionUtil {
	public function index($urlInfo){
// 		ActionUtil::action('Help')->shelltest($urlInfo);
		ActionUtil::action('Help')->help($urlInfo);
	}
}