<?php


$name = '陳信嘉';
$birth = 1967;
$email = 'shinjia168@gmail.com';
$photo = 'images/head1.jpg';
$page = 'http://www.facebook.com/whatmake';


/*
$name = '阮今天';
$birth = 1976;
$email = 'xxxxx@gmail.com';
$photo = 'images/head2.jpg';
$page =  'http:/xxx/xxxx.xxx';
*/

$back = 'images/bg' . mt_rand(1,4) . '.jpg';

$data = 'Email:' . $email;
$data .= '<br />Web:' . $page;


$age = $birth - 1911;





$html = <<< HEREDOC
<!DOCTYPE html>
<html lang="en" >

<head>
<meta charset="UTF-8">
<title>business_card_test</title>
  
<style>

#card {
  position: relative;
  top:50px;
  margin: 0 auto;
  width:450px;
  height:270px;
  background-color:#AA8888;
  background-image: url({$back});
}

#username{
  position: absolute;
  font-size: 40px;
  top:80px;
  left:50px;
}

#photo {
  position: absolute;
  top:20px;
  left:230px;
  width:180px;
  height:180px;
}

#data {
  position: absolute;
  top:220px;
  left:30px;
  
}
</style>
  
</head>

<body>

<div id="card">

  <div id="username">{$name}</div>
  <div id="photo"><img src="{$photo}"></div>
  <div id="data">
   {$data}
  </div>

</div>
    
</body>
</html>
HEREDOC;

echo $html;
?>