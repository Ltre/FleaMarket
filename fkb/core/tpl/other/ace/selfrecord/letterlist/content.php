<?php 
/**
 * 显示私信记录列表
 */

$args = ActionUtil::getTplArgs();
$self = $args['args'];
// OrekiUtil::var_dump_array($args);
// return;
?>

<div class="page-content">
	<div class="page-header">
		<h1>
			&nbsp;
			<small>
				<i class="icon-double-angle-right hide"></i>
				&nbsp;
			</small>
		</h1>
	</div><!-- /.page-header -->

	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->

			<div class="row">
				<div class="col-xs-12">
					<div class="tabbable">
						<ul id="inbox-tabs" class="inbox-tabs nav nav-tabs padding-16 tab-size-bigger tab-space-1">
							<li class="li-new-mail pull-right">
								<a data-toggle="tab" href="#write" data-target="write" class="btn-new-mail">
									<span class="btn bt1n-small btn-purple no-border">
										<i class=" icon-envelope bigger-130"></i>
										<span class="bigger-110">发送私信</span>
									</span>
								</a>
							</li><!-- ./li-new-mail -->
							
							<?php $opt=$self['opt'];$num=$self['num']?>
							<li <?php print 0==$opt?'class="active"':'' ?>>
								<a data-toggle="tab" onclick="javascript:location.href='<?php print "?x=listSelfLetter|0|$num|0"?>';" style="cursor: pointer;" data-target="inbox">
									<i class="blue icon-inbox bigger-130"></i>
									<span class="bigger-110"><?php print $self['tabs'][0]?></span><!-- 未读 -->
								</a>
							</li>

							<li <?php print 1==$opt?'class="active"':'' ?>>
								<a data-toggle="tab" onclick="javascript:location.href='<?php print "?x=listSelfLetter|1|$num|0"?>';" style="cursor: pointer;" data-target="sent">
									<i class="orange icon-location-arrow bigger-130 "></i>
									<span class="bigger-110"><?php print $self['tabs'][1]?></span><!-- 已读 -->
								</a>
							</li>

							<li <?php print 2==$opt?'class="active"':'' ?>>
								<a data-toggle="tab" onclick="javascript:location.href='<?php print "?x=listSelfLetter|2|$num|0"?>';" style="cursor: pointer;" data-target="draft">
									<i class="green icon-pencil bigger-130"></i>
									<span class="bigger-110"><?php print $self['tabs'][2]?></span><!-- 已发送 -->
								</a>
							</li>

							<li class="dropdown hide">
								<a data-toggle="dropdown" class="dropdown-toggle" href="#">
									<i class="pink icon-tags bigger-130"></i>

									<span class="bigger-110">
										Tags
										<i class="icon-caret-down"></i>
									</span>
								</a>

								<ul class="dropdown-menu dropdown-light-blue dropdown-125">
									<li>
										<a data-toggle="tab" href="#tag-1" data-target="tag-1">
											<span class="mail-tag badge badge-pink"></span>
											<span class="pink">Tag#1</span>
										</a>
									</li>

									<li>
										<a data-toggle="tab" href="#tag-family" data-target="tag-family">
											<span class="mail-tag badge badge-success"></span>
											<span class="green">Family</span>
										</a>
									</li>

									<li>
										<a data-toggle="tab" href="#tag-friends" data-target="tag-friends">
											<span class="mail-tag badge badge-info"></span>
											<span class="blue">Friends</span>
										</a>
									</li>

									<li>
										<a data-toggle="tab" href="#tag-work" data-target="tag-work">
											<span class="mail-tag badge badge-grey"></span>
											<span class="grey">Work</span>
										</a>
									</li>
								</ul>
							</li><!-- /.dropdown -->
						</ul>

						<div class="tab-content no-border no-padding">
							<div class="tab-pane in active">
								<div class="message-container">
									<div id="id-message-list-navbar" class="message-navbar align-center clearfix">
										<div class="message-bar">
											<div class="message-infobar hide" id="id-message-infobar">
												<span class="blue bigger-150"> &nbsp;&nbsp;</span>
												<span class="grey bigger-110"> &nbsp;&nbsp;</span>
											</div>
											<div class="message-toolbar hide">
												<div class="inline position-relative align-left">
													<a href="#" class="btn-message btn btn-xs dropdown-toggle" data-toggle="dropdown">
														<span class="bigger-110">操作</span>

														<i class="icon-caret-down icon-on-right"></i>
													</a>

													<ul class="dropdown-menu dropdown-lighter dropdown-caret dropdown-125">
														<li>
															<a href="#">
																<i class="icon-mail-reply blue"></i>
																&nbsp; 操作1
															</a>
														</li>

														<li>
															<a href="#">
																<i class="icon-mail-forward green"></i>
																&nbsp; 操作2
															</a>
														</li>

														<li>
															<a href="#">
																<i class="icon-folder-open orange"></i>
																&nbsp; 操作3
															</a>
														</li>

														<li class="divider"></li>

														<li>
															<a href="#">
																<i class="icon-eye-open blue"></i>
																&nbsp; Mark as read
															</a>
														</li>

														<li>
															<a href="#">
																<i class="icon-eye-close green"></i>
																&nbsp; Mark unread
															</a>
														</li>

														<li>
															<a href="#">
																<i class="icon-flag-alt red"></i>
																&nbsp; Flag
															</a>
														</li>

														<li class="divider"></li>

														<li>
															<a href="#">
																<i class="icon-trash red bigger-110"></i>
																&nbsp; Delete
															</a>
														</li>
													</ul>
												</div>

												<div class="inline position-relative align-left">
													<a href="#" class="btn-message btn btn-xs dropdown-toggle" data-toggle="dropdown">
														<i class="icon-folder-close-alt bigger-110"></i>
														<span class="bigger-110">移动到</span>

														<i class="icon-caret-down icon-on-right"></i>
													</a>

													<ul class="dropdown-menu dropdown-lighter dropdown-caret dropdown-125">
														<li>
															<a href="#">
																<i class="icon-stop pink2"></i>
																&nbsp; 位置1
															</a>
														</li>

														<li>
															<a href="#">
																<i class="icon-stop blue"></i>
																&nbsp; 位置2
															</a>
														</li>

														<li>
															<a href="#">
																<i class="icon-stop green"></i>
																&nbsp; 位置3
															</a>
														</li>

														<li>
															<a href="#">
																<i class="icon-stop grey"></i>
																&nbsp; 位置4
															</a>
														</li>
													</ul>
												</div>

												<a href="#" class="btn btn-xs btn-message">
													<i class="icon-trash bigger-125"></i>
													<span class="bigger-110">删除</span>
												</a>
											</div>
										</div>

										<div>
											<div class="messagebar-item-left">
												<label class="inline middle">
													<input type="hidden" id="id-toggle-all" class="ace" /><!-- 原为checkbox -->
													<span class="lbl"></span>
												</label>

												&nbsp;
												<!-- 标记为不使用：选择已读、未读、全部。。。 -->
												<div class="inline position-relative hide">
													<a href="#" data-toggle="dropdown" class="dropdown-toggle hide">
														<i class="icon-caret-down bigger-125 middle"></i>
													</a>

													<ul class="dropdown-menu dropdown-lighter dropdown-100 hide">
														<li>
															<a id="id-select-message-all" href="#">All</a>
														</li>

														<li>
															<a id="id-select-message-none" href="#">None</a>
														</li>

														<li class="divider"></li>

														<li>
															<a id="id-select-message-unread" href="#">Unread</a>
														</li>

														<li>
															<a id="id-select-message-read" href="#">Read</a>
														</li>
													</ul>
												</div>
											</div>
											<!-- 弃用排序，改为“刷新”按钮 -->
											<div class="messagebar-item-right">
												<div class="inline position-relative">
													<a href="#" data-toggle="dropdown" class="dropdown-toggle hide">
														Sort &nbsp;
														<i class="icon-caret-down bigger-125"></i>
													</a>
													<ul class="dropdown-menu dropdown-lighter pull-right dropdown-100 hide">
														<li>
															<a href="#">
																<i class="icon-ok green"></i>
																Date
															</a>
														</li>

														<li>
															<a href="#">
																<i class="icon-ok invisible"></i>
																From
															</a>
														</li>

														<li>
															<a href="#">
																<i class="icon-ok invisible"></i>
																Subject
															</a>
														</li>
													</ul>
													<?php $opt = $self['opt'];$num = $self['num'];$start = $self['start'] ?>
													<button type="button" onclick="javascript:location.href='<?php print "?x=listSelfLetter|$opt|$num|0"?>';" class="btn btn-sm btn-success">刷新</button>
												</div>
											</div>

											<div class="nav-search minimized">
												<form class="form-search">
													<span class="input-icon">
														<input type="text" autocomplete="off" class="input-small nav-search-input" placeholder="搜索..." />
														<i class="icon-search nav-search-icon hide"></i>
													</span>
												</form>
											</div>
										</div>
									</div>

									<div id="id-message-item-navbar" class="hide message-navbar align-center clearfix">
										<div class="message-bar">
											<div class="message-toolbar">
												<div class="inline position-relative align-left">
													<a href="#" class="btn-message btn btn-xs dropdown-toggle" data-toggle="dropdown">
														<span class="bigger-110">Action</span>

														<i class="icon-caret-down icon-on-right"></i>
													</a>

													<ul class="dropdown-menu dropdown-lighter dropdown-caret dropdown-125">
														<li>
															<a href="#">
																<i class="icon-mail-reply blue"></i>
																&nbsp; Reply
															</a>
														</li>

														<li>
															<a href="#">
																<i class="icon-mail-forward green"></i>
																&nbsp; Forward
															</a>
														</li>

														<li>
															<a href="#">
																<i class="icon-folder-open orange"></i>
																&nbsp; Archive
															</a>
														</li>

														<li class="divider"></li>

														<li>
															<a href="#">
																<i class="icon-eye-open blue"></i>
																&nbsp; Mark as read
															</a>
														</li>

														<li>
															<a href="#">
																<i class="icon-eye-close green"></i>
																&nbsp; Mark unread
															</a>
														</li>

														<li>
															<a href="#">
																<i class="icon-flag-alt red"></i>
																&nbsp; Flag
															</a>
														</li>

														<li class="divider"></li>

														<li>
															<a href="#">
																<i class="icon-trash red bigger-110"></i>
																&nbsp; Delete
															</a>
														</li>
													</ul>
												</div>

												<div class="inline position-relative align-left">
													<a href="#" class="btn-message btn btn-xs dropdown-toggle" data-toggle="dropdown">
														<i class="icon-folder-close-alt bigger-110"></i>
														<span class="bigger-110">Move to</span>

														<i class="icon-caret-down icon-on-right"></i>
													</a>

													<ul class="dropdown-menu dropdown-lighter dropdown-caret dropdown-125">
														<li>
															<a href="#">
																<i class="icon-stop pink2"></i>
																&nbsp; Tag#1
															</a>
														</li>

														<li>
															<a href="#">
																<i class="icon-stop blue"></i>
																&nbsp; Family
															</a>
														</li>

														<li>
															<a href="#">
																<i class="icon-stop green"></i>
																&nbsp; Friends
															</a>
														</li>

														<li>
															<a href="#">
																<i class="icon-stop grey"></i>
																&nbsp; Work
															</a>
														</li>
													</ul>
												</div>

												<a href="#" class="btn btn-xs btn-message">
													<i class="icon-trash bigger-125"></i>
													<span class="bigger-110">Delete</span>
												</a>
											</div>
										</div>

										<div>
											<div class="messagebar-item-left">
												<a href="#" class="btn-back-message-list">
													<i class="icon-arrow-left blue bigger-110 middle"></i>
													<b class="bigger-110 middle">Back</b>
												</a>
											</div>

											<div class="messagebar-item-right">
												<i class="icon-time bigger-110 orange middle"></i>
												<span class="time grey">Today, 7:15 pm</span>
											</div>
										</div>
									</div>

									<div id="id-message-new-navbar" class="hide message-navbar align-center clearfix">
										<div class="message-bar">
											<div class="message-toolbar hide">
												<a href="#" class="btn btn-xs btn-message">
													<i class="icon-save bigger-125"></i>
													<span class="bigger-110">Save Draft</span>
												</a>

												<a href="#" class="btn btn-xs btn-message">
													<i class="icon-remove bigger-125"></i>
													<span class="bigger-110">Discard</span>
												</a>
											</div>
										</div>

										<div class="message-item-bar">
											<div class="messagebar-item-left">
												<a href="#" class="btn-back-message-list no-hover-underline">
													<i class="icon-arrow-left blue bigger-110 middle"></i>
													<b class="middle bigger-110">返回</b>
												</a>
											</div>

											<div class="messagebar-item-right hide">
												<span class="inline btn-send-message">
													<button type="button" class="btn btn-sm btn-primary no-border">
														<span class="bigger-110">发送</span>

														<i class="icon-arrow-right icon-on-right"></i>
													</button>
												</span>
											</div>
										</div>
									</div>
									
									<!-- 消息列表 -->
									
									<div class="message-list-container">
										<div class="message-list" id="message-list">
											<!-- 隐藏该条信息 -->
											<div class="message-item message-unread hide">
												<label class="inline">
													<input type="hidden" class="ace"/><!-- 原为checkbox -->
													<span class="lbl"></span>
												</label>

												<i class="message-star icon-star orange2"></i>
												<span class="sender" title="某发送人">某发送人 </span>
												<span class="time">1:33 pm</span>

												<span class="summary">
													<span class="text">
														点击此处查看信息
													</span>
												</span>
											</div>
