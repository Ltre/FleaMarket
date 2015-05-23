<!DOCTYPE html>
<?php 
$ta = ActionUtil::getTplArgs();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<title>华软旧货市场  2014</title>
<link href="res/Matrix/style.css" title="style" rel="stylesheet" type="text/css" />
<link id="clink" href="res/Matrix/css/style-blue.css" title="style" rel="stylesheet" type="text/css" media="screen"/>

<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js" type="text/javascript"></script> -->
<script src="res/Matrix/scripts/jquery.min.js" type="text/javascript"></script>
<script src="res/Matrix/scripts/jquery.masonry.min.js" type="text/javascript"></script>
<script src="res/Matrix/scripts/jquery.easing.1.3.js" type="text/javascript"></script>
<script src="res/Matrix/scripts/MetroJs.lt.js" type="text/javascript"></script>
<script src="res/Matrix/scripts/jquery.fancybox-1.3.4.js" type="text/javascript" charset="utf-8"></script>
<script src="res/Matrix/scripts/jquery.flexslider-min.js" type="text/javascript" charset="utf-8"></script>
<script src="res/Matrix/scripts/hoverintent.js" type="text/javascript" charset="utf-8"></script>
<script src="res/Matrix/scripts/jquery.jplayer.min.js" type="text/javascript" charset="utf-8"></script>
<script src="res/Matrix/scripts/organictabs.jquery.js" type="text/javascript" charset="utf-8"></script>
<!--[if lt IE 9]>
  <style type="text/css">
  @import url("res/Matrix/style-ie8.css");
  </style>
  <script src="res/Matrix/scripts/css3-mediaqueries.js" type="text/javascript" charset="utf-8"></script>
  <script>
    document.createElement('header');
    document.createElement('nav');
    document.createElement('section');
    document.createElement('article');
    document.createElement('aside');
    document.createElement('footer');
    document.createElement('hgroup');
    </script>
<![endif]-->
<!--[if IE 9]>
  <style type="text/css">
  @import url("style-ie9.css");
  </style>
<![endif]-->
<script src="res/Matrix/scripts/javascript.js" type="text/javascript"></script>
<script src="res/Matrix/scripts/mediaplayer.js" type="text/javascript"></script>
<style type="text/css">
	.aismtext{
		font-size: 15px;
	}
	.aitextleft{
		text-align: left;
	}
</style>

</head>
<body>
<div id="bodypat">
<section id="container">
    <div id="colorchanger">
    <!-- <a href="#" class="cblue cbox" title="Blue Theme"><span class="blue">衣物鞋包</span></a> -->
    <!-- php代码<a shell="fleatypeSearch" params="分类名称编码" title="搜索该分类" style="cursor: pointer;"><span class="颜色数组循环">分类名称数组循环</span></a> -->
<?php 
$fleatypes = $ta['fleatypes'];
$colors = array('blue', 'red', 'green', 'magenta', 'purple', 'teal', 'lime', 'brown', 'pink', 'mango');
if($fleatypes) foreach ($fleatypes as $fleatype)
{
?>
	<a shell="fleatypeSearch" params="<?php print 'buy|'.$fleatype->id.'|10|0' ?>" title="搜索该分类" style="cursor: pointer;"><span class="<?php print $colors[intval(@$i++%10)] ?>"><?php print $fleatype->name ?></span></a>
<?php	
}
?>
    <h4 style="cursor: pointer;" opt="buy" fts="<?php if($fleatypes)$fts=null;foreach ($fleatypes as $fleatype){$fts.=$fleatype->id.'|';}print trim($fts,'|');?>" maxftlen="<?php print count($fleatypes)?>" shell="<?php print "fleatypeSearch|buy|{$fleatypes[rand(0, count($fleatypes)-1)]->id}|10|0"?>" onclick="javascript:click_underft(this);">随便搜搜(*^__^*).</h4>
	<!-- <h4>Theme Color Selector</h4> -->
    </div>
<!-- BEGIN HEADER -->
<header class="clearfix">
<!-- BEGIN LOGO -->
<a id="headerlink" href="#" title="home"><img id="logo" src="res/Matrix/images/logo.png" alt="logo"/><span id="sitename"><font face="黑体">华软旧货市场</font></span></a>
<!-- END LOGO -->

<!-- BEGIN NAVIGATION -->
<nav>
<ul id="nav" class="clearfix">
<!-- Menu Item 1 -->
	<li class="current"><a href="./" style="cursor: pointer;" title="Home"><span>首页</span></a></li>
<!-- Menu Item 2 -->
    <li>
    	<a href="?x=pageToCreateFleaInfo|newsell|0" target="_blank" title="发布旧货信息的玩意儿"><span>发一条</span></a>
        <ul>
            <!-- 
            <li><a shell="pageToCreateFleaInfo" params="newsell|0" class="ai-skip" title="卖啥？到这里来" style="cursor: pointer;"><span>转让信息</span></a></li>
            <li><a shell="pageToCreateFleaInfo" params="newbuy|0" class="ai-skip" title="买啥？有求必应" style="cursor: pointer;"><span>求购信息</span></a></li>
             -->
            <li><a href="?x=pageToCreateFleaInfo|newsell|0" title="卖啥？到这里来" target="_blank"><span>转让信息</span></a></li>
            <li><a href="?x=pageToCreateFleaInfo|newbuy|0" title="买啥？有求必应" target="_blank"><span>求购信息</span></a></li>
        </ul>
    </li>
