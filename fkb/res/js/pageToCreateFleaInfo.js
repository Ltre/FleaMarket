//编写：AI表单对应的反馈数据处理方法集合
jQuery(document).ready(function($){
//------------------------------------------------------------
	/**
	 * 【表单】
	 * 验证表单验证过程的集合
	 */
	/*
	 * 验证表单并发布旧货信息
	 * AI参数：标题、分类、价格、sell/buy
	 * 附加常规参数：details，编辑器内容，使用POST提交
	 */
	$AiFormValidates . publishNewFleaInfo = function(args){
		if(args[1]==''||args[3]==''||args[4]==''){
			alert('标题、物品名、价格等不能为空');
			return false;
		}
		if(args[1].length > 30){
			alert('标题长度超过30');
			return false;
		}
		if(args[3].length > 10){
			alert('物品名长度超过10');
			return false;
		}
		if(! /^\d+(\.?\d+)*$/.test(args[4])){
			alert('价格只能用正数输入');
			return false;
		}
		//封面图片验证
		var sin = $('#saveimgname').val();
		if(''==sin){
			alert('请上传封面图片');
			return false;
		}
		var url = "?x=publishNewFleaInfo";
		for(var i=1;i<=6;i++){
			url += "|" + encodeURIComponent(args[i]);
		}
		var jsn = {
			//编辑器内容  POST提交的内容不需要encodeURIComponent()
			//details :  $('textarea[name=fleadetail]').val()
			details :  $('#editor1').html() ,
			saveimgname : sin
		};
		if(jsn.details==''||jsn.details=='<br>'){
			alert('描述信息不能为空');
			return false;
		}
		$.post(url, jsn, function(data){
			data = eval("("+data+")");
			if('PUBSUCCESS'==data.status||'EDITSUCCESS'==data.status){
				var pc = $('.page-content')
				pc.empty();
				var mbargs = {titlecode:data.content.titlecode, opttype:args[5]};
				$.post('?x=ace-fleaopt-pageToCreateFleaInfo-pubresult', mbargs, function(dat){
					pc.append(dat);//获取编辑结果模板
				});
			}else{
				if('NOIMAGE'==data.status){
					alert(data.msg);
				}
				var msg = '';
				$.each(data.content, function(index,value){
					msg += index + " : " + value + '<br>';
				});
			}
		});
		return false;//阻止AI的默认提交，改用自己的方式
	};
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
//------------------------------------------------------------
	/**
	 * 【ai-ajax控件】
	 * 绑定ajax通信后处理反馈数据的过程
	 */
	$AiAjaxDealResults.xxx=function(data){};
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
	/**
	 * 普通控件部分
	 */
	//使类为ai-skip的普通控件具有跳转功能
	$AiForm.replaceDocWithClickAiSkip();
	
	
	
});
