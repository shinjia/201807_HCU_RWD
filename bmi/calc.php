<?php

$height = isset($_POST['height']) ? $_POST['height'] : '';
$weight = isset($_POST['weight']) ? $_POST['weight'] : '';

$height = 0+$height;
if($height==0)
{
	header('Location: input.php?status=X&weight=' . $weight);
	exit;
}


$bmi = ($weight) / (($height/100) * ($height/100));

// $bmi = number_format($bmi, 2);
$bmi = round($bmi, 2);



if($bmi>=24)
{
	$msg = '月巴月半';
	$pic = 'images/s1.jpg';
	$url = 'page1.html';
}
elseif( $bmi<24 && $bmi>=22 )
{
	$msg = '過重';
	$pic = 'images/s2.jpg';
	$url = 'page2.html';
}
elseif( ($bmi<22)  && ($bmi>=17.5) )
{
	$msg = '正常';
	$pic = 'images/s3.jpg';
	$url = 'page3.html';
}
elseif( $bmi<17.5 )
{
	$msg = '太輕';
	$pic = 'images/s4.jpg';
	$url = 'page4.html';
}
else
{
	$msg = '程式一定出錯了！';
	echo $msg;
	exit;
}



$html = <<< HEREDOC
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>BMI</title>
</head>

<body>
<h1>BMI</h1>
<p>你的BMI指數為 {$bmi}</p>
<p>{$msg}</p>
<p><img src="{$pic}"></p>
<p>建議<a href="{$url}">請點此處</a></p>
<iframe src="{$url}" width="600" height="300">
<hr />
<p>height: {$height}</p>
<p>weight: {$weight}</p>

</body>
</html>
HEREDOC;

echo $html;
?>