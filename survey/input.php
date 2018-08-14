<?php


/*
$str_mm = '    
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
        <option>6</option>
        <option>7</option>
        <option>8</option>
        <option>9</option>
        <option>10</option>
        <option>11</option>
        <option>12</option>
';
*/

// 處理月
$str_mm = '';
for($i=1; $i<=12; $i++)
{
   $str_mm .= '<option>' . $i . '</option>' . "\n";
}


// 處理日
$str_dd = '';
for($i=1; $i<=31; $i++)
{
   $str_dd .= '<option>' . $i . '</option>';
}


// 處理年
$str_yy = '';
for($i=1901; $i<=2018; $i++)
{
   $str_yy .= '<option>' . $i . '</option>';
}


// 處理年
$str_yy = '';
$year_begin = 1901;
$year_end = date('Y', time());
for($i=$year_begin; $i<=$year_end; $i++)
{
   $str_yy .= '<option>' . $i . '</option>';
}


// 處理年
$str_yy = '';
$year_begin = 1901;
$year_end = date('Y', time());
for($i=$year_end; $i>=$year_begin; $i--)
{
   $str_yy .= '<option>' . $i . '</option>';
}





$html = <<< HEREDOC
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Survey</title>
</head>

<body>
<h1>問卷調查</h1>
<p>請輸入你的個人基本資料</p>

<form method="post" action="show.php">

  <p>姓名：<input type="text" name="nickname"></p>

  <p>密碼：<input type="password" name="password"></p>

  <p>性別：
    <input type="radio" name="gender" value="M">男
    <input type="radio" name="gender" value="F">女
    <input type="radio" name="gender" value="X" checked="checked">未知
  </p>

  <p>血型：
    <input type="radio" name="blood" value="A">A
    <input type="radio" name="blood" value="B">B
    <input type="radio" name="blood" value="O">O
    <input type="radio" name="blood" value="AB">AB
    <input type="radio" name="blood" value="X" checked="checked">未知
  </p>

  <p>生日：
    <select name="birth_yy">
{$str_yy}
    </select>
    年 
    <select name="birth_mm">
{$str_mm}
    </select>
    月
    <select name="birth_dd">
{$str_dd}
    </select>
    日
  </p>

  <p>是否已婚：<input type="checkbox" name="marriage">(已婚請勾選)</p>

  <p>休閒興趣：
    <input type="checkbox" name="hobby1" value="Y">音樂 
    <input type="checkbox" name="hobby2" value="Y">閱讀 
    <input type="checkbox" name="hobby3" value="Y">旅遊 
    <input type="checkbox" name="hobby4" value="Y">美食
  </p>

  <p>個人簡介：
    <textarea rows="6" cols="40" name="intro"></textarea>
  </p>

  <p><input type="submit" value="送出"></p>

</form>
</body>
</html>
HEREDOC;

echo $html;
?>