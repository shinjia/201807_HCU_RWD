<?php


function constellation($mm, $dd)
{
   // 傳入月、日，對應出星座
   /*
   水瓶座：01-21 - 02-19
   雙魚座：02-20 - 03-20
   白羊座：03-21 - 04-20
   金牛座：04-21 - 05-21
   雙子座：05-22 - 06-21
   巨蟹座：06-22 - 07-22
   獅子座：07-23 - 08-23
   處女座：08-24 - 09-23
   天秤座：09-24 - 10-23
   天蠍座：10-24 - 11-22
   射手座：11-23 - 12-21
   魔羯座：12-22 - 01-20
   */

   $chk = $mm * 100 + $dd;

   $ret = '';
   if    ($chk>= 121 && $chk<= 219) { $ret = '水瓶座'; }
   elseif($chk>= 220 && $chk<= 320) { $ret = '雙魚座'; }
   elseif($chk>= 321 && $chk<= 420) { $ret = '白羊座'; }
   elseif($chk>= 421 && $chk<= 521) { $ret = '金牛座'; }
   elseif($chk>= 522 && $chk<= 621) { $ret = '雙子座'; }
   elseif($chk>= 622 && $chk<= 722) { $ret = '巨蟹座'; }
   elseif($chk>= 723 && $chk<= 823) { $ret = '獅子座'; }
   elseif($chk>= 824 && $chk<= 923) { $ret = '處女座'; }
   elseif($chk>= 924 && $chk<=1023) { $ret = '天秤座'; }
   elseif($chk>=1024 && $chk<=1121) { $ret = '射手座'; }
   elseif($chk>=1122 || $chk<= 120) { $ret = '魔羯座'; }
   else { $ret = '資料有誤';}

   return $ret;
}


// 日期類型的隨機亂數

// 出生年月日
$birthday = @date('Y-m-d', @strtotime('-'.mt_rand(0,365*50).' day'));
// 從今天起，之前五十年內的任一天


// 星座
$m = date('m', strtotime($birthday));
$d = date('d', strtotime($birthday));
$star = constellation($m, $d);



$html = <<< HEREDOC
<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8'>
<title>Generator</title>
</head>

<body>
<p>出日：{$birthday}</p>
<p>星座：{$star}</p>
</body>
</html>
HEREDOC;

echo $html;
?>