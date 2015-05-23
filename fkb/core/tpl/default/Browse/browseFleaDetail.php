<!DOCTYPE html>

<?php 
/**
 * @invoked BrowseAction::browseFleaDetail()
 */
?>

<?php 
$ta = ActionUtil::getTplArgs();
$isSell = !strcasecmp($ta['optType'], 'sell');//是转让还是求购
if($ta['result']==null){
	die("<br><br><br><br><br><br><br><br><br><br><center style='font-size:48px;font-family:微软雅黑;'>本条旧货信息已被发布者或管理员删除</center>");
}
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
	<a shell="fleatypeSearch" params="<?php print 'sell|'.$fleatype->id.'|10|0' ?>" title="搜索该分类" style="cursor: pointer;"><span class="<?php print $colors[intval(@$i++%10)] ?>"><?php print $fleatype->name ?></span></a>
<?php	
}
?>
    <h4 style="cursor: pointer;" opt="sell" fts="<?php if($fleatypes)$fts=null;foreach ($fleatypes as $fleatype){$fts.=$fleatype->id.'|';}print trim($fts,'|');?>" maxftlen="<?php print count($fleatypes)?>" onclick="javascript:click_underft(this);">随便搜搜(*^__^*).</h4>
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
    	<a shell="pageToCreateFleaInfo" params="newsell|0" class="ai-skip"  style="cursor: pointer;" title="发布旧货信息的玩意儿"><span>发一条</span></a>
        <ul>
            <li><a shell="pageToCreateFleaInfo" params="newsell|0" class="ai-skip" title="卖啥？到这里来" style="cursor: pointer;"><span>转让信息</span></a></li>
            <li><a shell="pageToCreateFleaInfo" params="newbuy|0" class="ai-skip" title="买啥？有求必应" style="cursor: pointer;"><span>求购信息</span></a></li>
        </ul>
    </li>
<!-- Menu Item 3 -->
    <li><a style="cursor: pointer;" title="随便看看" shell="randomSearch" params="sell|10|0"><span>随便看看</span></a>
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
<section class="mainpage hide">
	<!-- BEGIN TOGGLE CONTENT -->
	<div class="toggle-button"><span class="toggle-indicator">+</span></div>
    
    <div class="toggle-content close">
        <div class="flexslider mainslide">
        <ul class="slides">
            <li>
            <img src="res/Matrix/images/slideimg1.png" alt="Responsive" />
            <p class="flex-title">Responsive</p>
            </li>
            <li>
            <img src="res/Matrix/images/slideimg2.png" alt="Tile Design" />
            <p class="flex-title">Tile Design</p>
            </li>
            <li>
            <img src="res/Matrix/images/slideimg3.png" alt="Customizability" />
            <p class="flex-title">Customizability</p>
            </li>
        </ul>
        </div><!-- end .flexslider -->
    
    <div class="quote-bg1"><div class="quote-w">Hello! This is a Metro UI-inspired template which brings a new web-browsing experience to the users. To further improve it, feedbacks are greatly welcomed!</div></div>
    
    </div><!-- end .toggle-content -->
    <!-- END TOGGLE CONTENT -->
</section><!-- end #mainpage -->

<div id="loader"></div><!-- loader image for AJAX -->


<!-- ---------------------------------------------------------------------- -->
<!-- ---------------------------------------------------------------------- -->
<!-- ---------------------------------------------------------------------- -->
<!-- ---------------------------------------------------------------------- -->
<!-- ---------------------------------------------------------------------- -->


<!-- BEGIN CONTENT -->
<section id="mainpage-mos" class="clearfix">
<!-- Title --><div id="content-title"><?php print $ta['result']->name ?></div>

<!-- BEGIN SINGLE CONTENT -->
<section id="single">
    <article id="article-1" class="sbp-article">
    
        <div class="article-img">
           <div class="flexslider postslide">
            <ul class="slides">
            <!-- <li>
            <img class="tile-pre-img" src="res/Matrix/images/placeholder/blog_pre_blank.png" alt="Article 1" />
            </li> -->
            <li>
<?php 
$img = '../public/res/img/sellinfo/'.rand(1, 20).'.';
$img_file = '';
if(file_exists($img.'jpg')){
	$img_file = $img.'jpg';
}else if(file_exists($img.'png')){
	$img_file = $img.'png';
}else if(file_exists($img.'gif')){
	$img_file = $img.'gif';
}else{
	//res/Matrix/images/placeholder/blog_pre_blank.png
	$img_file = '../public/res/img/'.$ta['optType'].'info/'.$ta['optType'].'null.jpg';
}
?>
            <img class="tile-pre-img" width="640px" height="360px" src="<?php print FleaoptUtil::getFleaImgUrl( $ta['result']->id , $isSell?'sell':'buy'); //print $img_file ?>" alt="Article 1" />
            </li>
            </ul>
            </div>
        </div>
