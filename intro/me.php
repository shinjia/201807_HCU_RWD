<?php

$today = date('Y-m-d H:i:s 星期 w', time());
/*
$name = '陳信嘉';
$birth = 1967;
$email = 'shinjia168@gmail.com';
$photo = 'images/head1.jpg';
*/


$name = '阮今天';
$birth = 1976;
$email = 'xxxxx@gmail.com';
$photo = 'images/head2.jpg';



$age = $birth - 1911;



$html = <<< HEREDOC
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>me</title>
</head>

<body>
<h1>Hello World Hello</h1>
<p>今天是：{$today}</p>

<p>年齡：{$age}</p>
<p>email：{$email}</p>
<p><img src="{$photo}"></p>
</body>
</html>
HEREDOC;

echo $html;
?>