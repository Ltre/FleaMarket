<?php 
/**
 * 显示自己交易信息的详情页面
 * @invoked
 * @author Oreki
 * @since 2014-3-25
 */
?>

<?php 
$user = $_SESSION['user'];
$args = ActionUtil::getTplArgs();
$details = $args['details'];

if(null==$details){
	print '<br><br><br><br><br><br><br><br><br><br><br><br><center style="font-size:50px;font-family:微软雅黑;">该交易已被系统屏蔽</center>';//其实没有屏蔽，是真的没有这条记录。
	return;
}

$isSell = !strcasecmp($details['tradetype'], 'Z');
?>
<div class="page-content">

	<hr/>
	<h1><?php print($details['title'])?>
		<button shell="listSelfTrade" params="<?php print($args['num'].'|'.strval($args['start'] ? $args['start']-1 : $args['start'])) ?>" class="btn-inverse pull-right ai-skip">返回</button>
		<button shell="getTradeDetails" params="<?php print $args['id'].'|'.$args['tradetype'].'|'.$args['num'].'|'.$args['start'] ?>" class="btn-info pull-right">刷新</button>
		<script type="text/javascript">
			//刷新页面
			$AiForm.bindCommonAjaxValidateAndFeedback(
				$('[shell~=getTradeDetails]'), 
				function(){return true}, 
				function(data){
					$('.page-content').replaceWith(data);
					$AiForm.replaceDocWithClickAiSkip();
				}
			);
		</script>
	</h1>
	<hr/>
	<h2></h2>
	<hr/>
	
	<div class="row">
	
		<!-- 左侧显示预览图 -->
		
		<div class="col-sm-6">
			<h3>预览图</h3>
			<hr/>
			<?php 
			$img = '../public/res/img/'.($isSell?'sell':'buy').'info/'.$details['recordz'].'.';
			$img_file = '';
			if(file_exists($img.'jpg')){
				$img_file = $img.'jpg';
			}else if(file_exists($img.'png')){
				$img_file = $img.'png';
			}else if(file_exists($img.'gif')){
				$img_file = $img.'gif';
			}else{
				$img_file = '../public/res/img/sellinfo/sellnull.jpg';
			}
			?>
			<img src="<?php print FleaoptUtil::getFleaImgUrl( $details['recordz'], ($isSell?'sell':'buy') ); //print($img_file)?>" style="border: 2px groove;" width="399px" />
		</div>
		
		<!-- 右侧显示简要信息 -->
		
		<div class="col-sm-6">
			<h3>摘要信息</h3>
			<hr>
			<h4>旧货链接</h4>
			<p class="lead">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="?x=browseFleaDetail|<?php print ($isSell?'sell':'buy').'|'.$details['titlecode'] ?>" target="_blank"><?php print($details['title'])?></a>				
			</p>
			<h4>旧货分类</h4>
			<p class="lead">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php print($details['fleatype'])?>
			</p>
			<h4>见面时间</h4>
			<p class="lead">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php print($details['meettime'])?>
			</p>
			<h4>见面地点</h4>
			<p class="lead">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php print($details['meetplace'])?>
			</p>
			<h4>预约目的</h4>
			<p class="lead">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php print($details['purposevalue'])?>
			</p>
			<h4>交易类型</h4>
			<p class="lead">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php print($details['tradetypevalue'])?>
			</p>
			
			<h4>交易状态</h4>
			<p class="lead">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php print($details['statusvalue'])?>
			</p>
			<p class="lead">
			<?php 
			$shell_flag = false;
			if($user->id==$details['leftuserfk']){
				switch ($details['status']){
				case 0:;
				case 2:;
				case 5: 
					$shell_flag = true;
					print '你是甲方，请选择<button shell="affirmTrade" params="'.$details['id'].'|left">确认</button> 或 <button class="ai-ajax" shell="negateTrade" params="'.$details['id'].'|left" >否认</button> 该交易。';
					break;
				case 1:
					print '你已确认了交易，请等待乙方确认';
					break;
				case 4:
					print '你<font color=red>否认</font>了该交易，请等待乙方确认';
					break;
				case 3:
					print '<font color=green>你们双方都已确认该交易</font>';
					break;
				case 6:
					print '<font color=red>你确认了本次交易，但对方说没那回事</font>';
					break;
				case 7: 
					print '<font color=red>对方确认了本次交易，但你认为没那回事</font>';
					break;
				case 8:
					print '你们双方都否认了本次交易';
				}
			}else{
				switch ($details['status']){
					case 0:;
					case 1:;
					case 4:
						$shell_flag = true;
						print '你是乙方，请选择<button shell="affirmTrade" params="'.$details['id'].'|right">确认</button> 或 <button class="ai-ajax" shell="negateTrade" params="'.$details['id'].'|right" >否认</button> 该交易。';
						break;
					case 2:
						print '你已确认了交易，请等待甲方确认';
						break;
					case 5:
						print '你<font color=red>否认</font>了该交易，请等待甲方确认';
						break;
					case 3:
						print '<font color=green>你们双方都已确认该交易</font>';
						break;
					case 7:
						print '<font color=red>你确认了本次交易，但对方说没那回事</font>';
						break;
					case 6:
						print '<font color=red>对方确认了本次交易，但你认为没那回事</font>';
						break;
					case 8:
						print '你们双方都否认了本次交易';
				}
			}
			?>
			<?php if($shell_flag) { ?>
				<script type="text/javascript">
					$AiForm.bindCommonAjaxValidateAndFeedback(
						$('[shell=affirmTrade]'),
						function(){return true;},
						function(data){
							var data = eval('('+data+')');
							//alert(data.status);
							alert(data.msg);
						}
					);
					$AiForm.bindCommonAjaxValidateAndFeedback(
						$('[shell=negateTrade]'),
						function(){return true;},
						function(data){
							var data = eval('('+data+')');
							//alert(data.status);
							alert(data.msg);
						}
					);
				</script>				
			<?php }  ?>
			</p>
		</div>
		
	</div><!-- class=row 预览图和简要信息结束 -->
	
	<hr/>
	
	<!-- 显示转让信息的详情 -->
	
	<div class="row">
		<h3>旧货信息明细：</h3>
		<hr/>
		<div class="col-sm-10" style="border: solid 2px;padding: 10px;">
			<?php print($details['details']) ?>
		</div>
	</div>
	
	<hr/>
	
</div><!-- class="page-content -->
