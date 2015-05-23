<?php
class PunishstyleAction extends ActionUtil{
	public  function updatapss ($urlinfo){
		$info=$urlinfo['params'];
		$pname = $info[1];
		$puncode = $info[2];
		$details = $info[3];
		//echo "test".$pname.',  '.$puncode.',  '.$details."sf";
		$sql = 'INSERT INTO `fleamarket`.`fm_punishstyle` (`id`, `name`, `puncode`, `details`, `rolefk`, `duration`, `duraunitfk`) 
				VALUES (NULL, "'.$pname.'", "'.$puncode.'", "'.$details.'", "3", "7", "1");';
		$isset=AiMySQL::queryCustom($sql);
		if(!$isset){
			echo "添加成功！";
		}
		else{
			echo "添加失败！";
		}
		
	}
}