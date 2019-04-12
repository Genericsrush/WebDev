<?php
   session_start();
	$captcha_num = rand(1000,9999);
	$_SESSION["code"] = $captcha_num;

	$font_size = 30;
	$img_width = 70;
	$img_height = 40;	

	header('content-type: image/jpeg');

	$image = imagecreate($img_width, $img_height); // create background image with dimensions
	imagecolorallocate($image, 255, 255, 255); // set background color

	$text_color = imagecolorallocate($image, 0, 0, 0); // set captcha text color

	imagestring($image, 4, 15,12.5, $captcha_num,$text_color);
	imagejpeg($image);
?>