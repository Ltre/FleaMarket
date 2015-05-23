//编写：AI表单对应的反馈数据处理方法集合
$AiFormValidates = null;
$AiFormDealResults = null;
$AiAjaxValidates = null;
$AiAjaxDealResults = null;
jQuery(document).ready(function($){
//------------------------------------------------------------
	/**
	 * 【表单】
	 * 验证表单验证过程的集合
	 */
	$AiFormValidates = {
		//示例【指令名称：function(args){处理过程。。。}】
			
	};
//------------------------------------------------------------
	/**
	 * 【表单】
	 * 处理ajax反馈数据的过程集合
	 */
	$AiFormDealResults = {
		//示例【指令名称 : function(data){处理过程。。。}】
			
	};
//------------------------------------------------------------
	/**
	 * 【ai-ajax控件】
	 * 绑定ajax通信前验证过程
	 */
	$AiAjaxValidates = {
			
	};
//------------------------------------------------------------
	/**
	 * 【ai-ajax控件】
	 * 绑定ajax通信后处理反馈数据的过程
	 */
	$AiAjaxDealResults = {
			
	};
//------------------------------------------------------------
	/**
	 * 绑定统一过程的AI控件
	 */
	//$AiForm.bindCommonAjaxValidateAndFeedback(selector, validate, feedback);
//------------------------------------------------------------
	//将表单验证和数据处理方法集合 绑定到 对应表单
	/*$AiForm.aiFormBindFeedBack( $AiFormValidates, $AiFormDealResults );
	$AiForm.aiAjaxBindFeedBack( $AiAjaxValidates, $AiAjaxDealResults );*/
//------------------------------------------------------------
	/**
	 * 普通控件部分
	 */
	//使类为ai-skip的普通控件具有跳转功能
	/*$AiForm.replaceDocWithClickAiSkip();*/
});
