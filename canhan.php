<?php 
    session_start();
    include('connect.php');

    if(isset( $_SESSION['dangnhap']['username'])){
        $sql = "select * from nguoidung";
        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($query);
        $username = $_SESSION['dangnhap']['username'];
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/canhan.css">
    <title>View</title>
</head>
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
    <form method="post" action="">
        <div class="search_container">
            <input type="text" name = "name" placeholder="Tìm kiếm...">
            <button name = "tim">Tìm kiếm</button>
        </div>
    </form>
    <?php
        if(isset($_POST['tim'])){
            $name = $_POST['name'];
            
            $sqla = "select * from truyen where name like '%$name%'";
            $querya = mysqli_query($conn, $sqla);

            while ($row = mysqli_fetch_array($querya)) {
                        ?>
                        <a href="chapadd.php?id=<?=$row['id']?>">
                            <table class="table">
                                <tr>
                                    <td><img src="anh\truyen\<?php echo $row['anh']?>" alt="loi anh"></td>
                                    <td><a href="chapadd.php?id=<?=$row['id']?>" class="tentr"><?php echo $row['name']?></a></td>
                                </tr>
                                <tr>
                                    <td><a id = "adel" href="xoatruyen.php?id=<?=$row['id']?>" onclick = "
                                        return confirm('Bạn có muốn xóa ?');">Xóa</a></td>
                                </tr>
                            </table>
                        </a>
                    <?php
                }
        }else{
            ?>
            <div class="printruyen">
                <tbody>
                    <h2>Danh Sách Truyện Tranh ></h2>

                        <?php
                        // Xác định số lượng truyện tối đa trên mỗi trang
                        $limit = 12;

                        // Lấy giá trị của tham số page từ URL
                        $page = isset($_GET['page']) ? $_GET['page'] : 1;

                        // Tính toán vị trí bắt đầu lấy dữ liệu cho trang hiện tại
                        $start = ($page - 1) * $limit;

                        $sql_nst = "SELECT * FROM nhasangtao where username = '$username'";
                        $result_nst = mysqli_query($conn, $sql_nst);
                        //echo $sql_nst;
                        while ($row_nst = mysqli_fetch_array($result_nst)) {
                            $truyen = $row_nst['ten_truyen'];
                            $sql = "SELECT * FROM truyen where name = '$truyen' LIMIT $start, $limit";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_array($result)
                            ?>
                            <a href="chapadd.php?id=<?=$row['id']?>">
                                <table class="table">
                                    <tr>
                                        <td><img src="anh\truyen\<?php echo $row['anh']?>" alt="loi anh"></td>
                                        <td><a href="chapadd.php?id=<?=$row['id']?>" class="tentr"><?php echo $row['name']?></a></td>
                                    </tr>
                                    <tr>
                                        <td><a id = "adel" href="xoatruyen.php?tentruyen=<?=$row['name']?>" onclick = "
                                        return confirm('Bạn có muốn xóa ?');">Xóa</a></td>
                                    </tr>
                                </table>
                            </a>
                            <?php
                        }
                        // Tính toán tổng số trang
                        $countSql = "SELECT COUNT(*) as total FROM nhasangtao where username = '$username'";
                        $countResult = mysqli_query($conn, $countSql);
                        $countRow = mysqli_fetch_assoc($countResult);
                        $totalPages = ceil($countRow['total'] / $limit);
                        ?>
                        <div class="pagination">
                            <?php
                            // Hiển thị liên kết đến các trang
                            for ($i = 1; $i <= $totalPages; $i++) {
                                if ($i == $page) {
                                    echo "<strong>$i</strong> ";
                                } else {
                                    echo "<a href=\"?page=$i\">$i</a> ";
                                }
                            }
                        ?>
                    </div>
                </tbody>
            </div>
        <?php
        }
    ?>
</body>
</html>


