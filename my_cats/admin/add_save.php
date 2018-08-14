<?php
include 'config.php';
include 'utility.php';

// 接受外部表單傳入之變數
$code = (isset($_POST['code']))  ? $_POST['code']  : '';
$title = (isset($_POST['title']))  ? $_POST['title']  : '';
$prompt = (isset($_POST['prompt']))  ? $_POST['prompt']  : '';
$picture = (isset($_POST['picture']))  ? $_POST['picture']  : '';
$maintext = (isset($_POST['maintext']))  ? $_POST['maintext']  : '';
$remark = (isset($_POST['remark']))  ? $_POST['remark']  : '';


// 連接資料庫
$pdo = db_open();

// 寫出 SQL 語法
$sqlstr = "INSERT INTO cats(code, title, prompt, picture, maintext, remark) VALUES (:code, :title, :prompt, :picture, :maintext, :remark)";

$sth = $pdo->prepare($sqlstr);
$sth->bindParam(':code', $code, PDO::PARAM_STR);
$sth->bindParam(':title', $title, PDO::PARAM_STR);
$sth->bindParam(':prompt', $prompt, PDO::PARAM_STR);
$sth->bindParam(':picture', $picture, PDO::PARAM_STR);
$sth->bindParam(':maintext', $maintext, PDO::PARAM_STR);
$sth->bindParam(':remark', $remark, PDO::PARAM_STR);


// 執行SQL及處理結果
if($sth->execute())
{
   $new_uid = $pdo->lastInsertId();    // 傳回剛才新增記錄的 auto_increment 的欄位值
   $url_display = 'display.php?uid=' . $new_uid;
   header('Location: ' . $url_display);
}
else
{
   header('Location: error.php?type=add_save');
   echo print_r($pdo->errorInfo()) . '<br />' . $sqlstr; exit;  // 此列供開發時期偵錯用
}
?>