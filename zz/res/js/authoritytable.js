//表格中查看用户详细信息事件
$AiForm.bindCommonAjaxValidateAndFeedback(
				$("[class~=ai-auth]"),
				function(){
					//alert('$("[class~=ai-auth]")所选控件的验证过程');
					return true;//使用false则视为验证不通过
				},
				function(data){
					$("#apDiv1").html(data);
					});