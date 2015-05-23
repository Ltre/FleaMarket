<?php

/************************************************************/
$ta = ActionUtil::getTplArgs();//upimgdir、
/************************************************************/

if(@$_POST['upimg']) {
set_time_limit(0);
@header('Content-type: text/html;charset=UTF-8');

// OrekiUtil::var_dump_array($_GET);
// OrekiUtil::var_dump_array($_POST);
// OrekiUtil::var_dump_array($_FILES);
// OrekiUtil::var_dump_array($ta);
// die;

$img_w=$_GET["img_w"];  //生成缩略图宽
$img_h=$_GET["img_h"]; //生成缩略图高
$imgsize=$_GET["imgsize"]; //是否生成缩略图
$form="publishNewFleaInfo"; //表单名
$text="img"; //字段表
$pos = $ta['upimgdir']; //上传路径
//$url="?x=upimg|{$ta['opt']}&action=show";
$url = "?x=upimg|{$ta['opt']}&action=add&img_w=310&img_h=310&imgsize=1&img=hehe&simg=hehe_thumb";
	$curMonth=substr((string)date('Y-m-d'),0,7);
	if(!is_dir($pos)){
		echo "文件夹 \"{$pos}\"不存在  << <a href='{$url}'>返回</a>";
		exit;
	}
	//上传文件类型列表
	$uptypes=array(
	 'image/jpg',  						
	 'image/jpeg',
	 'image/png',
	 'image/pjpeg',
	 'image/gif',
	 'image/bmp',
	 //'application/x-shockwave-flash',
	 'image/x-png',
	 //'application/msword',
	 //'audio/x-ms-wma',
	 //'audio/mp3',
	 //'application/vnd.rn-realmedia',
	 //'application/x-zip-compressed',
	 //'application/octet-stream',
	 //'application/pdf'
	 );
	
	$max_file_size=20000000;   							//上传文件大小限制, 单位BYTE
	$path_parts=pathinfo($_SERVER['PHP_SELF']); 		//取得当前路径
	$destFolder=$pos.$curMonth."/"; 					//上传文件路径
	$watermark=0;   									//是否附加水印(1为加水印,其他为不加水印);
	$watertype=1;   									//水印类型(1为文字,2为图片)
	$waterposition=2;   								//水印位置(1为左下角,2为右下角,3为左上角,4为右上角,5为居中);
	$waterstring="华软旧货市场"; 						//水印字符串
	$waterimg="xplore.gif";  							//水印图片
	$imgpreview=0;   									//是否生成预览图(1为生成,其他为不生成);
	$imgpreviewsize=1/2;  								//缩略图比例
	$Imagesthumb=$imgsize;                                 //生成缩略图 (1生成,0不生成)
	$RESIZEWIDTH=$img_w;                                   // 生成图片的宽度
	$RESIZEHEIGHT=$img_w;                                  // 生成图片的高度
	
	//是否存在文件
	if (!is_uploaded_file($_FILES["upfile"]['tmp_name']))
	{
		echo "<font color='red'>请选择图片再上传</font> << <a href='{$url}'>返回</a>";
		exit;
	}
	 $file = $_FILES["upfile"];
	  //检查文件大小
	 if($max_file_size < $file["size"])
	 {
		 echo "<font color='red'>文件太大了</font> << <a href='{$url}'>返回</a>";
		 exit;
	  }
	
	//检查文件类型
	if(!in_array($file["type"], $uptypes))
	{
		 echo "<font color='red'>非法文件类型</font> << <a href='{$url}'>返回</a>";
		 exit;
	}
	
	if(!is_dir($destFolder)){
		mkdir($destFolder);
		chown($destFolder,0777);
	}
	$filename=$file["tmp_name"];
	$image_size = getimagesize($filename);
	$pinfo=pathinfo($file["name"]);
	$ftype=$pinfo['extension'];
	$imagename = time();
	$destination = $destFolder.$imagename.".".$ftype;
// 	$destination = 
	$thumb = $destFolder.$imagename.".thumb.".$ftype;
	$destPath=$curMonth."/".$imagename.".".$ftype;
	$thumbPath=$curMonth."/".$imagename.".thumb.".$ftype;
			
		// 生成缩略图
	if ($Imagesthumb==1) {
			$FILENAME=$pos.$thumbPath;  //生成缩略图地址
			function ResizeImage($im,$maxwidth,$maxheight,$name){ 
			$width = imagesx($im); 
			$height = imagesy($im); 
			if(($maxwidth && $width > $maxwidth) || ($maxheight && $height > $maxheight)){ 
			if($maxwidth && $width > $maxwidth){ 
			$widthratio = $maxwidth/$width; 
			$RESIZEWIDTH=true; 
			} 
			if($maxheight && $height > $maxheight){ 
			$heightratio = $maxheight/$height; 
			$RESIZEHEIGHT=true; 
			} 
			if($RESIZEWIDTH && $RESIZEHEIGHT){ 
			if($widthratio < $heightratio){ 
			$ratio = $widthratio; 
			}else{ 
			$ratio = $heightratio; 
			} 
			}elseif($RESIZEWIDTH){ 
			$ratio = $widthratio; 
			}elseif($RESIZEHEIGHT){ 
			$ratio = $heightratio; 
			} 
			$newwidth = $width * $ratio; 
			$newheight = $height * $ratio; 
			if(function_exists("imagecopyresampled")){ 
			
			$newim = imagecreatetruecolor($newwidth, $newheight); 
			imagecopyresampled($newim, $im, 0, 0, 0, 0, $newwidth, $newheight, $width, $height); 
			}else{ 
			$newim = imagecreate($newwidth, $newheight); 
			imagecopyresized($newim, $im, 0, 0, 0, 0, $newwidth, $newheight, $width, $height); 
			} 
			imagejpeg ($newim,$name ); 
			imagedestroy ($newim); 
			}else{ 
			imagejpeg ($im,$name ); 
			} 
			} 
			
			if($_FILES['upfile']['size']){ 
			if($_FILES['upfile']['type'] == "image/pjpeg"){ 
			$im = imagecreatefromjpeg($_FILES['upfile']['tmp_name']); 
			}elseif($_FILES['upfile']['type'] == "image/x-png"){ 
			$im = imagecreatefrompng($_FILES['upfile']['tmp_name']); 
			}elseif($_FILES['upfile']['type'] == "image/gif"){ 
			$im = imagecreatefromgif($_FILES['upfile']['tmp_name']); 
			} 
			if($im){ 
			//if(file_exists("$FILENAME.jpg")){ 
			//unlink("$FILENAME.jpg"); 
			//} 
			//-------------自定义缩略图代码开始---------------
			/* $dst_w = $RESIZEWIDTH;//缩略宽
			$dst_h = $RESIZEHEIGHT;//缩略高
			$src_w = imagesx($im);
			$src_h = imagesy($im);
			$dst_image = imagecreatetruecolor($dst_w, $dst_h);//创建新图像
			imagecopyresized($dst_image, $im, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);//写入新图像
			imagejpeg($im,$FILENAME);//将缩略图保存 */
			// ------------自定义缩略图代码结束------------//
			ResizeImage($im,$RESIZEWIDTH,$RESIZEHEIGHT,$FILENAME);
			ImageDestroy ($im); 
			} 
			} 
		}
	//生成缩略图结束
	if(!move_uploaded_file ($filename, $destination))
	{
		echo "<font color='red'>上传出错</font> << <a href='{$url}'>返回</a>";
		exit;
	}else{
	

			//加水印	
			if($watermark==1)
			{
			$iinfo=getimagesize($destination,$iinfo);
			$nimage=imagecreatetruecolor($image_size[0],$image_size[1]);
			$white=imagecolorallocate($nimage,255,255,255);
			$black=imagecolorallocate($nimage,0,0,0);
			$red=imagecolorallocate($nimage,255,0,0);
			imagefill($nimage,0,0,$white);
			switch ($iinfo[2])
			{
			case 1:
			$simage =imagecreatefromgif($destination);
			break;
			case 2:
			$simage =imagecreatefromjpeg($destination);
			break;
			case 3:
			$simage =imagecreatefrompng($destination);
			break;
			case 6:
			$simage =imagecreatefromwbmp($destination);
			break;
			default:
			die("<font color='red'>不能上传此类型文件！</a>");
			exit;
			}
			
			imagecopy($nimage,$simage,0,0,0,0,$image_size[0],$image_size[1]);
			imagefilledrectangle($nimage,1,$image_size[1]-15,80,$image_size[1],$white);
			
			switch($watertype)
			{
			case 1: //加水印字符串
			imagestring($nimage,2,3,$image_size[1]-15,$waterstring,$black);
			break;
			case 2: //加水印图片
			$simage1 =imagecreatefromgif("xplore.gif");
			imagecopy($nimage,$simage1,0,0,0,0,85,15);
			imagedestroy($simage1);
			break;
			}
			
			switch ($iinfo[2])
			{
			case 1:
			//imagegif($nimage, $destination);
			imagejpeg($nimage, $destination);
			break;
			case 2:
			imagejpeg($nimage, $destination);
			break;
			case 3:
			imagepng($nimage, $destination);
			break;
			case 6:
			imagewbmp($nimage, $destination);
			//imagejpeg($nimage, $destination);
			break;
			}
			//生成水印覆盖原上传文件
			imagedestroy($nimage);
			imagedestroy($simage);
			}
		//上传成功返回值	
		header("Location:?x=upimg|{$ta['opt']}&action=edit&img={$destPath}&simg={$thumbPath}&simg={$thumbPath}&imgsize={$imgsize}&img_w={$img_w}&img_h={$img_h}");
 		exit();
		}
}
if ($_GET["action"]=="add") {

?>
<script src="res/js/uploadfile/upimg/ImageMin.js"></script>
<script src="res/js/uploadfile/upimg/ImagePreview.js"></script>
<br><br>
<table width="100%" height="42" border="0" cellpadding="0" cellspacing="0">
  <form action="" method="post"  name="imgform" enctype="multipart/form-data">
  <tr>
    <td width="300">	<input type="file" name="upfile" id="idFile">
	<input type="hidden" name="imgsize" value="1" />
  	<input type="submit" name="upimg" value="上传"/></td>
	<td><img id="idImg" /></td>
  </tr>
  </form> 
</table>
<script>
var ip = new ImagePreview( $$("idFile"), $$("idImg"), {
	maxWidth: 40, maxHeight: 40, action: ""
});
ip.img.src = ImagePreview.TRANSPARENT;
ip.file.onchange = function(){ ip.preview(); };
</script>
<?php
if ($_GET["img"]!=false&&$_GET['simg']!=false){
	//图片重传,删除原图
	$tmp_img = "{$ta['upimgdir']}/".$_GET["img"];
	$tmp_simg = "{$ta['upimgdir']}/".$_GET["simg"]."";
	if(file_exists($tmp_img))
		unlink($tmp_img); //"{$ta['upimgdir']}/".$_GET["img"].""
	if(file_exists($tmp_simg))
		unlink($tmp_simg);//"{$ta['upimgdir']}/".$_GET["simg"].""
	print '<script type="text/javascript">';
	print 'parent.document.publishNewFleaInfo.saveimgname.value = "";';
	print '</script>';
}
}
if ($_GET["action"]=="edit") {
//下面的JS是把上传路径传递到数据页面文本框中,请注意form1表单名,要和修改或插入页面的表单名相同
?>
<script type="text/javascript">
	parent.document.publishNewFleaInfo.img.value='<?php print $_GET["img"]?>';
	parent.document.publishNewFleaInfo.img_thumb.value='<?php print $_GET["simg"]?>';
	parent.document.publishNewFleaInfo.saveimgname.value = '<?php print $ta['upimgdir'].$_GET["img"]?>';
</script>
<table width="100%" border="0" cellspacing="10" cellpadding="1">
  <tr>
    <td width="100%"><img name="" src="<?php print $ta['upimgdir']?>/<?php print $_GET["img"]?>" height="50" alt=""></td>
  </tr>
  <tr>
    <td width="50%"><a href='?x=upimg|<?php print $ta['opt']?>&action=add&img=<?php print $_GET["img"]?>&simg=<?php print $_GET["simg"]?>&imgsize=<?php print $_GET["imgsize"]?>&img_w=<?php print $_GET["img_w"]?>&img_h=<?php print $_GET["img_h"]?>'>重新上传</a></td>
  </tr>
</table>
<?php }?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	font-size:12px
}
input{ border:1px solid #ccc;}
textarea{ border:1px solid #ccc;}
form{padding:0px;margin:0px}
a{font-size:12px; text-decoration:none}
table{text-align: center;}
-->
</style>