<?php 
$cretime = getdate(strtotime($ta['result']->cretime));
?>    
    <div class="article-date redtxt" title="发布时间：<?php print $ta['result']->cretime ?>"><span class="date"><?php print $cretime['mday'] ?></span><span class="month"><?php print $cretime['month'] ?></span></div>
    <h1 class="sbp-title"><?php print '【'.($isSell?'转让':'求购').'】'.$ta['result']->title ?></h1>
    <span class="postcat redtxt">分类：<?php print $ta['fleatype'] ?></span><br>
	<span class="postcat bluetxt"><?php print '参考价格：'. $ta['result']->price .'元' ?></span><br>
	<span class="postcat bluetxt"><?php print '物品名：'. $ta['result']->name ?></span><br> 
    <!-- BEGIN POST CONTENT -->
    <div class="sbp-content">
    	<h5>详细说明：</h5>
        <p style="font-size: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;<?php print $ta['result']->details ?></p>
        <div class="quote">
			<h6>预约期</h6>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;将于<?php print($ta['result']->booklimit) ?>终止预约。
			<h6>收尾期</h6>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;将于<?php print($ta['result']->endlimit) ?>结束转让。
        </div>

    </div><!-- end .sbp-content -->
    <!-- END POST CONTENT -->
    <div id="authorinfo"><img id="author-avatar" width="80" height="80" src="<?php print UserUtil::getUserAvatarUrl($ta['result']->creuser) ?>" alt="Avatar"/><!-- 头像 -->
    <span class="author">发布人： <a href="?x=displayProfile|<?php print $ta['result']->creuser ?>" target="_blank"><?php print $ta['creuser'] ?></a></span>
    <p><?php print @$ta['result']->summary ?></p>
    </div>
    
    </article>
    
<!-- BEGIN COMMENTS -->
<section id="comments">
<div class="section-title"> </div><!-- 共有  条预订记录 -->

<ol class="commentlist hide"><!-- 这里自己加了hide隐藏 -->
<!-- Comment 1 -->
	<li class="comment">
    <article id="comment-1">
        <div class="comment-author"><img class="avatar" src="res/Matrix/images/commenter.png" alt="Avatar"/>
        	<a href="#"><span class="commenter">Frannqis</span></a><a href="#commentform" class="comment-reply"><span class="button-met light">Reply</span></a>
            <span class="comment-date">10 July 2012</span>
        </div>
        <div class="comment-content">
            <p>Duis fermentum, felis viverra venenatis laoreet, lectus ipsum egestas massa, at rutrum felis leo dictum orci. Nullam molestie erat sit amet libero sollicitudin rutrum. Cras luctus dignissim sapien, ac iaculis neque sodales vitae.</p>
        </div>
    </article>
    </li>
<!-- Comment 2 -->
    <li class="comment">
    <article id="comment-2">
        <div class="comment-author"><img class="avatar" src="res/Matrix/images/commenter.png" alt="Avatar"/>
        	<a href="#"><span class="commenter">John Doe Sr.</span></a><a href="#commentform" class="comment-reply"><span class="button-met light">Reply</span></a>
            <span class="comment-date">10 July 2012</span>
        </div>
        <div class="comment-content">
            <p>Cras luctus dignissim sapien, ac iaculis neque sodales vitae.</p>
        </div>
    </article>
<!-- BEGIN COMMENT CHILDREN -->
    <ul class="children">
<!-- Comment 3 -->
    <li class="comment">
    <article id="comment-3">
        <div class="comment-author"><img class="avatar" src="res/Matrix/images/commenter.png" alt="Avatar"/>
        	<a href="#"><span class="commenter">John Doe Jr.</span></a><a href="#commentform" class="comment-reply"><span class="button-met light">Reply</span></a>
            <span class="comment-date">10 July 2012</span>
        </div>
        <div class="comment-content">
            <p>Duis fermentum, felis viverra venenatis laoreet, lectus ipsum egestas massa, at rutrum felis leo dictum orci. Nullam molestie erat sit amet libero sollicitudin rutrum. Cras luctus dignissim sapien, ac iaculis neque sodales vitae.</p>
        </div>
    </article>
	</li>
<!-- Comment 4 -->
    <li class="comment">
    <article id="comment-4">
        <div class="comment-author"><img class="avatar" src="res/Matrix/images/commenter.png" alt="Avatar"/>
        	<a href="#"><span class="commenter">John Doe Sr.</span></a><a href="#commentform" class="comment-reply"><span class="button-met light">Reply</span></a>
            <span class="comment-date">10 July 2012</span>
        </div>
        <div class="comment-content">
            <p>Duis fermentum, felis viverra venenatis laoreet, lectus ipsum egestas massa, at rutrum felis leo dictum orci. Nullam molestie erat sit amet libero sollicitudin rutrum.</p>
        </div>
    </article>
	</li>
    </ul>
