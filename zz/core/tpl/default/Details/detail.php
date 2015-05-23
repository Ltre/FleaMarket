<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>华软旧货市场管理系统 </title>
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!-- basic styles -->

		<link href="res/assets/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="res/assets/css/font-awesome.min.css" />

		<!--[if IE 7]>
		  <link rel="stylesheet" href="res/assets/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!-- page specific plugin styles -->

		<!-- fonts -->

		<!-- <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" /> -->
		<link rel="stylesheet" href="res/assets/css/css.css" />
		<!-- ace styles -->

		<link rel="stylesheet" href="res/assets/css/ace.min.css" />
		<link rel="stylesheet" href="res/assets/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="res/assets/css/ace-skins.min.css" />

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="res/assets/css/ace-ie.min.css" />
		<![endif]-->
		<link rel=stylesheet type=text/css href="res/assets/css/jquery-ui-1.10.4.custom.css"/>
		<link rel=stylesheet type=text/css href="res/css/style.css"/>
		<!-- inline styles related to this page -->

		<!-- ace settings handler -->

		<script src="res/assets/js/ace-extra.min.js"></script>
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

		<!--[if lt IE 9]>
		<script src="res/assets/js/html5shiv.js"></script>
		<script src="res/assets/js/respond.min.js"></script>
		<![endif]-->
		
	</head>

	<body>
<?php $user = $_SESSION['user'];?>
		<div class="navbar navbar-default" id="navbar">
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>

			<div class="navbar-container" id="navbar-container">
				<div class="navbar-header pull-left">
					<a href="#" class="navbar-brand">
						<small>
							<i class="icon-leaf"></i>
							华软旧货市场管理系统
						</small>
					</a><!-- /.brand -->
				</div><!-- /.navbar-header -->

				<div class="navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="<?php print UserUtil::getUserAvatarUrl($user->id) ?>" alt="Jason's Photo" />
								<span class="user-info">
									<small>欢迎您！</small>
									<?php echo $user->username?>
								</span>

								<i class="icon-caret-down"></i>
							</a>

							<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<!-- <li>
									<a href="#">
										<i class="icon-cog"></i>
										Settings
									</a>
								</li> -->

								<li>
									<a href="<?php echo "../fkb?x=displayProfile|".$user->id ?>" target="_blank">
										<i class="icon-user"></i>
										个人信息
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="./?x=user_logout" shell="user_logout" class="ai-ajax">
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

		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			<div class="main-container-inner">
				<a class="menu-toggler" id="menu-toggler" href="#">
					<span class="menu-text"></span>
				</a>

				<div class="sidebar" id="sidebar">
					<script type="text/javascript">
						try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
					</script>

					<div class="sidebar-shortcuts" id="sidebar-shortcuts">
						

						<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
							<span class="btn btn-success"></span>

							<span class="btn btn-info"></span>

							<span class="btn btn-warning"></span>

							<span class="btn btn-danger"></span>
						</div>
					</div><!-- #sidebar-shortcuts -->
