<!DOCTYPE html>
<html lang="en">
<?php 
/** 该模板参数的结构
		$tplArgs = array(
			//class=page_content指定的正文区域内容（自定义内容）
			'page_content'	=>	'ace/fleaopt/pageToCreateFleaInfo/content.php',
			//<!-- page specific plugin scripts -->导入的js标签（包含ACE自己导入的）
			'ace_js'	=>	'ace/fleaopt/pageToCreateFleaInfo/jstag.php',	
			//<!-- page specific plugin styles -->导入的css标签（包含ACE自己导入的）
			'ace_css'	=>	'ace/fleaopt/pageToCreateFleaInfo/csstag.php',
			//<!-- inline scripts related to this page -->页内嵌入的脚本（包含ACE自身的）
			'ace_inline'=>	'ace/fleaopt/pageToCreateFleaInfo/injs.php',
			//自定义的外挂js
			'javascript'=>	'res/js/pageToCreateFleaInfo.js',	
			'action'	=>	'旧货信息操作',	//所在的模块
			'operation'	=>	'发布旧货信息',	//所在的功能
			//具体模板的专用参数，结构自己定义
			'args'		=>	array(
				'createType'	=>	$t,
			),
		);
*/
$args = ActionUtil::getTplArgs();
$user = $_SESSION['user'];
?>
	<head>
		<meta charset="utf-8" />
		<title>华软旧货市场</title>
		<meta name="keywords" content="旧货市场,折木さん,oreki,ltre,华软,fleamarket" />
		<meta name="description" content="毕业设计" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!-- basic styles -->

		<link href="res/ace/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="res/ace/css/font-awesome.min.css" />

		<!--[if IE 7]>
		  <link rel="stylesheet" href="res/ace/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!-- page specific plugin styles -->
<?php 
require_once OTHER_TEMPLATE_DIR . $args['ace_css'];
?>
		<link rel="stylesheet" href="res/ace/css/jquery-ui-1.10.3.custom.min.css" />

		<!-- fonts -->

		<!-- <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" /> -->
		<link rel="stylesheet" href="res/ace/new/googleapisFontOpenSans.css" />

		<!-- ace styles -->

		<link rel="stylesheet" href="res/ace/css/ace.min.css" />
		<link rel="stylesheet" href="res/ace/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="res/ace/css/ace-skins.min.css" />

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="res/ace/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->

		<script src="res/ace/js/ace-extra.min.js"></script>

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

		<!--[if lt IE 9]>
		<script src="res/ace/js/html5shiv.js"></script>
		<script src="res/ace/js/respond.min.js"></script>
		<![endif]-->
		
		
	</head>

	<body>
		<!-- 注释：顶部导航栏开始 -->
		<!-- 读取会话内容 -->
		<div class="navbar navbar-default" id="navbar" style="background-color: gray">
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>

			<div class="navbar-container" id="navbar-container">
				<div class="navbar-header pull-left">
					<a href="./" class="navbar-brand">
						<small>
							<i class="icon-leaf"></i>
							华软旧货市场
						</small>
					</a><!-- /.brand -->
				</div><!-- /.navbar-header -->
<?php 
$sql = 'select * from fm_message where msgtype=1 and isread=false';
$pubmsgnum = AiMySQL::getNumsOfRs($sql);
?>
				<div class="navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<li class="purple hide" title="公告">
							<a data-toggle="dropdown" class="dropdown-toggle" style="cursor: pointer;">
								<i class="icon-tasks"></i>
								<!-- PHP：公告数量 -->
								<span class="badge badge-grey"><?php print $pubmsgnum ?></span>
							</a>

							<ul class="hide pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="icon-ok"></i>
									0条未读公告
								</li>

								<li>
									<a href="#">
										<div class="clearfix">
											<span class="pull-left">Software Update</span>
											<span class="pull-right">65%</span>
										</div>

										<div class="progress progress-mini ">
											<div style="width:65%" class="progress-bar "></div>
										</div>
									</a>
								</li>

								<li>
									<a href="#">
										<div class="clearfix">
											<span class="pull-left">Hardware Upgrade</span>
											<span class="pull-right">35%</span>
										</div>

										<div class="progress progress-mini ">
											<div style="width:35%" class="progress-bar progress-bar-danger"></div>
										</div>
									</a>
								</li>

								<li>
									<a href="#">
										<div class="clearfix">
											<span class="pull-left">Unit Testing</span>
											<span class="pull-right">15%</span>
										</div>

										<div class="progress progress-mini ">
											<div style="width:15%" class="progress-bar progress-bar-warning"></div>
										</div>
									</a>
								</li>

								<li>
									<a href="#">
										<div class="clearfix">
											<span class="pull-left">Bug Fixes</span>
											<span class="pull-right">90%</span>
										</div>

										<div class="progress progress-mini progress-striped active">
											<div style="width:90%" class="progress-bar progress-bar-success"></div>
										</div>
									</a>
								</li>

								<li>
									<a href="#">
										查看更多系统公告
										<i class="icon-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>
