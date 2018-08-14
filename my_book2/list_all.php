<?php
include 'config.php';
include 'utility.php';



// 連接資料庫
$pdo = db_open();

// 寫出 SQL 語法
$sqlstr = "SELECT * FROM book ";

$sth = $pdo->prepare($sqlstr);

// 執行SQL及處理結果
if($sth->execute())
{
   // 成功執行 query 指令
   $total_rec = $sth->rowCount();
   $data = '';
   while($row = $sth->fetch(PDO::FETCH_ASSOC))
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

    
      $data .= <<< HEREDOC
<tr>
   <td>{$uid}</td>
   <td>{$bookcode}</td>
   <td>{$bookname}</td>
   <td>{$author}</td>
   <td>{$publish}</td>
   <td>{$pub_date}</td>
   <td>{$price}</td>
   <td>{$picture}</td>
   <td>{$remark}</td>

   <td><a href="display.php?uid={$uid}">詳細</a></td>
   <td><a href="edit.php?uid={$uid}">修改</a></td>
   <td><a href="delete.php?uid={$uid}" onClick="return confirm('確定要刪除嗎？');">刪除</a></td>
</tr>
HEREDOC;
   }
   
   $html = <<< HEREDOC
<h2 align="center">共有 {$total_rec} 筆記錄</h2>
<table border="1" align="center">
   <tr>
      <th>序號</th>
      <th>書籍代碼</th>
      <th>書籍名稱</th>
      <th>作者</th>
      <th>出版社</th>
      <th>出版日期</th>
      <th>售價</th>
      <th>商品圖檔</th>
      <th>備註欄位</th>

      <th colspan="3" align="center"><a href="add.php">新增記錄</a></th>
   </tr>
   {$data}
</table>
HEREDOC;
}
else
{
   // 無法執行 query 指令時
   $html = error_message('list_all');
}


include 'pagemake.php';
pagemake($html, '');
?>