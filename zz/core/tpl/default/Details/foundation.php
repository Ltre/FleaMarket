<?php
$sql="select p.id as `id` ,p.name as `name` ,p.puncode as  `puncode` ,p.details as `details` , r.name as `rolefk` ,p.duration as `duration` 
		from `fm_punishstyle` as p,`fm_roles` as r where r.id = p.rolefk";
$insql="INSERT INTO  `fleamarket`.`fm_punishstyle` (`id` ,`name` ,`puncode` ,`details` ,`rolefk` ,`duration` ,`duraunitfk`)
VALUES (NULL ,  '超时',  'CHT',  '超过时间，被城管结余',  '3',  '7',  '1');";
$guizelist=AiMySQL::queryCustom($sql);
$insertval=count($guizelist)
//var_dump($guizelist);
?>
<div class="page-content">
	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->

			<div class="space-6"></div>

			<div class="row">
				<div class="col-sm-10 col-sm-offset-1">
					<div class="widget-box transparent invoice-box">
						<div class="widget-header widget-header-large">
							<h3 class="grey lighter pull-left position-relative">
								<i class="icon-print red"></i>
								违规规则设定：
							</h3>
							<!-- <div class="widget-toolbar hidden-480">
								<a href="#">
									<i class="icon-print"></i>
								</a>
							</div> -->
						</div>
					</div><!-- row -->

					<div class="space"></div>
					<div>
						<table class="table table-striped table-bordered">
							<thead>
								<tr>
									<th class="center">名称</th>
									<th>规则编码</th>
									<th class="hidden-xs">描述</th>
									<th class="hidden-480">纳入角色</th>
									<th>维持时长</th>
								</tr>
							</thead>

							<tbody>
							<?php 
							if($insertval==0){echo  "暂无数据信息！";}
							else {
								foreach ($guizelist as $gugg){
									echo '<tr><td class="center">'.$gugg['name'].'</td><td>'.$gugg['puncode'].'</td><td class="hidden-xs">'.$gugg['details']
									.'</td><td class="hidden-480">'.$gugg['rolefk'].'</td><td>'.$gugg['duration'].'小时</td></tr>';
								}
							}
							?>
								<!-- <tr>
									<td class="center">1</td>
									<td>
										
									</td>
									<td class="hidden-xs">
										1 year domain registration
									</td>
									<td class="hidden-480"> --- </td>
									<td>$10</td>
								</tr> -->
							
							</tbody>
						</table>
					</div>

				<div class="hr hr8 hr-double hr-dotted"></div>
				<div class="space-6"></div>
				<div class="row well ai-inpss ">
					<form id="updatapss" class="ai-form">
						<div class="ai-title">新增规则：</div>
						<table class="col-sm-5 table table-striped table-bordered">
							<thead>
								<tr>
									<th class="center">名称</th>
									<th>规则编码</th>
									<th class="hidden-xs">描述</th>
									<th class="hidden-480">纳入角色</th>
									<th>维持时长(单位：h)</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="center"><input type="text" style="width:100px"  class="ai-args-1" /></td>
									<td>
										<input type="text" style="width:100px"  class="ai-args-2" />
									</td>
									<td class="hidden-xs">
										<input type="text" style="width:100px" class="ai-args-3" />
									</td>
									<td class="hidden-480"> 
										<input type="text"  style="width:100px"  value="<?php if($insertval!=0)echo $gugg['rolefk']?>" disabled="disabled" />
									</td>
									<td>
										<input type="text" style="width:30px"  value="7" disabled="disabled"/>
									</td>
								</tr>
							</tbody>
						</table>
							<div class="center"><input style="width:100px;height:30px" type="button" class="ai-submit" value="添   加"/></div>
					</form>
				</div>
						<script>
						$AiFormValidates = {
						//示例【指令名称：function(args){处理过程。。。}】
							updatapss : function (args){
							return true;
					 		}
						};
						//处理ajax反馈数据的过程集合
						$AiFormDealResults = {
							updatapss : function(data){
								$("a[class~='ai-foundation']").click();
								alert("现在处理updatapss的是指令反馈的数据："+data);
							}
						};
						$AiForm.aiFormBindFeedBack($AiFormValidates,$AiFormDealResults );
						</script>		
					
				</div>
			</div>

			<!-- PAGE CONTENT ENDS -->
		</div><!-- /.col -->
	</div><!-- /.row -->
</div><!-- /.page-content -->