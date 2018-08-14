<?php

$a_score = array(80, 90, 70, 60, 50, 45, 24, 86, 23, 84, 31);   // 定義分數

$size = count($a_score);

$cnt = 0;
$max = -99999;  // 很小的數
$min = 99999;   // 很大的數
$sum = 0;
foreach($a_score as $one)
{
   $cnt++;

   if($one>$max)
   {
   	 $max = $one;
   }

   if($one<$min)
   {
   	 $min = $one;
   }

   $sum += $one;
}

$avg = $sum / $size;


$html = <<< HEREDOC
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Array</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
人數：{$cnt}...{$size}<br />
最大：{$max}<br />
最小：{$min}<br />
總分：{$sum}<br />
平均：{$avg}<br />

</body>
</html>
HEREDOC;

echo $html;
?>