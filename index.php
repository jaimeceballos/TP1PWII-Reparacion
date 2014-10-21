<?php session_start();
    if(!empty($_SESSION['session_begin'])){
        $session_begin = $_SESSION['session_begin'];
    }

    if(empty($session_begin)){
        require_once('login.php');
    }else{
        require_once('welcome.php');
    }