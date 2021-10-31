<?php
include("connection.php");
session_start();
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
                    <h2>Thêm khách hàng</h2>
                </div>

                <div class="main_insert-content">
                        <!-- <form action="customer_ins-processing.php" class="customer_insert-form" method="POST" role="form"> -->
                        <form id="form-ins-customer" class="customer_insert-form" method="POST" role="form">
                            <div class="main_form-s">
                            <div class="form-input">
                                <label class="form_label" for="fname">Họ và tên khách hàng:</label>
                                <input type="text" class="form_input" name="customer_name">
                            </div>
                            <div class="form-input">
                                <label class="form_label" for="fname">Địa chỉ:</label>
                                <input type="text" class="form_input" name="customer_company">
                            </div>
                            <div class="form-input">
                                <label class="form_label" for="fname">Số điện thoại:</label>
                                <input type="text" class="form_input" name="customer_phone">
                            </div>
                            <div class="form-input">
                                <label class="form_label" for="fname">Email:</label>
                                <input type="text" class="form_input" name="customer_fax">
                            </div>
                            <div class="form-input">
                                <label class="form_label" for="fname">Giới tính:</label>
                                <input type="text" class="form_input" name="customer_fax">
                            </div>
                            <div class="form-input">
                                <label class="form_label" for="fname">Mật khẩu:</label>
                                <input type="text" class="form_input" name="customer_fax">
                            </div>
                        </div>
                        <input type="submit" class="button form-success_btn" name="submit" value="Thêm khách hàng">
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
        $("#form-ins-customer").submit(function(event) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: "./process.php?ins-brand",
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