<!-- Menu Item 3 -->
    <li><a style="cursor: pointer;" title="随便看看" shell="randomSearch" params="buy|10|0"><span>随便看看</span></a>
        <ul>
	        <li><a style="cursor: pointer;" title="看看都有什么可以买" shell="randomSearch" params="sell|10|0"><span>转让</span></a></li>
	        <li><a style="cursor: pointer;" title="看看都在收啥二手" shell="randomSearch" params="buy|10|0"><span>求购</span></a></li>
        </ul>
    </li>
<!-- Menu Item 4 -->
<?php 
if(isset($_SESSION['user'])){
	$user = $_SESSION['user'];
?>
    <li class="after_login_shell">
    	<a href="?x=displayProfile|<?php print(urlencode($user->id))?>" target="_blank" title="点击可查看个人信息"><span><?php printf($user->username)?></span></a>
    </li>
<?php 
	if(in_array($user->rolefk, array(2, 3))){
?>
    <li class="after_login_shell">
    	<a href="../zz" title="你是管理员，点击这里进行管理" target="_blank"><span>管理中心</span></a>
    </li>	
<?php 
	}
?>
    <li class="after_login_shell">
    	<a shell="user_logout" style="cursor: pointer;"><span>退出</span></a>
    </li>
<?php 
}else{
?>
    <li>
    	<!-- 原shell="FlatApp-page_login" -->
    	<a class="ai-skip" shell="ace-login" title="登录" style="cursor: pointer;"><span>登录/注册</span></a>
    </li>
<?php 
}
?>

</ul>
</nav>
<!-- END NAVIGATION -->
</header>
<!-- END HEADER -->

<!-- BEGIN MAIN PAGE CONTENT -->
<section class="mainpage">
	<!-- BEGIN TOGGLE CONTENT -->
	<div class="toggle-button"><span class="toggle-indicator">-</span></div>
    
    <div class="toggle-content close" id="ai-header" style="display: block;">
        <div class="flexslider mainslide">
        <ul class="slides">
            <li>
            <img src="res/img/index/slideimg1.jpg" alt="Tile Design" />
            <p class="flex-title teal"></p>
            </li>
            <li>
            <img src="res/img/index/slideimg2.jpg" alt="Responsive" /><!-- res/Matrix/images/slideimg1.png -->
            <p class="flex-title">二手的好去处</p>
            </li>
            <li>
            <img src="res/img/index/slideimg3.jpg" alt="Customizability" />
            <p class="flex-title lime"></p>
            </li>
        </ul>
        </div><!-- end .flexslider -->
    
    <div class="quote-bg1"><div class="quote-w">华软旧货市场，一个能够倒买倒卖的好去处，一个没有规定而又充满各种潜规则的好地方 ￢▽￢  。各位湿地湿妹，以后这里就归你们啦！</div></div>
    
    </div><!-- end .toggle-content -->
    <!-- END TOGGLE CONTENT -->
</section><!-- end #mainpage -->


<div id="loader"></div><!-- loader image for AJAX -->

<section id="mainpage-mos">
<!-- BEGIN TILE CONTENT -->
<section id="content-mos" class="centered clearfix">
<!-- Tile 1 -->
<?php 
$tile1 = $ta['tile1'];
$tile1_rs = $ta['tile1']['result'];
if($tile1['result'])
{
	$tile1_rzimg = FleaoptUtil::getFleaImgUrl($tile1['result']['rzid'], 'buy');//旧货信息封面
	$tile1_cuimg = UserUtil::getUserAvatarUrl($tile1['result']['creuser']);//发布人头像
	$tile1_cretime = getdate(strtotime($tile1_rs['cretime']));
?>
<a href="#article-1" class="lightbox" rel="section">
    <div class="tile large live" data-stops="0,25%,50%,75%,100%" data-speed="3000" data-delay="0" data-direction="horizontal" data-stack="true">
        <div class="live-front">
        	<img width="310px" height="310px" class="live-img" src="<?php print $tile1_rzimg?>" alt="Article 1"/><!-- res/Matrix/images/placeholder/large_blank.png -->
        </div>
        <div class="live-back">
        	<img width="310px" height="310px" class="live-img" src="<?php print $tile1_cuimg?>" alt="Article 1"/> <!-- res/Matrix/images/placeholder/large_blank.png -->
        </div>
        <span class="tile-date redtxt"><span class="date" style="font-size: 36px;color: green;"><?php print $tile1['result']['rzname']?></span><span class="month" style="color: black;font-weight: bold;font-family: 华文彩云;font-size: 25px;"><?php print $tile1['result']['username']?><br/>发布</span></span>
        <span class="tile-cat red">最新的求购：<?php print $tile1['result']['title']?></span>
    </div>
</a>
	<!-- Lightbox Article Preview -->
    <div class="tile-pre">
    <article id="article-1" class="lb-article" data-lbcolor="#e61400"><!-- 添加了“ data-lbcolor="#e61400" ” -->
    <div class="article-img hide" style="display: none;">
        <div class="flexslider postslide">
        <ul class="slides">
    	<li>
        <img class="tile-pre-img"src="res/Matrix/images/placeholder/blog_pre_blank.png" alt="Article 1" />
        </li>
        <li>
        <img class="tile-pre-img" src="res/Matrix/images/placeholder/blog_pre_blank.png" alt="Article 1" />
        </li>
        </ul>
        </div>
    </div>
    <br>
    <div class="article-date redtxt"><span class="date"><?php print $tile1_cretime['mday']?></span><span class="month"><?php print $tile1_cretime['month']?></span></div>
    <h1 class="lb-title"><a href="<?php print$tile1['href']?>" ><?php print $tile1_rs['title']?></a></h1>
    <span class="postcat redtxt">发布人：<?php print $tile1_rs['username']?></span>
    <div class="lb-excerpt">
        <p>旧货分类：<?php print $tile1_rs['fleatypename']?></p>
        <p>详情：<?php print $tile1_rs['details']?></p>
        <p><a class="exp-button" href="<?php print$tile1['href']?>">查看更多 &#8594;</a></p>
    </div>
    </article>
    </div>
<?php 
}
?>
    
    
<!-- Tile 2 -->
<?php 
$tile2 = $ta['tile2'];
?>
<a href="#article-2" class="lightbox" rel="section">
    <div class="tile medium live" style="background-color: <?php $colortmp = array('teal', 'black','brown', 'white', 'grey'); print $colortmp[rand(0, count($colortmp)-1)];?>;" data-stops="0,75%,100%" data-speed="750" data-delay="1500">
    	<div class="live-front">
        	<img class="live-img hide" src="res/Matrix/images/placeholder/medium_blank.png" alt="Article 2" />
        </div>
        <div class="live-back">
        	<img class="live-img hide" src="res/Matrix/images/placeholder/medium_blank.png" alt="Article 2" />
        </div>
        <span class="tile-date tealtxt"><span class="date">随机</span><span class="month">推荐</span></span>
        <span class="tile-cat lime">分类：<?php print $tile2['fleatype']?></span>
    </div>
