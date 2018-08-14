<?php

$status = isset($_GET['status']) ? $_GET['status'] : '';
$weight = isset($_GET['weight']) ? $_GET['weight'] : '';

$msg = '請輸入身高體重';
if($status=='X')
{
	$msg = '身高不得為零';
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
{$msg}
<form method="post" action="calc.php">
  <p>身高: <input type="text" name="height"></p>
  <p>體重: <input type="text" name="weight" value="{$weight}"></p>
  <p><input type="submit" value="計算"></p>
</form>

</body>
</html>
HEREDOC;

echo $html;
?>