<?php
include 'config.php';
include 'utility.php';

$uid = $_GET["uid"] + 0;



// 連接資料庫
$pdo = db_open();

// 寫出 SQL 語法
$sqlstr = "SELECT * FROM book WHERE uid=:uid ";

$sth = $pdo->prepare($sqlstr);
$sth->bindParam(':uid', $uid, PDO::PARAM_INT);


// 執行SQL及處理結果
if($sth->execute())
{
   // 成功執行 query 指令
   if($row = $sth->fetch(PDO::FETCH_ASSOC))
   {
      $bookcode = convert_to_html($row['bookcode']);
      $bookname = convert_to_html($row['bookname']);
      $author = convert_to_html($row['author']);
      $publish = convert_to_html($row['publish']);
      $pub_date = convert_to_html($row['pub_date']);
      $price = convert_to_html($row['price']);
      $picture = convert_to_html($row['picture']);
      $remark = convert_to_html($row['remark']);


      
      $data = <<< HEREDOC
<form action="edit_save.php" method="post">
    <table>
        <tr><th>書籍代碼</th><td><input type="text" name="bookcode" value="{$bookcode}" /></td></tr>
        <tr><th>書籍名稱</th><td><input type="text" name="bookname" value="{$bookname}" /></td></tr>
        <tr><th>作者</th><td><input type="text" name="author" value="{$author}" /></td></tr>
        <tr><th>出版社</th><td><input type="text" name="publish" value="{$publish}" /></td></tr>
        <tr><th>出版日期</th><td><input type="text" name="pub_date" value="{$pub_date}" /></td></tr>
        <tr><th>售價</th><td><input type="text" name="price" value="{$price}" /></td></tr>
        <tr><th>商品圖檔</th><td><input type="text" name="picture" value="{$picture}" /></td></tr>
        <tr><th>備註欄位</th><td><input type="text" name="remark" value="{$remark}" /></td></tr>

    </table>
    <p>
    <input type="hidden" name="uid" value="{$uid}">
    <input type="submit" value="送出">
    </p>
</form>
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
   $data = error_message('edit');
}



$html = <<< HEREDOC
<h2>修改資料</h2>
<button onclick="history.back();">返回</button>
{$data}
HEREDOC;

include 'pagemake.php';
pagemake($html, '');
?>