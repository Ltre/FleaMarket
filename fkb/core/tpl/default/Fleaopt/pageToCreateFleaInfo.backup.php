<!-- <section id="mainpage-mos" style="width:960px;">
	<section id="content-mos" class="centered clearfix masonry" style="position: relative; height: 640px; width: 960px;">

	</section>
</section>
 -->
 
<div style="background-color: white;width:960px;height:640px;">
	<form name="publishNewFleaInfo" id="publishNewFleaInfo" shell="publishNewFleaInfo" class="ai-form" >
		<textarea name="content1" style="width:700px;height:200px;visibility:hidden;"><?php echo "再此处添加文章内容" ?></textarea>
		<br />
		<input type="button" class="ai-submit" name="button" value="提交内容" /> (提交快捷键: Ctrl + Enter)
	</form>
</div>

<script charset="utf-8" src="res/kindeditor/kindeditor.js"></script>
<script charset="utf-8" src="res/kindeditor/lang/zh_CN.js"></script>
<script charset="utf-8" src="res/kindeditor/plugins/code/prettify.js"></script>
<script>
	KindEditor.ready(function(K) {
		var editor1 = K.create('textarea[name="content1"]', {
			cssPath : 'res/kindeditor/plugins/code/prettify.css',
			uploadJson : 'res/kindeditor/php/upload_json.php',
			fileManagerJson : 'res/kindeditor/php/file_manager_json.php',
			allowFileManager : true,
			afterCreate : function() {
				var self = this;
				K.ctrl(document, 13, function() {
					self.sync();
					K('form[name=publishNewFleaInfo]')[0].submit();
				});
				K.ctrl(self.edit.doc, 13, function() {
					self.sync();
					K('form[name=publishNewFleaInfo]')[0].submit();
				});
			}
		});
		prettyPrint();
	});
</script>

<script charset="utf-8" type="text/javascript">
//编写：AI表单对应的反馈数据处理方法集合
jQuery(document).ready(function($){
//------------------------------------------------------------
	/**
	 * 【表单】
	 * 验证表单验证过程的集合
	 */
	//$AiFormValidates.xxx=function(args){};
//------------------------------------------------------------
	/**
	 * 【表单】
	 * 处理ajax反馈数据的过程集合
	 */
	//$AiFormDealResults.xxx=function(data){};
//------------------------------------------------------------
	/**
	 * 【ai-ajax控件】
	 * 绑定ajax通信前验证过程
	 */
	//$AiAjaxValidates.xxx = function(){};
//------------------------------------------------------------
	/**
	 * 【ai-ajax控件】
	 * 绑定ajax通信后处理反馈数据的过程
	 */
	//$AiAjaxDealResults.xxx=function(data){};
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
alert(1234568);
</script>
