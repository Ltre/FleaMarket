<?php 
/**
 * 显示自己的个人信息或设置
 * @author Oreki
 * @since 2014-3-28
 */
?>

<?php 
$user = $_SESSION['user']; //貌似暂时用不到这个变量
$ta = ActionUtil::getTplArgs();
$ar = $ta['args'];
$destuser = $ar['destuser'];//取出当前被查看个人信息的用户实体
?>

<div class="page-content">
	<!-- <div class="page-header">
		<h1>
			个人信息页
			<small>
				<i class="icon-double-angle-right"></i>
				设置与操作
			</small>
		</h1>
	</div> --><!-- /.page-header -->

	<div class="space-30"></div>

	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->

			<div class="clearfix">
				<!-- 提醒条 -->
				<div class="pull-left alert alert-success no-margin hide">
					<button type="button" class="close" data-dismiss="alert">
						<i class="icon-remove"></i>
					</button>

					<i class="icon-umbrella bigger-120 blue"></i>
					点击下方的图片设置个性化头像
				</div>
				<!-- 选择样式 -->
				<div class="pull-right">
					<span class="green middle bolder hide">Choose profile: &nbsp;</span>

					<div class="btn-toolbar inline middle no-margin">
						<div data-toggle="buttons" class="btn-group no-margin">
							<label class="btn btn-sm btn-success">
								<span class="bigger-110">个人信息和近况</span>

								<input type="radio" value="2" />
							</label>

							<label class="btn btn-sm btn-inverse">
								<span class="bigger-110">设置与修改</span>

								<input type="radio" value="3" />
							</label>
						</div>
					</div>
				</div>
			</div>

			<div class="hr dotted"></div>
			<!-- 个人信息、最近活动、联系人、图片 -->
			<div>
				<div id="user-profile-2" class="user-profile">
					<div class="tabbable">
						<ul class="nav nav-tabs padding-18">
							<li class="active">
								<a data-toggle="tab" href="#home">
									<i class="green icon-user bigger-120"></i>
									个人信息
								</a>
							</li>

							<li class="hide">
								<a data-toggle="tab" href="#feed">
									<i class="orange icon-rss bigger-120"></i>
									最近活动
								</a>
							</li>

							<li>
								<a data-toggle="tab" href="#friends">
									<i class="blue icon-group bigger-120"></i>
									联系人
								</a>
							</li>

							<li>
								<a data-toggle="tab" href="#pictures">
									<i class="pink icon-picture bigger-120"></i>
									我的收藏
								</a>
							</li>
						</ul>

						<div class="tab-content no-border padding-24">
							<div id="home" class="tab-pane in active">
								<div class="col-xs-12 col-sm-3 center">
									<div>
										<span class="profile-picture">
											<img id="avatar" class="editable img-responsive" alt="头像" src="<?php print UserUtil::getUserAvatarUrl($destuser->id) ?>" />
										</span>

										
										<!-- iframe这行代码和这个input-hidden才是真正的上传代码，其它的都是作陪衬！！ -->
										<input name="img" type="hidden" id="img" value="100" /><!-- 保存的原图片名 -->
										<input name="img_thumb" type="hidden" id="img_thumb" value="100_thumb" /><!-- 保存的缩略图名 -->
										<input name="saveimgname" type="hidden" id="saveimgname" value=""/><!-- 上传标志码（保存的文件路径名），用于旧货信息和图片的对应 -->
										<iframe src="?x=upavatar|<?php print $destuser->id?>&action=add&img_w=310&img_h=310&imgsize=1&img=hehe&simg=hehe_thumb" width="100%" height="100" scrolling="No" frameborder="0" style="border:0px;"></iframe>
										
										<div class="space-4"></div>

										<div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
											<div class="inline position-relative">
												<a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
													<i class="icon-circle light-green middle"></i>
													&nbsp;
													<span class="white"><?php print($destuser->username)?></span>
												</a>

												<ul class="align-left dropdown-menu dropdown-caret dropdown-lighter hide">
													<li class="dropdown-header"> 切换状态 </li>

													<li>
														<a href="#">
															<i class="icon-circle green"></i>
															&nbsp;
															<span class="green">有空</span>
														</a>
													</li>

													<li>
														<a href="#">
															<i class="icon-circle red"></i>
															&nbsp;
															<span class="red">正忙</span>
														</a>
													</li>

													<li>
														<a href="#">
															<i class="icon-circle grey"></i>
															&nbsp;
															<span class="grey">离开</span>
														</a>
													</li>
												</ul>
											</div>
										</div>
									</div>

									<div class="space-6"></div>

									<div class="profile-contact-info">
										<div class="profile-contact-links align-left">
											<a id="addAsContacts" shell="addAsContacts" params="<?php print $destuser->id ?>" class="btn btn-link hide ai-ajax" style="cursor: pointer;">
												<i class="icon-plus-sign bigger-120 green"></i>
												纳入联系人
											</a>

											<a class="btn btn-link hide" href="?x=listSelfLetter|0|10|0#write">
												<i class="icon-envelope bigger-120 inverse"></i>
												发送私信
											</a>

											<a class="btn btn-link hide ai-ajax" shell="addUserFollow" params="<?php print $destuser->id?>" style="cursor: pointer;">
												<i class="icon-globe bigger-125 blue"></i>
												关注Ta
											</a>
										</div>

										<div class="space-6"></div>

									</div>

									<div class="hr hr12 dotted"></div>

									<div class="clearfix">
										<div class="grid2">
											<span class="bigger-175 blue"><?php print $destuser->credit ?></span>
											<br />
											信用
										</div>

										<div class="grid2">
											<span class="bigger-175 blue"><?php print $destuser->score ?></span>
											<br />
											积分
										</div>
									</div>

									<div class="hr hr16 dotted"></div>
								</div>

								<div class="col-xs-12 col-sm-9">

									<div class="space-12"></div>

									<div class="profile-user-info profile-user-info-striped">

										<div class="col-xs-12 col-sm-9" style="font-family: 微软雅黑;font-size: 20px;">

											<div class="profile-user-info">
												<div class="profile-info-row">
													<div class="profile-info-name" > 用户名 </div>

													<div class="profile-info-value">
														<span><?php print $destuser->username?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> 角&nbsp;&nbsp;&nbsp;色 </div>

													<div class="profile-info-value">
														<i class="icon-map-marker <?php print $destuser->rolefk==1?'light-green':'light-orange'?> bigger-110"></i>
														<span>
															<?php
															print TableUtil::getValueFromField('roles', 'name', array(new AiMySQLCondition('id', '=', $destuser->rolefk)));
															?>
														</span>
													</div>
												</div>

												<div class="profile-info-row hide"> <!-- 暂时屏蔽群组 -->
													<div class="profile-info-name"> 群&nbsp;&nbsp;&nbsp;组 </div>

													<div class="profile-info-value">
														<span>
															<?php 
															echo TableUtil::getValueFromField('group', 'name', array(new AiMySQLCondition('id', '=', $destuser->groupfk)));
															?>
														</span>
														<span>群组2</span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> 学&nbsp;&nbsp;&nbsp;号 </div>
													<div class="profile-info-value">
														<span><?php print $destuser->sid ?></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> 姓&nbsp;&nbsp;&nbsp;名 </div>
													<div class="profile-info-value">
														<span><?php print $destuser->name ?></span>
													</div>
												</div>
												
												<div class="profile-info-row">
													<div class="profile-info-name"> 邮&nbsp;&nbsp;&nbsp;箱 </div>
													<div class="profile-info-value">
														<span><?php print $destuser->email ?></span>
													</div>
												</div>
											</div>

											<div class="hr hr-8 dotted"></div>

										</div>
										
									</div>
									
									<div class="space-6"></div>
									
								</div>
								
							</div><!-- #home -->

							<div id="feed" class="tab-pane">
								<div class="profile-feed row-fluid">
									<!-- 预约记录 -->
									<div class="span6">

										<div class="profile-activity clearfix">
											<div>
												<i class="pull-left thumbicon icon-ok btn-success no-hover"></i>
												<a class="user" href="#"> Alex Doe </a>
												joined
												<a href="#">Country Music</a>

												group.
												<div class="time">
													<i class="icon-time bigger-110"></i>
													5 hours ago
												</div>
											</div>

											<div class="tools action-buttons">
												<a href="#" class="blue">
													<i class="icon-pencil bigger-125"></i>
												</a>

												<a href="#" class="red">
													<i class="icon-remove bigger-125"></i>
												</a>
											</div>
										</div>

									</div><!-- /span -->

									<!-- 交易记录 -->
									<div class="span6">

										<div class="profile-activity clearfix">
											<div>
												<i class="pull-left thumbicon icon-key btn-info no-hover"></i>
												<a class="user" href="#"> Alex Doe </a>

												logged in.
												<div class="time">
													<i class="icon-time bigger-110"></i>
													12 hours ago
												</div>
											</div>

											<div class="tools action-buttons">
												<a href="#" class="blue">
													<i class="icon-pencil bigger-125"></i>
												</a>

												<a href="#" class="red">
													<i class="icon-remove bigger-125"></i>
												</a>
											</div>
										</div>

										<div class="profile-activity clearfix">
											<div>
												<i class="pull-left thumbicon icon-off btn-inverse no-hover"></i>
												<a class="user" href="#"> Alex Doe </a>

												logged out.
												<div class="time">
													<i class="icon-time bigger-110"></i>
													16 hours ago
												</div>
											</div>

											<div class="tools action-buttons">
												<a href="#" class="blue">
													<i class="icon-pencil bigger-125"></i>
												</a>

												<a href="#" class="red">
													<i class="icon-remove bigger-125"></i>
												</a>
											</div>
										</div>

									</div><!-- /span -->
									
								</div><!-- /row -->

								<div class="space-12"></div>

							</div><!-- /#feed -->
							
							<!-- 联系人 -->
							<div id="friends" class="tab-pane">
								<div class="profile-users clearfix">
