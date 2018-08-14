<?php
include 'config.php';
include 'utility.php';



// 連接資料庫
$pdo = db_open();

// 寫出 SQL 語法
$sqlstr = "SELECT * FROM cats ";

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
      $code = convert_to_html($row['code']);
      $title = convert_to_html($row['title']);
      $prompt = convert_to_html($row['prompt']);
      $picture = convert_to_html($row['picture']);
      $maintext = convert_to_html($row['maintext']);
      $remark = convert_to_html($row['remark']);

    
      $data .= <<< HEREDOC
<tr>
   <td>{$uid}</td>
   <td>{$code}</td>
   <td>{$title}</td>
   <td>{$prompt}</td>
   <td>{$picture}</td>
   <td>{$str_maintext}</td>
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
      <th>代碼</th>
      <th>標題</th>
      <th>提示</th>
      <th>圖片</th>
      <th>本文</th>
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