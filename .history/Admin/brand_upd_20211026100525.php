<?php
include("connection.php");
$brand_id=$_GET['id'];
session_start();
$sql = "SELECT * FROM `ThuongHieu` WHERE ThuongHieu.MSTH = '$brand_id';";
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
                    <h2>Cập nhật thương hiệu sản phẩm</h2>
                </div>

                <div class="brand_insert-content">
                    <form id="form-upd-brand" class="brand_insert-form" method="POST" role="form">
                        <div class="main_form-s">
                        <?php while($brand = mysqli_fetch_array($rs)){ ?>
                            <div class="form-input">
                                <label class="form_label" for="fname">Mã thương hiệu:</label>
                                <input type="text" class="form_input disable-input" name="brand_id" readonly="true" value="<?php echo $brand['MSTH']?>">
                            </div>
                            <div class="form-input">
                                <label class="form_label" for="fname">Tên thương hiệu:</label>
                                <input type="text" class="form_input" name="brand_name" value="<?php echo $brand['TenTH']?>">
                            </div>
                        </div>
                        <?php }?>
                        <input type="submit" class="button form-success_btn" name="submit" value="Cập nhật">
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
        // Insert Brand
        $("#form-upd-brand").submit(function(event) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: './process.php?upd-brand',
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