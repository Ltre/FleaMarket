<?php 
$args = ActionUtil::getTplArgs();
$self = $args['args'];
$th_title = array();//表头标题
$th_pos = array();//表头序号
foreach ($self['header'] as $th_pos[]=>$th_title[]);

OrekiUtil::var_dump_array($args);

exit;
?>
					<div class="page-content">
						<div class="page-header">
							<h1>
								Tables
								<small>
									<i class="icon-double-angle-right"></i>
									Static &amp; Dynamic Tables
								</small>
							</h1>
						</div><!-- /.page-header -->

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
		<h3 class="header smaller lighter blue">jQuery dataTables</h3>
		<div class="table-header">
			Results for "Latest Registered Domains"
		</div>
		<div class="table-responsive">
			<table id="sample-table-3" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th class="center">
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
						<td class="center">
							<label>
								<input type="checkbox" class="ace" />
								<span class="lbl"></span>
							</label>
						</td>
						<td>
							<a href="#"><?php echo $record[$th_pos[0]] ?></a>
						</td>
						<td><?php echo $record[$th_pos[1]] ?></td>
						<td class="hidden-480"><?php echo $record[$th_pos[2]] ?></td>
						<td><?php echo $record[$th_pos[3]] ?></td>
						<td class="hidden-480">
							<span class="label label-sm label-warning"><?php echo $record[$th_pos[4]] ?></span>
						</td>
						<td>
							<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
								<a class="blue" href="#">
									<i class="icon-zoom-in bigger-130"></i>
								</a>
								<a class="green" href="#">
									<i class="icon-pencil bigger-130"></i>
								</a>
								<a class="red" href="#">
									<i class="icon-trash bigger-130"></i>
								</a>
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
											<a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
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
					<tr>
						<td class="center">
							<label>
								<input type="checkbox" class="ace" />
								<span class="lbl"></span>
							</label>
						</td>

						<td>
							<a href="#">app.com</a>
						</td>
						<td>$45</td>
						<td class="hidden-480">3,330</td>
						<td>Feb 12</td>

						<td class="hidden-480">
							<span class="label label-sm label-warning">Expiring</span>
						</td>

						<td>
							<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
								<a class="blue" href="#">
									<i class="icon-zoom-in bigger-130"></i>
								</a>

								<a class="green" href="#">
									<i class="icon-pencil bigger-130"></i>
								</a>

								<a class="red" href="#">
									<i class="icon-trash bigger-130"></i>
								</a>
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
											<a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
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

					<tr>
						<td class="center">
							<label>
								<input type="checkbox" class="ace" />
								<span class="lbl"></span>
							</label>
						</td>

						<td>
							<a href="#">best.com</a>
						</td>
						<td>$75</td>
						<td class="hidden-480">6,500</td>
						<td>Apr 03</td>

						<td class="hidden-480">
							<span class="label label-sm label-inverse arrowed-in">Flagged</span>
						</td>

						<td>
							<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
								<a class="blue" href="#">
									<i class="icon-zoom-in bigger-130"></i>
								</a>

								<a class="green" href="#">
									<i class="icon-pencil bigger-130"></i>
								</a>

								<a class="red" href="#">
									<i class="icon-trash bigger-130"></i>
								</a>
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
											<a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
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
					
					<tr>
						<td class="center">
							<label>
								<input type="checkbox" class="ace" />
								<span class="lbl"></span>
							</label>
						</td>

						<td>
							<a href="#">light.com</a>
						</td>
						<td>$40</td>
						<td class="hidden-480">3,100</td>
						<td>Feb 17</td>

						<td class="hidden-480">
							<span class="label label-sm label-success">Registered</span>
						</td>

						<td>
							<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
								<a class="blue" href="#">
									<i class="icon-zoom-in bigger-130"></i>
								</a>

								<a class="green" href="#">
									<i class="icon-pencil bigger-130"></i>
								</a>

								<a class="red" href="#">
									<i class="icon-trash bigger-130"></i>
								</a>
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
											<a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
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
					<tr>
						<td class="center">
							<label>
								<input type="checkbox" class="ace" />
								<span class="lbl"></span>
							</label>
						</td>

						<td>
							<a href="#">day.com</a>
						</td>
						<td>$55</td>
						<td class="hidden-480">5,600</td>
						<td>Jan 29</td>

						<td class="hidden-480">
							<span class="label label-sm label-info arrowed arrowed-righ">Sold</span>
						</td>

						<td>
							<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
								<a class="blue" href="#">
									<i class="icon-zoom-in bigger-130"></i>
								</a>

								<a class="green" href="#">
									<i class="icon-pencil bigger-130"></i>
								</a>

								<a class="red" href="#">
									<i class="icon-trash bigger-130"></i>
								</a>
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
											<a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
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

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->