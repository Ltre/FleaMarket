<form class="ai-form">
	<div style="margin-left:50px;">
	<div style="width:25% ;float: left;">
				<input type="checkbox" id="ti-args-1" class="ai-args-1" value="PSL" />
				发布转让信息<br>
				<input type="checkbox" id="ti-args-2" class="ai-args-2" value="MSL"/>
				修改转让信息<br>
				<input type="checkbox" id="ti-args-3" class="ai-args-3" value="DSL"/>
				删除转让信息<br>
			</div>
		<div style="width:25% ;float: left;">
				<input type="checkbox" id="ti-args-4" class="ai-args-4" value="PBL"/>
				发布求购信息<br>
				<input type="checkbox" id="ti-args-5" class="ai-args-5" value="MBL"/>
				修改求购信息<br>
				<input type="checkbox" id="ti-args-6" class="ai-args-6" value="DBL" />
				删除求购信息<br>
			</div>
		
		
			<div style="width:25% ;float: left;">
				<input type="checkbox" id="ti-args-7" class="ai-args-7" value="FSSX"/>
				发送私信<br>
				<input type="checkbox" id="ti-args-8" class="ai-args-8" value="FQYY"/>
				发起预约<br>
				<input type="checkbox" id="ti-args-9" class="ai-args-9" value="SCYY"/>
				删除预约<br>
				<input type="checkbox" id="ti-args-10" class="ai-args-10" value="QRJY"/>
				确认交易<br>
			</div>
	</div>
	<div style="float: bottom">
	<input type="button" class="ai-submit" value="修改"/>
	</div>
</form>


<script type="text/javascript">
jQuery(document).ready(function($){
<?php
		$url=ActionUtil::getTplArgs();
		if($url[0]['auid']!='null'){
		//echo "alert('9999');";
		for($i=0;$i<count($url);$i++){
			echo '$("input[class~=ai-args-'.$url[$i]["auid"].']").attr("checked","checked");' ;
			}
		}
		//$("input[class~='ai-args-1']").attr("checked","checked");
		?>

$("input[class~='ai-submit']").click(
		function (){
			//alert("32154");
			var inputlist=$("input[class^=ai-args]");
			var checkval="<?php echo $url[0]['uid'];?>";
			if(checkval!=null){
			for(var i=1 ; i<=inputlist.length;i++){
					if(document.getElementById('ti-args-'+i).checked)
							checkval+="|1";
					else checkval += "|0";
			}
				//alert(checkval);
				var url ="?x=upAuthority|"+checkval;//jhghjg/.test()
				$.post(url,function (data){
						alert("反馈信息："+data);

					});
				}
			});
		
});
</script>

