<?php
  /**
   * 課題3：セッションが確立しているとき，セッションを破棄してログアウトする処理を書いてください
   */
  session_start();
  $session_status = session_status();
  if(!isset($_POST["logout"])){
    // なにもしない
  }elseif($session_status = "PHP_SESSION_ACTIVE" && $_POST["logout"]) {
    session_destroy();
    echo "ログアウトしました";
    header('Location: table.php');
    //exit();
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>ログアウト</h2>
		<form action="logout.php" method="post">
		  <button type="submit" name="logout" value="send">ログアウト</button>
		</form>
	</body>
</html>