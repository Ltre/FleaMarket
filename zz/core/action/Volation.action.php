<?php
class VolationAction extends ActionUtil{
	//两个参数
	public  function upvolation($urlinfo){
		/* echo "1111111111111111111111111111111"; */
	 	$info = $urlinfo['params'];
		$id = $info[1];
		$rulevalue = $info[2];
		$sql = "UPDATE fm_rules SET rulevalue='".$rulevalue."' WHERE id=".$id;
		$result = AiMySQL::queryCustom($sql);
		if(!$result){
			echo "设置成功";
		}else {
			echo "设计失败！";
		}
	
	}
	
	//两个参数  id|name
	public function  upfleatype($urlinfo){
		$info= $urlinfo['params'];
		$id=intval($info[1]);
		$name = $info[2];
		//var_dump($info);
		$sql = "UPDATE fm_fleatype SET name='".$name."' WHERE id=".$id;
		$result = AiMySQL::queryCustom($sql);
		//var_dump($result);
		if(!$result){
			echo "修改名称成功！";
		}else {
			echo "修改失败！";
		}
	
	}
}