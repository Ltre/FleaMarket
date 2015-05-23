<?php
class  UserUtil{
	/**
	 * 获取用户头像链接	<br>
	 * @invoked 个人信息页调用
	 * @param int $id 用户id
	 * @return string 图片所在位置，如../public res/img/userinfo/1.jpg
	 */
	static function getUserAvatarUrl($id){
		$prefix = '../public/res/img/userinfo/';
		$null = $prefix . 'usernull.gif';
		$flag = false;
		$img = '';
		foreach (array('jpg','jpeg','png','gif') as $ext){
			$img = $prefix . $id . '.' . $ext;
			$flag = file_exists($img);
			if($flag) break;
		}
		return $flag ? $img : $null;
	}
	static function showtable($info){
		$sql="SELECT  `id` ,  `username` ,  `name` ,  `sid` ,  `email`,`credit`
			FROM  `fm_users`
			LIMIT ".$info." , 10";
		$users=AiMySQL::queryCustom($sql);
		$result="";
		foreach ($users as  $user){
			$sdf= '<tr><td class="center"><label><input type="checkbox" class="ace" /><span class="lbl"></span></label></td><td class="ai-user" shell="chaxun" params="'.$user['id'].'">'.$user['username'].
			'</td><td class="ai-user" shell="chaxun" params="'.$user['id'].'">'.$user['name'].
			'</td><td class="hidden-480 ai-user" shell="chaxun" params="'.$user['id'].'">'.$user['sid'].
			'</td><td class="ai-user" shell="chaxun" params="'.$user['id'].'">'.$user['email'].'</td><td class="hidden-480 ai-user" shell="chaxun" params="'.$user['id'].'"><span class="label label-sm label-warning">'.$user['credit'].'</span>
														</td><td>
															<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
																<a class="blue ai-user" href="#" shell="chaxun" params="'.$user['id'].'">
																	<i class="icon-zoom-in bigger-130"></i>
																</a>
		
																
		
																<a class="red ai-udelete" href="#" shell="userdelete" params="'.$user['id'].'|'.$user['username'].'">
																	<i class="icon-trash bigger-130"></i>
																</a>
															</div>
		
															<div class="visible-xs visible-sm hidden-md hidden-lg">
																<div class="inline position-relative">
																	<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
																		<i class="icon-caret-down icon-only bigger-120"></i>
																	</button>
		
																	<ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">
																		<li>
																			<a href="#" class="tooltip-info" data-rel="tooltip" title="View">
																				<span class="blue">
																					<i class="icon-zoom-in bigger-120"></i>
																				</span>
																			</a>
																		</li>
		
																		<li>
																			<a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
																				<span class="green">
																					<i class="icon-edit bigger-120"></i>
																				</span>
																			</a>
																		</li>
		
																		<li>
																			<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
																				<span class="red">
																					<i class="icon-trash bigger-120"></i>
																				</span>
																			</a>
																		</li>
																	</ul>
																</div>
															</div>
														</td></tr>';
			$result.=$sdf;
		}
		return  $result;
	}
}