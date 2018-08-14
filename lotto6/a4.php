<?php
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
		$found = false;
		foreach($a_box as $one)
		{
			if($one==$num)
			{
				$found = true;
			}
		}
		
	} while( $found );
	
	
	$a_box[] = $num;
}

// 結果取出來
$str = '';
foreach($a_box as $one)
{
	$str .= '<img src="images/' . $one . '.jpg" />';
}




$html = <<< HEREDOC
<!DOCTYPE html>
<html>

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