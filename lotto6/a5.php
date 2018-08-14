<?php

function ball_exist($n, $ary)
{
	// 檢查 $num 是否在陣列裡
	$found = false;
	foreach($ary as $one)
	{
		if($one==$n)
		{
			$found = true;
		}
	}
	
	return $found;
}


$min = 1;
$max = 42;
$total = 6;

$a_box = array();

// 產生六個球
$check = '';
for($i=1; $i<=$total; $i++)
{
	do
	{
		// 重覆『產生隨機亂數』，『放入陣列內』
		$num = mt_rand($min, $max);	
		$check .= $num . ', ';

        // 檢查此數是否在陣列內
		$found = ball_exist($num, $a_box);
		
	} while( $found );
	
	$a_box[] = $num;
}


// 結果取出來
$str = '';
foreach($a_box as $one)
{
	$str .= '<img src="images/' . $one . '.jpg" width="81" height="81" />';
}


$html = <<< HEREDOC
<html">

<head>
<meta charset="UTF-8">
<title>Lotto6</title>
</head>

<body>
<p>檢查每次抽出的數字：{$check}</p>
<br>
{$str}
</body>
</html>
HEREDOC;

echo $html;
?>