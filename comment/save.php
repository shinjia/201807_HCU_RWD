<?php
$nickname = isset($_POST['nickname']) ? $_POST['nickname'] : '';
$comment  = isset($_POST['comment'])  ? $_POST['comment']  : '';

// $filename = 'data.txt';
// $filename = 'save/data.txt';
$filename = 'save/data_' . date('Ymd',time()) . '.txt';

$now = date('Y-m-d H:i:s', time());


$data = <<< HEREDOC
時間：{$now}
姓名：{$nickname}
意見：{$comment}
---------------------------------

HEREDOC;

// 方法一
// file_put_contents($filename, $data, FILE_APPEND);


// 方法二
// 先確認檔案必須存在，若不在則先產生
if(!file_exists($filename))
{
   file_put_contents($filename, '');
}

$old = file_get_contents($filename);
$new = $data . $old;
file_put_contents($filename, $new);


// 寄信功能
$to = 'shinjia168@gmail.com';
$title = 'Receive comment';
$content = '已收到客戶的意見...' . $data;

@mail($to, $title, $content);



$html = <<< HEREDOC
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Comment</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<p>謝謝，已經收到您的意見!!!</p>
<p>{$nickname}</p>
<p>{$comment}</p>

</body>
</html>
HEREDOC;

echo $html;
?>