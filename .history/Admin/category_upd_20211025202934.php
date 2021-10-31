<?php
include("connection.php");
session_start();
$category_id = $_GET['id'];
$sql = "SELECT * FROM `LoaiSanPham` WHERE LoaiSanPham.MLSP = '$category_id';";
$rs = mysqli_query($conn, $sql);
$category = mysqli_fetch_assoc($rs);
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
                    <h2>Cập nhật loại sản phẩm</h2>
                </div>

                <div class="category_insert-content">
                    <form id="form-upd-category" class="category_insert-form" method="POST" role="form">
                        <div class="main_form-s">
                            <div class="form-input">
                                <label class="form_label" for="fname">Mã loại sản phẩm:</label>
                                <input type="text" class="form_input disable-input" name="category_id" readonly="true" value="<?php echo $category['MLSP'] ?>">
                            </div>
                            <div class="form-input">
                                <label class="form_label" for="fname">Tên loại sản phẩm:</label>
                                <input type="text" class="form_input" name="category_name" value="<?php echo $category['TenLSP'] ?>">
                            </div>
                        </div>
                        <div class="form-control">
                            <input type="submit" class="button form-success_btn" name="submit" value="Cập nhật">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- =============== SCRIPT =============== -->
    <script src="./asset/jquery/jquery.js"></script>
    <!-- <script src="./asset/jquery/main.js"></script> -->
    <script>
        // Ajax
        // Insert Category
        $("#form-upd-category").submit(function(event) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: './test.php?upd-category',
                data: $(this).serializeArray(),
                success: function(response) {
                    response = JSON.parse(response);
                    if (response.status == "0") {
                        alert(response.message);
                        console.log(response.message);
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