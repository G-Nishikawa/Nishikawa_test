<?php
    //var_dump($_SERVER['REQUEST_URI']);
    //var_dump($_SERVER['REQUEST_URI']);
    //echo '<br/>';
    //var_dump('^\/login$');

    //ログイン
    if(preg_match('<^\/login$>', $_SERVER['REQUEST_URI'])){
        require './login.php';
        //header('Location: /kensyu/kensyu/login.php');
    }elseif(preg_match('<^\/logout$>', $_SERVER['REQUEST_URI'])){
        require './logout.php';
        //header('Location: /kensyu/kensyu/logout.php');
    }


?>