<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Comment</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  
<h1>客戶意見留言</h1>

<form method="post" action="save.php">
  <p>姓名：
    <input type="text" name="nickname" />
  </p>
  <p>意見：
  	<textarea rows="6" cols="40" name="comment"></textarea>
  </p>
  <p>
    <input type="submit" value="送出" />
  </p>
</form>

</body>
</html>