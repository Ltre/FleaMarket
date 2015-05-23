<?php
$info = ActionUtil::getTplArgs();
$sql="select u.id as uid , u.username as uname , r.name as rname ,u.sid as sid from fm_roles as r,fm_users as u
		where r.id=u.rolefk LIMIT ".$info." , 10";
$userlist = AiMySQL::queryCustom($sql);

$result="";
foreach ($userlist as $user){
	$result.= '<tr class="ai-auth" shell="searchAuthority" params="'.$user['uid'].'"><td>'.$user['uname'].'</td><td>'.
			$user['rname'].'</td><td>'.$user['sid'].'</td><td><a >www.baidu.com'.'</a></td></tr>';
}
if($result!=null){
	echo $result.'<script src="res/js/authoritytable.js"></script>';
}
else echo "暂无数据！";