<?php 
$sql = 'select * from fm_message where msgtype in (4,5,7,8) and isread=false and receiver='.$user->id;
$noticenum = AiMySQL::getNumsOfRs($sql);
?>
						<li class="" title="提醒"> <!-- class="grey" -->
							<a data-toggle="dropdown" class="dropdown-toggle" href="javascript:;" onclick="location.href='?x=listSelfRemind|0|10|0';">
								<i class="icon-bell-alt icon-animated-bell"></i>
								<span class="badge badge-important"><?php print $noticenum ?></span>
							</a>

							<ul class="hide pull-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="icon-warning-sign"></i>
									8 Notifications
								</li>

								<li>
									<a href="#">
										<div class="clearfix">
											<span class="pull-left">
												<i class="btn btn-xs no-hover btn-pink icon-comment"></i>
												New Comments
											</span>
											<span class="pull-right badge badge-info">+12</span>
										</div>
									</a>
								</li>

								<li>
									<a href="#">
										<i class="btn btn-xs btn-primary icon-user"></i>
										Bob just signed up as an editor ...
									</a>
								</li>

								<li>
									<a href="#">
										<div class="clearfix">
											<span class="pull-left">
												<i class="btn btn-xs no-hover btn-success icon-shopping-cart"></i>
												New Orders
											</span>
											<span class="pull-right badge badge-success">+8</span>
										</div>
									</a>
								</li>

								<li>
									<a href="#">
										<div class="clearfix">
											<span class="pull-left">
												<i class="btn btn-xs no-hover btn-info icon-twitter"></i>
												Followers
											</span>
											<span class="pull-right badge badge-info">+11</span>
										</div>
									</a>
								</li>

								<li>
									<a href="#">
										查看所有提醒
										<i class="icon-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>
