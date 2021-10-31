<?php
include("connection.php");
$admin = (isset($_SESSION['admin'])) ? $_SESSION['admin'] : [];
if(empty($admin)){
    header("location: ./login.php");
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
                                        <th colspan="1" class="btn-edit">Tùy chọn</th>
                                        <th>STT</th>
                                        <th>Mã sản phẩm</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Mô tả</th>
                                        <th>Giá (VNĐ)</th>
                                        <th>Giá bán (VNĐ)</th>
                                        <th>Số lượng hàng</th>
                                        <th>Loại sản phẩm</th>
                                        <th>Thương hiệu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1;
                                    while($product = mysqli_fetch_array($rs)){
                                    ?>
                                    <tr>
                                        <td class="btn-edit">
                                            <a href="product_upd.php?id=<?php echo $product['MSSP']; ?>" class="button-edit btn-update">Chi tiết</a>
                                            <a href="./process.php?action=delete-prd&id=<?php echo $product['MSSP']; ?>" class="button-edit btn-delete">Xóa</a>
                                        </td>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $product['MSSP']?></td>
                                        <td><?php echo $product['TenSP']?></td>
                                        <td><?php echo $product['MoTa']?></td>
                                        <td><?php echo number_format($product['Gia'],0,',','.')?></td>
                                        <td><?php echo number_format($product['GiaBan'],0,',','.')?></td>
                                        <td><?php echo $product['SoLuongHang']?></td>
                                        <td>
                                            <!-- <?php
                                                $product_cate = $product['MLSP'];
                                                $sql1 = "SELECT loaiSanPham.TenLSP FROM `LoaiSanPham` WHERE loaiSanPham.MLSP =  '$product_cate' ;";
                                                $rs1 = mysqli_query($conn,$sql1);
                                                while($category_name = mysqli_fetch_array($rs1)){
                                                    echo $category_name['TenLSP'];
                                                }
                                            ?> -->
                                            <?php 
                                                // echo $product['TenLSP']
                                                echo $product['MLSP'];
                                                ?>
                                        </td>
                                        <td>
                                            <!-- <?php
                                                $product_cate = $product['MLSP'];
                                                $sql1 = "SELECT ThuongHieu.TenLSP FROM `LoaiSanPham` WHERE loaiSanPham.MLSP =  '$product_cate' ;";
                                                $rs1 = mysqli_query($conn,$sql1);
                                                while($category_name = mysqli_fetch_array($rs1)){
                                                    echo $category_name['TenLSP'];
                                                }
                                            ?> -->
                                            <?php 
                                                // echo $product['TenLSP']
                                                echo $product['MSTH'];
                                                ?>
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
</body>
</html>