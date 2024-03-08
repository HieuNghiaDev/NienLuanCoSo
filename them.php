<?php 
    include('connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/them.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <title>Document</title>
</head>
<body>
    <form method="post" name="login" action="">
    <div id="warpper">
        <from id="form-login">
            <h1 class="form-heading">Tạo tài khoản</h1>
            <div class="form-group">
                <i class="fas fa-user"></i>
                <input type="text" name="username" class="form-input" placeholder="Tên Đăng Nhập" required>
            </div>
            <div class="form-group">
                <i class="fas fa-key"></i>
                <input type="password" name = "password" class="form-input" placeholder="Mật Khẩu" required>
                <div id="eye">
                    <i class="fas fa-eye"></i>
                </div>
            </div>
            <div class="form-group">
                <i class="fas fa-key"></i>
                <input type="password" name = "repassword" class="form-input" placeholder="Mật Khẩu" required>
                <div id="eye">
                    <i class="fas fa-eye"></i>
                </div>
            </div>
            <div class="form-group">
                <i class="fas fa-user"></i>
                <input type="text" name="fullname" class="form-input" placeholder="fullname" required>
            </div>
            <input type="submit" value="Tạo Tài Khoản" class="form-submit">
            <div>
            <?php
                 if($_POST){
                    $username = $_POST['username'];
                    $password = md5($_POST['password']);
                    $repassword = md5($_POST['repassword']);
                    $fullname = $_POST['fullname'];
                    $avt = "avt.png";
                    if($username && $password && $repassword && $fullname){
                        $sql = "select * from nguoidung where username = '".$username."'";
                        $query = mysqli_query($conn, $sql);
                        $num_row = mysqli_num_rows($query);
                        if($num_row==1){
                            echo "Da ton tai user ".$username;
                        }
                        else{
                            if($password == $repassword){
                            $sql_add = "insert into nguoidung (username, password,fullname, avt) values('".$username."','".$password."','".$fullname."','".$avt."')";
                                $query = mysqli_query($conn, $sql_add);
                                if($query){
                                    header('location:dangnhap.php');
                                    // echo "Them Thanh cong";
                                }
                            }
                            else{
                                echo '<span style = "color: red">Mật Khẩu Không Trùng nhau</span>';
                            }
                        }
                    }
                }
            ?>
            </div>
            <div class="bottom">
                <p>Bạn Đã có Tài Khoản ? <a href="http://localhost/php/lhnweb/dangnhap.php">Đăng Nhập</a></p>
            </div>
        </from>
    </div>
    </form>
</body>
</html>