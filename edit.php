<?php session_start();?>
<?php
require_once(__DIR__.'/config.php');

try{
	$db=new PDO(DSN,DB_USERNAME,DB_PASSWORD);//データベースへ接続
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
   

 }catch(PDOException $e){
     echo $e->getmessage();//例外表示
     exit;
 }   
if(isset($_REQUEST['command'])){
	switch ($_REQUEST['command']) {
		case 'update':
		if(empty($_REQUEST["kind"]))//空の場合ブレイク	
	    break;
		$sql=$db->prepare('update subject set kind=? where id=?');//subjectテーブルの情報のアップデート
        $sql->execute([$_REQUEST['kind'],$_REQUEST['id']]);
	    break;
        case 'insert':
        if(empty($_REQUEST["kind"]))//空の場合ブレイク    
        break;
        $sql=$db->prepare('insert into subject values(null,?,?)');//subjectテーブルの情報の挿入
        $sql->execute([$_SESSION['customer']['id'],$_REQUEST['kind']]);
        break;
        case 'delete':
        $sql=$db->prepare('delete from subject where id=?');//subjectテーブルの情報の削除
        $sql->execute([$_REQUEST['id']]);
        break;
	}
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
    <div class="edit">
 	<?php
 	if(!isset($_SESSION["customer"])){
     	echo '<p class="kind">ログインが必要です！</p>';//ログアウト状態では非表示
     	
    }else{
    	
     	$sql=$db->prepare('select * from subject where customer_id =?');//顧客ＩＤと紐付けされているsubjectテーブルの情報を取り出す
        $sql->execute([$_SESSION['customer']['id']]);
     	
  
     foreach ($sql as $row){
     
     	 echo '<form action="edit.php" method="post">';//更新処理のフォーム
         echo '<input type="hidden" name="command" value="update">';
         echo '<input type="hidden" name="id" value="'.$row['id'].'">';
         echo '<input type="text" name="kind" value="'.$row['kind'].'">';
         echo '<input type="submit" value="更新">';
         echo '</form>';
         echo '<form action="edit.php" method="post">';//削除処理のフォーム
         echo '<input type="hidden" name="command" value="delete">';
         echo '<input type="hidden" name="id" value="'.$row['id'].'">';
         echo '<input type="submit" value="削除">';
         echo '</form>';
         echo '<br>';
    
     }
     
     	echo '<form action="edit.php" method="post">';//追加処理のフォーム
     	echo '<input type="hidden" name="command" value="insert">';
     	echo '<input type="text" name="kind">';
     	echo '<input type="submit" value="追加">';
        echo '</form>';
        
 }
 ?>
 <p><a href="index.php" class="rhome">ホーム</a></p>
 </div>
 
 </main>
</body>
</html>

