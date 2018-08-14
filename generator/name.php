<?php

// 定義所有的姓
$n1 = array('趙', '錢', '孫', '李', '周' );  
$n2 = array('美', '芬', '芳', '淑', '蓉', '潔' );
$n3 = array('美', '芬', '芳', '淑', '蓉', '潔' );

/*
$i = mt_rand(0, count($n1)-1);   // 隨機取出索引值
$username = $n1[$i];
*/
$username = $n1[mt_rand(0, count($n1)-1)] . $n2[mt_rand(0, count($n2)-1)] . $n3[mt_rand(0, count($n3)-1)];


/* 另一種方式 */
$username = $n1[array_rand($n1,1)] . $n2[array_rand($n2,1)] . $n3[array_rand($n3,1)];


$html = <<< HEREDOC
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Title of the document</title>
</head>

<body>
<p>姓名：{$username}</p>

</body>
</html>
HEREDOC;

echo $html;
?>