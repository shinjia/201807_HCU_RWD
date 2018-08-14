<?php
include 'config.php';
include 'utility.php';

$uid = $_GET["uid"] + 0;  // 強制轉成數值



// 連接資料庫
$pdo = db_open();

// 寫出 SQL 語法
$sqlstr = "SELECT * FROM book WHERE uid=:uid ";

$sth = $pdo->prepare($sqlstr);
$sth->bindParam(':uid', $uid, PDO::PARAM_INT);

// 執行 SQL
if($sth->execute())
{
   // 成功執行 query 指令
   if($row = $sth->fetch(PDO::FETCH_ASSOC))
   {
      $uid = $row['uid'];
      $bookcode = convert_to_html($row['bookcode']);
      $bookname = convert_to_html($row['bookname']);
      $author = convert_to_html($row['author']);
      $publish = convert_to_html($row['publish']);
      $pub_date = convert_to_html($row['pub_date']);
      $price = convert_to_html($row['price']);
      $picture = convert_to_html($row['picture']);
      $remark = convert_to_html($row['remark']);


      $data = <<< HEREDOC
<table>
   <tr><th>書籍代碼</th><td>{$bookcode}</td></tr>
   <tr><th>書籍名稱</th><td>{$bookname}</td></tr>
   <tr><th>作者</th><td>{$author}</td></tr>
   <tr><th>出版社</th><td>{$publish}</td></tr>
   <tr><th>出版日期</th><td>{$pub_date}</td></tr>
   <tr><th>售價</th><td>{$price}</td></tr>
   <tr><th>商品圖檔</th><td>{$picture}</td></tr>
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