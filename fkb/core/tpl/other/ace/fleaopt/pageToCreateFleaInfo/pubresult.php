<?php 
$t = $_REQUEST['titlecode'];
$o = $_REQUEST['opttype'];
$table = $o=='newsell'||$o=='editsell' ? 'sell' :'buy';
$rs = AiMySQL::queryEntity($table, array(0=>new AiMySQLCondition('titlecode', '=', $t)));
$r = null;
if($rs)
	foreach ($rs as $r);
if(!$r){
	echo "<h1 align='center'>获取旧货信息时发生了异常，请稍后再试<h1>";
	exit;
}
?>


<div class="col-sm-10">
	<h3 class="header smaller lighter green">内容已保存，如下：</h3>
	<div class="well well-lg">
		<h4 class="blue"><?php print($r->title); ?></h4>
		<?php print($r->details) ?>
	</div>
</div>

<div class="col-sm-10">
	<hr/>
	<h3>你还可以</h3>
	<a style="cursor: pointer;" class="btn btn-app btn-primary ai-skip" shell="pageToCreateFleaInfo" params="<?php if($o=='newsell'||$o=='editsell')print('editsell');else print('editbuy');print('|'.$r->titlecode); ?>">
		<i class="icon-edit bigger-230"></i>
		继续编辑
		<span class="badge badge-warning badge-left"></span>
	</a>
	&nbsp;&nbsp;&nbsp;&nbsp;
	<a id="getFleaDetails" style="cursor: pointer;" class="btn btn-app btn-purple ai-ajax" shell="getFleaDetails" params="<?php print($table.'|'.$r->titlecode.'|self|10|0')?>">
		<i class="icon-share-alt bigger-230"></i>
		查看详细
		<span class="badge badge-warning badge-left"></span>
	</a>
	&nbsp;&nbsp;&nbsp;&nbsp;
	<script type="text/javascript">
		$AiAjaxDealResults.getFleaDetails = function(data){
			$('.page-content').replaceWith(data);
			$AiForm.replaceDocWithClickAiSkip();
		};
		$AiForm.aiAjaxBindFeedBack( $AiAjaxValidates, $AiAjaxDealResults );
	</script>
	<a style="cursor: pointer;" class="btn btn-app btn-grey ai-skip" shell="<?php print ($table=='sell'?'listSelfSell':'listSelfBuy')?>" params="10|0">
		<i class="icon-folder-open-alt bigger-230"></i>
		返回列表
		<span class="badge badge-warning badge-left"></span>
	</a>
	<hr/>
</div>




<script type="text/javascript">
$AiForm.replaceDocWithClickAiSkip();
</script>