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
if(isset($_REQUEST['command'])){
	switch ($_REQUEST['command']) {
		case 'update':
		if(empty($_REQUEST["kind"]))	
	    break;
		$sql=$db->prepare('update subject set kind=? where id=?');
        $sql->execute([$_REQUEST['kind'],$_REQUEST['id']]);
	    break;
        case 'insert':
        if(empty($_REQUEST["kind"]))    
        break;
        $sql=$db->prepare('insert into subject values(null,?,?)');
        $sql->execute([$_SESSION['customer']['id'],$_REQUEST['kind']]);
        break;
        case 'delete':
        $sql=$db->prepare('delete from subject where id=?');
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
	<p><a href="customer-input.php">新規登録</a></p>
	<p><a href="login.php">ログイン</a></p>
	<p><a href="logout.php">ログアウト</a></p>
    <?php
    if(isset($_SESSION['customer'])){
        echo '<p>ようこそ<span class="user-name">'.$_SESSION['customer']['name'].'</span>さん。</p>';
    }else{
        echo '<p>ようこそゲストさん。</p>';
    }?>
    </div>
 </header>
 <main>
    <div class="edit">
 	<?php
 	if(!isset($_SESSION["customer"])){
     	echo '<p class="kind">ログインが必要です！</p>';
     	
    }else{
    	
     	$sql=$db->prepare('select * from subject where customer_id =?');
        $sql->execute([$_SESSION['customer']['id']]);
     	
  
     foreach ($sql as $row){
     
     	 echo '<form action="edit.php" method="post">';
         echo '<input type="hidden" name="command" value="update">';
         echo '<input type="hidden" name="id" value="'.$row['id'].'">';
         echo '<input type="text" name="kind" value="'.$row['kind'].'">';
         echo '<input type="submit" value="更新">';
         echo '</form>';
         echo '<form action="edit.php" method="post">';
         echo '<input type="hidden" name="command" value="delete">';
         echo '<input type="hidden" name="id" value="'.$row['id'].'">';
         echo '<input type="submit" value="削除">';
         echo '</form>';
         echo '<br>';
    
     }
     
     	echo '<form action="edit.php" method="post">';
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