</a>
	<!-- Lightbox Article Preview -->
    <div class="tile-pre">
    <article id="article-2" class="lb-article"  data-lbcolor="#8cbe29"><!-- 添加了“  data-lbcolor="#8cbe29" ” -->
    <div class="article-img" style="display: none;">
    	<div class="flexslider postslide">
        <ul class="slides">
        <li>
    	<img class="tile-pre-img" src="res/Matrix/images/placeholder/blog_pre_blank.png" alt="Article Two" />
        </li>
        <li>
    	<img class="tile-pre-img" src="res/Matrix/images/placeholder/blog_pre_blank.png" alt="Article Two" />
        </li>
        </ul>
        </div>
    </div>
    <br/>
    <div class="article-date limetxt"><span class="date">&nbsp;</span><span class="month">&nbsp;</span></div>
    <h1 class="lb-title"><a href="singleblogpost-1.html"><?php print $tile2['msg']?></a></h1>
<?php 
for($i=0;$i<$tile2['nums'];$i++)
{
?>
    <span class="postcat greentxt"><?php print$tile2['titles'][$i]?></span>
    <div class="lb-excerpt">
        <p>
        	发布人：<?php print $tile2['creusers'][$i]?>
        	<a class="exp-button" style="float: right;margin-right: 50px;" href="<?php print $tile2['hrefs'][$i]?>">查看详细内容 &#8594;</a>
        </p>
    </div>
 <?php 
}
 ?>   
    </article>
    </div>
    
<!-- Tile 3 -->
<?php 
$tile3 = $ta['tile3'];
$tile3_rs = $ta['tile3']['result'];
$tile3_rzimg = FleaoptUtil::getFleaImgUrl($tile3_rs ? $tile3['result']['rzid'] : 0, 'buy');//旧货信息封面
$tile3_cat = $tile3_rs ? '［'.$tile3_rs['fleatypename'].'］'.$tile3_rs['rzname'] : '此空位招收广告中';	//左下角显示的文字
// $tile3_cretime = getdate(strtotime($tile3_rs['cretime']));
$tile3_href = $tile3_rs ? $tile3['href'] : 'javascript:;';
$tile3_title = $tile3_rs ? $tile3_rs['title'] : '广告商招募中';
$tile3_creuser = $tile3_rs ? $tile3_rs['username'] : 'SYSTEM';//发布人的用户名
$tile3_details = $tile3_rs ? $tile3_rs['details'] : '华软旧货市场2014已上线，欢迎各位盆友入驻！！华软旧货市场2014已上线，欢迎各位盆友入驻！！';
?>
<a href="#portfolio-1" class="lightbox" rel="section">
    <div class="tile small">
	    <img width="150" height="150" class="live-img" src="<?php print $tile3_rzimg?>" alt="Project One"/><!-- res/Matrix/images/placeholder/small_blank.png -->
	    <span class="tile-cat lime aismtext"><?php print $tile3_cat?></span>
    </div>
