<?php 
    session_start();
    include('connect.php');
    $sql = "select * from nguoidung";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($query);
    $username = $_SESSION['dangnhap']['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/themtruyen.css">
    <title>View</title>
</head>
<body>
<body>
    <header>
        <div class="header">
            <h2>Xin Chào Nhà Sáng Tạo <a href="dangxuat.php"><?php echo $row['fullname'] ?></a></h2>
        </div>
    </header>
    <nav class="nav_menu">
        <div class="header_menu">
            <ul>
                <li><a href="canhan.php">Cá Nhân</a></li>
                <li><a href="themtruyen.php">Thêm Truyện</a></li>
                <li><a href="index.php">Về Trang Chủ</a></li>
            </ul>
        </div>
    </nav>
    <h2>THÊM TRUYỆN</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="name">Tên truyện:</label>
        <input type="text" id="name" name="name" required>

        <label for="theloai">Thể loại:</label>
        <select id="theloai" name="theloai" required>
            <option value="manhua">Manhua</option>
            <option value="manhwa">Manhwa</option>
            <option value="manga">Manga</option>
            <option value="codai">Cổ Đại</option>
            <option value="xuyenkhong">Xuyên Không</option>
            <option value="tinhcam">Tình Cảm</option>
            <option value="dothi">Đô Thị</option>
            <option value="hocduong">Học Đường</option>
            <option value="tutien">Tu Tiên</option>
            <option value="hanhdong">Hành Động</option>
        </select>

        <label for="anh">Ảnh:</label>
        <input type="file" id="anh" name="image" accept="image/*" required>

        <label for="noidung">Nội dung:</label>
        <textarea id="noidung" name="noidung" rows="4" cols="50" required></textarea>

        <input type="submit" name = "add" value="Thêm truyện">
    </form>
    <?php
        if(isset($_POST['add'])){
            $name = $_POST['name'];
            $theloai = $_POST['theloai'];
            $noidung = $_POST['noidung'];

            if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
                $image = $_FILES['image']['name']; 
    
                $target_dir = "anh/anhduyet/";

                // Di chuyển file đã tải lên vào thư mục chỉ định
                if(move_uploaded_file($_FILES['image']['tmp_name'], $target_dir.$image)){
                    echo "Tải lên file thành công.";
                } else{
                    echo "Tải lên file thất bại.";
                }
            } else {
                $image = NULL;
            }


            $sql_add = "INSERT INTO duyet_truyen (ten_truyen, the_loai, anh, noi_dung)
                        VALUES ('$name', '$theloai', '$image', '$noidung')";
            
            if (mysqli_query($conn, $sql_add)) {
                $sql_nst = "INSERT INTO nhasangtao (username, ten_truyen)
                VALUES ('$username','$name')";
                mysqli_query($conn, $sql_nst);
                echo "Thêm truyện thành công";
            } else {
                echo "Lỗi: " . mysqli_error($conn);
            }
        }
    ?>
</body>
</html>