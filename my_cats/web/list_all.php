<?php
include 'config.php';
include 'utility.php';



// 連接資料庫
$pdo = db_open();

// 寫出 SQL 語法
$sqlstr = "SELECT * FROM cats ";

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
      $code = convert_to_html($row['code']);
      $title = convert_to_html($row['title']);
      $prompt = convert_to_html($row['prompt']);
      $picture = convert_to_html($row['picture']);
      $maintext = convert_to_html($row['maintext']);
      $remark = convert_to_html($row['remark']);

    
      $data .= <<< HEREDOC

            <!-- Post -->
              <article class="post">
                <header>
                  <div class="title">
                    <h2><a href="single-one.html">{$title}</a></h2>
                    <p>about cat's everything</p>
                  </div>
                  <div class="meta">
                    <time class="published" datetime="2018-07-08">July 8, 2018</time>
                    <a href="#" class="author"><span class="name">knockknockcat</span><img src="img/avatar.jpg" alt="" /></a>
                  </div>
                </header>
                <a href="single-one.html" class="image featured"><img src="img/{$picture}" alt="" /></a>
                <p>{$prompt}</p>
                <footer>
                  <ul class="actions">
                    <li><a href="single-one.html" class="button large">閱讀更多...</a></li>
                  </ul>
                  
                  </ul>
                </footer>
              </article>
HEREDOC;
   }
   
}
else
{
   // 無法執行 query 指令時
   $html = error_message('list_all');
}




$html = <<< HEREDOC
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Knock Cat～敲敲貓～</title>
  <link rel="shortcut icon" href="img/icon.png" type="image/x-icon">
  

  
  <!-- 首頁動畫 -->
  <link rel="stylesheet" href="css/normalize.css">
  <!-- <link rel="stylesheet" type="text/css" href="css/htmleaf-demo.css">
  <link rel="stylesheet" href="css/main.css">
   -->
  


  <!-- 響應式網站語法必須要貼-->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">          

   <!-- bootstrap連結 -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.css" > 

<!-- 我寫的css -->
<link rel="stylesheet" type="text/css" href="css/first.css">
</head>
<body>
<!-- 表頭 --> 
<nav class="navbar navbar-expand-lg navbar-light" style="background-image: url('img/bg.jpg');">
  <a class="navbar-brand" href="index.html">
    <img src="img/logo.png" width="" height="" alt="" class="mx-1">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item mx-2">
        <a class="nav-link" href="#">我的專屬貓間</a>
      </li>
      <li class="nav-item mx-2">
        <a class="nav-link" href="#">貓咪大小事</a>
      </li>
      <li class="nav-item dropdown mx-2">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          貓奴買什麼
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
     <li class="nav-item mx-2">
        <a class="nav-link" href="#">關於我們</a>
      </li>
      <li class="nav-item mx-2">
        <a class="nav-link" href="contactus.html">聯絡我們</a>
      </li>
    </ul>
     <div class="form-inline">
          <div class="float-right">
          <a href="https://www.facebook.com" target="_blank">
          <svg img style="margin-right: 10px;" width="9" color="#838383" aria-hidden="true" data-prefix="fab" data-icon="facebook-f" class="svg-inline--fa fa-facebook-f fa-w-2" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 264 512"><path fill="currentColor" d="M76.7 512V283H0v-91h76.7v-71.7C76.7 42.4 124.3 0 193.8 0c33.3 0 61.9 2.5 70.2 3.6V85h-48.2c-37.8 0-45.1 18-45.1 44.3V192H256l-11.7 91h-73.6v229"></path></svg>
          </a>
          </div>
          <div class="form-inline">
          <a href="https://www.facebook.com" target="_blank">
            <svg img style="margin-right: 10px;" width="13" color="#838383" aria-hidden="true" data-prefix="fas" data-icon="heart" class="svg-inline--fa fa-heart fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"></path></svg>
          </a>
          </div>
          <div class="form-inline">
          <a href="https://www.facebook.com" target="_blank">
            <svg img style="margin-right: 10px;" width="13" color="#838383" aria-hidden="true" data-prefix="fas" data-icon="user" class="svg-inline--fa fa-user fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"></path></svg>
          </a>
          </div>
          
  </div>
</nav>  

<!-- blog 語法開始--> 

<div id="wrapper">

        <!-- Main -->
          <div id="main">

{$data}
            
            <!-- Pagination -->
              <ul class="actions pagination">
                <li><a href="" class="disabled button large previous">上一頁</a></li>
                <li><a href="#" class="button large next">下一頁</a></li>
              </ul>

          </div>

        <!-- Sidebar -->
          <section id="sidebar">

            <!-- Intro -->
              <section id="intro">
                <a href="#" class="logo"><img src="img/catfoot.png" alt="" /></a>
                <header>
                  <h2>敲敲貓</h2>
                  <p>關於貓咪大小事的紀錄</p>
                </header>
              </section>

            <!-- Mini Posts -->
              <section>
                <div class="mini-posts">

                  <!-- Mini Post -->
                    <article class="mini-post">
                      <header>
                        <h3><a href="single-one.html">怎麼幫貓咪洗澡?</a></h3>
                        <time class="published" datetime="2018-07-08">July 8, 2018</time>
                        <a href="#" class="author"><img src="img/avatar.jpg" alt="" /></a>
                      </header>
                      <a href="single-one.html" class="image"><img src="img/pic04.jpg" alt="" /></a>
                    </article>

                  <!-- Mini Post -->
                    <article class="mini-post">
                      <header>
                        <h3><a href="single-two.html">準備養貓前的沉思:生活上的改變and犧牲?</a></h3>
                        <time class="published" datetime="2018-07-07">July 07, 2018</time>
                        <a href="#" class="author"><img src="img/avatar.jpg" alt="" /></a>
                      </header>
                      <a href="single-two.html" class="image"><img src="img/pic05.jpg" alt="" /></a>
                    </article>

                  <!-- Mini Post -->
                    <article class="mini-post">
                      <header>
                        <h3><a href="single-three.html">貓咪長香菇(貓黴菌)</a></h3>
                        <time class="published" datetime="2018-07-01">July 01, 2018</time>
                        <a href="#" class="author"><img src="img/avatar.jpg" alt="" /></a>
                      </header>
                      <a href="single-three.html" class="image"><img src="img/pic06.jpg" alt="" /></a>
                    </article>

                </div>
              </section>

            

            <!-- About -->
              <section class="blurb">
                <h2>About關於...</h2>
                <p>這邊紀錄一些站主有關貓咪的文章這邊紀錄一些站主有關貓咪的文章這邊紀錄一些站主有關貓咪的文章這邊紀錄一些站主有關貓咪的文章</p>
                
              </section>

            <!-- Footer -->
              
          </section>

      </div>


 




<footer>
  <div id="bg">
    <p>© Copyright 2018 knockknockcat - All rights reserved.敲敲貓</p>
 </div>
</footer>
<!-- Bootstrap表頭語法連結 -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<!-- 輪播動畫js -->
<script src="js/jquery.min.js" type="text/javascript"></script>
<script>window.jQuery || document.write('<script src="js/jquery-1.11.0.min.js"><\/script>')</script>
<script src="js/main.js"></script>
</body>
</html>
HEREDOC;

echo $html;

?>