</a>
	<!-- Lightbox Article Preview -->
    <div class="tile-pre">
    <article id="portfolio-1" class="lb-portfolio" data-lbcolor="#e61400"><!-- 添加了“ data-lbcolor="#e61400" ” -->
    <div class="portfolio-img">
    <img class="tile-pre-img" width="330" height="580" src="<?php print $tile3_rzimg?>" alt="Project One" /><!-- res/Matrix/images/placeholder/portfolio_pre_blank.png -->
    </div>
    <div class="lb-port-cont" style="float: left;">
        <h1 class="lb-project"><a href="<?php print $tile3_href?>"><?php print $tile3_title?></a></h1>
        <span class="projectcat redtxt">发布人：<?php print $tile3_creuser?></span>
        <div class="lb-desc">
            <p>详情：<?php print $tile3_details?></p>
            <p><a class="exp-button" href="<?php print $tile3_href?>"><?php print $tile3_rs?'查看更多 &#8594;':''?></a></p>
        </div>
    </div>
    </article>
    </div>

<!-- Tile 4 -->
<?php 
$tile4 = $ta['tile4'];
$tile4_rs = $ta['tile4']['result'];
$tile4_rzimg = FleaoptUtil::getFleaImgUrl($tile4_rs ? $tile4['result']['rzid'] : 0, 'buy');//旧货信息封面
$tile4_cat = $tile4_rs ? '［'.$tile4_rs['fleatypename'].'］'.$tile4_rs['rzname'] : '此空位招收广告中';	//左下角显示的文字
// $tile4_cretime = getdate(strtotime($tile4_rs['cretime']));
$tile4_href = $tile4_rs ? $tile4['href'] : 'javascript:;';
$tile4_title = $tile4_rs ? $tile4_rs['title'] : '广告商招募中';
$tile4_creuser = $tile4_rs ? $tile4_rs['username'] : 'SYSTEM';//发布人的用户名
$tile4_details = $tile4_rs ? $tile4_rs['details'] : '华软旧货市场2014已上线，欢迎各位盆友入驻！！华软旧货市场2014已上线，欢迎各位盆友入驻！！';
?>
<a href="#portfolio-2" class="lightbox" rel="section">
    <div class="tile small">
	    <img width="150" height="150" class="live-img" src="<?php print $tile4_rzimg?>" alt="Project Two"/><!-- res/Matrix/images/placeholder/small_blank.png -->
	    <span class="tile-cat lime aismtext"><?php print $tile4_cat?></span>
    </div>
</a>
	<!-- Lightbox Article Preview -->
    <div class="tile-pre">
    <article id="portfolio-2" class="lb-portfolio" data-lbcolor="#00aaad">
    <div class="portfolio-img">
    <img class="tile-pre-img" width="330" height="580" src="<?php print $tile4_rzimg?>" alt="Project Two" /><!-- res/Matrix/images/placeholder/portfolio_pre_blank.png -->
    </div>
    <div class="lb-port-cont" style="float: left;">
        <h1 class="lb-project"><a href="<?php print $tile4_href?>"><?php print $tile4_title?></a></h1>
        <span class="projectcat tealtxt">发布人：<?php print $tile4_creuser?></span>
        <div class="lb-desc">
            <p>详情：<?php print $tile4_details?></p>
            <p><a class="exp-button" href="<?php print $tile4_href?>"><?php print $tile4_rs?'查看更多 &#8594;':''?></a></p>
        </div>
    </div>
    </article>
    </div>

<!-- Tile 5 -->
<?php 
$tile5 = $ta['tile5'];
$tile5_rs = $ta['tile5']['result'];
$tile5_rzimg = FleaoptUtil::getFleaImgUrl($tile5_rs ? $tile5['result']['rzid'] : 0, 'buy');//旧货信息封面
$tile5_cat = $tile5_rs ? '［'.$tile5_rs['fleatypename'].'］'.$tile5_rs['rzname'] : '此空位招收广告中';	//左下角显示的文字
// $tile5_cretime = getdate(strtotime($tile5_rs['cretime']));
$tile5_href = $tile5_rs ? $tile5['href'] : 'javascript:;';
$tile5_title = $tile5_rs ? $tile5_rs['title'] : '广告商招募中';
$tile5_creuser = $tile5_rs ? $tile5_rs['username'] : 'SYSTEM';//发布人的用户名
$tile5_details = $tile5_rs ? $tile5_rs['details'] : '华软旧货市场2014已上线，欢迎各位盆友入驻！！华软旧货市场2014已上线，欢迎各位盆友入驻！！';
?>
<a href="#portfolio-3" class="lightbox" rel="section">
    <div class="tile small">
	    <img width="150" height="150" class="live-img" src="<?php print $tile5_rzimg?>" alt="Project Three"/>
	    <span class="tile-cat lime aismtext"><?php print $tile5_cat?></span>
    </div>
</a>
	<!-- Lightbox Article Preview -->
    <div class="tile-pre">
    <article id="portfolio-3" class="lb-portfolio" data-lbcolor="#e61400"><!-- 添加了“ data-lbcolor="#e61400" ” -->
    <div class="portfolio-img">
    <img class="tile-pre-img" width="330" height="580" src="<?php print $tile5_rzimg?>" alt="Project Three" /><!-- res/Matrix/images/placeholder/portfolio_pre_blank.png -->
    </div>
    <div class="lb-port-cont" style="float: left;">
        <h1 class="lb-project"><a href="<?php print $tile5_href?>"><?php print $tile5_title?></a></h1>
        <span class="projectcat redtxt">发布人：<?php print $tile5_creuser?></span>
        <div class="lb-desc">
            <p>详情：<?php print $tile5_details?></p>
            <p><a class="exp-button" href="<?php print $tile5_href?>"><?php print $tile5_rs?'查看更多 &#8594;':''?></a></p>
        </div>
    </div>
    </article>
    </div>
    
