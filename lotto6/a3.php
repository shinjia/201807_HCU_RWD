<?php
$min = 1;   // 最小的數字
$max = 12;  // 最大的數字
$total = 6; // 球的個數 


$a_box = array();  // 宣告空陣列

$chk = '';  // 用來檢查每次出現的數字

// 『產生隨機亂數』，『放入陣列內』
for($i=1; $i<=$total; $i++)
{
   do 
   {
      $num = mt_rand($min, $max);  // 隨機產生一個數
      $chk .= $num  .', ';
   } while( in_array($num, $a_box) );  // 當數字在陣列裡時==>重新產生

   $a_box[] = $num;  // 把數字放進陣列裡
}


// 逐一取出陣列的值
$str1 = '';
foreach($a_box as $one)
{
   $str1 .= '<img src="images/' . $one . '.jpg">';
}

sort($a_box);  // 排序，由小排到大

// 逐一取出陣列的值
$str2 = '';
foreach($a_box as $one)
{
   $str2 .= '<img src="images/' . $one . '.jpg">';
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
<p>檢查每次出現的數：{$chk}</p>
<p>原來的順序：{$str1}</p>
<p>由小排到大：{$str2}</p>
</body>
</html>
HEREDOC;

echo $html;
?>