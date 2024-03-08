<?php
    include('connect.php');
    session_start();
    unset($_SESSION['dangnhap']);

    header('location:index.php');
?>