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
                    <form id="from-ins-prd" class="product_insert-form" method="POST" enctype="multipart/form-data">
                        <!-- <form id="from-ins-prd" action="./test.php?ins-prd" class="product_insert-form" method="POST" enctype="multipart/form-data"> -->
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
                                    <input type="text" class="form_input" id="fname" name="product_price">
                                </div>
                                <div class="form-input">
                                    <label class="form_label" for="fname">Giá bán</label>
                                    <input type="text" class="form_input" id="fname" name="product_sale">
                                </div>
                                <div class="form-input">
                                    <label class="form_label" for="fname">Số lượng</label>
                                    <input type="text" class="form_input" name="product_quantity">
                                </div>
                            </div>
                            <div class="main-form_right">
                                <div class="form-input">
                                    <label class="form_label" for="fname">Ảnh sản phẩm:</label>
                                    <input id="image" type="file" class="form_input" name="image_name">
                                    <input id="input-img" type="hidden" class="form_input" name="product_image" value="">
                                </div>
                                <div class="form-input">
                                    <label class="form_label" for="fname">Ngày ra mắt</label>
                                    <input type="date" class="form_input" name="product_debuts">
                                </div>
                                <div class="form-input">
                                    <label class="form_label" for="fname">Xuất xứ</label>
                                    <input type="text" class="form_input" name="product_madein">
                                </div>
                                <div class="form-input">
                                    <label class="form_label" for="fname">Loại hàng</label>
                                    <select class="form_input" name="product_category" id="category">
                                        <?php while ($category = mysqli_fetch_array($rs)) { ?>
                                            <option value="<?php echo $category['MLSP'] ?>"><?php echo $category['TenLSP'] ?></option>
                                        <?php }; ?>
                                    </select>
                                </div>
                                <div class="form-input">
                                    <label class="form_label" for="fname">Thương hiệu</label>
                                    <select class="form_input" name="product_brand" id="brand">
                                        <?php while ($brand = mysqli_fetch_array($rs1)) { ?>
                                            <option value="<?php echo $brand['MSTH'] ?>"><?php echo $brand['TenTH'] ?></option>
                                        <?php }; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input id="form-submit" onclick="return getImg();" type="submit" class="button form-success_btn" name="submit" value="Thêm sản phẩm">
                    </form>
                    <div class="content-title">
                    <h2>Thông sô kỹ thuật</h2>
                </div>
                    <form id="from-prd-det" class="product_insert-form" method="POST" enctype="multipart/form-data">
                        <!-- <form id="from-ins-prd" action="./test.php?ins-prd" class="product_insert-form" method="POST" enctype="multipart/form-data"> -->
                        <div class="main_form">
                            <div class="main-form_left">
                                <div class="form-input">
                                    <label class="form_label" for="fname">Màn hình:</label>
                                    <input type="text" class="form_input" id="fname" name="product_name">
                                </div>
                                <div class="form-input">
                                    <label class="form_label" for="fname">Camera trước:</label>
                                    <textarea type="text" class="form_input" id="fname" name="product_description"></textarea>
                                </div>
                                <div class="form-input">
                                    <label class="form_label" for="fname">Camera sau:</label>
                                    <input type="text" class="form_input" id="fname" name="product_price">
                                </div>
                                <div class="form-input">
                                    <label class="form_label" for="fname">Bộ nhớ:</label>
                                    <input type="text" class="form_input" id="fname" name="product_sale">
                                </div>
                                <div class="form-input">
                                    <label class="form_label" for="fname">Pin:</label>
                                    <input type="text" class="form_input" name="product_quantity">
                                </div>
                            </div>
                            <div class="main-form_right">
                                <div class="form-input">
                                    <label class="form_label" for="fname">CPU</label>
                                    <input type="date" class="form_input" name="product_debuts">
                                </div>
                                <div class="form-input">
                                    <label class="form_label" for="fname">GPU</label>
                                    <input type="text" class="form_input" name="product_madein">
                                </div>
                                <div class="form-input">
                                    <label class="form_label" for="fname">Ram:</label>
                                    <input id="input-img" type="text" class="form_input" name="product_image" value="">
                                </div>
                                <div class="form-input">
                                    <label class="form_label" for="fname">Hệ điều hành</label>
                                    <input type="text" class="form_input" name="product_madein">
                                </div>
                                <div class="form-input">
                                    <label class="form_label" for="fname">Thẻ Sim:</label>
                                    <input id="input-img" type="text" class="form_input" name="product_image" value="">
                                </div>
                            </div>
                        </div>
                        <input id="form-submit" onclick="return getImg();" type="submit" class="button form-success_btn" name="submit" value="Thêm sản phẩm">
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- <script type="text/javascript" src="./asset/bootstrap/js/bootstrap.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Lấy tên ảnh của input[type=file]
        function getImg() {
            var name = $("#image").prop('files')[0];
            // console.log(name['name']);
            // Gán vào input[type=hidden]
            document.getElementById('input-img').value = name['name'];
            // console.log(document.getElementById('input-img').value);
            return true;
        }
        // Ajax
        // Upload Image
        $("#from-ins-prd").submit(function(event) {
            event.preventDefault();
            var file_data = $("#image").prop('files')[0];
            // // Khởi tạo form data
            var img_data = new FormData();
            // Thêm file_data vào img_data
            img_data.append('file', file_data);
            $.ajax({
                type: "POST",
                url: "./test.php?ins-prd-img",
                data: img_data, // Gửi dữ liệu của ảnh trong img_data
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    response = JSON.parse(response);
                    if (response.status == "0") {
                        alert(response.message);
                        console.log(response.message);
                    } else {
                        // alert(response.message);
                        console.log(response.message);
                    }
                }
            });
        });

        // Insert Product
        $("#from-ins-prd").submit(function(event) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: './test.php?ins-prd',
                data: $(this).serializeArray(), // Gửi dữ liệu của form
                success: function(response) {
                    response = JSON.parse(response);
                    if (response.status == "0") {
                        alert(response.message);
                        console.log(response.message);
                    } else {
                        alert(response.message);
                        console.log(response.message);

                    }
                }
            });
        });
    </script>
</body>

</html>