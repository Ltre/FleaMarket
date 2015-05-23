
<html>
<head>
 </head>
   <body>
<form class="ai-form" id="updatausers">
	<table class='userslist'>
<?php
   $user=ActionUtil::getTplArgs();
   get_object_vars($user);
  $listkey = array('id'=>'ID',
					'username' =>    '用户名',
  					'rolefk'   =>    '角色',
					'password' =>    '密码',
					'sid'      =>    '学号',
					'email'    =>    '邮箱',
					'name'     =>    '姓名',
					'gender'   =>    '性别',
					'groupfk'  =>    '群组',
					'summary'  =>    '简介',
					'credit'   =>    '信用值',
					'score'    =>    '积分',
					'toolspace'=>    '道具空间上限',
					); 
 //print_r($listkey);
	$n=0;   
   foreach ($listkey as $index => $value){
   	$n++;
   	if($user->$index==null)
   		$user->$index="无";
   	if($index=='password'){
   		echo "<tr><td>".$listkey[$index].":</td>".'<td><input type="password" class="ai-args-'.$n.'" value="'.$user->$index.'" disabled="disabled"/></td></tr>';
   		continue;
   	}
    if($index == 'rolefk'){
   		echo "<tr><td>".$listkey[$index].":</td>".'<td><input type="text" id="ai-rolefk" class="ai-args-'.$n.'" value="'.$user->$index.'" disabled="disabled"/></td></tr>';
   		continue;
   	} 
   	if ($index == 'summary'){
   		echo "<tr><td>".$listkey[$index].":</td>".'<td><textarea  class="ai-args-'.$n.'"disabled="disabled">'.$user->$index.'</textarea></td></tr>';
   		continue;
   	}
   	echo "<tr><td>".$listkey[$index].":</td>".'<td><input type="text" class="ai-args-'.$n.'" value="'.$user->$index.'" disabled="disabled"/></td></tr>';
   } 
   ?>
   </table>
   <input id="ai-submit" type="button" class="ai-submit"  value="修改信息" onclick="usersubmit();" />
</form>

</body>
   </html>