<!-- Tile 6 -->
<a href="#quotation-1" class="lightbox" rel="section">
    <div class="tile small live" data-mode="flip" data-stops="100%" data-speed="750" data-delay="4000">
    	<div class="live-front">
        	<img class="live-img" src="res/Matrix/images/articles/quotation_1.png" alt="Quotation" />
        </div>
        <div class="live-back">
        	<img class="live-img" src="res/Matrix/images/articles/quotation_2.png" alt="Quotation" />
        </div>
    </div>
</a>
    <!-- Lightbox Article Preview -->
    <div class="tile-pre">
    <article id="quotation-1" class="lb-article">
    <div class="lb-quote">
    在前两行除了第一个大磁贴和我，其它的都是按随机的旧货分类来展示的内容。另外，第二行左侧边缘有个传送门<font color="red"><b>＂＜＂</b></font>，点击可以查看转让信息
    <div class="quote-author">&mdash; 某管理员这么说道...</div>
    </div>
    </article>
    </div>

<!-- Tile 7 -->
<?php 
$tile7 = $ta['tile7'];
$tile7_rs = $ta['tile7']['result'];
$tile7_rzimg = FleaoptUtil::getFleaImgUrl($tile7_rs ? $tile7['result']['rzid'] : 0, 'buy');//旧货信息封面
$tile7_cat = $tile7_rs ? '［'.$tile7_rs['fleatypename'].'］'.$tile7_rs['rzname'] : '此空位招收广告中';	//左下角显示的文字
// $tile7_cretime = getdate(strtotime($tile7_rs['cretime']));
$tile7_href = $tile7_rs ? $tile7['href'] : 'javascript:;';
$tile7_title = $tile7_rs ? $tile7_rs['title'] : '广告商招募中';
$tile7_creuser = $tile7_rs ? $tile7_rs['username'] : 'SYSTEM';//发布人的用户名
$tile7_details = $tile7_rs ? $tile7_rs['details'] : '华软旧货市场2014已上线，欢迎各位盆友入驻！！华软旧货市场2014已上线，欢迎各位盆友入驻！！';
?>
<a href="#portfolio-4" class="lightbox" rel="section">
    <div class="tile small">
	    <img width="150" height="150" class="live-img" src="<?php print $tile7_rzimg?>" alt="Project Four"/>
	    <span class="tile-cat lime aismtext"><?php print $tile7_cat?></span>
    </div>
</a>
    <!-- Lightbox Article Preview -->
    <div class="tile-pre">
    <article id="portfolio-4" class="lb-portfolio" data-lbcolor="##00aaad"><!-- 添加了“ data-lbcolor="#00aaad" ” -->
    <div class="portfolio-img">
    <img class="tile-pre-img" width="330" height="580" src="<?php print $tile7_rzimg?>" alt="Project Three" /><!-- res/Matrix/images/placeholder/portfolio_pre_blank.png -->
    </div>
    <div class="lb-port-cont" style="float: left;">
        <h1 class="lb-project"><a href="<?php print $tile7_href?>"><?php print $tile7_title?></a></h1>
        <span class="projectcat tealtxt">发布人：<?php print $tile7_creuser?></span>
        <div class="lb-desc">
            <p>详情：<?php print $tile7_details?></p>
            <p><a class="exp-button" href="<?php print $tile7_href?>"><?php print $tile7_rs?'查看更多 &#8594;':''?></a></p>
        </div>
    </div>
    </article>
    </div>

<!-- Tile 8 -->
<?php 
$tile8 = $ta['tile8'];
$tile8_rs = $ta['tile8']['result'];
$tile8_rzimg = FleaoptUtil::getFleaImgUrl($tile8_rs ? $tile8['result']['rzid'] : 0, 'buy');//旧货信息封面
$tile8_cat = $tile8_rs ? '［'.$tile8_rs['fleatypename'].'］'.$tile8_rs['rzname'] : '此空位招收广告中';	//左下角显示的文字
// $tile8_cretime = getdate(strtotime($tile8_rs['cretime']));
$tile8_href = $tile8_rs ? $tile8['href'] : 'javascript:;';
$tile8_title = $tile8_rs ? $tile8_rs['title'] : '广告商招募中';
$tile8_creuser = $tile8_rs ? $tile8_rs['username'] : 'SYSTEM';//发布人的用户名
$tile8_details = $tile8_rs ? $tile8_rs['details'] : '华软旧货市场2014已上线，欢迎各位盆友入驻！！华软旧货市场2014已上线，欢迎各位盆友入驻！！';
?>
<a href="#portfolio-5" class="lightbox" rel="section">
    <div class="tile small">
	    <img width="150" height="150" class="live-img" src="<?php print $tile8_rzimg?>" alt="Project Five"/>
	    <span class="tile-cat lime aismtext"><?php print $tile8_cat?></span>
    </div>
