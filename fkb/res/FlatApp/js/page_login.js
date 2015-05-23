//编写：AI表单对应的反馈数据处理方法集合
jQuery(document).ready(function($){
	/**
	 * 【表单】
	 * 验证表单验证过程的集合
	 */
	$AiFormValidates = {
		//示例【指令名称：function(args){处理过程。。。}】
		//用户登录验证
		user_login : function(args){
			if(args[1]==''||args[2]==''){
				if(undefined!=$('#login_nomima').html())
					$('#login_nomima').remove();
				$('body').append('<div id="login_nomima" class="modal hide fade in" aria-hidden="false" style="display:block;"><div class="modal-body text-left">'
						+'<p>你好像忘了填什么了。。</p></div></div>');
				$('#login_nomima').click(function(){
					$('#login_nomima').remove();
				});
				return false;
			}
			return true;
		},
		/*
		 * 用户注册验证
		 */
		user_register : function(args){
			var flag = true;
			var report = '<h5>请检查下：</h5>';
			for(i=1;i<=7;i++){
				if(args[i]==''){
					report += '<p>信息填完整了？</p>';
					flag = false;
					break;
				}
			}
			if(''==args[5]||args[5]!=args[6]){
				report += '<p>你确定密码没问题了？</p>';
				flag = false;
			}
			if( "undefined"==typeof($("#user_register .ai-args-7:checked").val()) ){
				report += '<p>看协议了么？</p>';
				flag = false;
			}
			if(flag)
				return true;
			else{
				if( undefined!=$('#register_error_tip').html() )
					$('#register_error_tip').remove();
				$('body').append('<div id="register_error_tip" class="modal hide fade in" aria-hidden="false" style="display:block;"><div class="modal-body text-left">'
					+ report + '</div></div>');
				$('#register_error_tip').click(function(){
					$(this).remove();
				});
				return false;
			}
			//return true;
		}
	};
	/**
	 * 【表单】
	 * 处理ajax反馈数据的过程集合
	 */
	$AiFormDealResults = {
		//示例【指令名称 : function(data){处理过程。。。}】
		/*
		 * 登录反馈数据处理
		 */
		user_login : function(data){
			var jsn = eval("("+data+")");
			if('SUCCESS' == jsn.status){
//				$AiForm.replaceDocWithUrl('?x=matrix-matrix');//转到页面
				window.open(location.href, '_self');//兼容IE的方案
			}else{
				//DIV提示框
				if(undefined!=$('#ai-login-rs').html())
					$('#ai-login-rs').remove();
				$('body').append(jsn.msg);
				//关闭提示框
				$('html').click(function(){
					$('#ai-login-rs').remove();
				});
			}
		},
		/*
		 * 注册反馈数据处理
		 */
		user_register : function(data){
			//DIV提示框
			if(undefined!=$('#ai-register-rs').html())
				$('#ai-register-rs').remove();
			$('body').append(data);
			//注册成功时添加“现在登录”按钮
			if(undefined!=$('#ai-register-rs button').html())
				$('#ai-register-rs button').click(function(){
					var username = encodeURIComponent($('#user_register .ai-args-3').val());
					var password = encodeURIComponent($('#user_register .ai-args-5').val());
					var posturl = '?x=user_login|'+username+'|'+password;
					$.post(posturl,function(dat){
						$AiFormDealResults.user_login(dat);//借用登录结果方法
					});
				});
			//关闭提示框
			$('html').click(function(){
				$('#ai-register-rs').remove();
			});
		}
	};
	/**
	 * 【ai-ajax控件】
	 * 绑定ajax通信前验证过程
	 */
	$AiAjaxValidates = {
			
	};

	/**
	 * 【ai-ajax控件】
	 * 绑定ajax通信后处理反馈数据的过程
	 */
	$AiAjaxDealResults = {
			
	};
	/**
	 * 绑定统一过程的AI控件
	 */
	//$AiForm.bindCommonAjaxValidateAndFeedback(selector, validate, feedback);
	//将表单验证和数据处理方法集合 绑定到 对应表单
	$AiForm.aiFormBindFeedBack( $AiFormValidates, $AiFormDealResults );
	$AiForm.aiAjaxBindFeedBack( $AiAjaxValidates, $AiAjaxDealResults );
	/**
	 * 普通控件部分
	 */
	//使类为ai-skip的普通控件具有跳转功能
	$AiForm.replaceDocWithClickAiSkip();

//===================================公共函数部分===================================//
	/**
	 * 登录回车键
	 */
	
	
});