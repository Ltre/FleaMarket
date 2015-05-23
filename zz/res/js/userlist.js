jQuery(function($) {
//表格中查看用户详细信息事件
$AiForm.bindCommonAjaxValidateAndFeedback(
				$("[class~=ai-user]"),
				function(){
					//alert('$("[class~=ai-user]")所选控件的验证过程');
					return true;//使用false则视为验证不通过
				},
				function(data){
					//alert("统一处理ajax反馈的数据："+data);
					dialog=document.getElementById("dialog");
					//dialog.style.top = document.body.scrollTop;
				 	dialog.innerHTML=data;
					$("#dialog").dialog({modal: false,
						stack : false,
						show:"puff",
						hide : "puff",
						position:"right",
						height:document.body.scrollHeight,
						width:window.screen.availWidth/3,
					});
				}
		);

//删除表格中用户信息事件
$AiForm.bindCommonAjaxValidateAndFeedback(
				$("[class~=ai-udelete]"),
				function(data){
					//alert('$("[class~=ai-udelete]")所选控件的验证过程');
					//alert($(this).attr("params"));
					//var data=$("[class~=ai-udelete]").first().attr("params").split('|');
					var issure = confirm("你确定删除"+data+"用户吗？");
					return issure;//使用false则视为验证不通过
				},
				function(data){
					alert("统一处理ajax反馈的数据："+data);
					//更新用户列表数据
					$("a[class~='ai-userinfo']").click();
					});
});
