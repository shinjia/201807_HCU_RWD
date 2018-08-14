<?php
$min = 1;   // 最小的數字
$max = 49;  // 最大的數字
$total = 6; // 球的個數 


$a_full = range($min, $max);
$a_box = array_rand($a_full, $total);

/*
echo '<pre>';
print_r($a_full);
print_r($a_box);
echo '</pre>';
exit;
*/

// 逐一取出陣列的值
$str1 = '';
foreach($a_box as $one)
{
   $str1 .= '<img src="images/' . ($one+1) . '.jpg">';
}

sort($a_box);  // 排序，由小排到大

// 逐一取出陣列的值
$str2 = '';
foreach($a_box as $one)
{
   $str2 .= '<img src="images/' . $a_full[$one] . '.jpg">';
}



$html = <<< HEREDOC
<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<title>Lotto6</title>
</head>

<body>
<p>幸運樂透數字</p>
<p>原來的順序：{$str1}</p>
<p>由小排到大：{$str2}</p>
</body>
</html>
HEREDOC;

echo $html;
?>