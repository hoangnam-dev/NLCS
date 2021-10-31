<?php
include("connection.php");
session_start();
$sql = "SELECT * FROM `LoaiSanPham`";
$rs = mysqli_query($conn,$sql);
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
                    <h2>Quản lý loại sản phẩm</h2>
                    <a href="category_insert.php" class="container-title_btn">
                        <div class="button button-general title-btn">Thêm loại sản phẩm</div>
                    </a>
                </div>

                <div class="main-content">
                    <div class="main-list">
                        <div class="main-content_control">
                            <div class="content-title">Danh sách loại sản phẩm:</div>
                        </div>
                        <div class="main-table">
                            <table class="main-table_content">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã loại sản phẩm</th>
                                        <th>Tên loại sản phẩm</th>
                                        <th>Tuỳ Chọn</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; while($category = mysqli_fetch_array($rs)){ ?>
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $category['MLSP']?></td>
                                        <td><?php echo $category['TenLSP']?></td>
                                        <td class="btn-edit">
                                            <a href="category_upd.php?id=<?php echo $category['MLSP']; ?>" class="button-edit btn-update">Chi tiết</a>
                                            <a href="process.php?action=delete-category&id=<?php echo $category['MLSP']; ?>" class="button-edit btn-delete">Xóa</a>
                                        </td>
                                    </tr>
                                    <?php $i++; }?>
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