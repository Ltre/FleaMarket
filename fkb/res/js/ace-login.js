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
				$.gritter.add({
					title: '登录检查',
					text: '<p style="font-size:16px;font-family:微软雅黑;font-weight:bold;">你好像忘了填什么了。。</p>',
					class_name: 'gritter-info gritter-center gritter-light'
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
			var pstyle = 'style="font-size:16px;font-family:微软雅黑;font-weight:bold;"';
			for(i=1;i<=7;i++){
				if(args[i]==''){
					report += '<p '+pstyle+'>信息填完整了？</p>';
					flag = false;
					break;
				}
			}
			if(''==args[5]||args[5]!=args[6]){
				report += '<p '+pstyle+'>你确定密码没问题了？</p>';
				flag = false;
			}
			if( "undefined"==typeof($("#user_register .ai-args-7:checked").val()) ){
				report += '<p '+pstyle+'>看协议了么？</p>';
				flag = false;
			}
			if(flag)
				return true;
			else{
				$.gritter.add({
					title: '注册提示',
					text: report,
					class_name: 'gritter-info gritter-center'
				});
				return false;
			}
			//return true;
		},
		/*
		 * 找回密码 
		 */
		user_find : function(args){
			if(''==args[1]){
				alert('邮箱呢？');
				return false;
			}
			return true;
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
				window.open(location.href, '_self');//兼容IE的方案
			}else{
				$.gritter.add({
					title: '登录提示',
					text: jsn.msg,
					class_name: 'gritter-info gritter-center gritter-light'
				});
			}
		},
		/*
		 * 注册反馈数据处理
		 */
		user_register : function(data){
			$.gritter.add({
				title: '注册提示',
				text: data,
				class_name: 'gritter-info gritter-center'
			});
			//注册成功时添加“现在登录”按钮,#regresult是后台反馈数据时添加的
			if(undefined!=$('#regresult').html()){
				$('#regresult').click(function(){
					var username = encodeURIComponent($('#user_register .ai-args-3').val());
					var password = encodeURIComponent($('#user_register .ai-args-5').val());
					var posturl = '?x=user_login|'+username+'|'+password;
					$.post(posturl,function(dat){
						$AiFormDealResults.user_login(dat);//借用登录结果方法
					});
				});
			}
		},
		/*
		 * 找回密码
		 */
		user_find : function(data){
			var data = eval('('+data+')');
			alert(data.tip);
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

	
	
	
//===================================公共事件绑定部分===================================//
	/**
	 * 登录回车键
	 */
	
	
	/**
	 * 显示协议和条款
	 */
	$('#acceptxieyi').on(ace.click_event, function(){
		var content = null;
		for(var i=0;i<88;i++)
			content += '条款内容';
		var pstyle = 'style="font-size:13px;font-family:微软雅黑;font-weight:bold;"';
		$.gritter.add({
			title: '<center><b>协议和条款</b></center>',
			text: '<p '+pstyle+'>'+content+'</p>',
			class_name: 'gritter-center gritter-light'
		});
		return false;
	});
	
	
});