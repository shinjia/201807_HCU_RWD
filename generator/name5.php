<?php

// 數字類型的隨機亂數
$height = mt_rand(150, 190);
$weight = mt_rand(40, 90);



$html = <<< HEREDOC
<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8'>
<title>Generator</title>
</head>

<body>
<p>身高：{$height}</p>
<p>體重：{$weight}</p>
</body>
</html>
HEREDOC;

echo $html;
?>