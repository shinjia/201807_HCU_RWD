<?php

$a_area = array(
'臺北市', '臺北市', '臺北市', '臺北市', '臺北市', '臺北市',
'新北市', '新北市', '新北市', '新北市', '新北市', '新北市', '新北市', 
'桃園市', '桃園市', '桃園市', '桃園市', 
'臺中市', '臺中市', '臺中市', '臺中市', 
'臺南市', '臺南市', '臺南市', 
'高雄市', 
'新竹縣', 
'苗栗縣', 
'彰化縣', 
'南投縣', 
'雲林縣', 
'嘉義縣', 
'屏東縣', 
'宜蘭縣', 
'花蓮縣', 
'臺東縣', 
'澎湖縣' );


$area = $a_area[array_rand($a_area,1)];



$html = <<< HEREDOC
<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8'>
<title>Generator</title>
</head>

<body>
<p>居住地區：{$area}</p>
</body>
</html>
HEREDOC;

echo $html;
?>