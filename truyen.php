<?php 
    ob_start();
    session_start();
    include('connect.php');
    if(isset($_SESSION['dangnhap']['username'])){
        $id = $_GET['id'];
        $username = $_SESSION['dangnhap']['username'];
        $sql = "select * from truyen where id = '".$id."'";
        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($query);
        $ten_truyen = $row['name'];

        $sql_nd = "select * from nguoidung where username = '".$username."'";
        $query_nd = mysqli_query($conn, $sql_nd);
        $row_nd = mysqli_fetch_array($query_nd);
        //echo $ten_truyen;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/truyen.css">
    <title>Truyen</title>
</head>
<body>
<header>
    <div id="header">
        <nav class="container">
            <div class = "brand">
                <span>
                    <a href="http://localhost/php/lhnweb/index.php"><img class = "logo" src="anh/backgr/logo.png" alt="Lỗi Ảnh"></a>
                </span>
            </div>
            <div class= "navbar">
                <div class = "searchbox">
                    <form method="post" name="truyen" action="timkiem.php">
                        <input class= "search" type="text" name = "name" placeholder = "Tìm Truyện Tại Đây Nè..."/>
                        <button class = "button" type = "submit" name = "tim"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
                <ul id ="header-menu">
                    <li>
                        <a href="https://mail.google.com/mail/u/0/#inbox">Liên hệ Với Chúng Tôi</a>
                    </li>
                    <li>
                        <?php
                        if(isset($_SESSION['dangnhap']['username'])){
                            ?>
                            <div class="avt"><img src="anh\avt\<?php echo $row_nd['avt']?>" alt="loi anh"></div>
                            <ul class="sub-menu">
                                <li><a href="toi.php?username=<?=$username?>"><i class="fa-solid fa-user"></i> <?php echo $row_nd['fullname'];?></a></li>                            
                                <li><a href="dangxuat.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Đăng Xuất </a></li>
                            </ul>
                            <?php
                        } else {
                            ?>
                            <div class="avt"><img src="anh\avt\avt.png" alt="loi anh"></div>
                            <ul class="sub-menu">
                                <li><a href="dangnhap.php">Đăng Nhập</a></li>
                            </ul>
                            <?php
                        }
                        ?>
                    </li>  
                </ul>
            </div>
        </nav>
    </div>
    </header>
    <nav class= "nav">
        <ul id = header-menu>
            <li><a href="index.php">Home</a></li>
            <li><a href="">Hot</a></li>
            <li><a href="">Thể Loại</a>
                <ul class="sub-menu">
                    <?php
                        $sql1 = "select * from truyen";
                        $result1 = mysqli_query($conn, $sql1);
                        
                        $row2 = mysqli_fetch_array($result1)
                    ?>
                    <li><a href="theloai.php?theloai=<?=$row2['theloai']?>">Manhua</a></li>
                    <li><a href="theloai.php?theloai=<?=$row2['theloai']='manhwa';?>">Manhwa</a></li>
                    <li><a href="theloai.php?theloai=<?=$row2['theloai']='manga';?>">Manga</a></li>
                    <li><a href="theloai.php?theloai=<?=$row2['theloai']='codai';?>">Cổ Đại</a></li>
                    <li><a href="theloai.php?theloai=<?=$row2['theloai']='xuyenkhong';?>">Xuyên Không</a></li>
                    <li><a href="theloai.php?theloai=<?=$row2['theloai']='dothi';?>">Đô Thị</a></li>
                    <li><a href="theloai.php?theloai=<?=$row2['theloai']='tinhcam';?>">Tình Cảm</a></li>
                    <li><a href="theloai.php?theloai=<?=$row2['theloai']='hocduong';?>">Học Đường</a></li>
                    <li><a href="theloai.php?theloai=<?=$row2['theloai']='tutien';?>">Tu Tiên </a></li>
                    <li><a href="theloai.php?theloai=<?=$row2['theloai']='hanhdong';?>">Hành Động</a></li>
                </ul>
            </li>
            <li><a href="">BXH</a></li>
            <li><a href="theodoi.php">Theo Dõi</a></li>  
        </ul>
    </nav>
    <form action=""  method="post" id = "form">
        <?php
            if(isset($_SESSION['dangnhap']['username'])){
                ?>
                 <div class="dtop">
                    <div class="right">
                        <table class= "table-right">      
                            <tr class="tentr"> 
                                <td class="tentr"><a href="?id=<?=$row['id']?>" class= "tentr"><?php echo $row['name']?></a></td>
                            </tr>
                            <tr>
                                <td><img src="anh\truyen\<?php echo $row['anh']?>" alt="loi anh"></td>
                            </tr>
                            <tr>
                                <td><input type="submit" name = "doc" value="Đọc Truyện" class="form-submit"></td>
                                <?php
                                    if(isset($_POST['doc'])){
                                        $id1=$row['id'];
                                        $sql_check = "SELECT * FROM view WHERE ten_truyen = '$ten_truyen'";
                                        $result_check = mysqli_query($conn, $sql_check);
                                        
                                        if(mysqli_num_rows($result_check) > 0){
                                            $sql_views = "UPDATE view SET view = view + 1 WHERE ten_truyen = '$ten_truyen'";
                                        } else {
                                            $sql_views = "INSERT INTO view (ten_truyen, view) VALUES ('$ten_truyen', 1)";
                                        }
                                        
                                        $result_views = mysqli_query($conn, $sql_views);
                                        
                                        header('Location:doctruyen.php?id='.$id);
                                    }
                                ?>
                            </tr>
                            <tr>
                                <?php
                                $username = $_SESSION['dangnhap']['username'];
                                $id2 = $row['id']; 
                                $checkSql = "SELECT * FROM theodoi WHERE id = '$username' AND matruyen = '$id2'";
                                $checkQuery = mysqli_query($conn, $checkSql);
                                if (mysqli_num_rows($checkQuery) > 0) {
                                    ?>
                                    <td><input type="submit" name="theodoi" value="Xóa" class="form-submit-del"></td>
                                    <style>
                                        .form-submit-del{
                                            background-color: #eebaba;
                                            border: 1px solid #f5f5f5;
                                            color: red;
                                            width : 175px;
                                            height : 25px;
                                        }
                                    </style>

                                    <?php
                                    if (isset($_POST['theodoi'])) {
                                        if (mysqli_num_rows($checkQuery) > 0) {
                                            // Nếu dữ liệu đã tồn tại, thực hiện câu lệnh DELETE để xóa dữ liệu
                                            $deleteSql = "DELETE FROM theodoi WHERE id = '$username' AND matruyen = '$id2'";
                                            mysqli_query($conn, $deleteSql);

                                            $updateViewSql_del = "UPDATE view SET folow = folow -1 WHERE ten_truyen = '$ten_truyen'";
                                            $del = mysqli_query($conn, $updateViewSql_del);

                                            header("refresh: 0");
                                        }
                                    }
                                } else {
                                    ?>
                                    <td><input type="submit" name="theodoi" value="Theo Dõi" class="form-submit"></td>
                                    <?php
                                    if (isset($_POST['theodoi'])) {
                                        $insertSql = "INSERT INTO theodoi (id, matruyen) VALUES ('$username', '$id2')";
                                        mysqli_query($conn, $insertSql);
                                    
                                        $checkViewSql = "SELECT * FROM view WHERE ten_truyen = '$ten_truyen'";
                                        $checkViewQuery = mysqli_query($conn, $checkViewSql);
                                        if (mysqli_num_rows($checkViewQuery) > 0) {
                                            $updateViewSql = "UPDATE view SET folow = folow + 1 WHERE ten_truyen = '$ten_truyen'";
                                            mysqli_query($conn, $updateViewSql);
                                        } else {
                                            $insertViewSql = "INSERT INTO view (ten_truyen, folow) VALUES ('$ten_truyen', 1)";
                                            mysqli_query($conn, $insertViewSql);
                                        }
                                    
                                        header("refresh: 0");
                                    }
                                }
                                ?>
                            </tr>
                            <table class="noidung">
                                <tr>
                                    <td class = "td">Nội Dung truyện : </td>
                                </tr>
                                <tr>
                                    <td class= "nd">
                                        <?php echo $row['noidung']?>
                                    </td>
                                </tr>
                            </table>
                        </table>
                    </div>
                    <div class="left">
                        <h3>Truyện Đề Xuất</h3>
                        <div class="table-left">
                            <?php
                                $theloai = $row['theloai'];
                                $sql_Sub = "SELECT * FROM truyen WHERE theloai = '".$theloai."' ORDER BY RAND() LIMIT 2";
                                $result_sub = mysqli_query($conn, $sql_Sub);

                                while ($row_sub = mysqli_fetch_array($result_sub)) {
                                    ?>
                                    <a href="truyen.php?id=<?=$row['id']?>">
                                        <table class="truyen-dx">
                                            <tr>
                                                <td><img src="anh\truyen\<?php echo $row_sub['anh']?>" alt="loi anh"></td>
                                            </tr>
                                            <tr>
                                                <td><a href="truyen.php?id=<?=$row_sub['id']?>" class="tentr-dx"><?php echo $row_sub['name']?></a></td>
                                            </tr>
                                        <table>
                                    </a>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                    <?php
                }else{
                    ?>
                    <h3 class = "conten">Bạn Cần Đăng Nhập Để Tiếp Tục <a href="dangnhap.php">Đăng Nhập</a></h3> 
                    <?php 
                }
                ob_end_flush();
            ?>
                 </div>
       
    </form>
</body>
</html>