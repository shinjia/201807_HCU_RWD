<?php
include "config.php";

// 接受外部表單傳入之變數
$usercode = isset($_POST["usercode"])? $_POST["usercode"] : "";
$username = isset($_POST["username"])? $_POST["username"] : "";
$address  = isset($_POST["address"]) ? $_POST["address"]  : "";
$birthday = isset($_POST["birthday"])? $_POST["birthday"] : "";
$height   = isset($_POST["height"])  ? $_POST["height"]   : 0;
$weight   = isset($_POST["weight"])  ? $_POST["weight"]   : 0;
$remark   = isset($_POST["remark"])  ? $_POST["remark"]   : "";

// 連接資料庫
@$link = mysqli_connect(DB_SERVERIP, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die(ERROR_CONNECT);
if(defined('SET_CHARACTER')) mysqli_query($link, SET_CHARACTER) or die(ERROR_CHARACTER);

// 寫出 SQL 語法
$sqlstr = "INSERT INTO person(usercode, username, address, birthday, height, weight, remark) VALUES (";
$sqlstr .= "'" . $usercode . "', ";
$sqlstr .= "'" . $username . "', ";
$sqlstr .= "'" . $address  . "', ";
$sqlstr .= "'" . $birthday . "', ";
$sqlstr .= ($height+0) . ", ";
$sqlstr .= ($weight+0) . ", "; 
$sqlstr .= "'" . $remark . "') ";  // 注意：最後一個欄位之後的符號

echo $sqlstr;

// 執行SQL及處理結果
$result = @mysqli_query($link, $sqlstr) or die(ERROR_QUERY);
if($result)
{
   $new_uid = mysqli_insert_id($link);   // 傳回剛才新增記錄的auto_increment欄位值
   $url_display = "display.php?uid=" . $new_uid;
   echo 'Success....<BR>Should redirect to next page: ' . $url_display;
   // header("Location: " . $url_display);
}
else
{
   // header("Location: error.php");
   echo 'Fail....<BR>Should redirect to error page<BR>';
   echo mysqli_error() . '<BR>' . $sqlstr;  // 此列供開發時期偵錯用，應刪除
}
?>