<?php foreach ($ar['contacts'] as $contact ) { ?>													
									<div class="itemdiv memberdiv">
										<div class="inline position-relative">
											<div class="user">
												<a class="click_user_to_info" href="<?php print "?x=displayProfile|".urlencode($contact['id']) ?>">
													<img src="<?php print UserUtil::getUserAvatarUrl($contact['id']) ?>" alt="头像" />
												</a>
											</div>

											<div class="body">
												<div class="name">
													<a class="click_user_to_info" href="<?php print "?x=displayProfile|".urlencode($contact['id']) ?>">
														<span class="user-status status-online"></span>
														<?php print $contact['username']?>
													</a>
												</div>
											</div>

											<div class="popover">
												<div class="arrow"></div>

												<div class="popover-content">
													<div class="bolder">信&nbsp;用</div>

													<div class="time">
														<i class="icon-time middle bigger-120 orange"></i>
														<span class="green"> 
															<?php 
															print TableUtil::getValueFromField('users', 'credit', array(new AiMySQLCondition('username', '=', $contact['username'])));
															?>
														</span>
													</div>

													<div class="hr dotted hr-8"></div>

													<div class="tools action-buttons hide">
														<a href="#">
															<i class="icon-facebook-sign blue bigger-150"></i>
														</a>

														<a href="#">
															<i class="icon-twitter-sign light-blue bigger-150"></i>
														</a>

														<a href="#">
															<i class="icon-google-plus-sign red bigger-150"></i>
														</a>
													</div>
												</div>
											</div>
										</div>
									</div>
<?php } ?>														
									<div class="itemdiv memberdiv hide"> <!-- 隐藏第一个示例用户头像 -->
										<div class="inline position-relative">
											<div class="user">
												<a href="#">
													<img src="res/ace/avatars/avatar4.png" alt="Bob Doe's avatar" />
												</a>
											</div>

											<div class="body">
												<div class="name">
													<a href="#">
														<span class="user-status status-online"></span>
														Bob Doe
													</a>
												</div>
											</div>

											<div class="popover">
												<div class="arrow"></div>

												<div class="popover-content">
													<div class="bolder">Content Editor</div>

													<div class="time">
														<i class="icon-time middle bigger-120 orange"></i>
														<span class="green"> 20 mins ago </span>
													</div>

													<div class="hr dotted hr-8"></div>

													<div class="tools action-buttons hide">
														<a href="#">
															<i class="icon-facebook-sign blue bigger-150"></i>
														</a>

														<a href="#">
															<i class="icon-twitter-sign light-blue bigger-150"></i>
														</a>

														<a href="#">
															<i class="icon-google-plus-sign red bigger-150"></i>
														</a>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="itemdiv memberdiv hide"> <!-- 隐藏第二个示例用户头像 -->
										<div class="inline position-relative">
											<div class="user">
												<a href="#">
													<img src="res/ace/avatars/avatar2.png" alt="Phil Doe's avatar" />
												</a>
											</div>

											<div class="body">
												<div class="name">
													<a href="#">
														<span class="user-status status-online"></span>
														Phil Doe
													</a>
												</div>
											</div>

											<div class="popover">
												<div class="arrow"></div>

												<div class="popover-content">
													<div class="bolder">Public Relations</div>

													<div class="time">
														<i class="icon-time middle bigger-120 orange"></i>
														<span class="green"> 2 hours ago </span>
													</div>

													<div class="hr dotted hr-8"></div>

													<div class="tools action-buttons hide">
														<a href="#">
															<i class="icon-facebook-sign blue bigger-150"></i>
														</a>

														<a href="#">
															<i class="icon-twitter-sign light-blue bigger-150"></i>
														</a>

														<a href="#">
															<i class="icon-google-plus-sign red bigger-150"></i>
														</a>
													</div>
												</div>
											</div>
										</div>
									</div>

								</div>

								<div class="hr hr10 hr-double"></div>

								<ul class="pager pull-right">
									<li class="previous disabled">
										<a href="javascript:;">&larr; 上一页</a>
									</li>

									<li class="next">
										<a href="javascript:;">下一页 &rarr;</a>
									</li>
								</ul>
							</div><!-- /#friends -->

							<div id="pictures" class="tab-pane">
								<ul class="ace-thumbnails">
