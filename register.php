<section>
    <form action="" method="post">
        <!--番号:<br>
        <input type="number" name="num" value=""><br>
        <br>-->
        名前:<br>
        <input type="text" name="name" value=""><br>
        <br>
        パスワード:<br>
        <input type="text" name="password" value=""><br>
        <input type="submit" value="登録">
    </form>
</section>

<?php
// 接続
$mysqli = new mysqli('localhost', 'nishikawa', '60220097', 'test');

//接続状況の確認
if($mysqli->connect_error){
        echo $mysqli->connect_error;
        exit();
}else{
        $mysqli->set_charset('utf8');
}

//$num = $_POST["num"];
$name = $_POST["name"];
$pass = $_POST["password"];

$stmt = $mysqli->prepare("INSERT INTO user(`name`, `password`) VALUES (?, ?)");
printf("mysqli Error: %s.\n", $mysqli->error);

printf("stmt Error: %s.\n", $stmt->error);

$stmt->bind_param("ss", $name, $pass);

$stmt->execute();

// 切断
$mysqli->close();
?>
