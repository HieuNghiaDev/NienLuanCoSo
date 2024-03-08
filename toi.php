<?php 
    include('connect.php');
    session_start();
    ob_start();
    $username = $_GET['username'];
    $sql = "select * from nguoidung where username = '".$username."'";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($query);
?>

<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/toi.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                        <a href="https://mail.google.com/mail/u/0/#inbox">Liên hệ Với Chúng Tôi</a>
                    </li>
                    <li>
                        <?php
                        if(isset($_SESSION['dangnhap']['username'])){
                            ?>
                            <div class="avt"><img src="anh\avt\<?php echo $row['avt']?>" alt="loi anh"></div>
                            <ul class="sub-menu">
                                <li><a href="toi.php?username=<?=$username?>"><i class="fa-solid fa-user"></i> <?php echo $row['fullname'];?></a></li>                            
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
            <li><a href="theodoi.php">Theo Dõi</a></li>  
        </ul>
    </nav>
    <form action="" method = "POST" name ="frmadd" enctype="multipart/form-data">
    <h2>Thông Tin Tài Khoản</h2>
    <table>
        <tr>
            <td>
                Tên Đăng Nhập : 
            </td>
            <td>
                <input type="text" name="username" value = "<?=$row['username']?>" readonly> 
            </td>
        </tr>
        <tr>
        <tr>
            <td>
                Họ Tên :
            </td>
            <td>
                <input type="text" name = "fullname" value ="<?=$row['fullname']?>" >
            </td>
        </tr>
        <tr>
            <td>
                Mật Khẩu : 
            </td>
            <td>
                <input type="password" name = "password" placeholder = "Nhập vào mật khẩu">
            </td>
        </tr>
        <tr>
            <td>
                Nhập Lại Mật Khẩu : 
            </td>
            <td>
                <input type="password" name = "repassword" placeholder = "Nhập Lại mật khẩu">
            </td>
        </tr>
        <tr>
            <td>
                Chọn Ảnh :
            </td>
            <td>
                <input type="file" name="image" accept="image/*">
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" name = "change" value="Đổi Thông Tin">
                <input type="text" name = "id" value="<?=$row['id']?>" hidden>
            </td>            
        </tr>        
    </table>    
</form>

<?php
    if(isset($_POST['change'])){
        $password = md5($_POST['password']);
        $repassword = md5($_POST['repassword']);
        $fullname = $_POST['fullname'];
        
        // Kiểm tra xem người dùng có tải lên file không
        if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
            $image = $_FILES['image']['name']; // get the name of the image file

            // specify the path to the images directory
            $target_dir = "anh/avt/";

            //Kiểm tra xem thư mục có tồn tại không, nếu không thì tạo thư mục
            // if (!file_exists($target_dir)) {
            //     mkdir($target_dir, 0777, true);
            // }

            // Di chuyển file đã tải lên vào thư mục chỉ định
            if(move_uploaded_file($_FILES['image']['tmp_name'], $target_dir.$image)){
                echo "Tải lên file thành công.";
            } else{
                echo "Tải lên file thất bại.";
            }
        } else {
            $image = NULL; // Nếu không có file nào được tải lên, đặt giá trị NULL cho biến $image
        }

        if($password && $repassword && $fullname){
            if($password == $repassword){
                if($password != "d41d8cd98f00b204e9800998ecf8427e"){
                    $sql_edit = "update nguoidung  set password = '".$password."',
                     fullname = '".$fullname."', avt = '".$image."' where username = '".$username."'";
                }else{
                    $sql_edit = "update nguoidung set fullname = '".$fullname."', avt = '".$image."' where username = '".$username."'";
                }
                $query1 = mysqli_query($conn, $sql_edit);
                if($query1){
                    header("location:dangnhap.php");
                }
            }else{
                echo "Mật Khẩu không Trùng Nhau ";
            }
        }else{
            echo "Nhập Đầy Đủ Thông tin ";
        }
    }
    ob_end_flush();        
?>       
</body>
</html>