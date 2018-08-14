<?php
include 'config.php';
include 'utility.php';

// 接受外部表單傳入之變數
$uid = (isset($_POST['uid'])) ? $_POST['uid']+0 : 0;
$bookcode = (isset($_POST['bookcode']))  ? $_POST['bookcode']  : '';
$bookname = (isset($_POST['bookname']))  ? $_POST['bookname']  : '';
$author = (isset($_POST['author']))  ? $_POST['author']  : '';
$publish = (isset($_POST['publish']))  ? $_POST['publish']  : '';
$pub_date = (isset($_POST['pub_date']))  ? $_POST['pub_date']  : '';
$price = (isset($_POST['price']))  ? $_POST['price']  : '';
$picture = (isset($_POST['picture']))  ? $_POST['picture']  : '';
$remark = (isset($_POST['remark']))  ? $_POST['remark']  : '';


// 連接資料庫
$pdo = db_open(); 

// 寫出 SQL 語法
$sqlstr = "UPDATE book SET bookcode=:bookcode, bookname=:bookname, author=:author, publish=:publish, pub_date=:pub_date, price=:price, picture=:picture, remark=:remark WHERE uid=:uid " ;

$sth = $pdo->prepare($sqlstr);
$sth->bindParam(':bookcode', $bookcode, PDO::PARAM_STR);
$sth->bindParam(':bookname', $bookname, PDO::PARAM_STR);
$sth->bindParam(':author', $author, PDO::PARAM_STR);
$sth->bindParam(':publish', $publish, PDO::PARAM_STR);
$sth->bindParam(':pub_date', $pub_date, PDO::PARAM_STR);
$sth->bindParam(':price', $price, PDO::PARAM_INT);
$sth->bindParam(':picture', $picture, PDO::PARAM_STR);
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