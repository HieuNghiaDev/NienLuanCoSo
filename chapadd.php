<?php 
    session_start();
    include('connect.php');
    $id = $_GET['id'];
    $sql = "select * from nguoidung";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($query);
    $username = $_SESSION['dangnhap']['username'];

    $sql_truyen = "select * from truyen where id = '$id'";
    $query_truyen = mysqli_query($conn, $sql_truyen);
    $row_truyen = mysqli_fetch_array($query_truyen);
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
    <h2>THÊM CHAP</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="matruyen">Mã truyện:</label>
        <input type="text" id="name" name="id" value = "<?=$row_truyen['id']?>" readonly >

        <label for="tenchap">Chap:</label>
        <input type="text" id="chap" name="chap" required>

        <label for="anh">Ảnh:</label>
        <input type="file" id="anh" name="image[]" multiple required>


        <input type="submit" name = "add" value="Thêm Chap">
    </form>
    <?php
        if(isset($_POST['add'])){
            $chap = $_POST['chap'];
            $id = $row_truyen['id'];
            
            if(isset($_FILES['image'])){
                $images = $_FILES['image'];
                $total = count($images['name']);
        
                for( $i=0 ; $i < $total ; $i++ ) {
                    $image = $images['name'][$i];
                    $target_dir = "anh/chap/";
        
                    if(move_uploaded_file($images['tmp_name'][$i], $target_dir.$image)){
                        echo "Tải lên file thành công.";
                        
                        $sql_add = "INSERT INTO chap (id, tenchap, anh)
                                    VALUES ('$id', '$chap', '$image')";

                        $sql_lastupdate = "UPDATE truyen SET last_updated = NOW() WHERE id = '$id'";

                        
                        if (mysqli_query($conn, $sql_add)) {
                            mysqli_query($conn, $sql_lastupdate);
                            echo "Thêm ảnh vào chap thành công";
                        } else {
                            echo "Lỗi: " . mysqli_error($conn);
                        }
                    } else{
                        echo "Tải lên file thất bại.";
                    }
                }
            }
        }        
    ?>
</body>
</html>