//编写：AI表单对应的反馈数据处理方法集合
jQuery(document).ready(function($){
	
//------------------------------------------------------------
	
	/**
	 * 【表单】
	 * 验证表单验证过程的集合
	 */
	$AiFormValidates.xxx=function(args){return true;};
	$AiFormValidates.searchFleaAsKeyword = function (args){
		if(''==args[2]){
			alert('你要搜啥？');
			return false;
		}
		else
			return true;
	}
	
//------------------------------------------------------------
	
	
	/**
	 * 【表单】
	 * 处理ajax反馈数据的过程集合
	 */
	$AiFormDealResults.xxx=function(data){};
	/*
	 * 按关键字搜索，替换中间部分内容为搜索结果
	 */
	$AiFormDealResults.searchFleaAsKeyword = function(data){
		$('#mainpage-mos').replaceWith(data);
	}

	
//------------------------------------------------------------
	
	
	/**
	 * 【ai-ajax控件】
	 * 绑定ajax通信前验证过程
	 */
	$AiAjaxValidates.xxx=function(){};
	
	
//------------------------------------------------------------
	
	
	/**
	 * 【ai-ajax控件】
	 * 绑定ajax通信后处理反馈数据的过程
	 */
	$AiAjaxDealResults.xxx=function(data){};
	//分页：随便看看
	$AiAjaxDealResults.randomSearch = function(data){
		$('#mainpage-mos').replaceWith(data);
	}
	//分页：按照分类
	$AiAjaxDealResults.fleatypeSearch = function(data){
		$('#mainpage-mos').replaceWith(data);
	}
	//分页：按照关键字
	$AiAjaxDealResults.searchFleaAsKeyword = function(data){
		$('#mainpage-mos').replaceWith(data);
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
	
	
//------------------------------------------------------------
	
	//使类为ai-skip的普通控件具有跳转功能
	$AiForm.replaceDocWithClickAiSkip();
	

});











//------------------------------实用方法-------------------------------

//监听表单回车提交事件
function EnterPress(e){ //传入 event 
	var e = e || window.event; 
	if(e.keyCode == 13){
		//alert($(".ai-submit")[0]);
		$(".ai-submit")[0].click();
	} 
}
