<?php



$html = <<< HEREDOC
<button onclick="history.back();">返回</button>
<h2>新增資料</h2>
<form action="add_save.php" method="post">
<table>
    <tr><th>書籍代碼</th><td><input type="text" name="bookcode" value="" /></td></tr>
    <tr><th>書籍名稱</th><td><input type="text" name="bookname" value="" /></td></tr>
    <tr><th>作者</th><td><input type="text" name="author" value="" /></td></tr>
    <tr><th>出版社</th><td><input type="text" name="publish" value="" /></td></tr>
    <tr><th>出版日期</th><td><input type="text" name="pub_date" value="" /></td></tr>
    <tr><th>售價</th><td><input type="text" name="price" value="" /></td></tr>
    <tr><th>商品圖檔</th><td><input type="text" name="picture" value="" /></td></tr>
    <tr><th>備註欄位</th><td><input type="text" name="remark" value="" /></td></tr>

</table>
<p><input type="submit" value="新增"></p>
</form>
HEREDOC;

include 'pagemake.php';
pagemake($html, '');
?>