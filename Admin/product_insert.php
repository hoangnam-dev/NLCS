<?php
include("connection.php");
session_start();
$sql = "SELECT * FROM LoaiSanPham";
$rs = mysqli_query($conn, $sql);
$sql1 = "SELECT * FROM ThuongHieu";
$rs1 = mysqli_query($conn, $sql1);
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
                    <div class="content-title">
                        <h2>Thông tin sản phẩm</h2>
                    </div>
                    <form id="form-ins-prd" class="product_insert-form" method="POST" enctype="multipart/form-data">
                        <!-- <form id="from-ins-prd" action="./test.php?ins-prd" class="product_insert-form" method="POST" enctype="multipart/form-data"> -->
                        <div class="main_form">
                            <div class="main-form_left">
                                <div class="form-input">
                                    <label class="form_label">Tên sản phẩm:</label>
                                    <input type="text" class="form_input" name="product_name">
                                </div>
                                <div class="form-input">
                                    <label class="form_label">Mô tả</label>
                                    <textarea type="text" class="form_input" name="product_description"></textarea>
                                </div>
                                <div class="form-input">
                                    <label class="form_label">Giá nhập</label>
                                    <input type="text" class="form_input" name="product_price">
                                </div>
                                <div class="form-input">
                                    <label class="form_label">Giá bán</label>
                                    <input type="text" class="form_input" name="product_sale">
                                </div>
                                <div class="form-input">
                                    <label class="form_label">Số lượng</label>
                                    <input type="text" class="form_input" name="product_quantity">
                                </div>
                            </div>
                            <div class="main-form_right">
                                <div class="form-input">
                                    <label class="form_label">Avatar sản phẩm:</label>
                                    <input id="image" type="file" class="form_input" name="image_name">
                                </div>
                                <div class="form-input">
                                    <label class="form_label">Ảnh khác của sản phẩm:</label>
                                    <input type="file" class="form_input" id="file" name="files[]" multiple/>
                                </div>
                                <div class="form-input">
                                    <label class="form_label">Ngày ra mắt</label>
                                    <input type="text" class="form_input" name="product_debuts">
                                </div>
                                <div class="form-input">
                                    <label class="form_label">Xuất xứ</label>
                                    <input type="text" class="form_input" name="product_madein">
                                </div>
                                <div class="form-input">
                                    <label class="form_label">Loại hàng</label>
                                    <select class="form_input" name="product_category" id="category">
                                        <?php while ($category = mysqli_fetch_array($rs)) { ?>
                                            <option value="<?php echo $category['MLSP'] ?>"><?php echo $category['TenLSP'] ?></option>
                                        <?php }; ?>
                                    </select>
                                </div>
                                <div class="form-input">
                                    <label class="form_label">Thương hiệu</label>
                                    <select class="form_input" name="product_brand" id="brand">
                                        <?php while ($brand = mysqli_fetch_array($rs1)) { ?>
                                            <option value="<?php echo $brand['MSTH'] ?>"><?php echo $brand['TenTH'] ?></option>
                                        <?php }; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="content-title">
                            <h2>Thông số kỹ thuật</h2>
                        </div>
                        <div class="main_form">
                            <div class="main-form_left">
                                <div class="form-input">
                                    <label class="form_label">Màn hình:</label>
                                    <input type="text" class="form_input" name="screen">
                                </div>
                                <div class="form-input">
                                    <label class="form_label">Camera sau:</label>
                                    <input type="text" class="form_input" name="camera">
                                </div>
                                <div class="form-input">
                                    <label class="form_label">Camera trước:</label>
                                    <input type="text" class="form_input" name="camera_selfie">
                                </div>
                                <div class="form-input">
                                    <label class="form_label">Ram:</label>
                                    <input type="text" class="form_input" name="ram">
                                </div>
                                <div class="form-input">
                                    <label class="form_label">Bộ nhớ trong:</label>
                                    <input type="text" class="form_input" name="rom">
                                </div>

                            </div>
                            <div class="main-form_right">
                                <div class="form-input">
                                    <label class="form_label">CPU</label>
                                    <input type="text" class="form_input" name="cpu">
                                </div>
                                <div class="form-input">
                                    <label class="form_label">GPU</label>
                                    <input type="text" class="form_input" name="gpu">
                                </div>
                                <div class="form-input">
                                    <label class="form_label">Dung lượng Pin:</label>
                                    <input type="text" class="form_input" name="battery">
                                </div>
                                <div class="form-input">
                                    <label class="form_label">Thẻ SIM:</label>
                                    <input type="text" class="form_input" name="sim">
                                </div>
                                <div class="form-input">
                                    <label class="form_label">Hệ điều hành</label>
                                    <input type="text" class="form_input" name="os">
                                </div>
                            </div>
                        </div>
                        <input id="form-submit" type="submit" class="button form-success_btn" name="submit" value="Thêm sản phẩm">
                    </form>

                </div>
            </div>
        </div>
    </div>


    <!-- <script type="text/javascript" src="./asset/bootstrap/js/bootstrap.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Ajax
        // Upload Product Image + Insert Product
        $("#form-ins-prd").submit(function(event) {
            event.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'process.php?ins-prd',
                data: new FormData(this), // Gửi dũ liệu của form(input+file) bằng PT FormData
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) { //console.log(response);
                    if (response.status == 0) {
                        alert(response.message);
                    } else {
                        alert(response.message);
                        location.reload();
                    }
                }
            });
        });
    </script>
</body>

</html>