<?php 
    session_start();
    include('connect.php');
    $sql = "select * from truyen";
    $query = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/themchap.css">
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

                        // Lấy danh sách truyện tranh từ cơ sở dữ liệu với giới hạn số lượng truyện
                        $sql = "SELECT * FROM truyen LIMIT $start, $limit";
                        $result = mysqli_query($conn, $sql);

                        // Hiển thị danh sách truyện tranh
                        while ($row = mysqli_fetch_array($result)) {
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

                        // Tính toán tổng số trang
                        $countSql = "SELECT COUNT(*) as total FROM truyen";
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