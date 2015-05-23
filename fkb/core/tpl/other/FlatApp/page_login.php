<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">

        <title>FlatApp - Premium, Responsive and Flat Bootstrap Admin Dashboard Template</title>

        <meta name="description" content="FlatApp is a Premium, Responsive and Flat Bootstrap Admin Dashboard Template created by pixelcave and published on Themeforest.">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">

        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="res/FlatApp/img/favicon.ico">
        <link rel="apple-touch-icon" href="res/FlatApp/img/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="57x57" href="res/FlatApp/img/apple-touch-icon-57x57-precomposed.png">
        <link rel="apple-touch-icon" sizes="72x72" href="res/FlatApp/img/apple-touch-icon-72x72-precomposed.png">
        <link rel="apple-touch-icon" sizes="114x114" href="res/FlatApp/img/apple-touch-icon-114x114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="res/FlatApp/img/apple-touch-icon-precomposed.png">
        <!-- END Icons -->

        <!-- Stylesheets -->
        <!-- The roboto font is included from Google Web Fonts -->
        <!-- <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,400italic,700,700italic"> -->
        <link rel="stylesheet" href="res/FlatApp/css/new/googleapis-fonts.css">

        <!-- Bootstrap is included in its original form, unaltered -->
        <link rel="stylesheet" href="res/FlatApp/css/bootstrap.css">

        <!-- Related styles of various icon packs and javascript plugins -->
        <link rel="stylesheet" href="res/FlatApp/css/plugins.css">

        <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
        <link rel="stylesheet" href="res/FlatApp/css/main.css">

        <!-- Load a specific file here from css/themes/ folder to alter the default theme of all the template -->

        <!-- The themes stylesheet of this template (for using specific theme color in individual elements (must included last) -->
        <link rel="stylesheet" href="res/FlatApp/css/themes.css">
        <!-- 自定义该页面css -->
        <link rel="stylesheet" href="res/FlatApp/css/page_login.css">
        <!-- END Stylesheets -->

        <!-- Modernizr (Browser feature detection library) & Respond.js (Enable responsive CSS code on browsers that don't support it) -->
        <script src="res/FlatApp/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <!-- 导入自定义脚本 -->
        <script src="<?php printf(APPROOT.JQUERY_LIB_PATH)?>"></script>
        <script type="text/javascript">
			/*jQuery(document).ready(function($){
				$('.right-door,.left-door').hide();
				$('.login-btn.themed-background-default').hide();
				$('#login-container').css('display','block');
			});*/
		</script>
    </head>

    <body class="login">

        <!-- Login Intro -->
        <a href="javascript:void(0)" class="login-btn themed-background-default">
            <span class="login-logo">
                <span class="square1 themed-border-default"></span>
                <span class="square2"></span>
                <span class="name">旧货市场</span>
            </span>
        </a>
        <div class="left-door"></div>
        <div class="right-door"></div>
        <!-- END Login Intro -->

        <!-- Login Container -->
        <div id="login-container" class="hide">
            <!-- Login Block -->
            <div class="block-tabs block-themed themed-border-night">
                <ul id="login-tabs" class="nav nav-tabs themed-background-deepsea" data-toggle="tabs">
                    <li class="active text-center">
                        <a href="#login-form-tab">
                            <i class="icon-user"></i> 登 录
                        </a>
                    </li>
                    <li class="text-center">
                        <a href="#register-form-tab">
                            <i class="icon-plus"></i> 注 册
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="login-form-tab">
                        <!-- Login Buttons -->
                        <!-- <div id="login-buttons">
                            <button id="login-btn-facebook" class="btn btn-large btn-primary"><i class="icon-facebook"></i> Facebook</button>
                            <button id="login-btn-twitter" class="btn btn-large btn-info"><i class="icon-twitter"></i> Twitter</button>
                        </div> -->
                        <!-- END Login Buttons -->

                        <!-- Login Form -->
                        <!-- <form action="index.html" method="post" id="login-form" class="form-inline"> -->
                        <form id="user_login" shell="user_login" class="form-inline ai-form">
                            <div class="control-group">
                                <div class="controls">
                                    <div class="input-prepend">
                                        <span class="add-on"><i class="icon-user"></i></span>
                                        <input type="text" class="ai-args-1" id="login-email" name="login-email" placeholder="用户名 / 学号">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <div class="input-prepend">
                                        <span class="add-on"><i class="icon-asterisk"></i></span>
                                        <input type="password" class="ai-args-2" id="login-password" name="login-password" placeholder="密码">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls clearfix">
                                    <div class="pull-right">
                                        <button type="button" class="btn btn-success remove-margin ai-submit">登录</button>
                                    </div>
                                    <div class="pull-left login-extra-check">
                                        <label for="login-remember-me">
                                            <input type="checkbox" id="login-remember-me" name="login-remember-me" class="input-themed">
                                            	记住我
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- END Login Form -->
                    </div>
                    <div class="tab-pane" id="register-form-tab">
                        <!-- Register Form -->
                        <!-- <form action="page_login.html" method="post" id="register-form" class="form-inline" onsubmit="return false;"> -->
                        <form id="user_register" shell="user_register" method="post" id="register-form" class="form-inline ai-form" onsubmit="return false;">
                            <div class="control-group">
                                <div class="controls">
                                    <div class="input-prepend">
                                        <span class="add-on"><i class="icon-user"></i></span>
                                        <input type="text" class="ai-args-1" id="register-username" name="register-username" placeholder="用户名">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <div class="input-prepend">
                                        <span class="add-on"><i class="icon-smile"></i></span>
                                        <input type="text" class="ai-args-2" id="register-email" name="register-email" placeholder="姓名">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <div class="input-prepend">
                                        <span class="add-on"><i class="icon-archive"></i></span>
                                        <input type="text" class="ai-args-3" id="register-email" name="register-email" placeholder="学号">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <div class="input-prepend">
                                        <span class="add-on"><i class="icon-envelope-alt"></i></span>
                                        <input type="text" class="ai-args-4" id="register-email" name="register-email" placeholder="华软邮箱">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <div class="input-prepend">
                                        <span class="add-on"><i class="icon-asterisk"></i></span>
                                        <input type="password" class="ai-args-5" id="register-password" name="register-password" placeholder="密码">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <div class="input-prepend">
                                        <span class="add-on"><i class="icon-asterisk"></i></span>
                                        <input type="password" class="ai-args-6" id="register-repassword" name="register-repassword" placeholder="确认密码">
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls text-center">
                                    <a href="#modal-terms" data-toggle="modal">协议与条款</a>
                                    <!-- Terms Modal -->
                                    <div id="modal-terms" class="modal hide fade">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">×</button>
                                            <h4>协议与条款</h4>
                                        </div>
                                        <div class="modal-body text-left">
                                            <h5>1. Heading</h5>
                                            <p>协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条</p>
                                            <h5>2. Heading</h5>
                                            <p>协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条</p>
                                            <h5>3. Heading</h5>
                                            <p>协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条</p>
                                            <h5>4. Heading</h5>
                                            <p>协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条</p>
                                            <h5>5. Heading</h5>
                                            <p>协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条款协议与条</p>
                                        </div>
                                    </div>
                                    <!-- END Terms Modal -->
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls clearfix">
                                    <div class="pull-right">
                                        <button type="button" class="btn btn-success remove-margin ai-submit">注册</button>
                                    </div>
                                    <div class="pull-left login-extra-check">
                                        <label for="register-terms">
                                            <input type="checkbox" id="register-terms" name="register-terms" class="input-themed ai-args-7">
                                            	接受协议和条款
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- END Register Form -->
                    </div>
                </div>
            </div>
            <!-- END Login Block -->
        </div>
        <!-- END Login Container -->

        <!-- Jquery library from Google ... -->
        <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->

        <!-- ... but if something goes wrong get Jquery from local file -->
        <script>!window.jQuery && document.write(unescape('%3Cscript src="<?php printf(APPROOT.JQUERY_LIB_PATH)?>"%3E%3C/script%3E'));</script>

        <!-- Bootstrap.js -->
        <script src="res/FlatApp/js/vendor/bootstrap.min.js"></script>

        <!--
        Include Google Maps API for global use.
        If you don't want to use the Google Maps API globally, just remove this line and the gmaps.js plugin from js/plugins.js (you can put it in a seperate file)
        Then iclude them both in the pages you would like to use the google maps functionality
        -->
        <!-- <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script> -->
        <script type="text/javascript" src="res/FlatApp/js/new/googlemap-sensor.js"></script>

        <!-- Jquery plugins and custom javascript code -->
        <script src="res/FlatApp/js/plugins.js"></script>
        <script src="res/FlatApp/js/main.js"></script>
        <!-- Javascript code only for this page -->
        <script>
            $(function() {
                var timeout = 0;

                // If our browser support transitions (class will be added with the help of modernizr library) add a timeout of 750ms
                // Nice fallback for our animation on older browser (such as IE8-9)
                if ($('html').hasClass('csstransitions'))
                    timeout = 750;

                // On button hover or touch reveal the login form
                $('.login-btn').mouseenter(function() {
                    $('.left-door, .right-door, .login-btn').addClass('login-animate');

                    setTimeout(function() {
                        $('#login-container').fadeIn(1500);
                        $('.login-btn .name').fadeOut(250, function() {
                            $('.login-btn .square1, .login-btn .square2').fadeIn(750);
                            $('#login-email').focus();
                        });
                    }, timeout);
                });
            });
        </script>
        <!-- 导入AI控件脚本 -->
		<script type="text/javascript" src="res/FlatApp/js/page_login.js"></script>
        <script type="text/javascript" src="../public/res/js/Ai/AiForm.js"></script>
    </body>
</html>