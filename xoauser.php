<?php 
    include('connect.php');
    $id = $_GET['id'];
    $sql = "delete from nguoidung where id = '".$id."'";
    $query = mysqli_query($conn, $sql);
    if($query)
        header('location:admin.php');
?>