</a>
    <!-- Lightbox Article Preview -->
    <div class="tile-pre">
    <article id="portfolio-5" class="lb-portfolio" data-lbcolor="##00aaad"><!-- 添加了“ data-lbcolor="#00aaad" ” -->
    <div class="portfolio-img">
    <img class="tile-pre-img" width="330" height="580" src="<?php print $tile8_rzimg?>" alt="Project Three" /><!-- res/Matrix/images/placeholder/portfolio_pre_blank.png -->
    </div>
    <div class="lb-port-cont" style="float: left;">
        <h1 class="lb-project"><a href="<?php print $tile8_href?>"><?php print $tile8_title?></a></h1>
        <span class="projectcat tealtxt">发布人：<?php print $tile8_creuser?></span>
        <div class="lb-desc">
            <p>详情：<?php print $tile8_details?></p>
            <p><a class="exp-button" href="<?php print $tile8_href?>"><?php print $tile8_rs?'查看更多 &#8594;':''?></a></p>
        </div>
    </div>
    </article>
    </div>

<!-- Tile 9 -->
<?php 
$tile9 = $ta['tile9'];
?>
<a href="#portfolio-9" class="lightbox" rel="section">
    <div class="tile small">
	    <img width="150" height="150" class="live-img" src="<?php print $tile9['rzimg']?>" alt="Project Nine"/>
	    <span class="tile-cat blue aismtext"><?php print $tile9['cat']?></span>
    </div>
</a>
    <!-- Lightbox Article Preview -->
    <div class="tile-pre">
    <article id="portfolio-9" class="lb-portfolio" data-lbcolor="##00aaad"><!-- 添加了“ data-lbcolor="#00aaad" ” -->
    <div class="portfolio-img">
    <img class="tile-pre-img" width="330" height="580" src="<?php print $tile9['rzimg']?>" alt="Project Three" /><!-- res/Matrix/images/placeholder/portfolio_pre_blank.png -->
    </div>
    <div class="lb-port-cont" style="float: left;">
        <h1 class="lb-project"><a href="<?php print $tile9['href']?>"><?php print $tile9['title']?></a></h1>
        <span class="projectcat tealtxt">发布人：<?php print $tile9['creuser']?></span>
        <div class="lb-desc">
            <p>详情：<?php print $tile9['details']?></p>
            <p><a class="exp-button" href="<?php print $tile9['href']?>"><?php print $tile9['result']?'查看更多 &#8594;':''?></a></p>
        </div>
    </div>
    </article>
    </div>
    
<!-- Tile 10 -->
<?php 
$tile10 = $ta['tile10'];
?>
<a href="#portfolio-10" class="lightbox" rel="section">
    <div class="tile small">
	    <img width="150" height="150" class="live-img" src="<?php print $tile10['rzimg']?>" alt="Project Ten"/>
	    <span class="tile-cat blue aismtext"><?php print $tile10['cat']?></span>
    </div>
</a>
    <!-- Lightbox Article Preview -->
    <div class="tile-pre">
    <article id="portfolio-10" class="lb-portfolio" data-lbcolor="#19a2de"><!-- 添加了“ data-lbcolor="#19a2de" ” -->
    <div class="portfolio-img">
    <img class="tile-pre-img" width="330" height="580" src="<?php print $tile10['rzimg']?>" alt="Project Ten" /><!-- res/Matrix/images/placeholder/portfolio_pre_blank.png -->
    </div>
    <div class="lb-port-cont" style="float: left;">
        <h1 class="lb-project"><a href="<?php print $tile10['href']?>"><?php print $tile10['title']?></a></h1>
        <span class="projectcat tealtxt">发布人：<?php print $tile10['creuser']?></span>
        <div class="lb-desc">
            <p>详情：<?php print $tile10['details']?></p>
            <p><a class="exp-button" href="<?php print $tile10['href']?>"><?php print $tile10['result']?'查看更多 &#8594;':''?></a></p>
        </div>
    </div>
    </article>
    </div>
    
    
<!-- Tile 11 -->
<?php 
$tile11 = $ta['tile11'];
?>
<a href="#portfolio-6" class="lightbox" rel="section">
    <div class="tile small">
	    <img width="150" height="150" class="live-img" src="<?php print $tile11['rzimg']?>" alt="Project Eleven"/>
	    <span class="tile-cat blue aismtext"><?php print $tile11['cat']?></span>
    </div>
</a>
    <!-- Lightbox Article Preview -->
    <div class="tile-pre">
    <article id="portfolio-6" class="lb-portfolio" data-lbcolor="#e61400"><!-- 添加了“ data-lbcolor="#e61400" ” -->
    <div class="portfolio-img">
    <img class="tile-pre-img" width="330" height="580" src="<?php print $tile11['rzimg']?>" alt="Project Eleven" /><!-- res/Matrix/images/placeholder/portfolio_pre_blank.png -->
    </div>
    <div class="lb-port-cont" style="float: left;">
        <h1 class="lb-project"><a href="<?php print $tile11['href']?>"><?php print $tile11['title']?></a></h1>
        <span class="projectcat tealtxt">发布人：<?php print $tile11['creuser']?></span>
        <div class="lb-desc">
            <p>详情：<?php print $tile11['details']?></p>
            <p><a class="exp-button" href="<?php print $tile11['href']?>"><?php print $tile11['result']?'查看更多 &#8594;':''?></a></p>
        </div>
    </div>
    </article>
    </div>

    
