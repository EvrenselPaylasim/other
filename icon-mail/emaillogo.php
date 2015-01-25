<?
$dirurl = "http://epfarki.com/hizmet/icon-mail/";  
$picdir = "jim_black";  

function read_from_file($file){
	$fp=fopen($file,"r");
	if(!$fp){
		return(FALSE);
	}
	flock($fp,LOCK_SH);
	$data=fread($fp,filesize($file));
	fclose($fp);
	return($data);
}

function hexrgb($hexstr, $rgb){ //
 $int = hexdec(str_replace("#", '', $hexstr));
 switch($rgb) {
		case "r":
		return 0xFF & $int >> 0x10;
			break;
		case "g":
		return 0xFF & ($int >> 0x8);
			break;
		case "b":
		return 0xFF & $int;
			break;
		default:
		return array(
			"r" => 0xFF & $int >> 0x10,
			"g" => 0xFF & ($int >> 0x8),
			"b" => 0xFF & $int
			);
			break;
	}    
}

if($_GET['start']=="5glive"){
	$filename = "images/sample.png";
	$type = 1;
}elseif($_GET['show']){
	$picname = $_GET['show'];
	$filename = $picdir."/".date("ymd",$picname)."/".$picname.".png";
	$type = 2;
}elseif($_GET['down']){
	$filename = $_GET['down'];
	header("Content-type: command");
	header("Content-Disposition: attachment; filename=EPfarki_emaillogo.png");
	readfile($picdir."/".date("ymd",$filename)."/".$filename.".png");
	exit;
}elseif($_GET['mkpic']=="5glive"){
	$username = trim($_GET['s']); //邮件地址
	if(preg_match("/^[_\.0-9a-zA-Z\_@.]*$/i",$username) && $username){
		$host = $_GET['maillogo']; //邮件HOST
		$srcUrl = "s_logo/".$host.".gif"; //Email图片URL

		$back_c = "#ffffff"; //背景颜色
		$border_c = $_GET['bordercolor']; //边框颜色
		$font_c = $_GET['color']; //文字颜色
		$font_size = $_GET['size']; //字体大小
		$font_url = "s_font/".$_GET['mailfont'].".ttf"; //字体URL

		if($_GET['border']=="true") $is_border = 1; else $is_border = 0; //是否有边框 0没有 非0有
		if($host) $is_logo = 1; else $is_logo=0; //是否有邮箱图标 0没有 非0有

		$srcWidth = 0;
		$srcHeight = 0;

		$str_pos = imagettfbbox($font_size,0,$font_url,$username);
		$str_width = intval($str_pos[2]); //文字字符宽度
		$str_height = intval(str_replace("-","",$str_pos[5])); //文字字符高度

		if($is_logo){
			$origImg = ImageCreateFromGIF($srcUrl);
			$srcWidth = intval(imagesx($origImg)); //Email图像宽度
			$srcHeight = intval(imagesy($origImg)); //Email图像高度
		}

		$newWidth = $str_width + 15 + $srcWidth; //LOGO总宽度
		$newHeight = ($srcHeight>$str_height) ? $srcHeight+2 : $str_height+8;

		$image=imagecreatetruecolor($newWidth, $newHeight); //创建图片

		$back_color = hexrgb($back_c,rgb); //取背景颜色
		$back = imagecolorallocate($image, $back_color['r'], $back_color['g'], $back_color['b']); //背景颜色 白色
		imagefilledrectangle($image, 0, 0, $newWidth - 1, $newHeight - 1, $back); //背景填充

		if($is_border){
			$border_color = hexrgb($border_c,rgb); //取边框颜色
			$border = imagecolorallocate($image, $border_color['r'], $border_color['g'], $border_color['b']); //边框颜色
			imagerectangle($image, 0, 0, $newWidth - 1, $newHeight - 1, $border); //画边框
		}

		if($is_logo){
			$srcX = $str_width+10; //Email图片X轴位置
			$srcY = ($newHeight - $srcHeight)/2; //Email图片Y轴位置
			ImageCopy($image, $origImg, $srcX,$srcY,0,0,$srcWidth,$srcHeight); //将Email图片复制到LOGO上
		}

		$font_color = hexrgb($font_c,rgb); //取字体颜色
		$color = imagecolorallocate($image, $font_color['r'], $font_color['g'], $font_color['b']); //字体颜色
		$str_x = $str_height+($newHeight-$str_height)/2;
		if(!$is_logo) $str_x-=2; //字体高度修正
		imagettftext($image, $font_size, 0, 6, $str_x, $color, $font_url, $username); //将文字写到图片上

		//输出图片
		$filename = time();
		$filedir = date("ymd",$filename);

		if(!file_exists($picdir."/".$filedir)){ //生成图片存储目录，按月份分开存储
			mkdir($picdir."/".$filedir);
		}
		header("Content-type: image/png");
		imagepng($image,$picdir."/".$filedir."/".$filename.".png"); //如果要将图片存在本地，打开此选项
		imagedestroy($image);
		header("location: ?show=".$filename);
		exit;
	}elseif($username==""){
		$filename = "images/taddyshen.png";
		$type = 4;
	}else{
		$filename = "images/error.png";
		$type = 4;
	}
}else{
	$filename = "images/error.png";
	$type = 4;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-9" />    
  
<meta name="google-site-verification" content="ciu-UfpnqJYe6rjrk5QMrrzz684u2HLlywF9KKLKEjk" />
<meta name="msvalidate.01" content="910AEDDA7AB4D2A7FA00ACB17E444EA5" />
<meta name="alexaVerifyID" content="ybOKfPS80NueBfPKssTKHmhaWo0" />  
<meta name="yandex-verification" content="5d863a6dead77fbe" />

<meta name="description" content="Resimli E-posta olu⺶urma � EPfarki.com Hizmetleri � Birazc齥 Farkl�" />
<meta name="keywords" content="Resimli E-posta olu⺶urma, epfarki, ep, farki, evrensel, paylasim, evrenselpaylasim, fark�, farkl�, farkli, fark, " />
<title>輈on Mail � Resimli E-posta olu⺶urma � EPfarki.com Hizmetleri � Birazc齥 Farkl�</title>



  <meta name="robots" content="index, follow" />
<meta http-equiv="reply-to" content="epfarki@gmail.com" />
<meta http-equiv="content-language" content="tr, en" />
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="cache-control" content="no-cache" />
<meta name="googlebot" content="index, follow" />
<meta name="abstract" content="EPfark� � Bilgiye Ik Tut!" />
<meta name="distribution" content="global" />
<meta name="classification" content="personel blog" />
<meta name="resource-type" content="document" />
<meta name="rating" content="all" />
<meta name="copyright" content="creativecommons" />
<meta name="creation" content="29/11/2010 " />
<meta name="generator" content="bizimakin" />
<meta name="designer" content="bizimakin" />
<meta name="publisher" content="bizimakin" />
<meta name="author" content="akin" />
<meta name="geo.region" content="TR-06" />
<meta name="geo.placename" content="ankara" />
<meta name="geo.position" content="38.963745;35.243322" />
<meta name="ICBM" content="38.963745, 35.243322" />
<meta name="DC.title" content="EPfark� � Bilgiye Ik Tut!" />


  <link href="http://dosya.epfarki.com/favicon.ico" rel="shortcut icon" type="image/x-icon" />
  <link href="http://epfarki.com/index.php?format=feed&amp;type=rss" rel="alternate" type="application/rss+xml" title="RSS 2.0" />
  <link href="http://epfarki.com/index.php?format=feed&amp;type=atom" rel="alternate" type="application/atom+xml" title="Atom 1.0" />

  <link rel='index' title='EPfarki' href='http://epfarki.com/' />


  <link href="images/common.css" rel="stylesheet" type="text/css" />
  



<style>
body{font-size:12px;color:#666;margin:0;}
</style>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-15636054-13']);
  _gaq.push(['_setDomainName', 'epfarki.com']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<body>
<? if($type==1){ ?>
<table style="border:1px solid #f5f5f5;" width="350" align="center">
<tr><td height="150" align="center"><img src="<?=$filename?>" id="newlogo" /></td></tr>
</table>
<? }elseif($type==2){ ?>
<script language="javascript">
function oCopy(obj){
obj.select();
js=obj.createTextRange();
js.execCommand("Copy");
} 
</script> 
<table style="border:1px solid #f5f5f5;" width="350" align="center">
<tr><td height="80" align="center"><img src="<?=$filename?>" id="newlogo" alt="邮箱图标" /></td></tr>
<tr><td height="40" bgcolor="#f5f5f5" align="center"><input name="savebutton" type="button" id="savebutton" onClick="document.location='?down=<?=$picname?>'" value="Resmi 輓dir" style="width:100px;line-height:150%;" /></td></tr>
<tr><td>
<table>
<tr><td height="20" align="center" width="60">Resim Adresi</td><td><input type="text" value="<?=$dirurl.$filename?>" style="width:200px;height:16px;font-family:arial;" onclick="this.select()" id="ubbpic" /></td><td><input type="button" value="Copy" onclick="oCopy(ubbpic)" /></td></tr>
<tr><td height="20" align="center">HTML codu</td><td><input type="text" value='<img src="<?=$dirurl.$filename?>" alt="Mail icon EPfarki.com" />' style="width:200px;height:16px;font-family:arial;" onclick="this.select()" id="htmlpic" /></td><td><input type="button" value="Copy" onclick="oCopy(htmlpic)" /></td></tr>
</table>
</td></tr>
</table>
<? }elseif($type==3){ ?>

<? }else{ ?>
<table style="border:1px solid #f5f5f5;" width="350" align="center">
<tr><td height="150" align="center"><img src="<?=$filename?>" id="newlogo" alt="汗,出错了,请重试!" /></td></tr>
</table>
<? } ?>
</body>
</html>