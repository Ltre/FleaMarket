
//编写：AI表单对应的反馈数据处理方法集合
jQuery(document).ready(function($){
//------------------------------------------------------------
	/**
	 * 【表单】
	 * 验证表单验证过程的集合
	 */
	$AiFormValidates .xxx=function(args){}
	
	/*
	 * 修改用户信息
	 */
	$AiFormValidates.updateProfile = function(args){
		alert(123);
		var flag = true;
		$.each(args, function(index, ele){
			if(index>3) return;//只取前三个
			if(''==ele) flag = false;
		});
		var url = $AiForm.assemblyShellParams('updateProfile',args);
		var gd = $('#updateProfile :checked').val();
		var sm = $('#updateProfile textarea').val();
		if( !flag || gd==undefined || ''==sm ){
			alert('信息未填完整，不允许提交');
			return false;
		}
		$.post(url, {gender:gd, summary:sm}, function(data){
			var data = eval('('+data+')');
			alert(data.msg);
		});
		return false;
	}
	
	/*
	 * 修改个人密码
	 */
	$AiFormValidates.updatePassword = function(args){
		var $flag = true;
		if(args[4]=='***'||args[5]=='***'||args[6]=='***'){
			alert('信息未填完整，不允许提交');
			return false;
		}
		if(args[5]!=args[6]){
			alert('两次输入的新密码不一致');
			return false;
		}
		var url = $AiForm.assemblyShellParams('updatePassword',args);
		alert(url);
		$.post(url, function(data){
			var data = eval('('+data+')');
			alert(data.msg);
		});
		return false;
	}
//------------------------------------------------------------
	/**
	 * 【表单】
	 * 处理ajax反馈数据的过程集合
	 */
	$AiFormDealResults.xxx=function(data){};
//------------------------------------------------------------
	/**
	 * 【ai-ajax控件】
	 * 绑定ajax通信前验证过程
	 */
	$AiAjaxValidates.xxx=function(){};
	/*
	 * 删除个人收藏的旧货信息前提示
	 */
	$AiAjaxValidates.delMyCollect = function(){
		return confirm('你确定要删除？');
	}

//------------------------------------------------------------
	/**
	 * 【ai-ajax控件】
	 * 绑定ajax通信后处理反馈数据的过程
	 */
	$AiAjaxDealResults.xxx=function(data){};
	/*
	 * 关注某用户
	 */
	$AiAjaxDealResults.addUserFollow = function(data){
		var data = eval('('+data+')');
		alert(data.msg);
	}
	/*
	 * 纳入联系人
	 */
	$AiAjaxDealResults.addAsContacts = function(data){
		switch(data){
		case '0':alert('暂时无法添加');break;
		case '1':alert('添加成功');break;
		case '2':alert('不能添加自己');break;
		case '3':alert('你们已经是联系人了');break;
		}
	};
	/*
	 * 删除自己的一条收藏
	 */
	$AiAjaxDealResults.delMyCollect = function(data){
		var data = eval('('+data+')');
		alert(data.msg);
		if(data.status=='SUCCESS'){
			$('#collect_'+data.deleted_id).remove();
		}
	}
//------------------------------------------------------------
	/**
	 * 绑定统一过程的AI控件
	 */
	//$AiForm.bindCommonAjaxValidateAndFeedback(selector, validate, feedback);
//------------------------------------------------------------
	//将表单验证和数据处理方法集合 绑定到 对应表单
	$AiForm.aiFormBindFeedBack( $AiFormValidates, $AiFormDealResults );
	$AiForm.aiAjaxBindFeedBack( $AiAjaxValidates, $AiAjaxDealResults );
	//使类为ai-skip的普通控件具有跳转功能
	$AiForm.replaceDocWithClickAiSkip();
//------------------------------------------------------------
	/**
	 * 普通控件部分
	 */
	
	/*
	 * 点击联系人，打开查看其个人信息页面
	 */
	$(".click_user_to_info").click(function(){
		var hrefz = $(this).attr("href");
		//window.open(hrefz, '_blank');
		location.href = hrefz;
	});

	
	
});









// --------------------------------------------------------


/**
 * 点击“基本信息”选项卡
 */
function changeToUpdateProfile(){
	$('#updatePassword [class~=ai-submit]').first().unbind();
	$('#updatePassword').attr('shell', 'updateProfile');
	$('#updatePassword').attr('id', 'updateProfile');
	$AiForm.aiFormBindFeedBack( $AiFormValidates, $AiFormDealResults );
}

/**
 * 点击“修改密码”选项卡
 */
function changeToUpdatePassword(){
	$('#updateProfile [class~=ai-submit]').first().unbind();
	$('#updateProfile').attr('shell', 'updatePassword');
	$('#updateProfile').attr('id', 'updatePassword');
	$AiForm.aiFormBindFeedBack( $AiFormValidates, $AiFormDealResults );
}
