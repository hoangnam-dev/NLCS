<?php
include("connection.php");
include("function.php");
session_start();
$admin = (isset($_SESSION['admin'])) ? $_SESSION['admin'] : [];
if(empty($admin)){
    header("location: ./index.php");
    exit;
}
// $sql1 = "SELECT * FROM `SanPham` INNER JOIN LoaiSanPham ON LoaiSanPham.MLSP =  SanPham.MLSP";
$sql = "SELECT * FROM `SanPham`";
$rs = mysqli_query($conn,$sql);
// $sql1 = "SELECT * FROM `SanPham` INNER JOIN ThuongHieu ON ThuongHieu.MLSP =  SanPham.MLSP";
// $rs1 = mysqli_query($conn,$sql1);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Main</title>
    <link rel="stylesheet" type="text/css" href="./asset/base.css">
    <link rel="stylesheet" type="text/css" href="./asset/main1.css">
    <link rel="stylesheet" href="./asset/fonts/fontawesome-free-5.15.4/css/all.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="./asset/bootstrap/css/bootstrap.min.css"> -->
</head>
<body>
    <div class="main">
        <div class="grid_full-width wrapper">
            <?php
                include("sidebar.php");
            ?>
            <div class="container">
                <div class="container-title">
                    <h2>Quản lý sản phẩm</h2>
                    <a href="./product_insert.php" class="container-title_btn">
                        <div class="button button-general title-btn">Thêm sản phẩm</div>
                    </a>
                </div>

                <div class="main-content">
                    <div class="main-list">
                        <div class="main-content_control">
                            <div class="content-title">Danh sách sản phẩm:</div>
                        </div>
                        <div class="main-table">
                            <table class="main-table_content">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Giá (VNĐ)</th>
                                        <th>Giá bán (VNĐ)</th>
                                        <th>Số lượng hàng</th>
                                        <th>Loại sản phẩm</th>
                                        <th>Kinh doanh</th>
                                        <th colspan="1" class="btn-edit">Tùy chọn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1;
                                    while($product = mysqli_fetch_array($rs)){
                                    ?>
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $product['TenSP']?></td>
                                        <td><?php echo number_format($product['Gia'],0,',','.')?></td>
                                        <td><?php echo number_format($product['GiaBan'],0,',','.')?></td>
                                        <td><?php echo $product['SoLuongHang']?></td>
                                        <td>
                                            <?php
                                                $product_category = $product['MLSP'];
                                                $sql1 = "SELECT * FROM `LoaiSanPham` WHERE loaiSanPham.MLSP =  '$product_category' ;";
                                                $rs1 = mysqli_query($conn,$sql1);
                                                $category_name = mysqli_fetch_assoc($rs1);
                                                echo $category_name['TenLSP'];
                                            ?>
                                        </td>
                                        <td>
                                            <a href="" id="check" class="check">
                                                <i class="prd-icon fas fa-check-circle"></i>
                                            </a>
                                            <a href="" id="exit" class="exit">
                                            <i class="fas fa-times-circle"></i>
                                            </a>
                                        </td>
                                        <td class="btn-edit">
                                            <a href="test-ajax.php?id=<?php echo $product['MSSP']; ?>" class="button-edit btn-update">Chi tiết</a>
                                        </td>
                                    </tr>
                                    <?php $i++;}?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- <script type="text/javascript" src="./asset/bootstrap/js/bootstrap.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./asset/jquery/main.js"></script>
    <script>
        
        $('#check').click(function() {
            // alert("oke");
            popupClose('check');
            popupOpen("exit");
        });
    </script>
</body>
</html>