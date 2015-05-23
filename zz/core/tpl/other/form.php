<html>
<head>
<script type="text/javascript" src="<?php printf(APPROOT.JQUERY_LIB_PATH); ?>"></script>
<script type="text/javascript" src="res/js/Ai/AiForm.js"></script><!-- 导入AI表单支持库 -->
<!-- AI表单编写完毕后，开始自定义数据处理，并绑定（注意：此段代码必须在文档加载完成后才能执行，否则将失效） -->
<script type="text/javascript">
	//编写：AI表单对应的反馈数据处理方法集合
	jQuery(document).ready(function($){
		$AiFormDealResults = {
			//示例【指令名称 : function(data){处理过程。。。}】
			aiFormLogin : function(data){
				alert("现在处理的是aiFormLogin指令反馈的数据："+data);
			},
			wocao : function(data){
				alert("现在处理的是wocao指令反馈的数据："+data);
			},
			help : function(data){
				alert("现在处理的是help指令反馈的数据（并发生AJAX页面跳转）："+data);
				var doc = document.open("text/html","replace");
				doc.write(data);
				doc.close();
			}
		};
		//将数据处理方法集合 绑定到 对应表单
		$AiForm.aiFormBindFeedBack( $AiFormDealResults );
	});
</script>
</head>


<body>
表单一（aiFormLogin）：
<!-- form的id就是URL指令 -->
<form id="aiFormLogin" class="ai-form">
	<!-- 后续参数集合：ai-args-n形式，必须连续且从1开始，“断链”处将放弃后续参数的解析，注意注意！ -->
	<input type="text" class="ai-args-1"value="Oreki" >
	<input type="password" class="ai-args-2" value="orikiltre" >
	<!-- 提交器：type绝对不能使用submit -->
	<input type="button" class="ai-submit" value="登录">
</form>
表单二（wocao）：
<form id="wocao" class="ai-form">
	<input type="text" class="ai-args-1"value="Oreki" >
	<input type="password" class="ai-args-2" value="orikiltre" >
	<input type="button" class="ai-submit" value="登录">
</form>
表单三（help）：
<form id="help" class="ai-form" style="margin-left:307px;">
	<input type="button" class="ai-submit" value="登录">
</form>
</body>
</html>