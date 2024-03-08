<?php 
    session_start();
    include('connect.php');
    $sql = "select * from nguoidung where quyen = 0";
    $query = mysqli_query($conn, $sql);

    $sql_yc = "select *  from yeu_cau";
    $query_yc = mysqli_query($conn, $sql_yc);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/duyetyc.css">
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
        <div class="printyc">
            <?php
            // Xác định số lượng truyện tối đa trên mỗi trang
            $limit = 12;

            // Lấy giá trị của tham số page từ URL
            $page = isset($_GET['page']) ? $_GET['page'] : 1;

            // Tính toán vị trí bắt đầu lấy dữ liệu cho trang hiện tại
            $start = ($page - 1) * $limit;

            // Lấy danh sách truyện tranh từ cơ sở dữ liệu với giới hạn số lượng truyện
            $sql = "SELECT * FROM yeu_cau LIMIT $start, $limit";
            $result = mysqli_query($conn, $sql);

            while ($row1 = mysqli_fetch_array($result)) {
                ?>
                <div class="comic-item">
                    <div class="username"><?php echo $row1['username']; ?></div>
                    <div class="nd"><?php echo $row1['noidung']; ?></div>
            
                    <form method="post">
                        <input type="hidden" name="id_yc" value="<?php echo $row1['id_yc']; ?>">
                        <input type="submit" name='duyet' value="Duyệt">
                    </form>
                    <?php
                    if(isset($_POST['duyet']) && $_POST['id_yc'] == $row1['id_yc']){
                        $username = $row1['username'];
                        // Cập nhật quyền trong bảng nguoidung
                        $sql_up = "UPDATE nguoidung SET quyen = 1 WHERE username = '$username'";
                                    
                        if (mysqli_query($conn, $sql_up)) {
                            // Xóa dữ liệu từ bảng yeu_cau
                            $sql_del = "DELETE FROM yeu_cau WHERE id_yc = ".$_POST['id_yc'];
                            if(mysqli_query($conn, $sql_del)){
                                header("refresh: 0");
                            } else {
                                echo "Lỗi: " . mysqli_error($conn);
                            }
                        } else {
                            echo "Lỗi: " . mysqli_error($conn);
                        }
                    }                            
                    ?>
                </div>
                <?php
            }
            ?>
        </div>
</tbody>
</html>