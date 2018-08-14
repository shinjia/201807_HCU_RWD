<?php

$num = mt_rand(0,9);
$pic = 'images/' . $num . '.jpg';


$html = <<< HEREDOC
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Title of the document</title>
</head>

<body>
<h1>Hello World Hello</h1>
<p><img src="{$pic}"></p>

</body>
</html>
HEREDOC;

echo $html;
?>