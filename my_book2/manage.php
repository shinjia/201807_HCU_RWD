<?php
include 'config.php';
include 'utility.php';

$op  = isset($_GET['op']) ? $_GET['op'] : 'HOME'; 

$uid = (isset($_POST['uid'])) ? $_POST['uid']+0 : (isset($_GET['uid'])?$_GET['uid']+0:'');

$code = isset($_GET['code']) ? $_GET['code'] : '';
$page = isset($_GET['page']) ? $_GET['page'] : 1;   // 目前的頁碼

$numpp = 15;

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

switch($op)
{
   case 'LIST_PAGE' :
        $url_page = '?op=LIST_PAGE';

        // 取得分頁所需之資訊 (總筆數、總頁數、擷取記錄之起始位置)
        $sqlstr = "SELECT count(*) as total_rec FROM book ";
        $sth = $pdo->query($sqlstr);
        if($row = $sth->fetch(PDO::FETCH_ASSOC))
        {
           $total_rec = $row["total_rec"];
        }
        $total_page = ceil($total_rec / $numpp);  // 計算總頁數
        $tmp_start = ($page-1) * $numpp;  // 從第幾筆記錄開始抓取資料
        
        // 寫出 SQL 語法
        $sqlstr = "SELECT * FROM book ";
        $sqlstr .= " LIMIT " . $tmp_start . "," . $numpp;
        
        
        $sth = $pdo->prepare($sqlstr);
        
        // 執行SQL及處理結果
        if($sth->execute())
        {
           // 成功執行 query 指令
           $total_rec = $sth->rowCount();
           $data = '';
           while($row = $sth->fetch(PDO::FETCH_ASSOC))
           {
              $uid = $row['uid'];
      $bookcode = convert_to_html($row['bookcode']);
      $bookname = convert_to_html($row['bookname']);
      $author = convert_to_html($row['author']);
      $publish = convert_to_html($row['publish']);
      $pub_date = convert_to_html($row['pub_date']);
      $price = convert_to_html($row['price']);
      $picture = convert_to_html($row['picture']);
      $remark = convert_to_html($row['remark']);


           
           $data .= <<< HEREDOC
<tr>
   <td>{$uid}</td>
   <td>{$bookcode}</td>
   <td>{$bookname}</td>
   <td>{$author}</td>
   <td>{$publish}</td>
   <td>{$pub_date}</td>
   <td>{$price}</td>
   <td>{$picture}</td>
   <td>{$remark}</td>

    <td><a href="?op=DISPLAY&uid=$uid">詳細</a></td>
    <td><a href="?op=EDIT&uid=$uid">修改</a></td>
    <td><a href="?op=DELETE&uid=$uid" onClick="return confirm('確定要刪除嗎？');">刪除</a></td>
</tr>
HEREDOC;
            }
        
        // ------ 分頁處理開始 -------------------------------------
        // 處理分頁之超連結：上一頁、下一頁、第一首、最後頁
        $lnk_pageprev = '?op=LIST_PAGE&page=' . (($page==1)?(1):($page-1));
        $lnk_pagenext = '?op=LIST_PAGE&page=' . (($page==$total_page)?($total_page):($page+1));
        $lnk_pagehead = '?op=LIST_PAGE&page=1';
        $lnk_pagelast = '?op=LIST_PAGE&page=' . $total_page;
        
        // 處理各頁之超連結：列出所有頁數 (暫未用到，保留供參考)
        $lnk_pagelist = "";
        for($i=1; $i<=$page-1; $i++)
        { $lnk_pagelist .= '<a href="?op=LIST_PAGE&page='.$i.'">'.$i.'</a> '; }
        $lnk_pagelist .= '[' . $i . ']';
        for($i=$page+1; $i<=$total_page; $i++)
        { $lnk_pagelist .= '<a href="?op=LIST_PAGE&page='.$i.'">'.$i.'</a> '; }
        
        // 處理各頁之超連結：下拉式跳頁選單
        $lnk_pagegoto  = '<form method="GET" action="" style="margin:0;">';
        $lnk_pagegoto .= '<input type="hidden" name="op" value="LIST_PAGE">';
        $lnk_pagegoto .= '<select name="page" onChange="submit();">';
        for($i=1; $i<=$total_page; $i++)
        {
           $is_current = (($i-$page)==0) ? ' selected' : '';
           $lnk_pagegoto .= '<option' . $is_current . '>' . $i . '</option>';
        }
        $lnk_pagegoto .= '</select>';
        $lnk_pagegoto .= '</form>';
        
        // 將各種超連結組合成HTML顯示畫面
        $ihc_navigator  = <<< HEREDOC
<table border="0" align="center">
    <tr>
        <td>頁數：{$page} / {$total_page} &nbsp;&nbsp;&nbsp;</td>
        <td>
        <a href="{$lnk_pagehead}">第一頁</a> 
        <a href="{$lnk_pageprev}">上一頁</a> 
        <a href="{$lnk_pagenext}">下一頁</a> 
        <a href="{$lnk_pagelast}">最末頁</a> &nbsp;&nbsp;
        </td>
        <td>移至頁數：</td>
        <td>{$lnk_pagegoto}</td>
    </tr>
</table>
HEREDOC;
        // ------ 分頁處理結束 -------------------------------------
        
        // 網頁輸出        
        $html = <<< HEREDOC
<h2 align="center">資料列表，共有 {$total_rec} 筆記錄</h2>
{$ihc_navigator}
<p></p>
<table border="1" align="center">   
    <tr>
      <th>序號</th>
      <th>書籍代碼</th>
      <th>書籍名稱</th>
      <th>作者</th>
      <th>出版社</th>
      <th>出版日期</th>
      <th>售價</th>
      <th>商品圖檔</th>
      <th>備註欄位</th>

        <th colspan="3" align="center">[<a href="?op=ADD">新增記錄</a>]</th>
    </tr>
{$data}
</table>
HEREDOC;
        }
        else
        {
           // 無法執行 query 指令時
           $html = error_message('list_page');
        }
        
        break;
        
        
        
   case 'ADD' :



        $html = <<< HEREDOC
<button onclick="history.back();">返回</button>
<h2>新增資料</h2>
<form action="?op=ADD_SAVE" method="post">
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
        break;
        
       
        
   case 'ADD_SAVE' :
        // 寫出 SQL 語法
       $sqlstr = "INSERT INTO book(bookcode, bookname, author, publish, pub_date, price, picture, remark) VALUES (:bookcode, :bookname, :author, :publish, :pub_date, :price, :picture, :remark)";
       
        $sth = $pdo->prepare($sqlstr);
$sth->bindParam(':bookcode', $bookcode, PDO::PARAM_STR);
$sth->bindParam(':bookname', $bookname, PDO::PARAM_STR);
$sth->bindParam(':author', $author, PDO::PARAM_STR);
$sth->bindParam(':publish', $publish, PDO::PARAM_STR);
$sth->bindParam(':pub_date', $pub_date, PDO::PARAM_STR);
$sth->bindParam(':price', $price, PDO::PARAM_INT);
$sth->bindParam(':picture', $picture, PDO::PARAM_STR);
$sth->bindParam(':remark', $remark, PDO::PARAM_STR);

        
        // 執行SQL及處理結果
        if($sth->execute())
        {
           $new_uid = $pdo->lastInsertId();    // 傳回剛才新增記錄的 auto_increment 的欄位值
           $url_display = '?op=DISPLAY&uid=' . $new_uid;
           header('Location: ' . $url_display);
        }
        else
        {
           header('Location: ?op=ERROR&type=add_save');
           echo print_r($pdo->errorInfo()) . '<br />' . $sqlstr; exit;  // 此列供開發時期偵錯用
        }
        break;
       
       
        
   case 'DISPLAY' :
        $sqlstr = "SELECT * FROM book WHERE uid=:uid ";
        
        $sth = $pdo->prepare($sqlstr);
        $sth->bindParam(':uid', $uid, PDO::PARAM_INT);

        // 執行 SQL
        if($sth->execute())
        {
           // 成功執行 query 指令
           if($row = $sth->fetch(PDO::FETCH_ASSOC))
           {
              $uid = $row['uid'];
      $bookcode = convert_to_html($row['bookcode']);
      $bookname = convert_to_html($row['bookname']);
      $author = convert_to_html($row['author']);
      $publish = convert_to_html($row['publish']);
      $pub_date = convert_to_html($row['pub_date']);
      $price = convert_to_html($row['price']);
      $picture = convert_to_html($row['picture']);
      $remark = convert_to_html($row['remark']);


           $data = <<< HEREDOC
<table>
   <tr><th>書籍代碼</th><td>{$bookcode}</td></tr>
   <tr><th>書籍名稱</th><td>{$bookname}</td></tr>
   <tr><th>作者</th><td>{$author}</td></tr>
   <tr><th>出版社</th><td>{$publish}</td></tr>
   <tr><th>出版日期</th><td>{$pub_date}</td></tr>
   <tr><th>售價</th><td>{$price}</td></tr>
   <tr><th>商品圖檔</th><td>{$picture}</td></tr>
   <tr><th>備註欄位</th><td>{$remark}</td></tr>

</table>
HEREDOC;
           }
           else
           {
         	   $data = '查不到相關記錄！';
           }
        }
        else
        {
           // 無法執行 query 指令時
           $data = error_message('display');
        }
        
        $html = <<< HEREDOC
<button onclick="location.href='?op=LIST_PAGE';">返回列表</button>
<h2>詳細資料</h2>
{$data}
HEREDOC;
        break;
        
        
   case 'EDIT' :
        $sqlstr = "SELECT * FROM book WHERE uid=:uid ";
        
        $sth = $pdo->prepare($sqlstr);
        $sth->bindParam(':uid', $uid, PDO::PARAM_INT);

        // 執行SQL及處理結果
        if($sth->execute())
        {
           // 成功執行 query 指令
           if($row = $sth->fetch(PDO::FETCH_ASSOC))
           {
      $bookcode = convert_to_html($row['bookcode']);
      $bookname = convert_to_html($row['bookname']);
      $author = convert_to_html($row['author']);
      $publish = convert_to_html($row['publish']);
      $pub_date = convert_to_html($row['pub_date']);
      $price = convert_to_html($row['price']);
      $picture = convert_to_html($row['picture']);
      $remark = convert_to_html($row['remark']);


              
              $data = <<< HEREDOC
<form action="?op=EDIT_SAVE" method="post">
    <table>
            <tr><th>書籍代碼</th><td><input type="text" name="bookcode" value="{$bookcode}" /></td></tr>
        <tr><th>書籍名稱</th><td><input type="text" name="bookname" value="{$bookname}" /></td></tr>
        <tr><th>作者</th><td><input type="text" name="author" value="{$author}" /></td></tr>
        <tr><th>出版社</th><td><input type="text" name="publish" value="{$publish}" /></td></tr>
        <tr><th>出版日期</th><td><input type="text" name="pub_date" value="{$pub_date}" /></td></tr>
        <tr><th>售價</th><td><input type="text" name="price" value="{$price}" /></td></tr>
        <tr><th>商品圖檔</th><td><input type="text" name="picture" value="{$picture}" /></td></tr>
        <tr><th>備註欄位</th><td><input type="text" name="remark" value="{$remark}" /></td></tr>

    </table>
    <p>
    <input type="hidden" name="uid" value="{$uid}">
    <input type="submit" value="送出">
    </p>
</form>
HEREDOC;
           }
           else
           {
         	   $data = '查不到相關記錄！';
           }
        }
        else
        {
           // 無法執行 query 指令時
           $data = error_message('edit');
        }

        $html = <<< HEREDOC
<button onclick="history.back();">返回</button>
<h2>修改資料</h2>
{$data}
HEREDOC;
        break;
        
        
        
   case 'EDIT_SAVE' :
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
           $url_display = '?op=DISPLAY&uid=' . $uid;
           header('Location: ' . $url_display);
        }
        else
        {
           header('Location: ?op=ERROR&type=edit_save');
           echo print_r($pdo->errorInfo()) . '<br />' . $sqlstr;  // 此列供開發時期偵錯用
        }
        break;
        
        

   case 'DELETE' :
        $sqlstr = "DELETE FROM book WHERE uid=:uid ";
        
        $sth = $pdo->prepare($sqlstr);
        $sth->bindParam(':uid', $uid, PDO::PARAM_INT);
        
        // 執行SQL及處理結果
        if($sth->execute())
        {
           $refer = $_SERVER['HTTP_REFERER'];  // 呼叫此程式之前頁
           header('Location: ' . $refer);
        }
        else
        {
           header('Location: ?op=ERROR&type=delete');
           echo print_r($pdo->errorInfo()) . '<br />' . $sqlstr;  // 此列供開發時期偵錯用
        }
        break;



   case 'ERROR' :
        $type = isset($_GET['type']) ? $_GET['type'] : 'default';
        
        $html = error_message($type);
        break;
        
        

   case 'PAGE' :
        $path = 'data/';   // 存放網頁內容的資料夾
        $filename = $path . $code . '.html';  // 規定副檔案為 .html
        
        if (!file_exists($filename))
        {
        	// 找不到檔案時的顯示訊息
            $html = error_message('page', ('錯誤：傳遞參數有誤。檔案『' . $filename . '』不存在！</p>'));
        }
        else
        {
            $html = join ('', file($filename));   // 讀取檔案內容並組成文字串
        } 
        break;


        
   case 'HOME' : 
        $html = '<p><br /><br /><br />Welcome...資料管理系統<br /><br /><br /><br /></p>';
        break;
   
   
   
   default :
        $html = '<p><br /><br /><br />Welcome...資料管理系統<br /><br /><br /><br /></p>';
     
}

$pdo = null;


include 'pagemake.php';
pagemake($html, '');
?>