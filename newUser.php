<?php
  //session_destroy();
  /**
   * 課題１：mysqliを用いてMySQLに接続し，POSTで受け取ったデータをtrx_usersにINSERTする処理を書いてください
   * パスワードはハッシュ化する必要があるので，以下の$password_hashを用いてください
   */
  // 接続
$mysqli = new mysqli('localhost', 'nishikawa', '60220097', 'Add_User');

//接続状況の確認
if($mysqli->connect_error){
        echo $mysqli->connect_error;
        exit();
}else{
        $mysqli->set_charset('utf8');
}

var_dump($_SESSION);

var_dump($_POST);

//formからのポスト時のみにDBを操作
if ($_POST["username"] && $_POST["password"]){

  $name = $_POST["username"];
  $password = $_POST["password"];
  $password_hash = hash("sha256", $password);

  $stmt = $mysqli->prepare("INSERT INTO trx_users(`user_name`, `password`) VALUES (?, ?)");

  //printf("mysqli Error: %s.\n", $mysqli->error);

  //printf("stmt Error: %s.\n", $stmt->error);

  $stmt->bind_param("ss", $name, $password_hash);

  $stmt->execute();

  // 切断
  $mysqli->close();

}
   
?>

<!DOCTYPE html>
<html>
  <head>
		<meta charset="utf-8">*:
	</head>
	<body>
		<h2>ユーザ追加</h2>
		<form action="newUser.php" method="post">
		  ユーザ: <input type="text" name="username" /><br/>
		  パスワード: <input type="password" name="password" /><br/>
		  <input type="submit" />
		</form>
	</body>
</html>