<!-- Tile 12 -->
<?php 
$tile12 = $ta['tile12'];
?>
    <div class="tile large live exclude" data-stack="true" data-stops="0,18%" data-speed="699" data-delay="500">
    	<div class="live-front" style="background-color: #cccccc;"><!-- class="live-front themecolor" -->
        	<ul id="tweeter" style="color: black;">
			<?php 
			for($i=0;$i<$tile12['nums'];$i++)
			{
			print "<li><a style='font-family:微软雅黑;color:black;font-weight:bold;font-size:13px;' href='{$tile12['hrefs'][$i]}'>{$tile12['titles'][$i]}———{$tile12['creusers'][$i]}</a></li>";
			}
			?>
        	</ul>
        </div>
        <div class="live-back themecolor">
        	<span class="tile-text tweeter">最近发布的求购</span>
        </div>
    </div>
    
    
    
    
<!-- Tile 13 -->
<?php 
$tile13 = $ta['tile13'];
?>
<a href="#article-3" class="lightbox" rel="section">
    <div class="tile medium" style="background-color: silver;">
        <img class="live-img hide" src="res/Matrix/images/placeholder/medium_blank.png" alt="Article 3" />
        <span class="tile-date blacktxt"><span class="date">最多</span><span class="month">需求</span></span>
        <span class="tile-cat teal">分类：<?php print $tile13['fleatype']?></span>
    </div>
</a>
	<!-- Lightbox Article Preview -->
    <div class="tile-pre">
    <article id="article-3" class="lb-article" data-lbcolor="#00aaad">
    <br>
    <div class="article-date tealtxt"><span class="date">最多</span><span class="month">的需求</span></div>
    <h1 class="lb-title"><?php print '［分类］'.$tile13['fleatype']?></h1>
    <div class="lb-excerpt">
        <p>现在查看的是需求最多的分类。</p>
        <p class="exp-button"><a href="javascript:;" style="font-size: 28px;" onclick="javascript:click_tile13(this);" shell="<?php print $tile13['shell']?>">点击查看该分类下的求购记录</a></p>
    </div>
<div style="left: 0px; top: 0px; display: block; position: relative;">
	<h2 class="postcat tealtxt">查看更多？所有分类都在这里了↓↓↓</h2>
	<div style="background:#fff;padding:20px 0 0 20px;width: 550px;">
	<?php
	$tile13colors = array('','-blue','-red','-green','-magenta','-purple','-teal','-lime','-brown','-pink','-mango');
	$tile13colorslen = count($tile13colors); 
	for ($i=0;$i<$tile13['num'];$i++)
	{
		$tile13color = $tile13colors[$i % $tile13colorslen];
	?>
	<a href="javascript:void(0);" shell="<?php print $tile13['hrefs'][$i]?>" onclick="javascript:click_tile13_ft(this);"><span class="button-met light<?php print $tile13color?>" style="margin-right:30px;margin-bottom: 15px;"><?php print $tile13['fleatypes'][$i]?></span></a>
	<?php 
	}
	?>
	</div>
</div>
    </article>
    </div>
    
    
    
<!-- Tile 14 -->
<?php 
$tile14 = $ta['tile14'];
?>
<a href="#portfolio-7" class="lightbox" rel="section">
    <div class="tile small">
	    <img width="150" height="150" class="live-img" src="<?php print $tile14['rzimg']?>" alt="Project Seven"/>
	    <span class="tile-cat green aismtext"><?php print $tile14['cat']?></span>
    </div>
</a>
    <!-- Lightbox Article Preview -->
    <div class="tile-pre">
    <article id="portfolio-7" class="lb-portfolio" data-lbcolor="#e61400"><!-- 添加了“ data-lbcolor="#e61400" ” -->
    <div class="portfolio-img">
    <img class="tile-pre-img" width="330" height="580" src="<?php print $tile14['rzimg']?>" alt="Project Seven" /><!-- res/Matrix/images/placeholder/portfolio_pre_blank.png -->
    </div>
    <div class="lb-port-cont" style="float: left;">
        <h1 class="lb-project"><a href="<?php print $tile14['href']?>"><?php print $tile14['title']?></a></h1>
        <span class="projectcat blacktxt">分类：<?php print $tile14['result']?$tile14['result']['fleatypename']:''?></span>
        <span class="projectcat tealtxt">发布人：<?php print $tile14['creuser']?></span>
        <div class="lb-desc">
            <p>详情：<?php print $tile14['details']?></p>
            <p><a class="exp-button" href="<?php print $tile14['href']?>"><?php print $tile14['result']?'查看更多 &#8594;':''?></a></p>
        </div>
    </div>
    </article>
    </div>

    
<!-- Tile 15 -->
<?php 
$tile15 = $ta['tile15'];
?>
<a href="#portfolio-6" class="lightbox" rel="section">
    <div class="tile small">
	    <img width="150" height="150" class="live-img" src="<?php print $tile15['rzimg']?>" alt="Project Eleven"/>
	    <span class="tile-cat blue aismtext"><?php print $tile15['cat']?></span>
    </div>