<!-- END COMMENT CHILDREN -->
    </li><!-- end comment 2 -->
</ol>

<div id="respond">
<h1>预约</h1>
<form id="addFleaBook" shell="addFleaBook" class="ai-form">
    <div id="commentformleft">
        <p class="comment-notes">
                填写以下信息后进行预约
        </p>
        <p class="comment-form-author">
        <input id="author" type="text" placeholder="见面时间" name="meettime" class="ai-args-1">
        </p>
        <p class="comment-form-email">
        <input id="email" type="text" placeholder="见面地点" name="meetplace" class="ai-args-2">
        </p>
        <p class="comment-form-url">
        <select name="purpose" class="ai-args-3">
        	<option value="4">预约目的</option>
        	<option value="1">看货</option>
        	<option value="2">交易</option>
        	<option value="3">两者皆可</option>
        	<option value="4">暂未确定</option>
        </select>
        </p>
    <input class="ai-args-4" type="hidden" value="<?php print $ta['optType'] ?>" /><!-- sell/buy -->
    <input class="ai-args-5" type="hidden" value="<?php print $ta['result']->id ?>" /><!-- 旧货信息id -->
    <input class="ai-args-6" type="hidden" value="<?php print $ta['result']->creuser ?>" /><!-- 发布者为甲方 -->
    <input class="ai-args-7" type="hidden" value="<?php print !isset($user) ? 'NOTLOGIN' : $user->id ?>" /><!-- 当前用户为乙方 -->
    <span class="button-met light ai-submit"><input type="button" name="comsubmit" value="预约" style="cursor: pointer;" /></span>
    </div>
</form>
<br>
<h1>有话要说？</h1>
<form id="sendPersonalLetter" shell="sendPersonalLetter" class="ai-form">
    <p class="comment-form-author">
    	<input type="text" placeholder="标题" class="ai-args-4" style="width: 350px;margin-left: 15px;">
    </p>
    <div id="commentformright"><!-- must not leave space after </div> of #commentformleft -->
        <input type="hidden" class="ai-args-1" value="<?php print !isset($user) ? 'NOTLOGIN' : $user->id ?>" /><!-- 发送人 -->
        <p class="comment-form-comment">
        <textarea id="comment" placeholder="私信内容" name="comment" class="ai-args-2"></textarea>
        </p>
        <input type="hidden" class="ai-args-3" value="<?php print $ta['result']->creuser ?>" /><!-- 接收人 -->
        <input type="hidden" name="title" value="<?php print $ta['result']->title ?>" /><!-- #带链接的旧货信息标题# 放在私信内容中 -->
        <input type="hidden" name="dongxi" value="<?php print $ta['result']->name ?>" /><!-- #带链接的物品名# 放在私信内容中 -->
        <input type="hidden" name="opttype" value="<?php print $ta['optType']=='sell'?'转让':'求购' ?>" /><!-- #旧货发布类型# 放在私信内容中 -->
        <span class="button-met light ai-submit"><input id="comsubmit" type="button" name="comsubmit" value="发送私信" /></span>
    </div><!-- end #commentformright -->
</form>
</div><!-- end #respond -->

</section><!-- end #comments -->
<!-- END COMMENTS -->
</section><!-- end #single -->
<!-- END SINGLE CONTENT -->


<!-- BEGIN SIDEBAR -->
<section id="sidebar">

<div id="post-meta" class="widget">

<!-- 点击私聊 -->
<div id="click_siliao" class="tile-sidebar">
    <a href="#sendPersonalLetter">
	    <div>
	    <img src="res/Matrix/images/sidebar-comm.png" alt="私聊" />
	    <div class="count">私信数</div>
	    <div class="comment-widget" style="font-size: 20px;font-weight: bold;color: black;">点 我<br>私 聊</div>
	    </div>
	</a>
</div><!-- end .tile-sidebar -->
<!-- 点击预约 -->
<div id="click_yuyue" class="tile-sidebar" style="background-image: url('res/Matrix/images/commenter100x100.png') ;">
    <a href="#addFleaBook">
    	<div>
	    <div class="count">5</div>
	    <div class="comment-widget" style="font-size: 36px;font-weight: bold;color: mango;">预约</div>
	    </div>
	</a>
</div><!-- end .tile-sidebar -->
<!-- 点击收藏 -->
<div class="tile-sidebar" style="background-image: url('res/Matrix/images/sidebar-fb.png');background-color: green ;">
    <a shell="addCollect" params="<?php print $ta['optType'].'|'.$ta['result']->id.'|'.$ta['result']->creuser ?>" id="addCollect" style="cursor: pointer;" >
    	<div>
	    <div class="count">6</div>
	    <div class="comment-widget" style="font-size: 36px;font-weight: bold;color: black;">收藏</div>
	    </div>
	</a>
