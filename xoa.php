<?php 
    session_start();
    include('connect.php');
    $username = $_SESSION['dangnhap']['username'];
    $id = $_GET['id'];
    $sql_del = "delete from theodoi where id = '$username' and matruyen = $id";
    $query2 = mysqli_query($conn, $sql_del);
    if($query2){
        header('location:theodoi.php');
    }    
?>
