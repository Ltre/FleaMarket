<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>登录——华软旧货市场</title>
		<meta name="keywords" content="华软旧货市场,Oreki,ActionInvoker" />
		<meta name="description" content="华软旧货市场" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!-- basic styles -->

		<link href="res/ace/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="res/ace/css/font-awesome.min.css" />

		<!--[if IE 7]>
		  <link rel="stylesheet" href="res/ace/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!-- page specific plugin styles -->
		
		<link rel="stylesheet" href="res/ace/css/jquery-ui-1.10.3.custom.min.css" />
		<link rel="stylesheet" href="res/ace/css/jquery.gritter.css" />
		
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

	<body class="login-layout">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="center">
								<h1>
									<i class="icon-leaf green"></i>
									<span class="red">华软</span>
									<span class="white">旧货市场</span>
								</h1>
								<h4 class="blue">&copy; Oreki团队</h4>
							</div>

							<div class="space-6"></div>

							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header blue lighter bigger">
												<i class="icon-coffee green"></i>
												请输入你的账号密码登录
											</h4>

											<div class="space-6"></div>

											<form id="user_login" shell="user_login" class="ai-form">
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control ai-args-1" placeholder="用户名或学号" />
															<i class="icon-user"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control ai-args-2" placeholder="密码" />
															<i class="icon-lock"></i>
														</span>
													</label>

													<div class="space"></div>

													<div class="clearfix">
														<label class="inline">
															<input type="checkbox" class="ace" />
															<span class="lbl"> 记住我</span>
														</label>

														<button type="button" class="width-35 pull-right btn btn-sm btn-primary ai-submit">
															<i class="icon-key"></i>
															登录
														</button>
													</div>

													<div class="space-4"></div>
												</fieldset>
											</form>

											<div class="social-or-login center hide">
												<span class="bigger-110">Or Login Using</span>
											</div>

											<div class="social-login center hide">
												<a class="btn btn-primary">
													<i class="icon-facebook"></i>
												</a>

												<a class="btn btn-info">
													<i class="icon-twitter"></i>
												</a>

												<a class="btn btn-danger">
													<i class="icon-google-plus"></i>
												</a>
											</div>
										</div><!-- /widget-main -->

										<div class="toolbar clearfix">
											<div class="hide"> <!-- 暂时隐藏该功能 -->
												<a href="#" onclick="show_box('forgot-box'); return false;" class="forgot-password-link">
													<i class="icon-arrow-left"></i>
													我忘记密码了
												</a>
											</div>

											<div>
												<a href="#" onclick="show_box('signup-box'); return false;" class="user-signup-link">
													注册新用户
													<i class="icon-arrow-right"></i>
												</a>
											</div>
										</div>
									</div><!-- /widget-body -->
								</div><!-- /login-box -->

								<div id="forgot-box" class="forgot-box widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header red lighter bigger">
												<i class="icon-key"></i>
												找回密码
											</h4>

											<div class="space-6"></div>
											<p>
												输入你注册时用的邮箱
											</p>

											<form id="user_find" shell="user_find" class="ai-form">
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="email" class="form-control ai-args-1" placeholder="邮箱" />
															<i class="icon-envelope"></i>
														</span>
													</label>

													<div class="clearfix">
														<button type="button" class="width-35 pull-right btn btn-sm btn-danger ai-submit">
															<i class="icon-lightbulb"></i>
															发送!
														</button>
													</div>
												</fieldset>
											</form>
										</div><!-- /widget-main -->

										<div class="toolbar center">
											<a href="#" onclick="show_box('login-box'); return false;" class="back-to-login-link">
												返回登录处
												<i class="icon-arrow-right"></i>
											</a>
										</div>
									</div><!-- /widget-body -->
								</div><!-- /forgot-box -->

								<div id="signup-box" class="signup-box widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header green lighter bigger">
												<i class="icon-group blue"></i>
												新用户注册
											</h4>

											<div class="space-6"></div>
											<p> 输入你的详细个人信息: </p>

											<form id="user_register" shell="user_register" method="post" id="register-form" class="ai-form" onsubmit="return false;">
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control ai-args-1" placeholder="用户名(可用于登录)" />
															<i class="icon-user"></i>
														</span>
													</label>
													
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control ai-args-2" placeholder="姓名(保密，不会公开)" />
															<i class="icon-book"></i>
														</span>
													</label>	
													
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control ai-args-3" placeholder="学号(可用于登录)" />
															<i class="icon-key"></i>
														</span>
													</label>											
													
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="email" class="form-control ai-args-4" placeholder="华软邮箱" />
															<i class="icon-envelope"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control ai-args-5" placeholder="设定你的密码" />
															<i class="icon-lock"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" class="form-control ai-args-6" placeholder="再重复输入密码" />
															<i class="icon-retweet"></i>
														</span>
													</label>

													<label class="block">
														<input type="checkbox" id="register-terms" name="register-terms" class="ace ai-args-7" />
														<span class="lbl">
															我接受
															<a id="acceptxieyi" style="cursor: pointer;">协议和条款</a>
														</span>
													</label>
													
													<div class="space-24"></div>

													<div class="clearfix">
														<button type="reset" class="width-30 pull-left btn btn-sm">
															<i class="icon-refresh"></i>
															重置
														</button>

														<button type="button" class="width-65 pull-right btn btn-sm btn-success ai-submit">
															注册
															<i class="icon-arrow-right icon-on-right"></i>
														</button>
													</div>
												</fieldset>
											</form>
										</div>

										<div class="toolbar center">
											<a href="#" onclick="show_box('login-box'); return false;" class="back-to-login-link">
												<i class="icon-arrow-left"></i>
												返回登录处
											</a>
										</div>
									</div><!-- /widget-body -->
								</div><!-- /signup-box -->
							</div><!-- /position-relative -->
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->

		<script src="res/ace/js/jquery-2.0.3.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="res/ace/js/jquery-1.10.2.min.js"></script>
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

		<!--[if lte IE 8]>
		  <script src="res/ace/js/excanvas.min.js"></script>
		<![endif]-->

		<script src="res/ace/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="res/ace/js/jquery.ui.touch-punch.min.js"></script>
		<script src="res/ace/js/bootbox.min.js"></script>
		<script src="res/ace/js/jquery.easy-pie-chart.min.js"></script>
		<script src="res/ace/js/jquery.gritter.min.js"></script>
		<script src="res/ace/js/spin.min.js"></script>

		<!-- ace scripts -->

		<script src="res/ace/js/ace-elements.min.js"></script>
		<script src="res/ace/js/ace.min.js"></script>
		
		<!-- inline scripts related to this page -->

		<script type="text/javascript">
			function show_box(id) {
			 jQuery('.widget-box.visible').removeClass('visible');
			 jQuery('#'+id).addClass('visible');
			}
		</script>
	<!-- <div style="display:none"><script src='res/ace/new/v7cnzz.js' language='JavaScript' charset='gb2312'></script></div> -->
    <!-- 导入AI控件脚本 -->
    <script type="text/javascript" src="../public/res/js/Ai/AiForm.js"></script>
	<script type="text/javascript" src="res/js/ace-login.js"></script>
</body>
</html>
