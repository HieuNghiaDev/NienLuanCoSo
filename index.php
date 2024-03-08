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

        $sql_view = "select * from view order by folow DESC";
        $query_view = mysqli_query($conn,$sql_view);

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Trang Chủ</title>
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
    <div class="recoment-title">
        <h2>Đề Xuất Theo Dõi </h2>
        <div class="recoment">
            <?php
            $limit = 6;
        
            $sql_view = "SELECT * FROM view ORDER BY folow DESC LIMIT $limit";
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
                            <img src="anh\truyen\<?php echo $row['anh']?>" alt="loi anh">
                        </div>
                    </a>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="left">
            <h2>Danh Sách Truyện Tranh ></h2>
            <?php
            $limit = 16;

            $page = isset($_GET['page']) ? $_GET['page'] : 1;

            $start = ($page - 1) * $limit;

            $sql = "SELECT * FROM truyen ORDER BY last_updated DESC LIMIT $start, $limit";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_array($result)) {
                ?>
                <a href="truyen.php?id=<?=$row['id']?>">
                    <table class="table">
                        <tr>
                            <td><img src="anh\truyen\<?php echo $row['anh']?>" alt="loi anh"></td>
                        </tr>
                        <tr>
                            <td><a href="truyen.php?id=<?=$row['id']?>" class="tentr"><?php echo $row['name']?></a></td>
                        </tr>
                    </table>
                </a>
                <?php
            }

            $countSql = "SELECT COUNT(*) as total FROM truyen";
            $countResult = mysqli_query($conn, $countSql);
            $countRow = mysqli_fetch_array($countResult);
            $totalPages = ceil($countRow['total'] / $limit);
            ?>
            <div class="pagination">
                <?php
                for ($i = 1; $i <= $totalPages; $i++) {
                    if ($i == $page) {
                        echo "<strong>$i</strong> ";
                    } else {
                        echo "<a href=\"?page=$i\">$i</a> ";
                    }
                }
                ?>
            </div>
        </div>
        <div class="right">
            <div class="right-top">
                <h2><a href="theodoi.php">Theo Dõi ></a></h2>
                <?php
                    $limit = 5;
                    $count = 0;

                    if (isset($_SESSION['dangnhap']['username'])) {
                        $rows = array(); // Mảng để lưu các hàng từ cơ sở dữ liệu
                        // Lấy các hàng từ cơ sở dữ liệu và thêm vào mảng
                        while ($row = mysqli_fetch_array($query)) {
                            $idd = $row['matruyen'];
                            $sql1 = "select * from truyen where id = '$idd'";
                            $result = mysqli_query($conn, $sql1);
                            $row1 = mysqli_fetch_array($result);
                            array_unshift($rows, array('row1' => $row1));
                        }
                        foreach ($rows as $data) {
                            $row1 = $data['row1'];
                            ?>
                            <a href="truyen.php?id=<?=$row1['id']?>">
                                <table class="table_follow">
                                    <tr>
                                        <td class = "name"><img src="anh\truyen\<?php echo $row1['anh']?>" alt="loi anh"></td>
                                        <td><a href="truyen.php?id=<?=$row1['id']?>" class="tentr"><?php echo $row1['name']?></a></td>
                                    </tr>
                                </table>
                            </a>
                            <?php
                            $count++;
                            if ($count >= $limit) {
                                break;
                            }
                        }?>
                        <p><a href="theodoi.php">xem tất cả</a></p>
                        <?php
                    } else {
                        ?>
                        <p>Bạn Cần <a id = "login" href="dangnhap.php">Đăng Nhập</a></p>
                        <?php
                    }
                ?>
            </div>
            <div class="right-bot">
                <h2>Bình Luận Mới ></h2>
                <?php
                    $sql_cmt = "SELECT * FROM comment ORDER BY id DESC LIMIT 6";
                    $result_cmt = mysqli_query($conn, $sql_cmt);
                    
                    while ($row_cmt = mysqli_fetch_array($result_cmt)) {
                        // Lấy id của truyện từ bình luận
                        $matruyen = $row_cmt['matruyen'];
                        // Truy vấn để lấy tên truyện từ bảng truyen
                        $sql_truyen = "SELECT * FROM truyen WHERE id = $matruyen";
                        $result_truyen = mysqli_query($conn, $sql_truyen);
                        $row_truyen = mysqli_fetch_array($result_truyen);
                        ?>
                            <div class="comment-display">
                                <a href="truyen.php?id=<?=$row_truyen['id']?>"><div class="name"><?php echo $row_truyen['name']?></div></a>
                                <div class="username"><?php echo $row_cmt['username']?></div>
                                <div class="comment-text" style="word-wrap: break-word;"><?php echo $row_cmt['noidung']?></div>
                            </div>
                        <?php
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="bot">
        <p>NTRUYỆN</p>
        <p>Càng đọc càng nghiện</p>
        <h4 class="coment">Bản quền trang web thuộc về @NTruyen</h4>
    </div>
</body>
</html>