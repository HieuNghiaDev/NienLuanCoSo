<?php 
    session_start();
    include('connect.php');
    $sql = "select * from nguoidung where quyen = 0";
    $query = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css">
    <title>View</title>
</head>
<body>
    <header>
        <div class="header">
            <h2>ĐÂY LÀ TRANG DÀNH CHO <a href="dangxuat.php">ADMIN</a></h2>
        </div>
    </header>
    <nav class="nav_menu">
        <div class="header_menu">
            <ul>
                <li><a href="admin.php">Trang chủ User</a></li>
                <li><a href="duyettruyen.php">Duyệt Truyện</a></li>
                <li><a href="duyetyc.php">Duyệt Yêu Cầu</a></li>
                <li><a href="quanlytruyen.php">Quản Lý Truyện</a></li>
                <li><a href="nhasangtao.php">Quản Lý Nhà Sáng Tạo Nội Dung</a></li>
            </ul>
        </div>
    </nav>
    <form method="post" action="">
        <div class="search_container">
            <input type="text" name = "name" placeholder="Tìm kiếm...">
            <button name = "tim">Tìm kiếm</button>
        </div>
    </form>
    <?php
        if(isset($_POST['tim'])){
            $name = $_POST['name'];
            
            $sqla = "select * from nguoidung where username = '$name'";
            $querya = mysqli_query($conn, $sqla);

            ?>
            <form method="post" name="login" action="">
                <table border="1">
                    <tr>
                        <th>STT</th>
                        <th>ID</th>
                        <th>USERNAME</th>
                        <th>FULLNAME</th>
                        <th>HÀNH ĐỘNG</th>
                    </tr>

                    <?php
                        $stt= 0;
                        while($row = mysqli_fetch_array($querya)){
                            $stt++;
                    ?>
                        <tr>
                            <td><?=$stt?></td>
                            <td><?=$row['id']?></td>
                            <td><?=$row['username']?></td>
                            <td><?=$row['fullname']?></td>
                            <td><a href="xoauser.php?id=<?=$row['id']?>" onclick = "
                            return confirm('Bạn có muốn xóa ?');">Xóa /</a><a href="xoauser.php?id=<?=$row['id']?>" onclick = "
                            return confirm('Bạn có muốn Sửa ?');">sửa</a></td>
                        </tr>
                    <?php
                        }
                    ?>
                </table>
            </form>
            <?php

        }else {
            ?>
            <form method="post" name="login" action="">
                <table border="1">
                    <tr>
                        <th>STT</th>
                        <th>ID</th>
                        <th>USERNAME</th>
                        <th>FULLNAME</th>
                        <th>HÀNH ĐỘNG</th>
                    </tr>

                    <?php
                        $stt= 0;
                        while($row = mysqli_fetch_array($query)){
                            $stt++;
                    ?>
                        <tr>
                            <td><?=$stt?></td>
                            <td><?=$row['id']?></td>
                            <td><?=$row['username']?></td>
                            <td><?=$row['fullname']?></td>
                            <td><a href="xoauser.php?id=<?=$row['id']?>" onclick = "
                            return confirm('Bạn có muốn xóa ?');">Xóa</a>/<a href="xoauser.php?id=<?=$row['id']?>" onclick = "
                            return confirm('Bạn có muốn Sửa ?');">Sửa</a></td>
                        </tr>
                    <?php
                        }
                    ?>
                </table>
            </form>
            <?php
        }
    ?>
</body>
</html>


