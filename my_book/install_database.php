<?php
include "config.php";

// 連接資料庫
// $link = mysqli_connect(DB_SERVERIP, DB_bookname, DB_PASSWORD, DB_DATABASE) or die(ERROR_CONNECT);
$link = mysqli_connect(DB_SERVERIP, DB_bookname, DB_PASSWORD, '') or die(ERROR_CONNECT);
if(defined('SET_CHARACTER')) mysqli_query($link, SET_CHARACTER) or die(ERROR_CHARACTER);

// 寫出 SQL 語法
$sqlstr = "CREATE DATABASE " . DB_DATABASE;
$sqlstr .= " DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ";   // or utf8

// 執行SQL及處理結果
$result = mysqli_query($link, $sqlstr);
if( $result )
{
    $msg = '資料庫 ' . DB_DATABASE . ' 建立成功！';
}
else
{
   $msg = '資料庫無法建立！<HR>';
   $msg .= '<HR>' . $sqlstr . '<HR>' . mysqli_error($link);
}


$html = <<< HEREDOC
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>書籍資料系統</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<h2>資料庫建立</h2>
{$msg}
</body>
</html>
HEREDOC;

echo $html;
?>