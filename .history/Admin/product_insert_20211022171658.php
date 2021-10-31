<?php
include("connection.php");

$sql = "SELECT * FROM LoaiSanPham";
$rs = mysqli_query($conn,$sql);
$sql1 = "SELECT * FROM NhanHieu";
$rs1 = mysqli_query($conn,$sql1);
// include("./funciton.php");
// if(isset($_GET['insert']) && $_GET['insert']=='product'){
//     $image_name = $_FILES['image_name'];
//     $err = uploadFiles($image_name);
//     if(!empty($errors)){
//         header("location: product_insert.php?success=Không hành công");
//         exit;
//     }else{
//         header("location: product_mamage.php?success=Thành công");
//     }
// }else {
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
                    <h2>Thêm sản phẩm</h2>
                </div>

                <div class="main_insert-content">
                    <form action="product_ins-processing.php?insert=product" class="product_insert-form" method="POST" enctype="multipart/form-data">
                        <div class="main_form">
                            <div class="main-form_left">
                                <div class="form-input">
                                    <label class="form_label" for="fname">Tên sản phẩm:</label>
                                    <input type="text" class="form_input" id="fname" name="product_name">
                                </div>
                                <div class="form-input">
                                    <label class="form_label" for="fname">Mô tả</label>
                                    <textarea type="text" class="form_input" id="fname" name="product_description"></textarea>
                                </div>
                                <div class="form-input">
                                    <label class="form_label" for="fname">Giá nhập</label>
                                    <input type="text" class="form_input" id="fname" name="product_priceIn">
                                </div>
                                <div class="form-input">
                                    <label class="form_label" for="fname">Giá bán</label>
                                    <input type="text" class="form_input" id="fname" name="product_priceOut">
                                </div>
                            </div>
                            <div class="main-form_right">
                                <div class="form-input">
                                    <label class="form_label" for="fname">Ảnh sản phẩm:</label>
                                    <!-- <input type="file" class="form_input" name="image_name"> -->
                                    <input type="file" class="form_input" name="image_name">
                                </div>
                                <div class="form-input">
                                    <label class="form_label" for="fname">Số lượng</label>
                                    <input type="text" class="form_input" name="product_quantity">
                                </div>
                                <div class="form-input">
                                    <label class="form_label" for="fname">Loại hàng</label>
                                    <select class="form_input" name="product_category" id="category">
                                        <?php while($category = mysqli_fetch_array($rs)){ ?>
                                        <option value="<?php echo $category['MLSP']?>"><?php echo $category['TenLSP']?></option>
                                        <?php };?>
                                    </select>
                                </div>
                                <div class="form-input">
                                    <label class="form_label" for="fname">Nhãn hiệu</label>
                                    <select class="form_input" name="product_brand" id="brand">
                                        <?php while($brand = mysqli_fetch_array($rs1)){ ?>
                                        <option value="<?php echo $brand['MaNH']?>"><?php echo $brand['TenNH']?></option>
                                        <?php };?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="submit" class="button form-success_btn" name="submit" value="Thêm sản phẩm">
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- <script type="text/javascript" src="./asset/bootstrap/js/bootstrap.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
<?php 
// }
?>