<!DOCTYPE HTML>
<html dir="ltr" lang="en-US">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title>华软旧货市场</title>
	<script type="text/javascript" src="<?php printf(APPROOT.JQUERY_LIB_PATH); ?>"></script>
	<script type="text/javascript" src="../public/res/js/Ai/AiForm.js"></script><!-- 导入AI表单支持库 -->
	
	<script type="text/javascript">
	//编写：AI表单对应的反馈数据处理方法集合
	jQuery(document).ready(function($){
		//初始化AI控件的事件绑定
		$AiForm.replaceDocWithClickAiSkip();
		//表单验证过程
		$AiFormValidates = {
				
				//示例【指令名称：function(args){处理过程。。。}】
				loginCheck : function (args){
					
					//假定验证成功
					if(true){
						alert("表单数据通过验证，数据准备提交...");
						return true;
					}else{
						alert("表单数据不合法！");
						return false;
					}
				}
		};
		//处理ajax反馈数据的过程集合
		$AiFormDealResults = {
			//示例【指令名称 : function(data){处理过程。。。}】
			loginCheck : function(data){
				//alert("处理loginCheck指令返回信息"+data);
				var doc = document.open("text/html","replace");
				doc.write(data);
				doc.close();
			}
		};
		//将数据处理方法集合 绑定到 对应表单
		$AiForm.aiFormBindFeedBack($AiFormValidates,$AiFormDealResults );
	});
		//回车键事件
	function EnterPress(e){ //传入 event 
		var e = e || window.event; 
		if(e.keyCode == 13){
			//alert($(".ai-submit")[0]);
			$(".ai-submit")[0].click();
		} 
		}
	</script>
	
	<!-- <script type="text/javascript" src="res/login/login.js"></script> -->
	<!--- CSS --->
	<link rel="stylesheet" href="res/login/style.css" type="text/css" />


	<!--- Javascript libraries (jQuery and Selectivizr) used for the custom checkbox --->

	<!--[if (gte IE 6)&(lte IE 8)]>
		<script type="text/javascript" src="jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="selectivizr.js"></script>
		<noscript><link rel="stylesheet" href="res/login/fallback.css" /></noscript>
	<![endif]-->

	</head>

	<body onkeypress="EnterPress(event)">
		<div id="container">
			<!-- <form action="core/tpl/default/login/welcome.html"> -->
			<form id="loginCheck" class="ai-form" >
				<div class="login">登录</div>
				<div class="username-text">用户名:</div>
				<div class="password-text">密码:</div>
				<div class="username-field">
					<input type="text" class="ai-args-1" name="username" value="" />
				</div>
				<div class="password-field">
					<input type="password" class="ai-args-2" name="password" value="" />
				</div>
				<input type="checkbox" name="remember-me" id="remember-me" /><label for="remember-me">记住密码</label>
				<div class="forgot-usr-pwd">忘记 <a href="#">用户名</a> 或 <a href="#">密码</a>?</div>
				<!-- <input type="submit" name="submit" value="GO" /> -->
				<input type="button" name="submit" class="ai-submit" value="GO"/>
			</form>
		</div>
		<div id="footer">
			Web 2.0 AI team and Login More Templates <a href="#" target="_blank" title="华软旧货市场">华软旧货市场</a>
		</div>
	</body>
	
</html>
