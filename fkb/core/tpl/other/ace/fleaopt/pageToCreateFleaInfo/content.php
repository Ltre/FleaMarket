<?php 
/**
 * 从属于 pageToCreateFleaInfo
 */
?>

					<div class="page-content">
						<!-- 注释：ACE正文标题开始 -->
						<div class="page-header">
<?php 
$t = $args['args']['optType'];
$t = !strcasecmp($t, 'newsell') ? '发布新的转让' :( 
	!strcasecmp($t, 'newbuy') ? '发布新的求购':( 
		!strcasecmp($t, 'editsell') ? '编辑转让信息'
			: '编辑求购信息' 
	) 
);
$record = null;
$isInEdit = false;
if('editsell'==$args['args']['optType']||'editbuy'==$args['args']['optType']){
	$isInEdit = true;
	$record = $args['args']['record'];
	if(!$record){	//如果当前记录不不存在
		echo '<br><br><br><br><br><br><br><h1 align="center">当前记录不存在或被删除,<a style="cursor:pointer;" class="ai-skip" shell="listSelfSell" params="10|0">请返回！</a></h1>';
		return;
	}
}
?>
							<h1><?php printf( $t )?> </h1>
						</div><!-- /.page-header -->
						<!-- 注释：ACE正文标题结束 -->
						<!-- ----------------------分割线--------------------- -->
						<!-- 注释：ACE正文内容开始 -->
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<!-- 表单实验,参数顺序：标题|旧货分类|价格 -->
								<form id="publishNewFleaInfo" name="publishNewFleaInfo" shell="publishNewFleaInfo" class="form-horizontal ai-form" role="form">
									<div class="form-group">
										<label class="col-sm-1 control-label no-padding-right" for="fleatitle"> 标&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;题 </label>
										<div class="col-sm-11">
											<input type="text" id="fleatitle" placeholder="请输入简明扼要的标题，限制30字" class="col-xs-10 col-sm-8 ai-args-1" <?php if($isInEdit)print('value="'.$record->title.'"'); ?> />
										</div>
									</div>
									<div class="space-4"></div>
									<div class="form-group">
										<label class="col-sm-1 control-label no-padding-right" for="fleatype">旧货分类</label>
										<div class="col-sm-2">
											<select class="form-control col-sm-2 ai-args-2" id="fleatype">
<?php 
//$ftrs = AiMySQL::queryEntity('fleatype');
$fstmt = AiMySQL::connect()->query('select id, name from fm_fleatype');
$ftrs = array();
while (@$result = $fstmt->fetch(PDO::FETCH_OBJ)){
	$ftrs[] = $result;
}
if($isInEdit){
	foreach ($ftrs as $ftr){
		print('<option '.(($ftr->id==$record->fleatypefk)?'selected="selected"':'').' value="'.$ftr->id.'">'.$ftr->name.'</option>');
	}
}else{
	foreach ($ftrs as $ftr){
		print('<option value="'.$ftr->id.'">'.$ftr->name.'</option>');
	}
}
?>
											</select>
										</div>
										<label class="col-sm-1 control-label no-padding-right" for="fleaname">物品名</label>
										<div class="col-sm-2">
											<input type="text" id="fleaname" placeholder="不超过10个字" class="col-xs-10 col-sm-8 form-control ai-args-3" <?php if($isInEdit)print('value="'.$record->name.'"'); ?> />
										</div>
										<label class="col-sm-1 control-label no-padding-right" for="fleaprice">参考价格</label>
										<div class="col-sm-1">
											<input type="text" id="fleaprice" placeholder="单位：元" class="col-xs-10 col-sm-8 form-control ai-args-4" <?php if($isInEdit)print('value="'.$record->price.'"'); ?> />
										</div>
									</div>
									<!-- 图片上传 -->
									<div class="col-sm-4">
										<div class="widget-box">
											<div class="widget-header">
												<h4>上传封面图</h4>
												<span class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="icon-chevron-up"></i>
													</a>
													<a href="#" data-action="close">
														<i class="icon-remove"></i>
													</a>
												</span>
											</div>
											<div class="widget-body">
												
												<!-- iframe这行代码和这个input-hidden才是真正的上传代码，其它的都是作陪衬！！ -->
												<input name="img" type="hidden" id="img" value="100" /><!-- 保存的原图片名 -->
												<input name="img_thumb" type="hidden" id="img_thumb" value="100_thumb" /><!-- 保存的缩略图名 -->
												<input name="saveimgname" type="hidden" id="saveimgname" value=""/><!-- 上传标志码（保存的文件路径名），用于旧货信息和图片的对应 -->
												<iframe src="?x=upimg|<?php print false!==strpos($args['args']['optType'], 'sell')?'sell':'buy'?>info&action=add&img_w=310&img_h=310&imgsize=1&img=hehe&simg=hehe_thumb" width="100%" height="100" scrolling="No" frameborder="0" style="border:0px;"></iframe>

												<div class="widget-main hide">
													<input type="file" id="id-input-file-2"/>
													<input multiple="" type="file" id="id-input-file-3" />
													<label>
														<input type="checkbox" name="file-format" id="id-file-format" class="ace" />
														<span class="lbl"> 仅允许图片</span>
													</label>
												</div>
											</div>
										</div>
									</div>	
									<br style="clear: both;"/>						
									<!-- 设置编辑器样式 -->
									<h4 class="header green clearfix">
										填写详情：
										<span class="block pull-right">
											<small class="grey middle">选择样式: &nbsp;</small>
											<span class="btn-toolbar inline middle no-margin">
												<span data-toggle="buttons" class="btn-group no-margin">
													<label class="btn btn-sm btn-yellow">
														1
														<input type="radio" value="1" />
													</label>
	
													<label class="btn btn-sm btn-yellow active">
														2
														<input type="radio" value="2" />
													</label>
	
													<label class="btn btn-sm btn-yellow">
														3
														<input type="radio" value="3" />
													</label>
												</span>
											</span>
										</span>
									</h4>
									<!-- ace编辑器的内容区 -->
									<div class="wysiwyg-editor" id="editor1"><?php if($isInEdit)print($record->details); ?></div>
									<!-- kingeditor编辑器 -->
									<!-- <textarea name="fleadetail" class="col-xs-10" style="height:390px;visibility:hidden;"></textarea> -->
									<!-- 隐藏域：发布编辑转让或求购  newsell/newbuy/editsell/editbuy-->
									<input type="hidden" class="ai-args-5" value="<?php printf($args['args']['optType'])?>" >
									<!-- 隐藏域：编辑转让或求购时，所需的当前旧货信息titlecode -->
									<input type="hidden" class="ai-args-6" value="<?php printf($args['args']['titlecode'])?>" >
									<!-- 表单提交器 -->
									<div class="clearfix form-actions">
										<div class="col-md-offset-10 col-md-2">
											<!-- <button class="btn" type="reset">
												<i class="icon-undo bigger-110"></i>
												Reset
											</button>
											&nbsp; &nbsp; &nbsp; -->
											<button class="btn btn-info ai-submit" type="button">
												<i class="icon-ok bigger-110"></i>
												<span style="font-weight: bold;font-family: 黑体;"><?php print($isInEdit?'保&nbsp;存':'发&nbsp;布') ?></span>
											</button>
										</div>
									</div>
									<div id="feedback"></div>
								</form>
								
								<script type="text/javascript">
									var $path_assets = "assets";//this will be used in loading jQuery UI if needed!
								</script>

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
						<!-- 注释：ACE正文内容结束 -->
					</div><!-- /.page-content -->