</a>
    <!-- Lightbox Article Preview -->
    <div class="tile-pre">
    <article id="portfolio-6" class="lb-portfolio" data-lbcolor="#e61400"><!-- 添加了“ data-lbcolor="#e61400" ” -->
    <div class="portfolio-img">
    <img class="tile-pre-img" width="330" height="580" src="<?php print $tile15['rzimg']?>" alt="Project Eleven" /><!-- res/Matrix/images/placeholder/portfolio_pre_blank.png -->
    </div>
    <div class="lb-port-cont" style="float: left;">
        <h1 class="lb-project"><a href="<?php print $tile15['href']?>"><?php print $tile15['title']?></a></h1>
        <span class="projectcat tealtxt">发布人：<?php print $tile15['creuser']?></span>
        <div class="lb-desc">
            <p>详情：<?php print $tile15['details']?></p>
            <p><a class="exp-button" href="<?php print $tile15['href']?>"><?php print $tile15['result']?'查看更多 &#8594;':''?></a></p>
        </div>
    </div>
    </article>
    </div>


<!-- Tile 16 -->
<?php 
$tile16 = $ta['tile16'];
?>
<a href="#portfolio-8" class="lightbox" rel="section">
    <div class="tile small">
	    <img width="150" height="150" class="live-img" src="<?php print $tile16['rzimg']?>" alt="Project Eight"/>
	    <span class="tile-cat green aismtext"><?php print $tile16['cat']?></span>
    </div>
</a>
    <!-- Lightbox Article Preview -->
    <div class="tile-pre">
    <article id="portfolio-8" class="lb-portfolio" data-lbcolor="#00aaad"><!-- 添加了“ data-lbcolor="#e61400" ” -->
    <div class="portfolio-img">
    <img class="tile-pre-img" width="330" height="580" src="<?php print $tile16['rzimg']?>" alt="Project Eight" /><!-- res/Matrix/images/placeholder/portfolio_pre_blank.png -->
    </div>
    <div class="lb-port-cont" style="float: left;">
        <h1 class="lb-project"><a href="<?php print $tile16['href']?>"><?php print $tile16['title']?></a></h1>
        <span class="projectcat blacktxt">分类：<?php print $tile16['result']?$tile16['result']['fleatypename']:''?></span>
        <span class="projectcat tealtxt">发布人：<?php print $tile16['creuser']?></span>
        <div class="lb-desc">
            <p>详情：<?php print $tile16['details']?></p>
            <p><a class="exp-button" href="<?php print $tile16['href']?>"><?php print $tile16['result']?'查看更多 &#8594;':''?></a></p>
        </div>
    </div>
    </article>
    </div>

    
<!-- END TILE CONTENT -->
</section><!-- end #content-mos -->

<!-- BEGIN AJAX PAGINATION -->
<div class="clearfix ajax-pagination">
<a href="?x=index" class="prev"></a>
</div>
<!-- END AJAX PAGINATION -->

</section><!-- end #mainpage-mos -->

<section class="mainpage">
<!-- BEGIN TOGGLE CONTENT -->
<div class="toggle-button"><span class="toggle-indicator">+</span></div>

<div class="toggle-content close clearfix hide" id="ai-footer">
<!-- Item 1 -->
    <div class="fixed-medium">
        <div class="highlights">
        <img class="themecolor" src="res/Matrix/images/responsive.png" alt="Responsive Design" />
        </div>
        <div class="highlights-txt">
        <h2>Responsive Design</h2>
        <p>The template will automatically resize to fit the browser according to its width. So, this template works not just on your desktop monitor, but your tablet or mobile phone as well!</p>
        </div>
    </div>
<!-- Item 2 -->
    <div class="fixed-medium">
        <div class="highlights">
        <img class="themecolor" src="res/Matrix/images/livetiles.png" alt="Live Tiles" />
        </div>
        <div class="highlights-txt">
        <h2>Live Tiles</h2>
        <p>As inspired by Metro UI, these 'Live' tiles can display more information without utilizing more screen space. Hence, it is not just the perfect solution for small-screened mobile devices, but also attractive.</p>
        </div>
    </div>
<!-- Item 3 -->
    <div class="fixed-medium last">
        <div class="highlights">
        <img class="themecolor" src="res/Matrix/images/customizability.png" alt="Customizability" />
        </div>
        <div class="highlights-txt">
        <h2>Customizability</h2>
        <p>Comes pre-loaded with 10 colours and easy-to-use colour tags, as well as multiple-sized tiles which automatically arrange themselves to fit the screen, you can create any layout you can imagine.</p>
        </div>
    </div>
    
</div><!-- end .toggle-content -->
<!-- END TOGGLE CONTENT -->

</section><!-- end .main-page -->
<!-- END MAIN PAGE CONTENT -->

<!-- BEGIN FOOTER -->
<footer class="clearfix">

<div id="footer-social" class="hide">
<a href="#"><span class="behance-mini"></span></a>
<a href="#"><span class="twitter-mini"></span></a>
<a href="#"><span class="facebook-mini"></span></a>
<a href="#"><span class="linkedin-mini"></span></a>
<a href="#"><span class="pinterest-mini"></span></a>
<a href="#"><span class="dribbble-mini"></span></a>
</div><!-- end #footer-social -->

<small>Copyright &#169; 2014 Y1525</small>
</footer>
<!-- END FOOTER -->

</section><!-- end #container -->
</div>

<!-- 导入自定义脚本 -->
<script type="text/javascript" src="../public/res/js/Ai/AiForm.js"></script>
<script type="text/javascript" src="res/js/index2.js"></script>

<!-- 自定义的初始化页面样式代码 -->
<script type="text/javascript">
	//$('#ai-footer').css('display':'block');//默认展开颈部
</script>
</body>
</html>