<?php 
$sql = 'select * from fm_message where msgtype=2 and isread=false and receiver='.$user->id;
$letternum = AiMySQL::getNumsOfRs($sql);
?>
						<li class="green" title="私信">
							<a data-toggle="dropdown" class="dropdown-toggle" href="javascript:;" onclick="location.href='?x=listSelfLetter|0|10|0';">
								<i class="icon-envelope icon-animated-vertical"></i>
								<span class="badge badge-success"><?php print $letternum ?></span>
							</a>

							<ul class="hide pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="icon-envelope-alt"></i>
									5 Messages
								</li>

								<li>
									<a href="#">
										<img src="res/ace/avatars/avatar.png" class="msg-photo" alt="Alex's Avatar" />
										<span class="msg-body">
											<span class="msg-title">
												<span class="blue">Alex:</span>
												Ciao sociis natoque penatibus et auctor ...
											</span>

											<span class="msg-time">
												<i class="icon-time"></i>
												<span>a moment ago</span>
											</span>
										</span>
									</a>
								</li>

								<li>
									<a href="#">
										<img src="res/ace/avatars/avatar3.png" class="msg-photo" alt="Susan's Avatar" />
										<span class="msg-body">
											<span class="msg-title">
												<span class="blue">Susan:</span>
												Vestibulum id ligula porta felis euismod ...
											</span>

											<span class="msg-time">
												<i class="icon-time"></i>
												<span>20 minutes ago</span>
											</span>
										</span>
									</a>
								</li>

								<li>
									<a href="#">
										<img src="res/ace/avatars/avatar4.png" class="msg-photo" alt="Bob's Avatar" />
										<span class="msg-body">
											<span class="msg-title">
												<span class="blue">Bob:</span>
												Nullam quis risus eget urna mollis ornare ...
											</span>

											<span class="msg-time">
												<i class="icon-time"></i>
												<span>3:15 pm</span>
											</span>
										</span>
									</a>
								</li>

								<li>
									<a href="inbox.html">
										查看所有私信
										<i class="icon-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>

						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="<?php print UserUtil::getUserAvatarUrl($user->id) ?>" alt="Jason's Photo" />
								<span class="user-info">
									<small>欢迎，</small>
									<?php printf($user->username)?>
								</span>

								<i class="icon-caret-down"></i>
							</a>

							<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a shell="displayProfile|<?php print(urlencode($user->id))?>" class="ai-skip" style="cursor: pointer;">
										<i class="icon-certificate"></i>
										信用 <span class="pull-right"><?php print $user->credit ?></span>
									</a>
								</li>

								<li>
									<a shell="displayProfile|<?php print(urlencode($user->id))?>" class="ai-skip" style="cursor: pointer;">
										<i class="icon-fire"></i>
										积分 <span class="pull-right"><?php print $user->score ?></span>
									</a>
								</li>

								<li>
									<a href="?x=displayProfile|<?php print(urlencode($user->id))?>">
										<i class="icon-user"></i>
										个人信息设置
									</a>
								</li>
								
								<li class="divider"></li>

								<li>
									<a shell="user_logout" class="ai-ajax" href="./">
										<i class="icon-off"></i>
										退出
									</a>
								</li>
							</ul>
						</li>
					</ul><!-- /.ace-nav -->
				</div><!-- /.navbar-header -->
			</div><!-- /.container -->
		</div>
		<!-- 注释：顶部导航栏 结束 -->
		<!-- --------------------------分割线-------------------------- -->
		<!-- 注释：导航栏下方的整个大容器 开始 -->
		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>
			
			<div class="main-container-inner">
				<a class="menu-toggler" id="menu-toggler" href="#">
					<span class="menu-text"></span>
				</a>
				<!-- 注释：侧栏  开始 -->
				<div class="sidebar" id="sidebar">
					<script type="text/javascript">
						try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
					</script>

					<div class="sidebar-shortcuts" id="sidebar-shortcuts">
						<div class="sidebar-shortcuts-large hide" id="sidebar-shortcuts-large">
							<button class="btn btn-success">
								<i class="icon-signal"></i>
							</button>

							<button class="btn btn-info">
								<i class="icon-pencil"></i>
							</button>

							<button class="btn btn-warning">
								<i class="icon-group"></i>
							</button>

							<button class="btn btn-danger">
								<i class="icon-cogs"></i>
							</button>
						</div>

						<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
							<span class="btn btn-success"></span>

							<span class="btn btn-info"></span>

							<span class="btn btn-warning"></span>

							<span class="btn btn-danger"></span>
						</div>
					</div><!-- #sidebar-shortcuts -->

					<ul class="nav nav-list">
					
						<li class="active open">
							<a class="dropdown-toggle" style="cursor: pointer;">
								<i class="icon-edit"></i>
								<span class="menu-text"> 发一条 </span>

								<b class="arrow icon-angle-down"></b>
							</a>
							<ul class="submenu">
								<li>
									<a href="?x=pageToCreateFleaInfo|newsell|0">
										<i class="icon-double-angle-right"></i>
										发起转让
									</a>
								</li>
								<li>
									<a href="?x=pageToCreateFleaInfo|newbuy|0">
										<i class="icon-double-angle-right"></i>
										发起求购
									</a>
								</li>
							</ul>
						</li>
						
						<li class="active open">
							<a href="#" class="dropdown-toggle">
								<i class="icon-list-alt"></i>
								<span class="menu-text"> 发布的记录 </span>

								<b class="arrow icon-angle-down"></b>
							</a>
							<ul class="submenu">
								<li>
									<a href="?x=listSelfSell|10|0">
										<i class="icon-double-angle-right"></i>
										自己的转让
									</a>
								</li>
								<li>
									<a href="?x=listSelfBuy|10|0">
										<i class="icon-double-angle-right"></i>
										自己的求购
									</a>
								</li>
								<li>
									<a class="ai-skip hide" shell="listSelfAppraise" params="10|0" style="cursor: pointer;">
										<i class="icon-double-angle-right"></i>
										所有的评价
									</a>
								</li>
								<li class="hide">
									<a class="ai-skip" shell="listSelfAccessRecord" params="10|0" style="cursor: pointer;">
										<i class="icon-double-angle-right"></i>
										访问记录
									</a>
								</li>
							</ul>
						</li>
						
						<li class="active open">
							<a href="#" class="dropdown-toggle">
								<i class="icon-list-alt"></i>
								<span class="menu-text"> 我的交易活动 </span>
								<b class="arrow icon-angle-down"></b>
							</a>
							<ul class="submenu">
								<li>
									<a href="?x=listSelfBook|10|0">
										<i class="icon-double-angle-right"></i>
										预约记录
									</a>
								</li>
								<li>
									<a href="?x=listSelfTrade|10|0">
										<i class="icon-double-angle-right"></i>
										交易记录
									</a>
								</li>
							</ul>
						</li>
						
						<li>
							<a href="?x=listSelfLetter|0|10|0">
								<i class="icon-calendar"></i>
								<span class="menu-text"> 私信记录 </span>
							</a>
						</li>

						<li class="hide">
							<a href="calendar.html">
								<i class="icon-comments"></i>
								<span class="menu-text"> 我的联系人 </span>
							</a>
						</li>

						<li class="hide">
							<a href="calendar.html">
								<i class="icon-cogs"></i>
								<span class="menu-text"> 我的道具 </span>
							</a>
						</li>

						<li class="hide">
							<a href="#" class="dropdown-toggle">
								<i class="icon-desktop"></i>
								<span class="menu-text"> 三层菜单 </span>
								<b class="arrow icon-angle-down"></b>
							</a>
							<ul class="submenu">
								<li>
									<a href="treeview.html">
										<i class="icon-double-angle-right"></i>
										树菜单
									</a>
								</li>
								<li>
									<a href="#" class="dropdown-toggle">
										<i class="icon-double-angle-right"></i>

										三级菜单
										<b class="arrow icon-angle-down"></b>
									</a>
									<ul class="submenu">
										<li>
											<a href="#">
												<i class="icon-leaf"></i>
												第一级
											</a>
										</li>
										<li>
											<a href="#" class="dropdown-toggle">
												<i class="icon-pencil"></i>
												第四级
												<b class="arrow icon-angle-down"></b>
											</a>

											<ul class="submenu">
												<li>
													<a href="#">
														<i class="icon-plus"></i>
														添加产品
													</a>
												</li>
												<li>
													<a href="#">
														<i class="icon-eye-open"></i>
														查看商品
													</a>
												</li>
											</ul>
										</li>
									</ul>
								</li>
							</ul>
						</li>
						
					</ul><!-- /.nav-list -->

					<div class="sidebar-collapse" id="sidebar-collapse">
						<i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
					</div>

					<script type="text/javascript">
						try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
					</script>
				</div>
				<!-- 注释：侧栏  结束 -->
				<!-- -----------------------------分割线---------------------------- -->
				<!-- 注释：主内容容器（顶栏除外）开始 -->
				<div class="main-content">
					<!-- 注释：所在的功能 开始 -->
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<span style="color: brown;"><?php printf($args['action'])?></span>
							</li>
							<li>
								<span style="color: brown;"><?php printf($args['operation'])?></span>
							</li>
						</ul><!-- .breadcrumb -->

						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="搜索 ..." class="nav-search-input hide" id="nav-search-input" autocomplete="off" />
									<i class="icon-search nav-search-icon hide"></i>
								</span>
							</form>
						</div><!-- #nav-search -->
					</div>
					<!-- 注释：所在的功能结束 -->
					<!-- ------------------------分割线----------------------- -->
					<!-- 注释：ACE正文区域开始 -->
