//编写：AI表单对应的反馈数据处理方法集合
jQuery(document).ready(function($){
	/**
	 * 【表单】
	 * 验证表单验证过程的集合
	 */
	$AiFormValidates = {
		//示例【指令名称：function(args){处理过程。。。}】
	};
	/**
	 * 【表单】
	 * 处理ajax反馈数据的过程集合
	 */
	$AiFormDealResults = {
		//示例【指令名称 : function(data){处理过程。。。}】
	};
	/**
	 * 【ai-ajax控件】
	 * 绑定ajax通信前验证过程
	 */
	$AiAjaxValidates = {
		//示例【指令名称 : function( ){处理过程。。。}】
		blockDetail : function(){
			alert("ai-ajax控件验证通过！");
			if(true)
				return true;
			else
				return false;
		}
	};

	/**
	 * 【ai-ajax控件】
	 * 绑定ajax通信后处理反馈数据的过程
	 */
	$AiAjaxDealResults = {
		blockDetail : function(data){
			alert("ai-ajax控件通信结果："+data);
			$(".mainpage").remove();
		}
	};
	//将表单验证和数据处理方法集合 绑定到 对应表单
	$AiForm.aiFormBindFeedBack( $AiFormValidates, $AiFormDealResults );
	$AiForm.aiAjaxBindFeedBack( $AiAjaxValidates, $AiAjaxDealResults );
	/**
	 * 普通控件部分
	 */
	//使类为ai-skip的普通控件具有跳转功能
	$AiForm.replaceDocWithClickAiSkip();
	
	//=========================================================================
	/**
	 * 退出时，将用户名和“退出”替换成“登录/注册”
	 */
	$AiForm.bindCommonAjaxValidateAndFeedback(
		$("[shell~=user_logout]"),
		function(){return true},
		function(data){
			//if(1==data){
				$(".after_login_shell").remove();
				$("#nav").append('<li><a class="ai-skip" shell="ace-login" title="登录" style="cursor: pointer;"><span>登录/注册</span></a></li>');
				$AiForm.replaceDocWithClickAiSkip();//使新增的ai-skip控件生效
			//}else{
				//alert('系统异常，无法正常退出，该问题将尽快解决！');
			//}
		}
	);
	/**
	 * 点击“随便看看”，将中间内容替换成搜索结果
	 * 调用模板：aciton::randomSearch
	 */
	$AiForm.bindCommonAjaxValidateAndFeedback(
		$('[shell~=randomSearch]'),
		function(){return true;},
		function(data){
			$('#ai-header').closest('.mainpage').remove();
			$('#mainpage-mos').replaceWith(data);
			$('#nav>li:eq(0)').removeClass("current");
			$('#nav>li:eq(2)').addClass("current");
		}
	);
	/**
	 * 点击侧栏分类，将中间内容替换成搜索结果
	 * 借用模板：aciton::randomSearch
	 */
	$AiForm.bindCommonAjaxValidateAndFeedback(
		$('[shell~=fleatypeSearch]'),
		function(){return true;},
		function(data){
			$('#ai-header').closest('.mainpage').remove();
			$('#mainpage-mos').replaceWith(data);
		}
	);
	
	
	
	/* ================================普通事件绑定部分=================================== */
	/**
	 * 点击随便看看,改变按分类查看时的方式（方式有：转让、求购）
	 */
	$('[shell~=randomSearch]').click(function(){
		var opt = $(this).attr('params').match('sell')?'sell':'buy';
		$('[shell=fleatypeSearch]').each(function(index, domEle){
			$(this).unbind();//在重新绑定事件前，先移除原来的监听器
			var params = $(domEle).attr('params');
			params = params.replace(/buy/,opt);
			params = params.replace(/sell/,opt);
			$(domEle).attr('params', params);
			$(domEle).click(function(){
				$.post('?x=fleatypeSearch|'+params, function(data){
					$('#ai-header').closest('.mainpage').remove();
					$('#mainpage-mos').replaceWith(data);
				});
			});
		});
	});
	
	
});





/**
 * 点击磁贴13：搜索最多货源/需求的分类
 * @param obj
 */
function click_tile13(obj){
	var shell = $(obj).attr('shell');
	$.post('?x='+shell, function(data){
		$('#ai-header').closest('.mainpage').remove();
		$('#mainpage-mos').replaceWith(data);
	});
	$('#fancybox-overlay').css('display','none');//屏蔽遮罩层
	$('#fancybox-content').css('margin-top', '-50px;');//弹窗位置调整
}

/**
 * 在磁贴13弹出框中点击其中一个分类
 * @param obj
 */
function click_tile13_ft(obj){
	click_tile13(obj);
}



/**
 * 在分类导航侧栏下方点击“随便搜搜”
 * @param obj
 */
function click_underft(obj){
	var shell = $(obj).attr('shell');
	var fts = $(obj).attr('fts').split('|');
	var len = $(obj).attr('maxftlen');
	var fleatypefk = Math.floor(Math.random()*len);
	var opt = $(obj).attr('opt');
	var url = '?x=fleatypeSearch|'+opt+'|'+fleatypefk+'|10|0';
	$.post(url, function(data){
		$('#ai-header').closest('.mainpage').remove();
		$('#mainpage-mos').replaceWith(data);
	});
}






