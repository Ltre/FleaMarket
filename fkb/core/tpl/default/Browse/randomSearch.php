<?php 
$args = ActionUtil::getTplArgs();
$isSell = !strcasecmp($args['optType'], 'sell');//是转让还是求购
?>

<!-- BEGIN CONTENT -->
<!-- 原为： <section id="content" class="clearfix"> -->
<style>
<!--
/*style="font-size: 36px;float: right;line-height: 45px;margin-top: 12px;"*/
/*按转让、求购筛选 【现已停用，可删除】*/
.ai_selection{
	font-size: 36px;float: left;line-height: 45px;margin-top: 12px;display: block;
}
-->
</style>

<section id="mainpage-mos" class="clearfix">
<!-- Title --><div id="content-title" style="font-size: 36px;"><?php print $isSell?'转让信息':'求购信息'?><button></button></div>
<!-- BEGIN LEFT CONTENT -->
<section id="blogtile-left">
<!-- BEGIN TILE CONTENT -->
<div id="blogs" class="clearfix centered">
<?php 
$color = array('red', 'lime', 'teal', 'blue', 'brown');//颜色
$i = 1;
if(count(@$rs=$args['results'])) foreach ($rs as $r)
{
	$cretime = getdate(strtotime($r['cretime']));
	//$img = '../public/res/img/'.$args['optType'].'info/'.$r['id'].'.';暂用随机的图片
	$img = '../public/res/img/sellinfo/'.rand(1, 20).'.';
	$img_file = '';
	if(file_exists($img.'jpg')){
		$img_file = $img.'jpg';
	}else if(file_exists($img.'png')){
		$img_file = $img.'png';
	}else if(file_exists($img.'gif')){
		$img_file = $img.'gif';
	}else{
		$img_file = '../public/res/img/'.$args['optType'].'info/'.$args['optType'].'null.jpg';
	}
?>
	<div class="tile large">
        <a href="<?php print '?x=browseFleaDetail|'.$args['optType'].'|'.$r['titlecode'] ?>" target="_blank" title="<?php print ($isSell?'转让人：':'求购人：') . $r['creuser']?>">
        <div class="bl-posttitle"><span class="bl-title"><?php print '【'. ($isSell?'转让':'求购') .'】'.$r['title'].'<br>旧货分类：'.$r['fleatype'] ?></span></div>
        <img class="tile-pre-img" src="<?php print FleaoptUtil::getFleaImgUrl( $r['id'] , $args['optType']); //print $img_file ?>" alt="<?php print $r['fleatype'] ?>" width="310px" height="310px" />
        <span class="tile-date <?php print $color[$i%5] ?>txt"><span class="date"><?php print $cretime['mday'] ?></span><span class="month"><?php print $cretime['month'] ?></span></span>
        <span class="tile-cat <?php print $color[$i%5] ?>"><?php print $r['name'] ?></span>
        </a>
    </div>
<?php 
	$i++;
}
?>
</div><!-- end #blogs -->
<!-- END TILE CONTENT -->
<?php 
//分页代码
$rsnum = $args['rsnum'];
$pagesum = $args['pagesum'];
$pagepos = $args['pagepos'];
$startpos = $pagepos - 6;
$startpos = $startpos <= 0 ? 1 : $startpos;//开始页码标签
$stoppos = $pagepos + 6;
$stoppos = $stoppos >= $pagesum ? $pagesum : $stoppos;//结束页码标签
?>
    <!-- BEGIN PAGINATION -->
    <div class="pagination clearfix">
    	<span class="pages"><?php print '第 '.$args['pagepos'].' 页，共 '.$args['pagesum'] .' 页' ?></span>
<?php 
for ($i = $startpos ; $i <= $stoppos ; $i ++)
{
	if($i==$pagepos)
	{
?>
		<span class="current"><?php print $i ?></span>
<?php
	}
	else
	{
		//分页按钮参数
		$params = !strcasecmp($args['shell'], 'randomSearch') ? $args['optType'].'|'.$args['numperpage'].'|'.$args['numperpage']*($i-1)
			: ( !strcasecmp($args['shell'], 'fleatypeSearch') ? $args['optType'].'|'.$args['fleatype'].'|'.$args['numperpage'].'|'.$args['numperpage']*($i-1)
			: ( ( !strcasecmp($args['shell'], 'searchFleaAsKeyword') ? $args['optType'].'|'.$args['keyword'].'|'.$args['numperpage'].'|'.$args['numperpage']*($i-1) : '' ) ) );
?>
		<a class="page ai-ajax" id="<?php print $args['shell'] ?>" shell="<?php print $args['shell'] ?>" params="<?php print $params ?>" style="cursor: pointer;" ><?php print $i ?></a>
<?php	
	}
}
?>
        <a href="#" class="nextpagelink">&raquo;</a>
    </div>
    <!-- END PAGINATION -->
</section>
<!-- END LEFT CONTENT -->

<!-- BEGIN SIDEBAR -->
<section id="sidebar">

<!-- 按照关键字搜索 -->
<div id="search" class="widget">
<form class="ai-form" shell="searchFleaAsKeyword" id="searchFleaAsKeyword" onsubmit="javascript:return false;">
<input type="hidden" class="ai-args-1" value="<?php print $args['optType'] ?>" />
<input id="search-field" type="search" name="sitesearch" class="placeholder ai-args-2" placeholder="按标题、物品名、发布人搜<?php print $isSell?'转让':'求购' ?>信息" onkeypress="EnterPress(event)" />
<input type="hidden" class="ai-args-3" value="<?php print $args['numperpage'] ?>" />
<input type="hidden" class="ai-args-4" value="0" />
<input type="button" class="ai-submit" id="search-submit" value=" " />
</form>
</div><!-- end #search -->

<div id="recent-box" class="widget">
<h5>绝赞广告位！</h5>
<ul class="articles-widget">
<li>
	<a href="javascript:;">
	<img src="res/img/browseFleaDetail/ad1.jpg" alt="Article 1" />
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
    	<th title="Monday" scope="col">M</th>
        <th title="Tuesday" scope="col">T</th>
        <th title="Wednesday" scope="col">W</th>
        <th title="Thursday" scope="col">T</th>
        <th title="Friday" scope="col">F</th>
        <th title="Saturday" scope="col">S</th>
        <th title="Sunday" scope="col">S</th>
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
<script type="text/javascript" src="res/js/randomSearch.js"></script>
<script type="text/javascript">

</script>
