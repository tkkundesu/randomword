<?php session_start();?>
<?php
require_once(__DIR__.'/config.php');

try{
	$db=new PDO(DSN,DB_USERNAME,DB_PASSWORD);//データベース接続
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
   

 }catch(PDOException $e){
     echo $e->getmessage();//例外表示
     exit;
 }
 if(isset($_SESSION["customer"])){
  $id=$_SESSION["customer"]["id"];
  $sql=$db->prepare('select * from customer where id!=? and login=?');//ログイン状態のログイン名更新時の重複チェック
  $sql->execute([$id,$_REQUEST['login']]);
}else{
  $sql=$db->prepare('select * from customer where login=?');//新規登録時のログイン名重複チェック
  $sql->execute([$_REQUEST['login']]);
}
if(empty($sql->fetch())){
  if(isset($_SESSION["customer"])){
    $sql=$db->prepare('update customer set name=?,login=?,password=? where id=?');//ログイン状態時の会員情報をデータベースへアップデート
    $sql->execute([$_REQUEST["name"],$_REQUEST["login"],$_REQUEST["password"],$id]);
    $_SESSION["customer"]=[
    'id'=>$id,'name'=>$_REQUEST['name'],'login'=>$_REQUEST['login'],//セッションに格納
    'password'=>$_REQUEST['password']];
     echo '<script>alert("お客様情報を更新しました。");</script>';
  } else {
  $sql=$db->prepare('insert into customer values(null,?,?,?)');//新規顧客情報をデータベースへ追加
  $sql->execute([$_REQUEST["name"],$_REQUEST["login"],$_REQUEST["password"]]);
   echo '<script>alert("お客様情報を登録しました。");</script>';

}
}else{
   echo '<script>alert("ログイン名がすでに使用されていますので、変更してください。");</script>';
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
 <p class="chome"><a href="index.php">ホーム</a></p>
 </main>
</body>
</html>
