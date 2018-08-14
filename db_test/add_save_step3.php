<?php
include 'config.php';

// 連接資料庫
$link = @mysqli_connect(DB_SERVERIP, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die(ERROR_CONNECT);
if(defined('SET_CHARACTER')) mysqli_query($link, SET_CHARACTER) or die(ERROR_CHARACTER);

// 寫出 SQL 語法 
$sqlstr = "INSERT INTO person(usercode, username, address, birthday, height, weight, remark) 
           VALUES('103', 'Candy', 'Kaohsiung', '2010-5-2', '165', '65', 'ok') ";

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
?>