</div><!-- end .tile-sidebar -->

</div><!-- end post-meta -->

<div id="recent-box" class="widget">
<h5>绝赞广告位！</h5>
<ul class="articles-widget">
<li>
	<a href="javascript:;">
	<img src="res/img/browseFleaDetail/ad1.jpg" alt="Article 1" /><!-- res/Matrix/images/placeholder/medium_blank.png -->
    <div class="title">最显眼最舒适的广告位<br><span class="redtxt">广告一</span></div>
    <div class="more"></div>
    </a>
</li>
<li>
	<a href="javascript:;">
	<img src="res/img/browseFleaDetail/ad2.jpg" alt="Article 2" />
    <div class="title">想要获取更高效益？<br><span class="limetxt">广告二</span></div>
    <div class="more"></div>
    </a>
</li>
<li>
	<a href="javascript:;">
	<img src="res/img/browseFleaDetail/ad3.jpg" alt="Article 3" />
    <div class="title">还在等什么，快到这里！<br><span class="tealtxt">广告三</span></div>
    <div class="more"></div>
    </a>
</li>
</ul>
</div><!-- end #recent-box -->

<div id="archive-box" class="widget" style="display: none;">
<h5>日历</h5>
<table id="archive">
<thead>
    <tr>
    	<th title="Monday" scope="col">日</th>
        <th title="Tuesday" scope="col">一</th>
        <th title="Wednesday" scope="col">二</th>
        <th title="Thursday" scope="col">三</th>
        <th title="Friday" scope="col">四</th>
        <th title="Saturday" scope="col">五</th>
        <th title="Sunday" scope="col">六</th>
    </tr>
</thead>
<tbody>
  <tr>
    <td class="none">&nbsp;</td>
    <td class="none">&nbsp;</td>
    <td class="none">1</td>
    <td class="none">2</td>
    <td class="red">3</td>
    <td class="teal">4</td>
    <td class="green">5</td>
  </tr>
  <tr>
    <td class="blue">6</td>
    <td class="none">7</td>
    <td class="lime">8</td>
    <td class="blue">9</td>
    <td class="green">10</td>
    <td class="red">11</td>
    <td class="none">12</td>
  </tr>
  <tr>
    <td class="blue">13</td>
    <td class="red">14</td>
    <td class="lime">15</td>
    <td class="teal">16</td>
    <td class="green">17</td>
    <td class="none">18</td>
    <td class="brown">19</td>
  </tr>
  <tr>
    <td class="teal">20</td>
    <td class="green">21</td>
    <td class="brown">22</td>
    <td class="blue">23</td>
    <td class="none">24</td>
    <td class="red">25</td>
    <td class="green">26</td>
  </tr>
  <tr>
    <td class="lime">27</td>
    <td class="lime">28</td>
    <td class="brown">29</td>
    <td class="none">30</td>
    <td class="green">31</td>
    <td class="none">&nbsp;</td>
    <td class="none">&nbsp;</td>
  </tr>
</tbody>
<tfoot>
	<tr>
    <td id="prev">&#8249;</td>
    <td id="month" colspan="5">April</td>
    <td id="next">&#8250;</td>
    </tr>
</tfoot>
</table>
</div><!-- end #archive-box -->

<div class="widget text-widget">
<h5>每日提示</h5>
<p>对东西有意？点击预约吧！你还可以先和对方私聊再作决定。</p>
<p>想按分类来查看求购信息？导航栏——随便看看——求购——再点侧栏分类</p>
</div><!-- end .text-widget -->


<div id="twitter" class="widget hide">
<h5>待定宣传位</h5>
<ul id="tweeter">
</ul>

</div><!-- end #twitter -->

</section>
<!-- END SIDEBAR -->
</section>
<!-- END CONTENT -->



<!-- ---------------------------------------------------------------------- -->
<!-- ---------------------------------------------------------------------- -->
<!-- ---------------------------------------------------------------------- -->
<!-- ---------------------------------------------------------------------- -->
<!-- ---------------------------------------------------------------------- -->
<section class="mainpage hide">
<!-- BEGIN TOGGLE CONTENT -->
<div class="toggle-button"><span class="toggle-indicator">+</span></div>

<div class="toggle-content close clearfix">
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

<small>Copyright &#169; 2014 Oreki</small>
</footer>
<!-- END FOOTER -->

</section><!-- end #container -->
</div>

<!-- 导入自定义脚本 -->
<script type="text/javascript" src="../public/res/js/Ai/AiForm.js"></script>
<script type="text/javascript" src="res/js/browseFleaDetail.js"></script>

</body>
</html>
