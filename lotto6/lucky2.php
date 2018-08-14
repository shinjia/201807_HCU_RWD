<?php
$max = 49;

$num1 = mt_rand(1, $max);
$num2 = mt_rand(1, $max);
$num3 = mt_rand(1, $max);
$num4 = mt_rand(1, $max);
$num5 = mt_rand(1, $max);
$num6 = mt_rand(1, $max);

$pic1 = 'images/' . $num1 . '.jpg';
$pic2 = 'images/' . $num2 . '.jpg';
$pic3 = 'images/' . $num3 . '.jpg';
$pic4 = 'images/' . $num4 . '.jpg';
$pic5 = 'images/' . $num5 . '.jpg';
$pic6 = 'images/' . $num6 . '.jpg';



$html = <<< HEREDOC
<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<title>Test</title>
</head>

<body>
<p>我的樂透猜測</p>
<p>
<img src="{$pic1}" width="81" height="81" />
<img src="{$pic2}" width="81" height="81" />
<img src="{$pic3}" width="81" height="81" />
<img src="{$pic4}" width="81" height="81" />
<img src="{$pic5}" width="81" height="81" />
<img src="{$pic6}" width="81" height="81" />
</p>

</body>
</html>
HEREDOC;

echo $html;
?>