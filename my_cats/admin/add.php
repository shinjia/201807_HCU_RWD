<?php



$html = <<< HEREDOC
<button onclick="history.back();">返回</button>
<h2>新增資料</h2>
<form action="add_save.php" method="post">
<table>
    <tr><th>代碼</th><td><input type="text" name="code" value="" /></td></tr>
    <tr><th>標題</th><td><input type="text" name="title" value="" /></td></tr>
    <tr><th>提示</th><td><input type="text" name="prompt" value="" /></td></tr>
    <tr><th>圖片</th><td><input type="text" name="picture" value="" /></td></tr>
    <tr><th>本文</th><td><textarea name="maintext"></textarea></td></tr>
    <tr><th>備註欄位</th><td><input type="text" name="remark" value="" /></td></tr>

</table>
<p><input type="submit" value="新增"></p>
</form>
HEREDOC;

include 'pagemake.php';
pagemake($html, '');
?>