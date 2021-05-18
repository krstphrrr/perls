<?php
session_start();
session_regenerate_id(true); 

	$str = "";
	$length = 0;
	for ($i = 0; $i < 4; $i++) {
	// this numbers refer to numbers of the ascii table (small-caps)
		 $str .= chr(rand(97, 122));
	}
	$_SESSION['rand_code'] = $str;


// generate image
$imgX = 100;
$imgY = 50;
$image = imagecreatetruecolor(100, 50);
$backgr_col = imagecolorallocate($image, 238,239,239);
$border_col = imagecolorallocate($image, 125,125,125);
$text_col = imagecolorallocate($image, 0,0,150);
imagefilledrectangle($image, 0, 0, 100, 50, $backgr_col);
imagerectangle($image, 0, 0, 99, 49, $border_col);
$font = "./palscri.ttf"; // font
$font_size = rand(30, 35);
$angle = rand(-13, 13);
$box = imagettfbbox($font_size, $angle, $font, $_SESSION['rand_code']);
$x = (int)($imgX - $box[4]) / 2;
$y = (int)($imgY - $box[5]) / 2;
imagettftext($image, $font_size, $angle, $x, $y, $text_col, $font, $_SESSION['rand_code']);
header("Content-type: image/png");
imagepng($image);
imagedestroy ($image);
?>