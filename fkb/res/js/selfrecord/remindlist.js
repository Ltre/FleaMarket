
$ThisPage = {};//本页全局变量

//编写：AI表单对应的反馈数据处理方法集合
jQuery(document).ready(function($){
//------------------------------------------------------------
	/**
	 * 【表单】
	 * 验证表单验证过程的集合
	 */
	$AiFormValidates .xxx=function(args){};
	/*
	 * 发送私信
	 */
	$AiFormValidates.sendPersonalLetter = function(args){
		var content = $("#wysiwyg-editor").html();
		if(args[4]==''||args[3]==0||content==''||content=='<br>'){
			alert('请把信息填完整再发');
			return false;
		}
		if(args[4].length>18){
			alert('主题长度不能超过18');
			return false;
		}
		var url = $AiForm.assemblyShellParams('sendPersonalLetter', args);
		$.post(url, {contents:content}, function(data){
			alert(data);
		});
		return false;
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
	/*
	 * 删除预订信息
	 */
	$AiAjaxDealResults.xxx=function(data){
	};
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

	
	
	/**
	 * 点击展开私信详情
	 */
	$('.message-list .message-item .text').on('click', function(){
		var message = $(this).closest('.message-item');
		//if message is open, then close it
		if(message.hasClass('message-inline-open')) {
			message.css('background-color','');//取消提醒高亮显示
			message.removeClass('message-inline-open').find('.message-content').remove();
			return;
		}else{
			var that = $(this);
			var url = '?x='+that.attr('shell')+'|'+that.attr('params');
			$.post(url,function(data){
				var data = eval('('+data+')');
				if(data.status != 'SUCCESS')
					alert(data.msg);//如果获取内容失败，则提示错误
				else{
					var letter = data.letter;
					message.css('background-color','#CCCCCC');//高亮显示正在查看的私信
					//在标题下方追加内容
					$('.message-container').append('<div class="message-loading-overlay"><i class="icon-spin icon-spinner orange2 bigger-160"></i></div>');
					setTimeout(function() {
						$('.message-container').find('.message-loading-overlay').remove();
						message
							.addClass('message-inline-open')
							.append('<div class="message-content" />')
						var content = message.find('.message-content:last').html( letter.contents );
						content.find('.message-body').slimScroll({
							height: 200,
							railVisible:true
						});
						//点击查看预定明细
						message.find('[url*=getBookDetails]').click(function(){
							$.post($(this).attr("url"),function(data){
								$(".page-content").replaceWith(data);
								$AiForm.replaceDocWithClickAiSkip();
							});
						});
						//点击查看交易明细（仅当有交易提醒推送时）
						message.find('[url*=getTradeDetails]').click(function(){
							$.post($(this).attr('url'), function(data){
								$('.page-content').replaceWith(data);
								$AiForm.replaceDocWithClickAiSkip();
							});
						});
					}, 0);//200 + parseInt(Math.random() * 200)					
				}
			});
		}
	});
	
	
	
});





//------------------------自由代码---------------------




//监听表单回车提交事件
function EnterPress(e){ //传入 event 
	var e = e || window.event; 
	if(e.keyCode == 13){
		//$(".ai-submit")[0].click();
		
	} 
}

/**
 * 对收件进行回复
 */
function reply(obj, data){
	var message = $(obj).closest('.message-item');
	var rp = $(obj).closest('.reply');
	var erid = message.find('.er').eq(0).attr("erid");//此次回复的接收人
	var me = message.attr('me');//此次回复的发送人（即自己）
	var contentsz = rp.find('textarea').eq(0).html();
	var titlez = '回复：【'+message.find('.text').eq(0).text().trim().substring(0,15)+'...】';
	var args = [me,'THIS_IS_AI_CONTENTS_IN_SENDING_LETTER',erid,'THIS_IS_AI_TITLE_IN_SENDING_LETTER'];
	var url = $AiForm.assemblyShellParams('sendPersonalLetter', args);
	$.post(url, {contents:contentsz,title:titlez}, function(data){
		alert(data);
	});
}

/**
 * 按页码跳转
 */
function gotoPage(obj, event){
	var e = e || window.event; 
	if(e.keyCode == 13){
		var pagesum = $(obj).attr('pagesum');
		var pagepos = parseInt($(obj).val());
		pagepos = pagepos>pagesum?pagesum:pagepos;
		pagepos = pagepos<1?1:pagepos;
		var u1 = $(obj).attr("puprefix");
		var u2 = (pagepos-1)*$(obj).attr('num');
		location.href = u1 + u2;
	} 
}

