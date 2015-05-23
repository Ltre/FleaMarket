<div class="page-content col-xs-10" style="margin:0.5cm auto;">
<?php 
	$sql="select u.id as uid , u.username as uname , r.name as rname ,u.sid as sid from fm_roles as r,fm_users as u 
		where r.id=u.rolefk LIMIT 0 , 10";
	//$user = new UserRoles();
	$sumsql="select count(id) from fm_users ;";
	$sum = AiMySQL::queryCustom($sumsql);
	$sum = $sum[0][0];
	$userlist = AiMySQL::queryCustom($sql);
	//var_dump($userlist);
	
?>

	<div class="table-header">权限操作：</div>
	<div class="table-responsive" >
		<table class="table table-striped table-bordered table-hover" >
			<thead><tr><td>用户名</td><td>角色</td><td>学号</td><td>查看个人信息</td></tr></thead>
			<tbody id="ai-tbody">
			<?php 
				foreach ($userlist as $user){
					echo '<tr class="ai-auth" shell="searchAuthority" params="'.$user['uid'].'"><td>'.$user['uname'].'</td><td>'.
					$user['rname'].'</td><td>'.$user['sid'].'</td><td><a >www.baidu.com'.'</a></td></tr>';
				}
			
			?>
			</tbody>
		</table>
		</div>	
	<div class="row">
		<div class="col-sm-7">
			<div class="dataTables_paginate paging_bootstrap">
				<ul class="pagination">
					<li class="prev">
						<a href="#" class="ai-change" shell="authoritytable" params="0" ><i class="icon-double-angle-left"></i></a>
					</li>
						<li class="active"><a href="#" id="ai-first">1</a></li>
						<li><a href="#" id="ai-second">2</a></li>
						<li><a href="#" id="ai-three">3</a></li>
					<li class="next">
						<a href="#" class="ai-next" shell="authoritytable" params="0"><i class="icon-double-angle-right"></i></a>
					</li>
					<li class="" ><a>共<b id="ai-sum"> <?php echo intval($sum/10+($sum%10>0?1:0));?></b>页</a></li>
				</ul>
			</div>
		</div>
	</div><!--end row  -->	
	
	<div id="apDiv1" class="col-xs-11">
	
	</div>
	<script src="res/js/authoritytable.js"></script>
		<script type="text/javascript">
		jQuery(function($) {
			
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
							var url = "?x=authoritytable|"+param;
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
					var url = "?x=authoritytable|"+param;
					$.post(url,function(data){
						$("#ai-tbody").html(data);
						});
					
					return false;//使用false则视为验证不通过
				},
				function(data){;}
		);
		});
		</script>			
</div>

