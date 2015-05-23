<?php
class UserinfoAction extends ActionUtil{
	//统一查询
	
	public function chaxun($urlinfo){
		$userinfo= $urlinfo['params'];
		$userid = $userinfo[1];
		$sql="SELECT u.id AS id, u.rolefk AS roleid, u.username AS username, u.password AS password, u.groupfk AS groupfk, u.name AS name, u.gender AS gender, u.sid AS sid, u.email AS email, u.summary AS summary, u.credit AS credit, u.score AS score, u.toolspace AS toolspace, r.name AS rolefk
				FROM fm_users AS u, fm_roles AS r
				WHERE u.rolefk = r.id and u.id='".$userid."'";
		$users = AiMySQL::queryCustom($sql);
		//var_dump($users);
		$isuser=null;
		$user = new Users();
		if(count($users)!=0)
		{	
		foreach ($users as $isuser);
		//var_dump($isuser);
		foreach ($user as $index => $value){
			$user->$index =  $isuser[$index];
			//echo $index ."=>". $user->$index."<br>";
		} 
		echo $user->username."的详细信息如下：";
		$this->tpl($user);
		}else {
			echo '<li><b>暂无数据</b></li>';
		}
		
	}
	//更新用户信息
	public function updatausers($urlinfo){
		$userinfo= $urlinfo['params'];
		for ($j=0;$j<count($userinfo);$j++){
			if($userinfo[$j]=="无")
			$userinfo[$j]=null;
		}
		$userarray=array('id'=>intval($userinfo[1]),
				'username' =>  $userinfo[2],
				'rolefk'   =>  intval($userinfo[3]),
				'password' =>  $userinfo[4],
				'sid'      =>  $userinfo[5],
				'email'    =>  $userinfo[6],
				'name'     =>    $userinfo[7],
				'gender'   =>    $userinfo[8],
				'groupfk'  =>    $userinfo[9],
				'summary'  =>    $userinfo[10],
				'credit'   =>    intval($userinfo[11]),
				'score'    =>    intval($userinfo[12]),
				'toolspace'=>    intval($userinfo[13]),
		);
		//print_r($userinfo);
		//print_r($userarray);
		$user = new Users();
		foreach ($userarray as $index => $value){
			$user->$index = $value;
		}
		//echo $user->id;
		$sql="select password from fm_users as u where id=".$user->id;
		$userkey=AiMySQL::queryCustom($sql);
		foreach ($userkey as $olduser);
		$oldpw = $olduser['password'];
		//print_r($oldpw);
		if($user->password==$oldpw);
		else {$user->password=sha1($user->password);}
		$iss_success = Tableutil::update_with_prepare($user);
		if ($iss_success){
			echo "更新成功!";
		}
		else echo "更新失败!";
		
	}
	//删除用户
	public function userdelete($urlinfo){
		$userinfo = $urlinfo['params'];
		$userId = $userinfo[1];
		$user = new Users();
		$user->id = $userId;
		$is_success = AiMySQL::delete($user);
		if($is_success!=false){
			echo "用户".$user->username."删除成功！";
		}
		else {
			echo "删除失败！";
		}
		exit;
	}
}
?>