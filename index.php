<?php session_start()?>
<?php
require_once(__DIR__.'/config.php');
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
	<p><a href="edit.php">編集</a></p>
	<p><a href="customer-input.php"><?php//ログイン状態では会員登録変更
	   if(isset($_SESSION["customer"])){
  　　　　　　　　　　echo '会員登録変更';
　　　　　　　　}else{//ログインしていない時では新規登録
  　　　　　　　　　　echo '新規登録';
　　　　　　　　　}
	  ?></a></p>
	<p><a href="login.php">ログイン</a></p>
	<p><a href="logout.php">ログアウト</a></p>
	<?php
	if(isset($_SESSION['customer'])){
		echo '<p>ようこそ<span class="user-name">'.$_SESSION['customer']['name'].'</span>さん。</p>';//ログイン状態では顧客名表示
	}else{
		echo '<p>ようこそゲストさん。</p>';
	}?>
    </div>
 </header>
 <main>
 	<div class="container">
 	<h1>ワードガチャ</h1>
 	<form action="result.php" method="post">
 		<button><a href="result.php">START!!</a></button>
 	</form>
 	</div>
 </main>
</body>
</html>

