<?php
include 'config.php';
include 'utility.php';

// 連接資料庫
$pdo = db_open();


// 新增資料表之SQL語法 (採用陣列方式，可以設定多個)
$a_table["book"] = "

CREATE TABLE book
(
   uid int(11) NOT NULL auto_increment, 
   bookcode VARCHAR(255) NULL, 
   bookname VARCHAR(255) NULL, 
   author VARCHAR(255) NULL, 
   publish VARCHAR(255) NULL, 
   pub_date DATE NULL, 
   price INT NULL, 
   picture VARCHAR(255) NULL, 
   remark VARCHAR(255) NULL, 
   PRIMARY KEY (uid) ); 

";


// 執行SQL及處理結果
$msg = '';
foreach($a_table as $key=>$sqlstr)
{
   $sth = $pdo->exec($sqlstr);   
   if($sth===FALSE)
   {
      $msg .= '資料表『' . $key . '』無法建立<br />';
      $msg .= print_r($pdo->errorInfo(),TRUE) . '<br />' . $sqlstr;
   }
   else
   {
      $msg .= '資料表『' . $key . '』建立完成<BR>';
   }
}


$html = <<< HEREDOC
<body>
<h2>資料表建立結果</h2>
{$msg}
HEREDOC;

include 'pagemake.php';
pagemake($html, '');
?>