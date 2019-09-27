<?php session_start();?>
<?php
require_once(__DIR__.'/config.php');

  
   if(isset($_SESSION["customer"])){
    unset($_SESSION['customer']);//セッション情報アンセットによりログアウト状態にする
    echo '<script>alert("ログアウトしました。");</script>';
   
   	}else{
    echo '<script>alert("すでにログアウトされてます。");</script>';
  
   }
    
// ?>
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
  <p><a href="customer-input.php">新規登録</a></p>
  <p><a href="login.php">ログイン</a></p>
  <p><a href="logout.php">ログアウト</a></p>
  </div>
 </header>
 <main>
 <p class="greet">ご利用ありがとうございました、またきてね</p>
 <p class="oss"><a href="index.php" class="ohome">ホーム</a></p>
 </main>
</body>
</html>

