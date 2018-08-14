<?php
session_start();

$chk_input = mt_rand(1000,9999);
$chk_md5 = md5($chk_input);

$html = <<< HEREDOC
<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>reCaptcha demo</title>
</head>

<body>


<form method="post" action="result.php">
  <p>輸入帳號：<input type="text" name="t1"></p>
  <p>請輸入驗証碼：<input type="text" name="chk" value="{}" disabled></p>
  <input type="hidden" name="chk" value="" disabled>
  <input type="submit" value="送出">
</form>
  
  

</body>

</html>
HEREDOC;

echo $html;
?>