<?php 
    session_start();
    ob_start();
    include('connect.php');
    if(isset( $_SESSION['dangnhap']['username'])){
        $username = $_SESSION['dangnhap']['username'];
        $sql = "select * from theodoi where id = '".$username."'";
        $query = mysqli_query($conn, $sql);
    }

    $sql_nd = "select * from nguoidung where username = '$username'";
    $query_nd = mysqli_query($conn, $sql_nd);
    $row_nd = mysqli_fetch_array($query_nd);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/theodoi.css">
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
                                <li><a href="toi.php?username=<?=$username?>"><i class="fa-solid fa-user"></i> <?php echo $_SESSION['dangnhap']['username'];?></a></li>                            
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
                while($row = mysqli_fetch_array($query)){
                    $id = $row['matruyen'];
                    $sql1 = "select * from truyen where id = '$id'";
                    $result = mysqli_query($conn, $sql1);
                    $row1 = mysqli_fetch_array($result);
                    ?>
                    <a href="truyen.php?id=<?=$row1['id']?>">
                        <table class= "table">
                            <tr>
                                <td><img src="anh\truyen\<?php echo $row1['anh']?>" alt="loi anh"></td>
                            </tr>
                            <tr>
                                <td>
                                    <a class = "readre" href="doctruyen.php?id=<?=$row1['id']?>">Đọc Truyện</a>
                                    <a class = "readdel" href="xoa.php?id=<?=$row1['id']?>">xóa</a>
                                </td>   
                            </tr>   
                            <tr>
                                <td><a href="truyen.php?id=<?=$row1['id']?>" class= "tentr"><?php echo $row1['name']?></a></td>
                            </tr>
                        </table>
                    </a>
                <?php
                }
            }else{
                ?>
                <h3 class = "conten">Bạn Cần Đăng Nhập Để Tiếp Tục <a href="dangnhap.php">Đăng Nhập</a></h3> 
                <?php 
            }
            ob_end_flush();
        ?>
        </form>
    </body>
</html>

