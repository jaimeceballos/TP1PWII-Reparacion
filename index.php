<?php session_start();
    if(!empty($_SESSION['session_begin'])){
        $session_begin = $_SESSION['session_begin'];
    }

    if(empty($session_begin)){
        require_once('public/login.php');
    }else{
        require_once('public/welcome.php');
    }