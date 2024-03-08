<?php 
    session_start();
    include('connect.php');
    $id = $_GET['id'];
    $sql = "select * from truyen where id = '".$id."'";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($query);
    $nguoidung = $_SESSION['dangnhap']['username'];
    // $sql_user = "select * from nguoidung where username = '$nguoidung'";
    // $query_user = mysqli_query($conn, $sql_user);
    // $row_user = mysqli_fetch_array($query_user);

    $sql_nd = "select * from nguoidung where username = '".$nguoidung."'";
    $query_nd = mysqli_query($conn, $sql_nd);
    $row_nd = mysqli_fetch_array($query_nd);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/doctruyen.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Document</title>
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
            <li><a href="theodoi.php">Theo Dõi</a></li>  z`
        </ul>
    </nav>
    </div>
    <?php
        if (isset($_GET['chap'])) {
            $current_chap = $_GET['chap'];
        } else {
            $current_chap = 1; 
        }
        $prev_chap = $current_chap - 1;
        $next_chap = $current_chap + 1;

        // truy vấn cơ sở dữ liệu để lấy số lượng chap tối đa
        $sqlc = "select max(tenchap) as maxchap from chap where id = '$id'";
        $resultc = mysqli_query($conn, $sqlc);
        $rowc = mysqli_fetch_array($resultc);
        $maxchap = $rowc['maxchap'];
    ?>
    <form action="" method="post">
        <div class="noidung">
            <?php
                if(isset($_SESSION['dangnhap']['username'])){
                ?>
                <table>
                    <tr class="tentr"> 
                        <td class="tentr"><a href="" class= "tentr"><?php echo $row['name']?></a></td>
                    </tr>
                </table>
                <tbody>
                <?php
                    $sqld = "select * from chap where id = '$id' and tenchap = '$current_chap'";
                    $resultd = mysqli_query($conn, $sqld);

                    while($rowd = mysqli_fetch_array($resultd)){

                    ?> 
                    <div class="anhchap">
                        <img src="anh\chap\<?php echo $rowd['anh']?>" alt="loi anh">
                    </div>
                    <?php } ?>
                </tbody>
            <?php
                }
                ?>
        </div>
        <div class="buttons">
            <div class="chap-selector">
                <select id="chap-select" onchange="location.href='doctruyen.php?id=<?php echo $id ?>&chap=' + this.value">
                    <?php
                        for ($i = 1; $i <= $maxchap; $i++) {
                            echo "<option value='$i'>Chap $i</option>";
                        }
                    ?>
                </select>
            </div>
            <?php if ($prev_chap >= 1) { ?>
                <button type="button" onclick="location.href='doctruyen.php?id=<?php echo $id ?>&chap=<?php echo $prev_chap ?>'">Chap trước</button>
            <?php } ?>
            <?php if ($next_chap <= $maxchap) { ?>
                <button type="button" onclick="location.href='doctruyen.php?id=<?php echo $id ?>&chap=<?php echo $next_chap ?>'">Chap tiếp theo</button>
            <?php } ?>
        </div>
        <div class="comment-section">
            <div class="comment-input">
                <textarea name="cmt" id="cmt" placeholder = "Nhập vào khung này nếu bạn muốn bình luận cho bộ truyện này.."></textarea>
                <input type="submit" name = "add" value="Đăng">
                <?php
                    ob_start();
                    if(isset($_POST['add'])){
                        $cmt = $_POST['cmt'];
                        $username = $_SESSION['dangnhap']['username']; 
                        $tenchap = $current_chap;
                        $matruyen = $_GET['id'];
                    
                        $sql_add_cmt = "INSERT INTO comment (username, matruyen, tenchap, noidung)
                            VALUES ('$username', '$matruyen', '$tenchap', '$cmt')";
                        mysqli_query($conn, $sql_add_cmt);
                        ob_end_clean(); 
                        // Redirect to the same page using GET
                        //header("Location: " . $_SERVER['REQUEST_URI']);
                       // exit();
                        echo "<script type='text/javascript'>window.top.location='".$_SERVER['REQUEST_URI']."';</script>";
                        exit();
                    
                    
                        // if (mysqli_query($conn, $sql_add_cmt)) {
                        //     echo "Đăng bình luận thành công";
                        // } else {
                        //     echo "Lỗi: " . mysqli_error($conn);
                        // }
                    }
                ?>
            </div>
            <div class="comment-display">
            <?php
                $tenchap = $current_chap;
                if(isset($tenchap)){
                    $matruyen = $_GET['id'];
                    $sql_cmt = "select * from comment where matruyen = $matruyen and tenchap = $tenchap ORDER BY id DESC";
                    $result_cmt = mysqli_query($conn, $sql_cmt);

                    while($row_cmt = mysqli_fetch_array($result_cmt)){
                        $username_cmt = $row_cmt['username'];
                        $sql_user_cmt = "select * from nguoidung where username = '$username_cmt'";
                        $query_user_cmt = mysqli_query($conn, $sql_user_cmt);
                        $row_user_cmt = mysqli_fetch_array($query_user_cmt);
                        ?>
                        <div class="comment">
                            <div class="avt1"><img src="anh\avt\<?php echo $row_user_cmt['avt']?>" alt="loi anh"></div>
                            <div class="cmt_phai">
                                <div class="username"><?php echo $row_cmt['username']?></div>
                                <div class="comment-text" style="word-wrap: break-word;"><?php echo $row_cmt['noidung']?></div>
                                <div class="comment-actions">
                                    <button type="button">Trả lời</button>
                                    <button type="button">Thích</button>
                                    <button type="button">Không thích</button>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }else{
                    // ...
                }
            ?>

            </div>

        </div>
    </form>
    
    <div class="bot">
        <p>NTRUYỆN</p>
        <p>Càng đọc càng nghiện</p>
        <h4 class="coment">Bản quền trang web thuộc về @NTruyen</h4>
    </div>
</body>
</html>

