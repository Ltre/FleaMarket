//编写：AI表单对应的反馈数据处理方法集合
jQuery(document).ready(function($){
	/**
	 * 【表单】
	 * 验证表单验证过程的集合
	 */
	$AiFormValidates = {
		//示例【指令名称：function(args){处理过程。。。}】
		/*
		 * 验证：发送私信
		 */
		sendPersonalLetter : function(args){
			if(args[1]=='NOTLOGIN'){
				if(confirm("要发送私信，请先登录"))
					$AiForm.replaceDocWithShell('ace-login');
				return false;
			}
			if(''==args[4]||'标题'==args[4]){
				alert('标题不能为空！');
				return false;
			}
			if(''==args[2]||'私信内容'==args[2]){
				alert('内容不能为空！');
				return false;
			}
			var title = $("#sendPersonalLetter").find(" [name=title]").first().val();//旧货信息标题
			var dongxi = $("#sendPersonalLetter").find(" [name=dongxi]").first().val();//物品名
			var opttype = $("#sendPersonalLetter").find(" [name=opttype]").first().val();//旧货发布类型
			var lh = " # <a href='" + location.search + "' target='_blank'>" + '【'+opttype+'】' + title + '（物品名：'+dongxi+'）' + "</a> # ";
			var url = $AiForm.assemblyShellParams('sendPersonalLetter', args);
			$.post(url, {linkhref:lh}, function(data){
				alert(data);
			});
			return false;//这里阻止执行后续的反馈方法
		},
		/*
		 * 验证：预订
		 */
		addFleaBook : function(args){
			if(args[7]=='NOTLOGIN'){
				if(confirm("请登录后再预约"))
					$AiForm.replaceDocWithShell('ace-login');
				return false;
			}
			if(''==args[1]||decodeURIComponent('见面时间')==args[1]||''==args[2]||decodeURIComponent('见面地点')==args[2]){
				alert('确认填写完了？');
				return false;
			}
			if(! /^\d\d\d\d-\d\d?-\d\d?/.test(args[1])){
				alert('时间格式必须是：YYYY-mm-dd');
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
		 * 反馈：预订
		 */
		addFleaBook : function(data){
			var data = eval('('+data+')');
			var tip = data.status=='DUPLICATE'
				? '已经预约过了，不要重复操作'
				: ( data.status=='DONTSELF' ? '自己不能跟自己预约'
						: ( data.status=='SUCCESS' ? '预约成功，等待对方确认':'预约失败' ) );
			//如果没有登录（一般是进了详情页面又点了退出的逗逼就想试试预约功能时，才会出现的提示）
			tip = data.status=='NOTLOGIN' ? data.msg : tip;
			//如果没有权限，则提示
			tip = data.status=='NOAUTHORITY' ? data.msg : tip;
			alert(tip);
		}
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
			$('#mainpage-mos').replaceWith(data);
		}
	);
	
	/**
	 * 点击收藏按钮
	 */
	$AiForm.bindCommonAjaxValidateAndFeedback(
		$('[shell~=addCollect'),
		function(){return true;},
		function(data){
			var data = eval('('+data+')');
			alert(data.msg);
		}
	);
	
	
	/* __________________________________________________________________________ */
	/* _____________________________普通事件绑定_________________________________ */
	/* __________________________________________________________________________ */

	
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
					$('#mainpage-mos').replaceWith(data);
				});
			});
		});
	});
	
	
/*	
	//点击“私聊”，禁用左边表单域，启用右边表单域
	$("#click_siliao").click(function(){
		$("#commentform").attr("shell", "sendPersonalLetter");
		var meettime = $("#commentform").find("[name=meettime]");
		meettime.attr("disabled","disabled");
		meettime.attr("class","ai-args-0");//屏蔽参数
		$("#commentform").find("[name=meetplace]").attr("disabled","disabled");
		$("#commentform").find("[name=purpose]").attr("disabled","disabled");
		var comment = $("#commentform").find("[name=comment]");
		comment.removeAttr("disabled");
		comment.attr("class","ai-args-1");
		$("#comsubmit").val("发送私信");
		$("#comsubmit").unbind();//防止重复绑定
		$AiForm.singleAiFormBindFeedBack(
			$("#commentform"),
			function(args){
				if(''==args[1]||decodeURIComponent('见面时间')==args[1]||''==args[2]||decodeURIComponent('见面地点')==args[2]){
					alert('私信内容不能为空！');
					return false;
				}
				return true;
			},
			function(data){
				alert("预约了。。");
			}
		);
	});
	
	//点击“预约”，启用左边表单域，禁用右边表单域
	$("#click_yuyue").click(function(){
		$("#commentform").attr("shell","addFleaBook");
		$("#commentform").find("[name=meettime]").removeAttr("disabled");
		var meettime = $("#commentform").find("[name=meettime]");
		meettime.removeAttr("disabled");
		meettime.attr("class","ai-args-1");//参数解禁
		$("#commentform").find("[name=meetplace]").removeAttr("disabled");
		$("#commentform").find("[name=purpose]").removeAttr("disabled");
		var comment = $("#commentform").find("[name=comment]");
		comment.attr("disabled","disabled");
		comment.attr("class","ai-args-0");
		$("#comsubmit").val("预约");
		$("#comsubmit").unbind();//防止重复绑定
		$AiForm.singleAiFormBindFeedBack(
			$("#commentform"),
			function(args){return true;},
			function(data){
				alert("预约了。。");
			}
		);
	});
*/	
	
	
	
});






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
		$('#mainpage-mos').replaceWith(data);
	});
}