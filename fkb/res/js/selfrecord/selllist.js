//编写：AI表单对应的反馈数据处理方法集合
jQuery(document).ready(function($){
//------------------------------------------------------------
	/**
	 * 【表单】
	 * 验证表单验证过程的集合
	 */
	$AiFormValidates .xxx=function(args){}
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
	$AiAjaxValidates.delFleaInfo = function(){
		return confirm("确定删除？");
	};
//------------------------------------------------------------
	/**
	 * 【ai-ajax控件】
	 * 绑定ajax通信后处理反馈数据的过程
	 */
	/*
	 * 删除旧货信息
	 */
	$AiAjaxDealResults.delFleaInfo=function(data){
		data = eval('('+data+')');
		//alert('SUCCESS'==data.status?'删除成功':'删除失败');
		alert(data.msg);
		if('SUCCESS'!=data.status)
			return;
		//删除对应行
		$('[params*='+data.deleted+']').closest('tr').remove();
		var from = parseInt($('span#rs_from').text());
		var to = parseInt($('span#rs_to').text());
		var total = parseInt($('span#rs_total').text());
		to--;
		total--;
		$('span#rs_from').text(from);
		$('span#rs_to').text(to);
		$('span#rs_total').text(total);
		//如果本页所有记录全被删除，则跳到上一页
		if(to < from){
			var numPerPage = parseInt($('span#numPerPage').text());
			$AiForm.replaceDocWithShell('listSelfSell|'+numPerPage+'|'+(from-numPerPage));
		}
	};
//------------------------------------------------------------
	/**
	 * 绑定统一过程的AI控件
	 */
	//$AiForm.bindCommonAjaxValidateAndFeedback(selector, validate, feedback);
	/*
	 * 显示自己的转让详情
	 * 被绑定的控件：表格每行第二个单元格和最后一个单元格的预览按钮 
	 */
	$AiForm.bindCommonAjaxValidateAndFeedback(
		$('[shell~=getFleaDetails]'), 
		function(){return true}, 
		function(data){
			$('.page-content').replaceWith(data);
			$AiForm.replaceDocWithClickAiSkip();
		}
	);
//------------------------------------------------------------
	//将表单验证和数据处理方法集合 绑定到 对应表单
	$AiForm.aiFormBindFeedBack( $AiFormValidates, $AiFormDealResults );
	$AiForm.aiAjaxBindFeedBack( $AiAjaxValidates, $AiAjaxDealResults );
//------------------------------------------------------------
	/**
	 * 普通控件部分
	 */
	//使类为ai-skip的普通控件具有跳转功能
	$AiForm.replaceDocWithClickAiSkip();
	
	
	
});