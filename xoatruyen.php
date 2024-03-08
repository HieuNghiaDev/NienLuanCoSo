<?php 
    include('connect.php');
    session_start();
    if(isset( $_SESSION['dangnhap']['username'])){
        $ten_tr = $_GET['tentruyen'];
        $sql = "delete from truyen where name = '".$ten_tr."'";
        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($query);
        $sql = "delete from nhasangtao where ten_truyen = '".$ten_tr."'";
        $query = mysqli_query($conn, $sql);
        if($query)
            header('location:canhan.php');
    }
?>