<?php 
foreach ($self['letters'] as $letter)
{
?>											
											<!-- 查看消息明细时，添加“message-inline-open”类 -->
											<div class="message-item message-unread" me="<?php print$_SESSION['user']->id?>" opt="<?php print$self['opt']?>">
												<label class="inline">
													<input type="hidden" class="ace" /><!-- 原为checkbox -->
													<span class="lbl"></span>
												</label>

												<i class="message-star icon-star-empty light-grey hide"></i>
												<img width="55px" height="55px" src="<?php print UserUtil::getUserAvatarUrl($letter['erid'])?>" />
												<a class="er" erid="<?php print$letter['erid']?>" title="<?php print $self['opt']==2?'接收人':'发送人'?>" href="<?php print '?x=displayProfile|'.$letter['erid'] ?>" style="width:200px;" >
													<font color="green"><?php print $self['opt']==2?'接收人':'发送人'?>：</font><?php print $letter['er'] ?>
												</a>
												<span class="time" style="width: 120px;">
													<?php print $letter['sendtime'] ?>
												</span>

												<span class="attachment">
													<i class="icon-time"></i>
												</span>

												<span class="summary">
													<span class="badge badge-pink mail-tag hide"></span>
													<span class="text" shell="getLetterDetail" params="<?php print $letter['id']?>">
														<?php print $letter['title']?>
													</span>
												</span>
											</div>
<?php 
}
?>
										</div>
									</div><!-- /.message-list-container -->

									<div class="message-footer clearfix">
										<div class="pull-left"> <?php print $self['total'] ?> 条私信 </div>

										<div class="pull-right">
											<div class="inline middle"> 共 <?php print $self['pagesum'] ?> 页 </div>

											&nbsp; &nbsp;
											<ul class="pagination middle">
												<li>
													<a href="<?php print "?x=listSelfLetter|".$self['opt'].'|'.$self['num'].'|0' ?>">
														<i class="icon-step-backward middle"></i>
													</a>
												</li>

												<li>
													<?php 
													$prevpage = $self['pagepos'] - 1;
													$pagesum = $self['pagesum'];
													$prevpage = $prevpage < 1 ? 1 : $prevpage;
													?>
													<a href="<?php print "?x=listSelfLetter|".$self['opt'].'|'.$self['num'].'|'.($prevpage-1)*$self['num'] ?>">
														<i class="icon-caret-left bigger-140 middle"></i>
													</a>
												</li>

												<li>
													<span>
														<?php $puprefix = '?x=listSelfLetter|'.$self['opt'].'|'.$self['num'].'|'?>
														<input value="<?php print $self['pagepos']?>" onkeyup="javascript:gotoPage(this,event);" puprefix="<?php print$puprefix?>" num="<?php print$num?>" pagesum="<?php print$pagesum?>" maxlength="5" type="text"  />
													</span>
												</li>

												<li>
													<?php 
													$nextpage = $self['pagepos'] + 1;
													$pagesum = $self['pagesum'];
													$nextpage = $nextpage > $pagesum ? $pagesum : $nextpage;
													?>
													<a href="<?php print "?x=listSelfLetter|".$self['opt'].'|'.$self['num'].'|'.($nextpage-1)*$self['num'] ?>">
														<i class="icon-caret-right bigger-140 middle"></i>
													</a>
												</li>

												<li>
													<a href="<?php print "?x=listSelfLetter|".$self['opt'].'|'.$self['num'].'|'.($pagesum-1)*$self['num'] ?>">
														<i class="icon-step-forward middle"></i>
													</a>
												</li>
											</ul>
										</div>
									</div>

									<div class="hide message-footer message-footer-style2 clearfix">
										<div class="pull-left"> simpler footer </div>

										<div class="pull-right">
											<div class="inline middle"> message 1 of 151 </div>

											&nbsp; &nbsp;
											<ul class="pagination middle">
												<li class="disabled">
													<span>
														<i class="icon-angle-left bigger-150"></i>
													</span>
												</li>

												<li>
													<a href="#">
														<i class="icon-angle-right bigger-150"></i>
													</a>
												</li>
											</ul>
										</div>
									</div>
								</div><!-- /.message-container -->
							</div><!-- /.tab-pane -->
						</div><!-- /.tab-content -->
					</div><!-- /.tabbable -->
				</div><!-- /.col -->
			</div><!-- /.row -->
			
			<?php //指令参数：发送人id|内容|接收人id|标题 ?>
			<form shell="sendPersonalLetter" class="hide form-horizontal message-form col-xs-12 ai-form"><!-- 原有id="id-message-form"，现删除  -->
				<div class="">
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-recipient">收件人</label>

						<div class="col-sm-9">
							<span class="input-icon">
								<!-- <input type="email" name="recipient" id="form-field-recipient" data-value="alex@doe.com" value="alex@doe.com" placeholder="Recipient(s)" /> -->
								<select class="ai-args-3" style="width: 120px;" id="form-field-recipient" name="recipient" >
								<option value="0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;选择联系人</option>
								<?php 
								//拿到自己的联系人列表
								foreach ($self['contacts'] as $ctc){
									print '<option value="'.$ctc['id'].'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$ctc['username'].'</option>';
								}
								?>
								</select>
								<i class="icon-user"></i>
							</span>
						</div>
					</div>

					<div class="hr hr-18 dotted"></div>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-subject">主题</label>

						<div class="col-sm-6 col-xs-12">
							<div class="input-icon block col-xs-12 no-padding">
								<input maxlength="100" type="text" class="col-xs-12 ai-args-4" name="subject" id="form-field-subject" placeholder="输入简明扼要的主题" />
								<i class="icon-comment-alt"></i>
							</div>
						</div>
					</div>

					<div class="hr hr-18 dotted"></div>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right">
							<span class="inline space-24 hidden-480"></span>
							内容
						</label>
						<input type="hidden" value="THIS_IS_AI_CONTENTS_IN_SENDING_LETTER" class="ai-args-2" /><!-- 指令参数——内容，已被POST参数代替 -->
						<input type="hidden" value="<?php print $_SESSION['user']->id?>" class="ai-args-1" />
						<div class="col-sm-9">
							<div id="wysiwyg-editor" class="wysiwyg-editor"></div>
						</div>
					</div>

					<div class="hr hr-18 dotted"></div>

					<div class="form-group no-margin-bottom hide">
						<label class="col-sm-3 control-label no-padding-right">Attachments:</label>

						<div class="col-sm-9">
							<div id="form-attachments">
								<input type="file" name="attachment[]" />
							</div>
						</div>
					</div>

					<div class="align-right hide">
						<button id="id-add-attachment" type="button" class="btn btn-sm btn-danger">
							<i class="icon-paper-clip bigger-140"></i>
							添加附件
						</button>
					</div>
					
					<div class="align-right">
						<button type="button" class="btn btn-info ai-submit" style="font-size: 18px;">
							发 送
							<i class="icon-arrow-right icon-on-right"></i>
						</button>
					</div>

					<div class="space"></div>
				</div>
			</form>
			
			<!-- 隐藏的消息内容，点击后打开 -->
			
			<div class="hide message-content" id="id-message-content">
				<div class="message-header clearfix hide">
					<div class="pull-left">
						<div class="space-4"></div>

					</div>

					<div class="action-buttons pull-right">
						<a href="#">
							<i class="icon-reply green icon-only bigger-130"></i>
						</a>

						<a href="#">
							<i class="icon-mail-forward blue icon-only bigger-130"></i>
						</a>

						<a href="#">
							<i class="icon-trash red icon-only bigger-130"></i>
						</a>
					</div>
				</div>

				<div class="hr hr-double"></div>

				<div class="message-body">
					<p>
						私信内容私信内容私信内容私信内容私信内容私信内容私信内容私信内容私信内容私信内容私信内容私信内容私信内容私信内容私信内容私信内容私信内容私信内容私信内容私信内容私信内容私信内容私信内容私信内容私信内容私信内容私信内容私信内容私信内容私信内容私信内容私信内容私信内容私信内容私信内容私信内容私信内容私信内容私信内容私信内容私信内容私信内容私信内容私信内容
					</p>

					<p>
						私信内容私信内容私信内容私信内容私信内容私信内容私信内容私信内容私信内容私信内容私信内容
					</p>
				</div>

				<div class="hr hr-double"></div>

				<div class="message-attachment clearfix hide">
					<div class="attachment-title">
						<span class="blue bolder bigger-110 hide">Attachments</span>
						&nbsp;
						<span class="grey hide">(2 files, 4.5 MB)</span>

						<div class="inline position-relative hide">
							<a href="#" data-toggle="dropdown" class="dropdown-toggle">
								&nbsp;
								<i class="icon-caret-down bigger-125 middle hide"></i>
							</a>

							<ul class="dropdown-menu dropdown-lighter hide">
								<li>
									<a href="#">Download all as zip</a>
								</li>

								<li>
									<a href="#">Display in slideshow</a>
								</li>
							</ul>
						</div>
					</div>

					&nbsp;
					<ul class="attachment-list pull-left list-unstyled hide">
						<li>
							<a href="#" class="attached-file inline hide">
								<i class="icon-file-alt bigger-110 middle hide"></i>
								<span class="attached-name middle hide">Document1.pdf</span>
							</a>

							<div class="action-buttons inline hide">
								<a href="#">
									<i class="icon-download-alt bigger-125 blue hide"></i>
								</a>

								<a href="#">
									<i class="icon-trash bigger-125 red hide"></i>
								</a>
							</div>
						</li>

						<li>
							<a href="#" class="attached-file inline hide">
								<i class="icon-film bigger-110 middle hide"></i>
								<span class="attached-name middle hide">Sample.mp4</span>
							</a>

							<div class="action-buttons inline hide">
								<a href="#">
									<i class="icon-download-alt bigger-125 blue hide"></i>
								</a>

								<a href="#">
									<i class="icon-trash bigger-125 red hide"></i>
								</a>
							</div>
						</li>
					</ul>

					<div class="attachment-images pull-right">
						<div class="vspace-sm-4"></div>

						<div>
							<img width="36" alt="image 4" src="assets/images/gallery/thumb-4.jpg" />
							<img width="36" alt="image 3" src="assets/images/gallery/thumb-3.jpg" />
							<img width="36" alt="image 2" src="assets/images/gallery/thumb-2.jpg" />
							<img width="36" alt="image 1" src="assets/images/gallery/thumb-1.jpg" />
						</div>
					</div>
				</div>
			</div><!-- /.message-content -->

			<!-- PAGE CONTENT ENDS -->
		</div><!-- /.col -->
	</div><!-- /.row -->
</div><!-- /.page-content -->