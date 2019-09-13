<?php session_start();?>

 <?php
$name=$login=$password="";
if(isset($_SESSION['customer'])){
  $name=$_SESSION['customer']['name'];
  $login=$_SESSION['customer']['login'];
  $password=$_SESSION['customer']['password'];
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>wordrandom</title>
	<link rel="stylesheet" href="styles.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="app.js"></script>
</head>
<body>
 <header>
  <div class="top">
	<p><a href="index.php">ホーム</a></p>
</div>
 </header>
 <main>
  <div class="edit">
  <h2>新規登録</h2>
 	<form action="customer-output.php" method="post">
 	<p class="form">お名前:<input type="text" name="name" value="<?php echo $name;?>"></p>
 	<p class="form">ログイン名:<input type="text" name="login" value="<?php echo $login;?>"></p>
  <p class="form">パスワード:<input type="password" name="password" value="<?php echo $password;?>"></p>
  <p><input type="submit" name="送信"></p>
 	</form>
 </div>
 </main>
</body>
</html>
