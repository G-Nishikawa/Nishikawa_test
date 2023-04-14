<?php

// 接続
$mysqli = new mysqli('localhost', 'nishikawa', '60220097', 'Add_User');

//接続状況の確認
if($mysqli->connect_error){
        echo $mysqli->connect_error;
        exit();
}

/**
 * 課題：結合したテーブルをSELECTして$result変数に格納する処理を書いてください
 */
$sql = "SELECT * FROM `trx_comments` AS `comments`
JOIN `trx_users` AS `users` ON `users`.`id` = `comments`.`user_id`";
$result = $mysqli->query($sql);

echo "<table>\n";
echo "<tr><th>ID</th><th>ユーザ名</th><th>コメント</th></tr>\n";
while($row = $result->fetch_assoc() ){
    // 何行も文字列書くときはこのようなヒアドキュメントが便利
    $html = <<<TEXT
<tr>
  <td>{$row['id']}</td>
  <td>{$row['user_name']}</td>
  <td>{$row['text']}</td>7
</tr>
TEXT;
    echo $html;
}
echo "</table>";

?>