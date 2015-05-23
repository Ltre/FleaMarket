<?php
//规则设定
$keylist = array(
		'YDQSC',
		'SYJYQSC',
		'USERINITCREDIT',
		'USERINITSCORE',
		'WGCLMRWCSC',
		);
$tip = null;
foreach ($keylist as $value){
	$tip.="'{$value}',";
}
$tip = trim($tip,",");
$sql="SELECT name ,id , rulevalue  FROM  `fm_rules` 
		where itemcode in ( ".$tip.")";
$guizelist=Tableutil::queryCustom($sql);
$gzkey = count($guizelist);
//var_dump($guizelist);

//分类  
$flsql="SELECT id,name FROM  `fm_fleatype` "; 
$fenlei = Tableutil::queryCustom($flsql); 
$fenkey = count($fenlei);
//var_dump($fenlei); 
?> 
	<!-- <div id = "cao"></div> -->
	<div class="page-content">
	<div class="row">
		<div class="col-xs-6 col-sm-5 pricing-box">
			<div class="widget-box">
				<div class="widget-header header-color-dark">
					<h5 class="bigger lighter">规则设定</h5>
				</div>
		
				<div class="widget-body">
					<div class="widget-main" style="overflow:scroll;height:500px">
						<ul class="list-unstyled spaced2">
							<?php 
								if($gzkey==0){echo '<li><b>暂无数据</b></li>';}
								else{
								foreach ($guizelist as $index){
									echo '<li><div class="auto"><form ><input type="text" class="itemcode hide" value="'.$index->id.'"/>';
									echo '<input type="text" disabled="disabled" value="'.$index->name.'"/><input type="text" class="ai-args" value='.$index->rulevalue.'>';
									echo '<input type="button" class ="ai-submit" value="更改"/><br/> </form></div></li>';
								}}
								?>
						</ul>
					</div>
		
					<div>
						<a href="#" class="btn btn-block btn-inverse">
							<i class="bigger-110"></i>
							<span></span>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-7 col-sm-5 pricing-box">
			<div class="widget-box">
				<div class="widget-header header-color-dark">
					<h5 class="bigger lighter">分类管理</h5>
				</div>
		
				<div class="widget-body">
					<div class="widget-main" style="overflow:scroll;height:500px">
						<ul class="list-unstyled spaced2">
							<?php 
								$n=0;
								if($fenkey==0){echo '<li><b>暂无数据</b></li>';}
								else{
								foreach ($fenlei as $index){
									$n++;
									echo '<li><div class="auto2"><input type="text" disabled="disabled" value="'.$n.'"/><input type="text" class="ai-fid hide" value="'.$index->id.'"/>';
									echo '<input type="text" class="ai-name" value="'.$index->name.'"/>';
									echo '<input type="button" class ="ai-button" value="更改"/></div></li>';
									}}
								?>
						</ul>
					</div>
		
					<div>
					
						<a href="#" class="btn btn-block btn-inverse">
							
							<i class="bigger-110"></i>
							<span></span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
	
<script>
	$('[class~=ai-submit]').click(function (e){
		var obj = $(this).closest("[class=auto]");
		var itemcode = obj.find('[class~=itemcode]').val();
		var rulevalue = obj.find('[class~=ai-args]').val();
		var isset=/^\d+$/.test(rulevalue);
		var url = "../zz/?x=upvolation|"+itemcode+"|"+rulevalue;
	if(isset){
	$.post (url,
		function (data){
			alert(""+data);
			//$("#cao").html(data);
		});
	}else{alert("格式不正确，请输入正整数！");}
	});


//
	$('[class~=ai-button]').click(function (e){
		var obj2 = $(this).closest("[class=auto2]");
		var id = obj2.find('[class~=ai-fid]').val();
		var name = obj2.find('[class~=ai-name]').val();
		name = encodeURIComponent(name);
		//var isset=/^\d+$/.test(rulevalue);encodeURIComponent
		var url = "../zz/?x=upfleatype|"+id+"|"+name;
	//if(isset){
	$.post (url,
		function (data){
			alert(""+data);
			//$("#cao").html(data);
		});
	//}else{alert("格式不正确，请输入正整数！");}
	});
</script>
</div>