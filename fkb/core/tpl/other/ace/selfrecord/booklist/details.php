<?php 
/**
 * 显示自己预订信息的详情页面
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
	print '<br><br><br><br><br><br><br><br><br><br><br><br><center style="font-size:50px;font-family:微软雅黑;">由于对方的原因，该预约已被对方删除</center>';
	return;
}

$isSell = !strcasecmp($details['booktype'], 'Z');
?>
<div class="page-content">

	<hr/>
	<h1><?php print($details['title'])?>
		<button shell="listSelfBook" params="<?php print($args['num'].'|'.strval($args['start'] ? $args['start']-1 : $args['start'])) ?>" class="btn-inverse pull-right ai-skip">返回</button>
		<button shell="getBookDetails" params="<?php print $args['id'].'|'.$args['booktype'].'|'.$args['num'].'|'.$args['start'] ?>" class="btn-info pull-right">刷新</button>
		<script type="text/javascript">
			//刷新页面
			$AiForm.bindCommonAjaxValidateAndFeedback(
				$('[shell~=getBookDetails]'), 
				function(){return true}, 
				function(data){
					$('.page-content').replaceWith(data);
					$AiForm.replaceDocWithClickAiSkip();
				}
			);
		</script>
	</h1>
	<hr/>
	<h2>由&nbsp;<a href="?x=displayProfile|<?php print(urlencode($details['rightuserfk']))?>" target="_blank"><?php print($details['rightuser'])?>（乙方）</a> &nbsp; 于 &nbsp; <?php print($details['booktime'])?> &nbsp; 向&nbsp; <?php print '<a href="?x=displayProfile|'.$details['leftuserfk'].'" target="_blank">'.$details['leftuser'].'（甲方）</a>发起预约。'?></h2>
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
			<h4>预约类型</h4>
			<p class="lead">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php print($details['booktypevalue'])?>
			</p>
			
			<h4>预约状态</h4>
			<p class="lead">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php print($details['statusvalue'])?>
			</p>
			<p class="lead">
			<?php 
			if(1==$details['status'])
				if($user->id==$details['leftuserfk']){
					print '你是甲方，请选择<button shell="agreeBook" params="'.$details['id'].'">同意</button> 或 <button class="ai-ajax" shell="disagreeBook" params="'.$details['id'].'" >拒绝</button> 该预约。';
			?>
				<script type="text/javascript">
					$AiForm.bindCommonAjaxValidateAndFeedback(
						$('[shell=agreeBook'),
						function(){return true;},
						function(data){
							var data = eval('('+data+')');
							//alert(data.status);
							alert(data.msg);
						}
					);
					$AiForm.bindCommonAjaxValidateAndFeedback(
						$('[shell=disagreeBook'),
						function(){return true;},
						function(data){
							var data = eval('('+data+')');
							//alert(data.status);
							alert(data.msg);
						}
					);
				</script>	
			<?php
				}
				else
					print '你是乙方，请等待甲方确认该预约。';
			?>
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
	
	<!-- 删除按钮 -->
<?php 
if(2!=$details['status']&&$user->id==$details['rightuserfk'])
{
?>
	<div class="row">
		<button id="delBookInfoInDetails" shell="delBookInfo" params="<?php print($details['id'])?>" class="btn-danger pull-right ai-ajax">删除</button>
		<script type="text/javascript">
			$AiAjaxValidates.delBookInfoInDetails = function(){
				return confirm("确定删除？");
			};
			$AiAjaxDealResults.delBookInfoInDetails = function(data){
				data = eval('('+data+')');
				switch(data.status){
				case 'NOTFOUND':
					alert('该预约不存在或被删除');break;
				case 'DONTDEL':
					alert('已经达成了预约，不能删除');break;
				case 'EXCEPTION':
					alert('删除过程中发生了异常，请联系管理员');break;
				case 'SUCCESS':
					alert('删除成功！');
				}
				//删除完毕后，返回列表的第一页
				if('SUCCESS'==data.status)
					$AiForm.replaceDocWithShell('listSelfBook|<?php print($args['num'].'|' . (intval($args['start']%$args['num'])/$args['num']) ) ?>');
			};
			$AiForm.aiAjaxBindFeedBack( $AiAjaxValidates, $AiAjaxDealResults );
		</script>
	</div>
<?php 
}
?>
	
</div><!-- class="page-content -->
