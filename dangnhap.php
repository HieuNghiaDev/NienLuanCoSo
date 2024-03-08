<?php 
    session_start();
    include('connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dangnhap.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <title>Đăng Nhập</title>
</head>
<body>
    <form method="post" name="login" action="">
    <div id="warpper">
        <from id="form-login">
            <h1 class="form-heading">Đăng Nhập</h1>
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
            <input type="submit" value="Đăng Nhập" class="form-submit">
            <div class="bottom">
                <div class="left">
                    <input type="checkbox" id="check">
                    <label for="check">Nhớ Tôi Cho Lần Đăng Nhập Sau</label>
                </div>
                <div class="right">
                    <label><a href="them.php">Bạn Chưa Có Tài Khoản ?</a></label><br>
                </div>
            </div>
            <div>
                <?php
                   if($_POST){
                       $username = $_POST['username'];
                       $password = md5($_POST['password']);
                       $sql = "select username, password, fullname ,quyen from nguoidung where username = '".$username."'";
                       $query = mysqli_query($conn,$sql);
                       $row = mysqli_fetch_array($query);
                       $num_row = mysqli_num_rows($query);
                       $_SESSION['dangnhap']['username'] = $_POST['username'];
                       //$admin = 'admin';
                       //$quyen_admin = 2;
                       echo $row['quyen'];
                       if($num_row==1){
                           if($row['password']==$password){
                                if($row['quyen'] == "2"){
                                    header('location:admin.php');
                                }else {
                                    header('location:index.php');
                                   //echo "xin chào : ".$row['fullname'];
                                }
                           }else
                               echo '<span style = "color: red">Sai Mật Khẩu</span>';
                               //echo-e "\e[91mMật Khẩu Sai";
                               //    echo "sai mật khẩu!!!";
                       }
                       else
                           echo '<span style = "color: red">Không Tồn Tại user</span>';
                   }
                ?>
           </div>
        </from>
    </div>
    </form>
</body>
<script>
    const eye = document.querySelector('#eye');
    const passwordInput = document.querySelector('input[name="password"]');

    eye.addEventListener('click', () => {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
        } else {
            passwordInput.type = 'password';
        }
    });
</script>
</html>