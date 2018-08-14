<?php
/*
echo '<pre>';
print_r($_POST);
echo '</pre>';
exit;
*/

// extract($_POST);
$nickname = isset($_POST['nickname']) ? $_POST['nickname'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$gender   = isset($_POST['gender'])   ? $_POST['gender']   : '';
$blood    = isset($_POST['blood'])    ? $_POST['blood']    : '';
$birth_yy = isset($_POST['birth_yy']) ? $_POST['birth_yy'] : '';
$birth_mm = isset($_POST['birth_mm']) ? $_POST['birth_mm'] : '';
$birth_dd = isset($_POST['birth_dd']) ? $_POST['birth_dd'] : '';
$marriage = isset($_POST['marriage']) ? $_POST['marriage'] : '';
$hobby1   = isset($_POST['hobby1'])   ? $_POST['hobby1']   : '';
$hobby2   = isset($_POST['hobby2'])   ? $_POST['hobby2']   : '';
$hobby3   = isset($_POST['hobby3'])   ? $_POST['hobby3']   : '';
$hobby4   = isset($_POST['hobby4'])   ? $_POST['hobby4']   : '';
$intro    = isset($_POST['intro'])    ? $_POST['intro']    : '';


// 處理姓名的狀況 (單一條件)
$str_nickname = $nickname;
if($nickname=='')
{
    $str_nickname = '無名氏';
}


// 處理性別的輸入 (雙重條件)
if( $gender=='M' )
{
    $str_gender1 = '先生';
    $str_gender2 = '男';
}
else
{
    $str_gender1 = '小姐';
    $str_gender2 = '女';
}



// 處理出生季節 (多重條件)
$m = $birth_mm;
if($m==3 || $m==4 || $m==5)
{
    $str_season = '春天';
}
elseif( ($m==6) || ($m==7) || ($m==8) )
{
    $str_season = '夏天';
}
elseif( $m>=9 && $m<=11 )
{
    $str_season = '秋天';
}
elseif( $m==12 || $m==1 || $m==2 )
{
    $str_season = '冬天';
}
else
{
    $str_season = '!!!!!不詳';  // 注意是有可能發生的
    // exit;
}




// 處理血型 (多重條件，根據一個變數的不同值進行判斷)
switch($blood)
{
    case 'A' :
    case 'a' :
        $str_blood = 'A型的你XXXXXX';	
        break;
		
    case 'B' :
        $str_blood = 'B型的你XXXXXX';	
        break;
		
    case 'O' :
        $str_blood = 'O型的你XXXXXX';	
        break;
		
    case 'AB' :
        $str_blood = 'AB型的你XXXXXX';
        break;
		
    default:
        $str_blood = '血型有誤!!!';
}


/*
$cnt = 0;
if($hobby1=='Y')
{
	$cnt += 1;
}
else
{
	$cnt += 0;
}
*/

$cnt = 0;
$cnt += ($hobby1=='Y') ? 1 : 0;
$cnt += ($hobby2=='Y') ? 1 : 0;
$cnt += ($hobby3=='Y') ? 1 : 0;
$cnt += ($hobby4=='Y') ? 1 : 0;

$str_hobby = '';  // 顯示的文字
$str_hobby .= ($hobby1=='Y') ? '音樂 ' : ' ';
$str_hobby .= ($hobby2=='Y') ? '閱讀 ' : ' ';
$str_hobby .= ($hobby3=='Y') ? '旅遊 ' : ' ';
$str_hobby .= ($hobby4=='Y') ? '美食 ' : ' ';

$str_intro = nl2br($intro);


// 若包含中文要轉成 big5，新版使用 mb_convert_encoding() 函式
$s_nickname = mb_convert_encoding($nickname, 'big5', 'UTF-8');


$data = <<< HEREDOC
{$s_nickname},{$hobby1},{$hobby2},{$hobby3},{$hobby4}

HEREDOC;


file_put_contents('data.csv', $data, FILE_APPEND);



$html = <<< HEREDOC
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Title of the document</title>
</head>

<body>
<h1>Hello World Hello</h1>
<p>{$str_nickname} {$str_gender1} 你好，已經收到您的資料，如下：</p>
<p>姓名：{$str_nickname}</p>
<p>密碼：{$password}</p>
<p>性別：{$str_gender2}</p>
<p>血型：{$blood}...{$str_blood}</p>
<p>生日：{$birth_yy} 年 {$birth_mm} 月 {$birth_dd} 日....出生季節{$str_season}</p>
<p>已婚：{$marriage}</p>
<p>興趣：{$hobby1}, {$hobby2}, {$hobby3}, {$hobby4}....已勾選{$cnt}項，項目是：{$str_hobby} </p>
<p>介紹：{$str_intro}</p>
</body>
</html>
HEREDOC;

echo $html;
?>