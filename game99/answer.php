<?php

$a = isset($_GET['a']) ? $_GET['a'] : '0';
$b = isset($_GET['b']) ? $_GET['b'] : '0';

$ans = $a * $b;

$n1 = $ans % 10;  // 個位數
$n2 = floor($ans / 10);  // 十位數


$n1_pic = '<img src="images/' . $n1 . '.jpg">';
$n2_pic = '<img src="images/' . $n2 . '.jpg">';


if($ans<10)
{
	$n2_pic = '';
}


$html = <<< HEREDOC
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Game 99</title>
</head>

<body>
<h1>九九乘法CAI練習</h1>
<p>{$a} 乘以 {$b} 的答案是 {$ans}</p>
<p>{$n2_pic}{$n1_pic}</p>
<p><a href="question.php">再試一題</a></p>
<hr />
<p>n1 = {$n1}</p>
<p>n2 = {$n2}</p>
</body>
</html>
HEREDOC;

echo $html;
?>