<?php
include 'config.php';
include 'utility.php';

// 接受外部表單傳入之變數
$uid = (isset($_POST['uid'])) ? $_POST['uid']+0 : 0;
$code = (isset($_POST['code']))  ? $_POST['code']  : '';
$title = (isset($_POST['title']))  ? $_POST['title']  : '';
$prompt = (isset($_POST['prompt']))  ? $_POST['prompt']  : '';
$picture = (isset($_POST['picture']))  ? $_POST['picture']  : '';
$maintext = (isset($_POST['maintext']))  ? $_POST['maintext']  : '';
$remark = (isset($_POST['remark']))  ? $_POST['remark']  : '';


// 連接資料庫
$pdo = db_open(); 

// 寫出 SQL 語法
$sqlstr = "UPDATE cats SET code=:code, title=:title, prompt=:prompt, picture=:picture, maintext=:maintext, remark=:remark WHERE uid=:uid " ;

$sth = $pdo->prepare($sqlstr);
$sth->bindParam(':code', $code, PDO::PARAM_STR);
$sth->bindParam(':title', $title, PDO::PARAM_STR);
$sth->bindParam(':prompt', $prompt, PDO::PARAM_STR);
$sth->bindParam(':picture', $picture, PDO::PARAM_STR);
$sth->bindParam(':maintext', $maintext, PDO::PARAM_STR);
$sth->bindParam(':remark', $remark, PDO::PARAM_STR);

$sth->bindParam(':uid', $uid, PDO::PARAM_INT);

// 執行SQL及處理結果
if($sth->execute())
{
   $url_display = 'display.php?uid=' . $uid;
   header('Location: ' . $url_display);
}
else
{
   header('Location: error.php?type=edit_save');
   echo print_r($pdo->errorInfo()) . '<br />' . $sqlstr;  // 此列供開發時期偵錯用
}
?>