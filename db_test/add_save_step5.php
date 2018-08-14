<?php
include 'config.php';

if(!isset($_POST['username')) die('Cannot execute this program directly.');


// 接受外部表單傳入之變數
$usercode = isset($_POST['usercode'])? $_POST['usercode'] : '';
$username = isset($_POST['username'])? $_POST['username'] : '';
$address  = isset($_POST['address']) ? $_POST['address']  : '';
$birthday = isset($_POST['birthday'])? $_POST['birthday'] : '';
$height   = isset($_POST['height'])  ? $_POST['height']   : 0;
$weight   = isset($_POST['weight'])  ? $_POST['weight']   : 0;
$remark   = isset($_POST['remark'])  ? $_POST['remark']   : '';

// 連接資料庫
$link = db_open();

$sqlstr = "INSERT INTO person(usercode, username, address, birthday, height, weight, remark) 
           VALUES('$usercode', '$username', '$address', '$birthday', $height, $weight, '$remark') ";


// 執行SQL
$result = @mysqli_query($link, $sqlstr) or die(ERROR_QUERY);
if($result)
{
   echo 'Success...';
}
else
{
   echo 'Fail...<br />';
   echo mysqli_error($link) . '<br />' . $sqlstr;  // 偵錯用
}

db_close($link);
?>