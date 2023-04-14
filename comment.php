<?php

/**
 * コメント投稿したときに呼ばれる想定
 */
session_start();


if (!isset($_SESSION['user_id'])) {
    //ログインしていないときは処理されたくない
    echo "Bad Request";
    exit();
}
echo "post";
var_dump($_POST["token"]);
echo "token";
var_dump($_SESSION['token']);
if ($_POST["token"] != $_SESSION['token']) {
    //トークンが合致しないときも処理されたくない
    echo "Fraudulent Transactions";
    exit();
}

// 接続
$mysqli = new mysqli('localhost', 'nishikawa', '60220097', 'Add_User');

//接続状況の確認
if($mysqli->connect_error){
  echo $mysqli->connect_error;
  exit();
}

/**
 * 課題：trx_commentsにPOSTされたコメントとログインしているユーザのidをINSERTで追加する処理を書いてください
 */

$stmt = $mysqli->prepare("INSERT INTO trx_comments(`user_id`, `text`) VALUES (?, ?)");

//var_dump($_SESSION);

$stmt->bind_param("ss", $_SESSION['user_id'], $_POST["comment"]);

//echo $stmt->error;

//var_dump($_SESSION);

$stmt->execute();

//var_dump($_POST);

//echo $stmt->error;

//リダイレクト（table.phpにリダイレクトすると自然な流れになると思います）
header('Location: table.php');
