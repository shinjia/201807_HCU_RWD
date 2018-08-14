<?php

// 定義所有的姓
$n1 = array('趙', '錢', '孫', '李', '周', '吳', '鄭', '王' );  

// 說明：在陣列裡隨機挑一個『值』
/*
$i = mt_rand(0, count($n1)-1);   // 隨機取出索引值
$username = $n1[$i];
*/

// 方法一
$username = $n1[mt_rand(0, count($n1)-1)];

// 方法二
$username = $n1[array_rand($n1,1)];


$html = <<< HEREDOC
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Generator</title>
</head>

<body>
<p>姓：{$username}</p>

</body>
</html>
HEREDOC;

echo $html;
?>