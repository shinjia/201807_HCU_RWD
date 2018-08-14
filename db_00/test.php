<?php

$link = mysqli_connect('localhost', 'root', '', 'class');


$sqlstr = "DELETE FROM person WHERE height>160 ";
mysqli_query($link, $sqlstr);


mysqli_close($link);  // 關閉資料庫，可省略
echo 'ok';
?>