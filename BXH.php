<?php 
    include('connect.php');
    session_start();
    if(isset( $_SESSION['dangnhap']['username'])){
        $username = $_SESSION['dangnhap']['username'];
        $sql = "select * from theodoi where id = '".$username."'";
        $query = mysqli_query($conn, $sql);

        $sql_nd = "select * from nguoidung where username = '$username'";
        $query_nd = mysqli_query($conn, $sql_nd);
        $row_nd = mysqli_fetch_array($query_nd);

        $sql_view = "select * from view";
        $query_view = mysqli_query($conn,$sql_view);
        $row_view = mysqli_fetch_array($query_view);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bxh.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>BXH</title>
</head>
<body>
    <div id="header">
        <nav class="container">
            <div class = "brand">
                <span>
                    <a href="index.php"><img class = "logo" src="anh/backgr/logo.png" alt="Lỗi Ảnh"></a>
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
                        <a href="yeucau.php">Liên hệ Với Chúng Tôi</a>
                    </li>
                    <li>
                        <?php
                        if(isset($_SESSION['dangnhap']['username'])){
                            $quyen = $row_nd['quyen'];
                            if($quyen == 1){
                            ?>
                            <div class="avt"><img src="anh\avt\<?php echo $row_nd['avt']?>" alt="loi anh"></div>
                                <ul class="sub-menu">
                                    <li><a href="toi.php?username=<?=$username?>"><i class="fa-solid fa-user"></i> <?php echo $row_nd['fullname'];?></a></li>                            
                                    <li><a href="dangxuat.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Đăng Xuất </a></li>
                                    <li><a href="canhan.php"><i class="fa-solid fa-address-card"></i> Người Sáng Tạo </a></li>
                                </ul>
                            <?php
                            }else{
                                ?>
                                <div class="avt"><img src="anh\avt\<?php echo $row_nd['avt']?>" alt="loi anh"></div>
                                    <ul class="sub-menu">
                                        <li><a href="toi.php?username=<?=$username?>"><i class="fa-solid fa-user"></i> <?php echo $row_nd['fullname'];?></a></li>                            
                                        <li><a href="dangxuat.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Đăng Xuất </a></li>
                                    </ul>
                                    <?php
                                }
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
            <li><a href="BXH.php">BXH</a></li>
            <li><a href="theodoi.php">Theo Dõi</a></li> 
        </ul>
    </nav>
    <div class="bxh">
        <h2>Bảng Xếp Hạng : </h2>
        <div class="bxh-box">
            <?php
            $limit = 6;
        
            $sql_view = "SELECT * FROM view ORDER BY view DESC LIMIT $limit";
            $query_view = mysqli_query($conn, $sql_view);

            while ($row_view = mysqli_fetch_array($query_view)) {
                $name = $row_view['ten_truyen'];
                $sql = "SELECT * FROM truyen WHERE name = '$name'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($result)
                ?>
                <div class="story">
                    <a href="truyen.php?id=<?=$row['id']?>">
                        <div class="story-image">
                            <div class="image">
                                <img src="anh\truyen\<?php echo $row['anh']?>" alt="loi anh">       
                            </div>
                            <div class="name">
                                <h3><?php echo $row_view['ten_truyen']?></h3>
                                <h5>Lượt Xem : <span><?php echo $row_view['view']?></span></h5>
                            </div>
                        </div>
                        
                    </a>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</html>