<ul class="nav nav-list">
						
				 <li class="active open">
							<a href="#" class="dropdown-toggle">
								<i class="icon-list"></i>
								<span class="menu-text"> 信息管理中心 </span>

								<b class="arrow icon-angle-down"></b>
							</a>

							<ul class="submenu">
								<li class="active">
									<a href="#" class="ai-sike ai-userinfo" shell="formwork" params="userlist">
										<i class="icon-double-angle-right"></i>
										用户信息
									</a>
								</li>

								<li>
									<a href="#" class="ai-sike" shell="formwork" params="authorityinfo">
										<i class="icon-double-angle-right"></i>
										权限信息
									</a>
								</li>
							</ul>
						</li> 
						<li>
							<a href="#" class="dropdown-toggle">
								<i class="icon-list"></i>
								<span class="menu-text" > 旧货管理 </span>

								<b class="arrow icon-angle-down"></b>
							</a>

							<ul class="submenu">
								<li>
									<a href="?x=listSelfSell|10|0" >
										<i class="icon-double-angle-right"></i>
										转让管理
									</a>
								</li>

								<li>
									<a href="?x=listSelfBuy|10|0" >
										<i class="icon-double-angle-right"></i>
										求购管理
									</a>
								</li>
							</ul>
						</li> 
						<li>
							<a href="#" class="ai-sike ai-foundation" shell="formwork" params="foundation" >
								<i class="icon-list"></i>
								<span class="menu-text"> 违规处理 </span>
							</a>
						</li>
						<li>
							<a href="#" class="ai-sike" shell="formwork" params="volation" >
								<i class="icon-list"></i>
								<span class="menu-text"> 基础设定 </span>
							</a>
						</li>
						
						
					</ul><!-- /.nav-list -->

					<div class="sidebar-collapse" id="sidebar-collapse">
					
						<i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
					</div>

					<script type="text/javascript">
						try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
					</script>
				</div>

				<div id ="state" state="true"></div>
				<div id="dialog" title="用户详情：" style="display:none">消息框</div>
					<!-- 	调节 -->
				<div class="main-content">
						
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
							<li>
								<i class="icon-home home-icon"></i>
								<a href="#">首页</a>
							</li>

							<li>
								<a href="#">信息中心</a>
							</li>
							<li class="active"></li>
						</ul><!-- .breadcrumb -->

						<!--<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="icon-search nav-search-icon"></i>
								</span>
							</form>
						</div> #nav-search -->
					</div>
					 <?php 
					/*  $args = ActionUtil::getTplArgs();
					 print_r( $args);
					 require_once ACTION_TEMPLATE_DIR . 'Details/userlist.php'; */
					 //require_once ACTION_TEMPLATE_DIR . $args['page_content'];
					  ?> 
						<div class="page-content">
							<center>
								<h1>
									欢迎登陆！
								</h1>
							</center>
						</div>	
				</div><!-- /.main-content -->
				
				<div class="ace-settings-container" id="ace-settings-container">
					<div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
						<i class="icon-cog bigger-150"></i>
					</div>

					<div class="ace-settings-box" id="ace-settings-box">
						<div>
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
							<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-navbar" />
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
								<!-- <b>.container</b> -->
							</label>
						</div>
					</div>
				</div><!-- /#ace-settings-container -->
			</div><!-- /.main-container-inner -->

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="icon-double-angle-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->
		
		<!-- basic scripts -->

		<!--[if !IE]> -->

		<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script> -->
		<script src="res/assets/js/jquery-2.0.3.min.js"></script>
		<script src="res/assets/js/jquery-ui-1.10.4.custom.min.js"></script> 
		<!-- <![endif]-->

		<!--[if IE]>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 
		<script src="res/assets/js/jquery-1.10.2.min.js"></script>
<![endif]-->

		<!--[if !IE]> -->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='res/assets/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='res/assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='res/assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="res/assets/js/bootstrap.min.js"></script>
		<script src="res/assets/js/typeahead-bs2.min.js"></script>

		<!-- page specific plugin scripts -->

		<script src="res/assets/js/jquery.dataTables.min.js"></script>
		<script src="res/assets/js/jquery.dataTables.bootstrap.js"></script>

		<!-- ace scripts -->

		<script src="res/assets/js/ace-elements.min.js"></script>
		<script src="res/assets/js/ace.min.js"></script>
		<script src="../public/res/js/Ai/AiForm.js"></script><!-- AiForm库 -->
		<!-- inline scripts related to this page -->

		<script type="text/javascript">
			jQuery(function($) {
				var oTable1 = $('#sample-table-2').dataTable( {
				"aoColumns": [
			      { "bSortable": false },
			      null, null,null, null, null,
				  { "bSortable": false }
				] } );
				
				
				$('table th input:checkbox').on('click' , function(){
					var that = this;
					$(this).closest('table').find('tr > td:first-child input:checkbox')
					.each(function(){
						this.checked = that.checked;
						$(this).closest('tr').toggleClass('selected');
					});
						
				});
			//模板替换右侧栏
			$AiForm.bindCommonAjaxValidateAndFeedback(
								$("[class~=ai-sike]"),
								function(data){
									//alert('$("[class~=ai-sike]")所选控件的验证过程');
									return true;//使用false则视为验证不通过
								},
								function(data){
									//alert("统一处理ajax反馈的数据："+data);
									//
									$("[class~=page-content]").replaceWith(data);
									$("div#dialog").dialog('close');
									});
			
				$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('table')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
			});
		</script>
		
		<!--   <div style="display:none"><script src='res/assets/js/stat.js' language='JavaScript' charset='utf-8'></script></div>-->
	
</body>
</html>