<?php 
require_once OTHER_TEMPLATE_DIR . $args['page_content'];
?>
					<!-- 注释：ACE正文区域结束 -->
				</div><!-- /.main-content -->
				<!-- 注释：主内容容器（顶栏除外）结束 -->
				<!-- ------------------分割线---------------- -->
				<!-- 注释：ACE设置按钮区域开始 -->
				<div class="ace-settings-container" id="ace-settings-container">
					<div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
						<i class="icon-cog bigger-150"></i>
					</div>
					<div class="ace-settings-box" id="ace-settings-box">
						<div class="hide"><!-- 这里设置隐藏，不更换主题 -->
							<div class="pull-left">
								<select id="skin-colorpicker" class="hide">
									<option data-skin="default" value="#438EB9">#438EB9</option>
									<option data-skin="skin-1" value="#222A2D">#222A2D</option>
									<option data-skin="skin-2" value="#C6487E">#C6487E</option>
									<option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
								</select>
							</div>
							<span>&nbsp; 选择主题色</span>
						</div>
						<div>
							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-navbar"/>
							<label class="lbl" for="ace-settings-navbar"> 固定导航栏</label>
						</div>
						<div>
							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-sidebar" />
							<label class="lbl" for="ace-settings-sidebar"> 固定侧栏</label>
						</div>
						<div>
							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-breadcrumbs" />
							<label class="lbl" for="ace-settings-breadcrumbs"> 固定搜索栏</label>
						</div>
						<div>
							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" />
							<label class="lbl" for="ace-settings-rtl"> 左右切换</label>
						</div>
						<div>
							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container" />
							<label class="lbl" for="ace-settings-add-container">
								窄屏显示
								<b class="hide">.container</b>
							</label>
						</div>
					</div> 
				</div><!-- /#ace-settings-container -->
				<!-- 注释：ACE设置按钮区域结束 -->
			</div><!-- /.main-container-inner -->
			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="icon-double-angle-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->
		<!-- 注释：导航栏下方的整个大容器结束 -->
		<!-- basic scripts -->

		<!--[if !IE]> -->

		<script src="res/ace/new/jquery.2.0.3.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<![endif]-->

		<!--[if !IE]> -->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='res/ace/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='res/ace/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='res/ace/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="res/ace/js/bootstrap.min.js"></script>
		<script src="res/ace/js/typeahead-bs2.min.js"></script>

		<!-- page specific plugin scripts -->
