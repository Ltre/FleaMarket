<?php 
/**
 * 显示自己转让信息的详情页面
 * @invoked FleaoptAction::getFleaDetails()
 * @author Oreki
 * @since 2014-3-25
 */
?>

<?php 
$args = ActionUtil::getTplArgs();
$details = $args['details'];

?>
<div class="page-content">

	<hr/>
	<h1><?php print($details->title)?>
		<button shell="listSelfSell" params="<?php print($args['num'].'|'.strval($args['start'] ? $args['start']-1 : $args['start'])) ?>" class="btn-info pull-right ai-skip">返回</button>
		<button shell="pageToCreateFleaInfo" params="editsell|<?php print($details->titlecode)?>" class="hide btn btn-inverse pull-right ai-skip">编辑</button>
		<button shell="getFleaDetails" params="<?php print 'sell|'.$details->titlecode.'|self|'.$args['num'].'|'.$args['start'] ?>" class="btn-info pull-right">刷新</button>
		<script type="text/javascript">
			//刷新页面
			$AiForm.bindCommonAjaxValidateAndFeedback(
				$('[shell~=getFleaDetails]'), 
				function(){return true}, 
				function(data){
					$('.page-content').replaceWith(data);
					$AiForm.replaceDocWithClickAiSkip();
				}
			);
		</script>
	</h1>
	<hr/>
	<h2>由&nbsp;<a href="../fkb/?x=displayProfile|<?php print(urlencode(TableUtil::getValueFromField('users', 'id', array(new AiMySQLCondition('username', '=', $details->creuser)))))?>" target="_blank"><?php print($details->creuser)?></a> &nbsp; 于 &nbsp; <?php print($details->cretime)?> &nbsp; 发布</h2>
	<hr/>
	
	<div class="row">
	
		<!-- 左侧显示预览图 -->
		
		<div class="col-sm-6">
			<h3>预览图</h3>
			<hr/>
			<?php 
			/* $img = '../public/res/img/sellinfo/'.$details->id.'.';
			$img_file = '';
			if(file_exists($img.'jpg')){
				$img_file = $img.'jpg';
			}else if(file_exists($img.'png')){
				$img_file = $img.'png';
			}else if(file_exists($img.'gif')){
				$img_file = $img.'gif';
			}else{
				$img_file = '../public/res/img/sellinfo/sellnull.jpg';
			} */
			?>
			<img src="<?php print FoptUtil::getFleaImgUrl($details->id, 'sell'); //print($img_file)?>" style="border: 2px groove;" width="399px" />
		</div>
		
		<!-- 右侧显示简要信息 -->
		
		<div class="col-sm-6">
			<h3>摘要信息</h3>
			<hr>
			<h4>物品名</h4>
			<p class="lead">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php print($details->name)?>
			</p>
			<h4>旧货分类</h4>
			<p class="lead">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php print($details->fleatypefk)?>
			</p>
			<h4>参考价格</h4>
			<p class="lead">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php print($details->price)?>&nbsp;元
			</p>
			<h4>转让状态</h4>
			<p class="lead">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php print($details->status)?>
			</p>
		</div>
		
	</div><!-- class=row 预览图和简要信息结束 -->
	
	<hr/>
	
	<!-- 显示转让信息的详情 -->
	
	<div class="row">
		<h3>详细说明：</h3>
		<hr/>
		<div class="col-sm-10" style="border: solid 2px;padding: 10px;">
			<?php print($details->details) ?>
		</div>
	</div>
	
	<hr/>
	
	<!-- 显示期限 -->
	<div class="row">
		<div class="col-sm-10" style="border: solid 2px;padding: 10px;">
			<h4>预约期</h4>
			<p class="head">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;将于<?php print($details->booklimit) ?>终止预约。</p>
			<h4>收尾期</h4>
			<p class="head">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;将于<?php print($details->endlimit) ?>结束转让。</p>
		</div>
	</div>

	<!-- 删除按钮 -->

	<div class="row">
		<button id="delFleaInfoInDetails" shell="delFleaInfo" params="sell|<?php print($details->titlecode)?>" class="btn pull-right ai-ajax">删除</button>
		<script type="text/javascript">
			$AiAjaxValidates.delFleaInfoInDetails = function(){
				return confirm("确定删除？");
			};
			$AiAjaxDealResults.delFleaInfoInDetails = function(data){
				data = eval('('+data+')');
				alert(data.msg);
				//删除完毕后，返回列表的第一页
				if('SUCCESS'==data.status)
					$AiForm.replaceDocWithShell('listSelfSell|<?php print($args['num'].'|' . (intval($args['start']%$args['num'])/$args['num']) ) ?>');
			};
			$AiForm.aiAjaxBindFeedBack( $AiAjaxValidates, $AiAjaxDealResults );
		</script>
	</div>
	
	
</div><!-- class="page-content -->
