					<div class="page-content">
						<!--<div class="page-header">
							<h1>
								信息中心
							</h1>
						</div> /.page-header -->
						<div class="row">
							<div class="col-xs-11">
								<!-- PAGE CONTENT BEGINS -->


								<!-- <div class="hr hr-18 dotted hr-double"></div> -->

								<div class="row">
									<div class="col-xs-12">
										<!-- <h3 class="header smaller lighter blue">用户信息</h3> -->
										<div class="table-header">
											用户信息列表
										</div>

										<div class="table-responsive">
											<table id="sample-table-2" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th class="center">
															<label>
																<input type="checkbox" class="ace" />
																<span class="lbl"></span>
															</label>
														</th>
														<th>用户名</th>
														<th>姓名</th>
														<th class="hidden-480">SID</th>

														<th>
															<i class="icon-time bigger-110 hidden-480"></i>
															邮箱
														</th>
														<th class="hidden-480">信用值</th>

														<th></th>
													</tr>
												</thead>
<script src="res/js/userlist.js"></script>
												<tbody id="ai-tbody">

<?php 
			$sumsql="select count(id) from `fm_users`;";
		 	$sum = AiMySQL::queryCustom($sumsql);
		 	if(count($sum)==0){echo '<li><b>暂无数据</b></li>';}
		 	else {
		 	$sum =$sum[0][0];
			echo UserUtil::showtable(0);
			}
	?>
	
													
												</tbody>
												<!-- <script type="text/javascript" src="res/js/userlist.js"></script> -->
											</table>
	<div class="row">
		<div class="col-sm-7">
			<div class="dataTables_paginate paging_bootstrap">
				<ul class="pagination">
					<li class="prev">
						<a href="#" class="ai-change" shell="usertable" params="0" ><i class="icon-double-angle-left"></i></a>
					</li>
						<li class="active"><a href="#" id="ai-first">1</a></li>
						<li><a href="#" id="ai-second">2</a></li>
						<li><a href="#" id="ai-three">3</a></li>
					<li class="next">
						<a href="#" class="ai-next" shell="usertable" params="0"><i class="icon-double-angle-right"></i></a>
					</li>
					<li class="" ><a>共<b id="ai-sum"> <?php echo intval($sum/10+($sum%10>0?1:0));?></b>页</a></li>
				</ul>
			</div>
		</div>
	</div><!--end row  -->
	
										</div>
									</div>
								</div><!-- /.col -->
						</div><!-- /.row -->
						<!-- 消息框 -->
				

				<!--  -->
				<script type="text/javascript">
	jQuery(document).ready(function($){

		//处理上下页
		changetable=function (){
			var one = parseInt($("#ai-first").html());
			var two = parseInt($("#ai-second").html());
			var three= parseInt($("#ai-three").html());
			//alert(first);
			if(one==1){
					$("[class~=ai-prev]").parent().attr('class',"prev disabled");
					$("[class~=ai-prev]").attr('class',"disabled");
					alert("已经是第一页了！");
				}
			else{
				$('[class~=ai-next]').parent().attr('class',"next");
					$("#ai-first").html(one-1);
					$("#ai-second").html(one);
					$("#ai-three").html(two);
				}
			}
		next = function (){
			var last=parseInt($("#ai-sum").html());//获取最后一页
			//alert(last);
			var one = parseInt($("#ai-first").html());
			var two = parseInt($("#ai-second").html());
			var three= parseInt($("#ai-three").html());
			 if(three == last){
				 $('[class~=ai-change]').parent().attr('class',"prev");
				 $("#ai-first").html(last-1);
				$("#ai-second").html(last);
				$("#ai-three").html(null);
				 }
			 else if(two == last){
				 $('[class~=ai-change]').parent().attr('class',"prev");
				 $("#ai-first").html(last);
				 $("#ai-second").html(null);
				 $("#ai-three").html(null);
				 }
			 else if(one==last){
				 $('[class~=ai-change]').parent().attr('class',"prev");
					$('[class~=ai-next]').parent().attr('class',"next disabled");
					$('[class~=ai-next]').attr('class',"disabled");
					alert("已经是最后一页了！");
				}
			else if(three <last){
				$('[class~=ai-change]').parent().attr('class',"prev");
					$("#ai-first").html(three-1);
					$("#ai-second").html(three);
					$("#ai-three").html(three+1);
				}
			
			}
	 	//分页技术
		$AiForm.bindCommonAjaxValidateAndFeedback(
						$("[class~=ai-change]"),
						function(){
							//alert('$("[class~=ai-prev]")所选控件的验证过程');
							changetable();
							var param=(parseInt($("#ai-first").html())-1)*10;
							var url = "?x=usertable|"+param;
							$.post(url,function(data){
								$("#ai-tbody").html(data);
								});
							return false;//使用false则视为验证不通过
						},
						function(data){;}
				);
		//next下一页
		$AiForm.bindCommonAjaxValidateAndFeedback(
				$("[class~=ai-next]"),
				function(){
					//alert('$("[class~=ai-prev]")所选控件的验证过程');
					next();
					var param=(parseInt($("#ai-first").html())-1)*10;
					var url = "?x=usertable|"+param;
					$.post(url,function(data){
						$("#ai-tbody").html(data);
						});
					return false;//使用false则视为验证不通过
				},
				function(data){;}
		);
		
		//初始化AI控件的事件绑定
		bindvalue=false;
		$AiForm.replaceDocWithClickAiSkip();
		//表单验证过程
		$AiFormValidates = {
				//示例【指令名称：function(args){处理过程。。。}】
				updatausers : function (args){
					if (bindvalue==true){
					//假定验证成功
					//var textlist=$("input[class^='ai-args']");
					var url = $AiForm.assemblyShellParams('updatausers',args);
					var args= $("textarea[class^='ai-args']").html();
					$.post(url,{summary:args},function (data){
						alert("现在处理的是updatausers指令反馈的数据："+data);
						$("a[class~='ai-userinfo']").click();
						}
					);
					
					if(true){
						//alert("表单数据通过验证，数据准备提交...");
						return false;
					}else{
						alert("表单数据不合法！");
						return false;
					}
				}else return false;
			 }
				
		};
		//处理ajax反馈数据的过程集合
		$AiFormDealResults = {
			updatausers : function(data){
				alert("现在处理的是updatausers指令反馈的数据："+data);
			}
		};
		//将数据处理方法集合 绑定到 对应表单
		usersubmit=function (){
					if($("[class~=ai-submit]").attr("value")=="更新"&&bindvalue==true){
						;
					}
					else{
						document.getElementById("ai-submit").value="更新";
						$("[class^=ai-args]").removeAttr("disabled"); 
						//修改角色选择列表
						var airolefk = $("input[id='ai-rolefk']");
						$("input[id='ai-rolefk']").replaceWith('<select id="role">'+
								'<option value="1">普通</option>'+
								'<option value="2">日常管理员</option>'+
								'<option value="3">系统管理员</option>'+
								'</select>');
						//alert(airolefk.val());
						$("select>option:contains('"+airolefk.val()+"')").attr({ selected:"selected"}); 
						$("select[id='role']").addClass("ai-args-3") ;
						//绑定状态
						bindvalue=true;
						$AiForm.aiFormBindFeedBack($AiFormValidates,$AiFormDealResults );
					}
				}
	});
   </script>
   </div>
		</div><!-- /.page-content -->