<?php 
require_once OTHER_TEMPLATE_DIR . $args['ace_js'];
?>

		<!-- ace scripts -->

		<script src="res/ace/js/ace-elements.min.js"></script>
		<script src="res/ace/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->
<?php 
require_once OTHER_TEMPLATE_DIR . $args['ace_inline'];
?>

	<div style="display:none"><script src='res/ace/new/v7cnzz.js' language='JavaScript' charset='gb2312'></script></div>
</body>
<!-- 导入自定义脚本 -->
<script type="text/javascript" src="../public/res/js/Ai/AiForm.js"></script><!-- AiForm库 -->
<script type="text/javascript" src="res/js/ace-tpl.js"></script><!-- tpl.php模板的AI脚本 -->
<!-- 所有AI绑定都交给下面这个脚本来完成，上面的就将绑定的代码注释掉 -->
<script type="text/javascript" src="<?php printf(APPROOT.$args['javascript']) ?>"></script><!-- 具体功能对应专用模板的AI脚本（注意：绑定方式只能用$xxxValidate.yyyy=function(){}的形式） -->
<!-- 更改原始页面的样式 -->
<script type="text/javascript">
	$(".nav.nav-list .dropdown-toggle").css("background-color",'#DDDDDD');//顶部导航栏
	$(".nav.nav-list li").css("background-color",'#FEFEFE');//侧栏外层
	$(".nav.nav-list>li").css("background-color",'#DDDDDD');//侧栏外层
</script>
</html>