<?php
include 'config.php';
include 'utility.php';

$uid = $_GET["uid"] + 0;



// 連接資料庫
$pdo = db_open();

// 寫出 SQL 語法
$sqlstr = "SELECT * FROM cats WHERE uid=:uid ";

$sth = $pdo->prepare($sqlstr);
$sth->bindParam(':uid', $uid, PDO::PARAM_INT);


// 執行SQL及處理結果
if($sth->execute())
{
   // 成功執行 query 指令
   if($row = $sth->fetch(PDO::FETCH_ASSOC))
   {
      $code = convert_to_html($row['code']);
      $title = convert_to_html($row['title']);
      $prompt = convert_to_html($row['prompt']);
      $picture = convert_to_html($row['picture']);
      $maintext = convert_to_html($row['maintext']);
      $remark = convert_to_html($row['remark']);


      
      $data = <<< HEREDOC
<form action="edit_save.php" method="post">
    <table>
        <tr><th>代碼</th><td><input type="text" name="code" value="{$code}" /></td></tr>
        <tr><th>標題</th><td><input type="text" name="title" value="{$title}" /></td></tr>
        <tr><th>提示</th><td><input type="text" name="prompt" value="{$prompt}" /></td></tr>
        <tr><th>圖片</th><td><input type="text" name="picture" value="{$picture}" /></td></tr>
        <tr><th>本文</th><td><textarea name="maintext">{$maintext}</textarea></td></tr>
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