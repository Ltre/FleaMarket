<?php
class  AuthorityinfoAction extends ActionUtil{
	public  function searchAuthority ($urlinfo){
		$userid = $urlinfo['params'][1];
		$sql = "select u.id as uid,u.username as uname,au.id as auid,au.optcode as optcode,au.name as auname
				from fm_authority as au , fm_userauthority as ua ,fm_users as u
				where ua.authority=au.id and u.id=ua.userfk and u.id='".$userid."'";
		$authlist = AiMySQL::queryCustom($sql);
		$newlist= array();
		for($i=0;$i<count($authlist);$i++){
			$newlist[$i]['auid']=$authlist[$i]['auid'];
			$newlist[$i]['uid']= $authlist[$i]['uid'];
			$newlist[$i]['optcode']=$authlist[$i]['optcode'];
		}
		if($newlist!=null){
			print_r("用户  <b style='color:red;'>".$authlist[0]['uname']."</b>的权限：");
			$this->tpl($newlist);
		}else {
			$showlist=array(0=>array('uid'=>$userid,'auid'=>"null"));
			print_r("ID为<b style='color:red;'>".$showlist[0]['uid']."</b>的权限：");
			$this->tpl($showlist);
		}
	}
	public function upAuthority($urlinfo){
		$userid=$urlinfo['params'][1];
		//echo $userid;
		$sql = "select u.id as uid,u.username as uname,au.id as auid,au.optcode as optcode,au.name as auname
				from fm_authority as au , fm_userauthority as ua ,fm_users as u
				where ua.authority=au.id and u.id=ua.userfk and u.id='".$userid."'";
		$authlist = AiMySQL::queryCustom($sql);
		$oldlist=array(0,0,0,0,0,0,0,0,0,0);
		for($i=0;$i<count($authlist);$i++){
			//echo "yiyou:".$authlist[$i]['auid'];
			$oldlist[$authlist[$i]['auid']-1]=1;
		}
		//print_r($oldlist) ;
		$upsql=null;
		$starinsert =null;
		$stardelete = null;
		for($j=2;$j<count($urlinfo['params']);$j++){
			if($urlinfo['params'][$j]){
				//echo "xianzai :".($j-1);
				 if($oldlist[$j-2]==0){
					//echo "增加".($j-1);
					$starinsert=$starinsert."(NULL, '".$userid."', '".($j-1)."'),";
					
				} 
			}
			else{
				if($oldlist[$j-2]){
					//echo "删去".($j-1);
					$stardelete.="delete from fleamarket.fm_userauthority where (fm_userauthority.userfk=".$userid." and fm_userauthority.authority=".($j-1).");";
				}
			}
		}
		if($starinsert!=null){
			$starinsert=trim($starinsert,",");
			$upsql.="INSERT INTO `fleamarket`.`fm_userauthority` (`id`, `userfk`, `authority`) VALUES ".$starinsert.";";
			//echo "INSERT INTO `fleamarket`.`fm_userauthority` (`id`, `userfk`, `authority`) VALUES ".$starinsert.";";
		}
		if($stardelete!=null){
			$upsql.= $stardelete;
			//echo $stardelete;
		}
		
		if($upsql!=null){
			//echo $upsql;
			if (!AiMySQL::queryCustom($upsql)){
				echo "ID为：".$userid."权限修改成功！";
			}
			else {
				echo "修改失败!";
			}
		}
		else {echo "权限没有更改！";}
		
	}
		public  function authoritytable($url){
			$tableinfo= $url['params'][1];
			$this->tpl($tableinfo);
		}
}