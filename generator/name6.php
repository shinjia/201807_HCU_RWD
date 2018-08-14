<?php

// 組合類型的隨機亂數

// 身分証字號，利用ASCII碼 A(65), Z(90)
$id = '';
$id .= chr(mt_rand(65, 90));  // 第一碼英文字母
$id .= mt_rand(1, 2);       // 第二碼1或2
for($i=1; $i<=8; $i++)
{
   $id .= mt_rand(0, 9);
}


// 電話號碼 (09xx-999999)
$tel = '';
$tel .= '09' . mt_rand(1,9) . mt_rand(1,9);
$tel .= '-';
for($i=0; $i<=6; $i++)
{
   $tel .= mt_rand(0,9);
}




$html = <<< HEREDOC
<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8'>
<title>Generator</title>
</head>

<body>
<p>身分証字號：{$id}</p>
<p>電話號碼：{$tel}</p>
</body>
</html>
HEREDOC;

echo $html;
?>