<?php session_start();?>
<?php
require_once(__DIR__.'/config.php');

try{
	$db=new PDO(DSN,DB_USERNAME,DB_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
   

 }catch(PDOException $e){
     echo $e->getmessage();
     exit;
 } 
   if($_SERVER['REQUEST_METHOD']==='POST'){
   	unset($_SESSION["customer"]);
   	$sql=$db->prepare('select * from customer where login=? and password=?');
   	$sql->execute([$_REQUEST["login"],$_REQUEST["password"]]);
   	foreach ($sql as $row) {
   		$_SESSION["customer"]=[
        'id'=>$row["id"],'name'=>$row["name"],'login'=>$row["login"],'password'=>$row["password"]
   		];
   	}
   if(isset($_SESSION["customer"])){
   	header('Location:index.php');exit();
   	}else{
    echo '<script>alert("ログイン名またはパスワードが違います。");</script>';
   }
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
	<p><a href="index.php" class="lhome">ホーム</a></p>
  </div>
 </header>
 <main>
  <div class="edit">
 	<form action="login.php" method="post">
 	<p class="form">ログイン:<input type="text" name="login"></p>
 	<p class="form">パスワード:<input type="password" name="password"></p>
  <input type="submit" value="送信">
 	</form>
 </div>
 </main>
</body>
</html>

