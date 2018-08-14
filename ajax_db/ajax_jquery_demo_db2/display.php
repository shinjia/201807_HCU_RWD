<?php
include 'config.php';

$uid = isset($_GET['uid']) ? $_GET['uid'] : 'xxx';

// 連接資料庫
$link = db_open();


// 寫出 SQL 語法
$sqlstr = "SELECT * FROM person WHERE uid=" . $uid;

// 執行 SQL
$result = @mysqli_query($link, $sqlstr);
if($row=mysqli_fetch_array($result))
{
   $uid      = $row['uid'];
   $username = $row['username'];
   $address  = $row['address'];
   $birthday = $row['birthday'];
   $height   = $row['height'];
   $weight   = $row['weight'];
   
   $data = <<< HEREDOC
   <table border="1">
     <tr><th>姓名</th> <td>{$username}</td></tr>
     <tr><th>地址</th> <td>{$address}</td></tr>
     <tr><th>生日</th> <td>{$birthday}</td></tr>
     <tr><th>身高</th> <td>{$height}</td></tr>
     <tr><th>體重</th> <td>{$weight}</td></tr>
   </table>
HEREDOC;
}
else
{
	 $data = '查無相關記錄！';
}


$html = <<< HEREDOC
{$data}
HEREDOC;

echo $html;
?>