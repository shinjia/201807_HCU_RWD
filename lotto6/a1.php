<?php
$min = 1;
$max = 49;

// 隨機亂數產生個別的六個
$pic1 = '<img src="images/' . mt_rand($min, $max) . '.jpg">';
$pic2 = '<img src="images/' . mt_rand($min, $max) . '.jpg">';
$pic3 = '<img src="images/' . mt_rand($min, $max) . '.jpg">';
$pic4 = '<img src="images/' . mt_rand($min, $max) . '.jpg">';
$pic5 = '<img src="images/' . mt_rand($min, $max) . '.jpg">';
$pic6 = '<img src="images/' . mt_rand($min, $max) . '.jpg">';



$html = <<< HEREDOC
<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<title>Lotto6</title>
</head>

<body>
<p>幸運樂透數字</p>
<p>{$pic1}{$pic2}{$pic3}{$pic4}{$pic5}{$pic6}</p>
</body>
</html>
HEREDOC;

echo $html;
?>