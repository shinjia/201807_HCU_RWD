<?php

$num = mt_rand(1, 49);


$html = <<< HEREDOC
<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<title>Test</title>
</head>

<body>
<p>幸運數字</p>
<p><img src="images/{$num}.jpg" width="81" height="81" /></p>
</body>
</html>
HEREDOC;

echo $html;
?>