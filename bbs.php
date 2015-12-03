<?php

//POST送信が行われたら、下記の処理を実行
if(isset($_POST)){
	//データベースに接続
	$dsn='mysql:dbname=oneline_bbs;host=localhost';
	$user='root';
	$password='';
	$dbh=new PDO($dsn,$user,$password);
	$dbh->query('SET NAMES utf8');

	$nickname=$_POST['nickname'];
	$hitokoto=$_POST['comment'];
	
	//SQL文作成（INSERT文）
	//INSERT文実行
	$sql='INSERT INTO bbs(nickname,hitokoto,date)VALUES("'.$nickname.'","'.$hitokoto.'",NOW())'; //データベースに情報データを入れる
	//var_dump($sql);
	$stmt=$dbh->prepare($sql);
	$stmt->execute();

	$sql = 'SELECT * FROM `bbs` WHERE 1';  //データベースから情報、でーた　もってくる
	$stmt = $dbh->prepare($sql);
	$stmt->execute();

	
	//データベースから切断
	$dbh=null;
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>セブ掲示版</title>

</head>
<body>
    <form action="bbs.php" method="post">
      <input type="text" name="nickname" placeholder="nickname" required>
      <textarea type="text" name="comment" placeholder="comment" required></textarea>
      <button type="submit" >つぶやく</button>
    </form>

    <h2><a href="#">nickname Eriko</a> <span>2015-12-02 10:10:20</span></h2>
    <p>つぶやきコメント</p>

    <h2><a href="#">nickname Eriko</a> <span>2015-12-02 10:10:10</span></h2>
    <p>つぶやきコメント2</p>

<?php
	while(1){
				$rec = $stmt->fetch(PDO::FETCH_ASSOC);
				if($rec == false)
				{
					break;
				}
				echo $rec['id'];
				echo '&nbsp;';
				echo $rec['nickname'];
				echo '&nbsp;';
				echo $rec['hitokoto'];
				echo $rec['date'];
				echo '<br />';
		
			}

			$dbh = null;
			?>



	</body>
</html>



