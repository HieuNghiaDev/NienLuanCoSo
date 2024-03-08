<?php 
    session_start();
    include('connect.php');
    $sql = "select * from nguoidung where quyen = 0";
    $query = mysqli_query($conn, $sql);

    $sql_tr = "select *  from duyet_truyen";
    $query_tr = mysqli_query($conn, $sql_tr);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/duyet.css">
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
        <div class="printruyen">
    <tbody>
    <h2>Danh Sách Truyện Tranh</h2>
    <div class="comic-list">
        <?php
        // Xác định số lượng truyện tối đa trên mỗi trang
        $limit = 12;

        // Lấy giá trị của tham số page từ URL
        $page = isset($_GET['page']) ? $_GET['page'] : 1;

        // Tính toán vị trí bắt đầu lấy dữ liệu cho trang hiện tại
        $start = ($page - 1) * $limit;

        // Lấy danh sách truyện tranh từ cơ sở dữ liệu với giới hạn số lượng truyện
        $sql = "SELECT * FROM duyet_truyen LIMIT $start, $limit";
        $result = mysqli_query($conn, $sql);

        while ($row1 = mysqli_fetch_array($result)) {
            ?>
            <div class="comic-item">
                <img src="anh\anhduyet\<?php echo $row1['anh']?>" alt="<?php echo $row1['anh']?>">
                <h3><a href="chapadd.php?id=<?=$row['id']?>"><?php echo $row1['ten_truyen']?></a></h3>
                <form method="post">
                    <input type="hidden" name="id_truyen" value="<?php echo $row1['id_tr']; ?>">
                    <input type="submit" name='capnhat' value="Cập nhật">
                </form>
                <?php
                if(isset($_POST['capnhat']) && $_POST['id_truyen'] == $row1['id_tr']){
                    $name = $row1['ten_truyen'];
                    $theloai = $row1['the_loai'];
                    $anh = $row1['anh'];
                    $noidung = $row1['noi_dung'];

                    // Đường dẫn nguồn và đích cho tệp ảnh
                    $source = 'anh/anhduyet/' . $anh;
                    $destination = 'anh/truyen/' . $anh;

                    // Di chuyển tệp ảnh
                    if(rename($source, $destination)) {
                        echo "Di chuyển ảnh thành công";
                    } else {
                        echo "Lỗi di chuyển ảnh: " . mysqli_error($conn);
                    }

                    $sql_add = "INSERT INTO truyen (name, theloai, anh, noidung)
                                VALUES ('$name', '$theloai', '$anh', '$noidung')";
                                
                                if (mysqli_query($conn, $sql_add)) {
                                    $id = $row1['id_tr'];
                                    $sql_del = "DELETE from duyet_truyen where id_tr = '$id'";
                                    mysqli_query($conn, $sql_del);

                                    //$username = $_SESSION['dangnhap']['username'];
                                    //$sql_nst = "INSERT INTO nhasangtao (username, ten_truyen)
                                    //VALUES ('$username', '$name')";
                                    //mysqli_query($conn, $sql_nst);
                                    header("refresh: 0");
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
        <?php
                // Tính toán tổng số trang
                $countSql = "SELECT COUNT(*) as total FROM duyet_truyen";
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
</body>
</html>