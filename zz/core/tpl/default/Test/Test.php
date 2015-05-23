<html>
<head>
 <script type="text/javascript" src="<?php printf(APPROOT.JQUERY_LIB_PATH); ?>"></script>
<!-- <script src="res/assets/js/jquery-2.0.3.min.js"></script> -->
<script type="text/javascript" src="res/test/jquery-ui-1.10.4.custom.min.js"></script>
<link rel=stylesheet type=text/css href="res/test/jquery-ui-1.10.4.custom.css"/>
</head>
<body>
	<div id=tabs>
		<div>
		<ul>
			<li><a href=#tab1>tab1</a></li>
			<li><a href=#tab2>tab2</a></li>
			<li><a href=#tab3>tab3</a></li>
		</ul>
		</div>
		<div id=tab1>sofijlskfjoisaflkj</div>
		<div id=tab2>77777777777777</div>
		<div id=tab3>5555555555555555</div>
	</div>
	<div id="sb">
		<h1><a>m1</a></h1>
		<div id=tb style="display: none;">
			<h1><a>m11</a></h1>
			<div>nimei</div>
			<h1><a>m12</a></h1>
			<div>caoni</div>
		</div>
		<h1><a>m2</a></h1>
		<div>meifasldkfj222222</div>
		<h1><a>m3</a></h1>
		<div>sdf3333333</div>
	</div>
	<div id="dialog" title="Dialog Title" style="display: none;" >I'm in a dialog</div>
	<input type="button" onClick="dialog()" value="dialog"/>

	
	
	
	
	
	<!-- PAGE CONTENT BEGINS -->

								<div class="row">
									<div class="col-xs-6 col-sm-3 pricing-box">
										<div class="widget-box">
											<div class="widget-header header-color-dark">
												<h5 class="bigger lighter">Basic Package</h5>
											</div>

											<div class="widget-body">
												<div class="widget-main">
													<ul class="list-unstyled spaced2">
														<li>
															<i class="icon-ok green"></i>
															10 GB Disk Space
														</li>

														<li>
															<i class="icon-ok green"></i>
															200 GB Bandwidth
														</li>

														<li>
															<i class="icon-ok green"></i>
															100 Email Accounts
														</li>

														<li>
															<i class="icon-ok green"></i>
															10 MySQL Databases
														</li>

														<li>
															<i class="icon-ok green"></i>
															$10 Ad Credit
														</li>

														<li>
															<i class="icon-remove red"></i>
															Free Domain
														</li>
													</ul>

													<hr />
													<div class="price">
														$5
														<small>/month</small>
													</div>
												</div>

												<div>
													<a href="#" class="btn btn-block btn-inverse">
														<i class="icon-shopping-cart bigger-110"></i>
														<span>Buy</span>
													</a>
												</div>
											</div>
										</div>
									</div>

									<div class="col-xs-6 col-sm-3 pricing-box">
										<div class="widget-box">
											<div class="widget-header header-color-orange">
												<h5 class="bigger lighter">Starter Package</h5>
											</div>

											<div class="widget-body">
												<div class="widget-main">
													<ul class="list-unstyled spaced2">
														<li>
															<i class="icon-ok green"></i>
															50 GB Disk Space
														</li>

														<li>
															<i class="icon-ok green"></i>
															1 TB Bandwidth
														</li>

														<li>
															<i class="icon-ok green"></i>
															1000 Email Accounts
														</li>

														<li>
															<i class="icon-ok green"></i>
															100 MySQL Databases
														</li>

														<li>
															<i class="icon-ok green"></i>
															$25 Ad Credit
														</li>

														<li>
															<i class="icon-ok green"></i>
															Free Domain
														</li>
													</ul>

													<hr />
													<div class="price">
														$10
														<small>/month</small>
													</div>
												</div>

												<div>
													<a href="#" class="btn btn-block btn-warning">
														<i class="icon-shopping-cart bigger-110"></i>
														<span>Buy</span>
													</a>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="space-24"></div>
								<!-- PAGE CONTENT ENDS -->
	
	
	
	
	
	
	<script type="text/javascript">
	$(document).ready(function() {
		$("#tabs").tabs();
		$("#sb").accordion();
		$("#tb").accordion();
		//$("#tb").accordion().collapsible();
		dialog=function (){
			//alert($("div#dialog").val());
			$("div#dialog").dialog({ modal: true });
		}
			  });
	</script>

</body>
</html>