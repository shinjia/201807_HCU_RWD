<?php
include 'config.php';

// 連接資料庫
$link = db_open();

// 新增資料表之SQL語法 (採用陣列方式，可以設定多個)
$a_table['book'] = '
CREATE TABLE book (
  uid int(11) NOT NULL auto_increment,
  bookcode varchar(255) NULL,
  bookname varchar(255) NULL,
  descr    varchar(255) NULL,
  author   varchar(255)  NULL,
  publish  varchar(255)  NULL,
  pub_date date default NULL,
  price    int(11) default NULL,
  picture    varchar(255) NULL,
  remark   varchar(255) NULL,
  PRIMARY KEY  (uid)
  )
';

// 執行SQL及處理結果
$msg = '';
foreach($a_table as $key=>$sqlstr)
{
   $result = mysqli_query($link, $sqlstr);
   
   $msg .= '資料表『' . $key . '』.........';
   $msg .= ($result) ? '建立完成！' : '無法建立！'.mysqli_error($link);
   $msg .= '<br>';
}

db_close($link);


$html = <<< HEREDOC
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>書籍資料系統</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<h2>資料表建立結果</h2>
{$msg}
</body>
</html>
HEREDOC;

echo $html;
?>