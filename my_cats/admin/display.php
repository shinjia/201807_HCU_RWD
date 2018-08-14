<?php
include 'config.php';
include 'utility.php';

$uid = $_GET["uid"] + 0;  // 強制轉成數值



// 連接資料庫
$pdo = db_open();

// 寫出 SQL 語法
$sqlstr = "SELECT * FROM cats WHERE uid=:uid ";

$sth = $pdo->prepare($sqlstr);
$sth->bindParam(':uid', $uid, PDO::PARAM_INT);

// 執行 SQL
if($sth->execute())
{
   // 成功執行 query 指令
   if($row = $sth->fetch(PDO::FETCH_ASSOC))
   {
      $uid = $row['uid'];
      $code = convert_to_html($row['code']);
      $title = convert_to_html($row['title']);
      $prompt = convert_to_html($row['prompt']);
      $picture = convert_to_html($row['picture']);
      $maintext = convert_to_html($row['maintext']);
      $remark = convert_to_html($row['remark']);

        // 顯示『maintext』欄位的文字區域文字
        $str_maintext = nl2br($maintext);

      $data = <<< HEREDOC
<table>
   <tr><th>代碼</th><td>{$code}</td></tr>
   <tr><th>標題</th><td>{$title}</td></tr>
   <tr><th>提示</th><td>{$prompt}</td></tr>
   <tr><th>圖片</th><td>{$picture}</td></tr>
   <tr><th>本文</th><td>{$str_maintext}</td></tr>
   <tr><th>備註欄位</th><td>{$remark}</td></tr>

</table>
HEREDOC;
   }
   else
   {
 	   $data = '查不到相關記錄！';
   }
}
else
{
   // 無法執行 query 指令時
   $data = error_message('display');
}


$html = <<< HEREDOC
<button onclick="location.href='list_page.php';">返回列表</button>
<h2>顯示資料</h2>
{$data}
HEREDOC;
 
 
include 'pagemake.php';
pagemake($html, '');
?>