<?php 
/*
 * 收藏的旧货信息
 */
foreach ($ar['collects'] as $collect)
{
	$opt = $collect['collecttype']=='Z'?'sell':'buy';
?>								
									<li id="<?php print 'collect_'.$collect['id']?>">
										<a href="<?php print '?x=browseFleaDetail|'.$opt.'|'.$collect['titlecode']?>" target="blank" data-rel="colorbox">
											<img alt="150x150" width="150" height="150" src="<?php print FleaoptUtil::getFleaImgUrl($collect['recordz'] , $opt) ?>" /><!-- res/ace/images/gallery/thumb-1.jpg -->
											<div class="text">
												<div class="inner"><?php print '【'.($opt=='sell'?'转让':'求购').'】'.$collect['title']?></div>
											</div>
										</a>

										<div class="tools tools-bottom">
											<a href="#" class="hide">
												<i class="icon-link"></i>
											</a>

											<a href="#" class="hide">
												<i class="icon-paper-clip"></i>
											</a>

											<a href="#" class="hide">
												<i class="icon-pencil"></i>
											</a>

											<a href="javascript:;" id="delMyCollect" shell="delMyCollect" params="<?php print $collect['id']?>" class="ai-ajax">
												<i class="icon-remove red"></i>
											</a>
										</div>
									</li>
<?php 
}
?>									
								</ul>
							</div><!-- /#pictures -->
						</div>
					</div>
				</div>
			</div>

			<div class="hide">
				<div id="user-profile-3" class="user-profile row">
					<div class="col-sm-offset-1 col-sm-10">
						<div class="well well-sm hide"> <!-- 个人信息设置上方的提示条，现隐藏之 -->
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							&nbsp;
							<div class="inline middle blue bigger-110"> Your profile is 70% complete </div>

							&nbsp; &nbsp; &nbsp;
							<div style="width:200px;" data-percent="70%" class="inline middle no-margin progress progress-striped active">
								<div class="progress-bar progress-bar-success" style="width:70%"></div>
							</div>
						</div><!-- /well -->

						<div class="space"></div>

						<form class="form-horizontal ai-form" shell="updateProfile" id="updateProfile">
							<div class="tabbable">
								<ul class="nav nav-tabs padding-16">
									<li class="active">
										<a data-toggle="tab" href="#edit-basic" onclick="changeToUpdateProfile()">
											<i class="green icon-edit bigger-125"></i>
											基本信息
										</a>
									</li>

									<li>
										<a data-toggle="tab" href="#edit-password" onclick="changeToUpdatePassword()">
											<i class="blue icon-key bigger-125"></i>
											修改密码
										</a>
									</li>
								</ul>

								<div class="tab-content profile-edit-tab-content">
									<div id="edit-basic" class="tab-pane in active">
									
										<h4 class="header blue smaller">基&nbsp;&nbsp;&nbsp;本</h4>

										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-field-website">用户名</label>

											<div class="col-sm-9">
												<span class="input-icon input-icon-right">
													<input type="url" id="form-field-website" class="ai-args-1" value="<?php print $destuser->username?>" />
												</span>
											</div>
										</div>

										<div class="space-4"></div>
										
										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-field-email">邮&nbsp;&nbsp;&nbsp;箱</label>

											<div class="col-sm-9">
												<span class="input-icon input-icon-right">
													<input type="email" id="form-field-email" class="ai-args-2" value="<?php print $user->email ?>" />
													<i class="icon-envelope"></i>
												</span>
											</div>
										</div>
										
										<div class="space-4"></div>
										
										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-field-phone">学&nbsp;&nbsp;&nbsp;号</label>
											<div class="col-sm-9">
												<span class="input-icon input-icon-right">
													<input class="input-mask-phone ai-args-3" type="text" id="form-field-phone" value="<?php print $user->sid ?>" />
													<i class="icon-briefcase icon-flip-horizontal"></i>
												</span>
											</div>
										</div>										

										<div class="space-4"></div>

										<h4 class="header blue smaller">扩&nbsp;&nbsp;&nbsp;展</h4>

										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right">性&nbsp;&nbsp;&nbsp;别</label>
											<?php 
											/* $gen_chk = function ($value,$user){
												return $user->gender==$value ? 'checked="checked"' : '';
											} */
											?>
											<div class="col-sm-9">
												<label class="inline">
													<input name="form-field-radio" type="radio" class="ace" value="男" <?php print $destuser->gender=='男'?'checked="checked"':'' ?> />
													<span class="lbl"> 男</span>
												</label>

												&nbsp; &nbsp; &nbsp;
												<label class="inline">
													<input name="form-field-radio" type="radio" class="ace" value="女" <?php print $destuser->gender=='女'?'checked="checked"':'' ?> />
													<span class="lbl"> 女</span>
												</label>
											</div>
										</div>

										<div class="space-4"></div>

										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-field-comment">简&nbsp;&nbsp;&nbsp;介</label>

											<div class="col-sm-9">
												<textarea id="form-field-comment"><?php print $destuser->summary ?></textarea>
											</div>
										</div>

										<div class="space"></div>

									</div>

									<div id="edit-password" class="tab-pane">
										<div class="space-10"></div>

										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-field-pass1">原密码</label>
											<div class="col-sm-9">
												<input type="password" id="form-field-pass1" value="" class="ai-args-4" />
											</div>
										</div>

										<div class="space-4"></div>
										
										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-field-pass2">新密码</label>
											<div class="col-sm-9">
												<input type="password" id="form-field-pass2" value="" class="ai-args-5" />
											</div>
										</div>

										<div class="space-4"></div>

										<div class="form-group">
											<label class="col-sm-3 control-label no-padding-right" for="form-field-pass3">确认密码</label>
											<div class="col-sm-9">
												<input type="password" id="form-field-pass3" value="" class="ai-args-6" />
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="clearfix form-actions">
								<div class="col-md-offset-3 col-md-9">
									<button class="btn btn-info ai-submit" type="button">
										<i class="icon-ok bigger-110"></i>
										保&nbsp;&nbsp;&nbsp;存
									</button>

									&nbsp; &nbsp;
									<button class="btn" type="reset">
										<i class="icon-undo bigger-110"></i>
										重&nbsp;&nbsp;&nbsp;置
									</button>
								</div>
							</div>
						</form>
					</div><!-- /span -->
				</div><!-- /user-profile -->
			</div>

			<!-- PAGE CONTENT ENDS -->
		</div><!-- /.col -->
	</div><!-- /.row -->
</div><!-- /.page-content -->
