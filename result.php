<?php session_start();?>
<?php
require_once(__DIR__.'/config.php');

try{
	$db=new PDO(DSN,DB_USERNAME,DB_PASSWORD);//データベース接続
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);



 }catch(PDOException $e){
     echo $e->getmessage();//エラー表示
     exit;
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
	<p><a href="edit.php">編集</a></p>
	  <p><a href="customer-input.php">
	<?php
		//ログイン状態では会員登録変更
	if(isset($_SESSION['customer'])){
	 echo '会員情報変更';
	   }else{//ログインしていない時では新規登録
         echo '新規登録';
			 }?></a></p>
	<p><a href="login.php">ログイン</a></p>
	<p><a href="logout.php">ログアウト</a></p>
    </div>
 </header>
 <main>
    <div class="container">
 	<?php
     if(!isset($_SESSION["customer"])){
     	echo '<p class="lhome">ログインが必要です！</p>';//ログイン状態でない時の画面
     	echo '<p><a href="index.php" class="rhome">ホーム</a></p>';
     }else{
     	$sql=$db->prepare('select * from subject where customer_id =? ORDER BY rand() LIMIT 1');
	     //顧客ＩＤと紐付けされているsubjectテーブルのkindカラムから1つランダムで抽出
     	$sql->execute([$_SESSION['customer']['id']]);
     	foreach ($sql as $row) {
     		echo '<p class="kind">'.$row['kind'].'</p>';
     		echo '<p><a href="index.php" class="rhome">ホーム</a></p>';
     	}
     }

 	?>
    </div>
 </main>
</body>
</html>
