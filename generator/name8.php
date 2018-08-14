<?php

$a_picture = array(
	'01.svg', '02.svg', '03.svg', '04.svg',
	'05.svg', '06.svg', '07.svg', '08.svg',
	'09.svg', '10.svg', '11.svg', '12.svg', 
	'13.svg', '14.svg', '15.svg', '16.svg' );

// 圖像
$pic = $a_picture[array_rand($a_picture, 1)];




$html = <<< HEREDOC
<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8'>
<title>Generator</title>
</head>

<body>
<p>圖像：<img src="image_avatars/{$pic}" width="800"></p>
</body>
</html>
HEREDOC;

echo $html;
?>