<?php
session_start();

//$_SESSION['user_id'] = $user_ID;
//$_SESSION['user_name'] = $name;
//var_dump($user_ID);


//var_dump($_SESSION['user_id']);

if (isset($_SESSION['user_id'])) {

  /**
   * 課題：ここにechoでHTMLタグを書いてコメント投稿フォームを出力してください
   */
    //var_dump($_SESSION['user_id']);
    echo '<form action="comment.php" method="post">';
    echo '<input type="hidden" name="token" value="'.$_SESSION["token"].'">';
    echo 'コメント: <input type="text" name="comment" /><br/>';
    echo '<input type="submit" name="send" />';
    echo '</form>';

    // var_dump($_POST["send"]);

    // if($_POST["send"]){

    //     var_dump($_POST["send"]);

    //     require './comment.php';
    // }
    
}

// 接続
$mysqli = new mysqli("localhost", "nishikawa", "60220097", "Add_User");

//接続状況の確認
if($mysqli->connect_error){
        echo $mysqli->connect_error;
        exit();
}

/**
 * 結合したテーブルをSELECTして$result変数に格納する処理（前の課題の部分なので中略している）
 */
$sql = "SELECT `comments`.`id`, `user_name`, `text` FROM `trx_comments` AS `comments`
JOIN `trx_users` AS `users` ON `users`.`id` = `comments`.`user_id` ORDER BY `comments`.`id` ASC";
$result = $mysqli->query($sql);

echo "<table>\n";
echo "<tr><th>ID</th><th>ユーザ名</th><th>コメント</th></tr>\n";
while($row = $result->fetch_assoc() ){
    echo "<tr>\n";
    echo "<td>{$row['id']}</td>\n";
    echo "<td>{$row['user_name']}</td>\n";
    echo "<td>{$row['text']}</td>\n";
    echo "</tr>\n";
}
echo "</table>";

?>