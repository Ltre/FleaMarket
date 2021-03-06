<?php 
/**
 * 显示预订记录列表
 * @invoked SelfRecordAction::listSelfBook()
 */
?>

<?php 
$user = $_SESSION['user'];
$args = ActionUtil::getTplArgs();
$self = $args['args'];
$th_title = array();//表头标题
$th_pos = array();//表头序号
foreach ($self['header'] as $th_pos[]=>$th_title[]);
// OrekiUtil::var_dump_array($args);
// OrekiUtil::var_dump_array($th_title);
// OrekiUtil::var_dump_array($th_pos);
// OrekiUtil::var_dump_array($self['records']);
// return;
?>
					<div class="page-content">
						<!-- <div class="page-header">
							<h1>
								Tables
								<small>
									<i class="icon-double-angle-right"></i>
									Static &amp; Dynamic Tables
								</small>
							</h1>
						</div> --><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								
<!-- ------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------- -->
								
								
								
<div class="row">
	<div class="col-xs-12">
<?php 
$from = intval(($self['pageOffset']-1)*$self['num']+1);
$to = intval($from+$self['num']-1);
$to = $to > $self['total'] ? $self['total'] : $to;
$from = !$to ? 0 : $from;
?>
		<h3 class="header smaller lighter blue">当前显示第 <span id="rs_from"><?php print($from) ?></span> 到 <span id="rs_to"><?php print($to) ?></span> 条记录，共<span id="rs_total"><?php print($self['total']) ?></span>条<font color="red">预约</font>记录</h3>
		<div class="table-header">
			点击每行右侧的小图标查看详细
		</div>
		<div class="table-responsive">
			<table id="sample-table-3" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th class="center hide"><!-- 隐藏勾选列 -->
							<label>
								<input type="checkbox" class="ace" />
								<span class="lbl"></span>
							</label>
						</th>
						<th><?php print($th_title[0]); ?></th>
						<th><?php print($th_title[1]); ?></th>
						<th class="hidden-480"><?php print($th_title[2]); ?></th>
						<th>
							<i class="icon-time bigger-110 hidden-480"></i>
							<?php print($th_title[3]); ?>
						</th>
						<th class="hidden-480"><?php print($th_title[4]); ?></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
<?php foreach ($self['records'] as $record ){ ?>
					<tr>
						<td class="center hide"><!-- 隐藏勾选列 -->
							<label>
								<input type="checkbox" class="ace" />
								<span class="lbl"></span>
							</label>
						</td>
						<td shell="getBookDetails" params="<?php print $record['id'].'|'.$record['booktype'].'|'.($self['num'].'|'.strval($from))?>" style="cursor: pointer;">
							<a><?php echo $record[$th_pos[0]] ?></a>
						</td>
						<td><?php echo $record[$th_pos[1]] ?></td>
						<td class="hidden-480"><?php echo $record[$th_pos[2]] ?></td>
						<td><?php echo $record[$th_pos[3]] ?></td>
						<td class="hidden-480">
							<span class="label label-sm label-inverse arrowed-in"><?php print $record[$th_pos[4]] ?></span>
						</td>
						<td>
							<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
								<a shell="getBookDetails" params="<?php print $record['id'].'|'.$record['booktype'].'|'.($self['num'].'|'.strval($from))?>" style="cursor: pointer;" class="blue">
									<i class="icon-zoom-in bigger-130"></i>
								</a>
							<?php 
							if(2!=$record['status'] && $user->id==$record['rightuserfk']) {
							?>
								<a id="delBookInfo" shell="delBookInfo" params="<?php echo $record['id']?>" style="cursor: pointer;" class="red ai-ajax">
									<i class="icon-trash bigger-130"></i>
								</a>
							<?php 
							}
							?>
							</div>
							<div class="visible-xs visible-sm hidden-md hidden-lg">
								<div class="inline position-relative">
									<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown">
										<i class="icon-caret-down icon-only bigger-120"></i>
									</button>
									<ul class="dropdown-menu dropdown-only-icon dropdown-yellow pull-right dropdown-caret dropdown-close">
										<li>
											<a href="#" class="tooltip-info" data-rel="tooltip" title="View">
												<span class="blue">
													<i class="icon-zoom-in bigger-120"></i>
												</span>
											</a>
										</li>
										<li>
											<a class="tooltip-success" data-rel="tooltip" title="Edit">
												<span class="green">
													<i class="icon-edit bigger-120"></i>
												</span>
											</a>
										</li>
										<li>
											<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
												<span class="red">
													<i class="icon-trash bigger-120"></i>
												</span>
											</a>
										</li>
									</ul>
								</div>
							</div>
						</td>
					</tr>
<?php } ?>

				</tbody>
			</table>
		</div>
	</div>
</div>								
								
								
								
<!-- ------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------- -->
<?php 
/*
 * 输出分页按钮
 */
$num = $self['num'];//每页显示结果集数
print('<div class="btn-group pull-right">');
$pageTotal = $self['total'] / $num;
$pageTotal = $self['total'] % $num ? $pageTotal+1 : $pageTotal; 
for ($i = 1 ; $i <= $pageTotal ; $i ++){
	$pageOffset = ($self['pageOffset'] == $i)?'btn-inverse':'';
	print('<button class="btn '.$pageOffset.' ai-skip" shell="listSelfBook" params="'.$num.'|'.strval(($i-1)*$num).'">'.$i.'</button>');
}
print('<span id="numPerPage" class="hide">'.$num.'</span>');
print('</div>');
?>
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->