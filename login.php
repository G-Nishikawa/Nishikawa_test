<?php
  
  //var_dump($_SESSION);
  //MySQLに接続
  $mysqli = new mysqli('localhost', 'nishikawa', '60220097', 'Add_User');

  if($mysqli->connect_error){
    echo $mysqli->connect_error;
    exit();
  }

  /**
   * 課題２：データベースにPOSTで取得したusername,password(ハッシュ化)と一致するものがあればセッションを開始し
   * $_SESSION['user_id']にユーザIDを,$_SESSION['user_name']にユーザ名を格納する処理を書いてください
   */


  //formからのポスト時のみにDBを操作
  if(!isset($_POST["username"]) || !isset($_POST["password"])){
    // なにもしない
  }elseif ($_POST["username"] && $_POST["password"]){

    $name = htmlspecialchars($_POST["username"],ENT_QUOTES,'UTF-8');
    $password = htmlspecialchars($_POST["password"],ENT_QUOTES,'UTF-8');
    $password_hash = hash("sha256", $password);


    $sql = "SELECT `id` FROM trx_users WHERE `user_name`='{$name}' AND `password`='{$password_hash}'";
    $login_result= $mysqli->query($sql);
    $user_ID = implode($login_result->fetch_assoc());


    //var_dump($_SESSION['user_id']);
    //var_dump($login_result);

    if (!(is_bool($login_result))){
        if(isset($_SESSION['user_id'])) {
            // SESSION[user_id]に値入っていればログインしたとみなす
            echo "既にログインしています";
            //exit();
        }else{
            session_start();
            $_SESSION['user_id'] = $user_ID;
            $_SESSION['user_name'] = $name;
            echo "ログインしました";
            $token = bin2hex(random_bytes(32));
            $_SESSION['token'] = $token;
            header('Location: table.php');
            //session_destroy();
            //require './table.php';
            //exit();
        }
    }else{
        echo "登録されていません";
        //exit();
    }
    // 切断
  $mysqli->close();
  }

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>ログイン</h2>
		<form action="login.php" method="post">
		  ユーザ: <input type="text" name="username" /><br/>
		  パスワード: <input type="password" name="password" /><br/>
		  <input type="submit" />
		</form>
	</body>
</html>