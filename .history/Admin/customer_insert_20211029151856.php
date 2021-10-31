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
                                <label class="form_label">Họ và tên khách hàng(*):</label>
                                <input type="text" class="form_input" name="customer_name">
                                <span id="error-customer_name" class="error-message"></span>
                            </div>
                            <div class="form-input">
                                <label class="form_label">Địa chỉ(*):</label>
                                <input type="text" class="form_input" name="customer_address">
                                <span id="error-customer_address" class="error-message"></span>
                            </div>
                            <div class="form-input">
                                <label class="form_label">Số điện thoại(*):</label>
                                <input type="text" class="form_input" name="customer_phone">
                                <span id="error-customer_phone" class="error-message"></span>
                            </div>
                            <div class="form-input">
                                <label class="form_label">Email:</label>
                                <input type="text" class="form_input" name="customer_email">
                                <span id="error-customer_email" class="error-message"></span>
                            </div>
                            <div class="form-input">
                                <label class="form_label">Giới tính:</label>
                                <input type="text" class="form_input" name="customer_sex">
                            </div>
                            <div class="form-input">
                                <label class="form_label">Mật khẩu(*):</label>
                                <input type="text" class="form_input" name="customer_password">
                                <span id="error-customer_password" class="error-message"></span>
                            </div>
                            <div class="form-input">
                                <label class="form_label">Nhập lại mật khẩu(*):</label>
                                <input type="text" class="form_input" name="customer_repassword">
                                <span id="error-customer_repassword" class="error-message"></span>
                            </div>
                        </div>
                        <input type="submit" class="button form-success_btn" name="submit" value="Thêm khách hàng" onclick="return validateCustomer();">
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- =============== SCRIPT =============== -->
    <script src="./asset/jquery/jquery.js"></script>
    <script src="./asset/jquery/main.js"></script>
    <script>
        // Validate Form
        function validateCustomer() {
            var name = getElement("customer_username");
            var address = getElement("customer_address");
            var phone = getElement("customer_phone");
            var email = getElement("customer_email");
            var password = getElement("customer_password");
            var repassword = getElement("customer_repassword");

            var flag = true;

            if (name != "") {
                if (!/[a-zA-Z0-9]/.test(name)) {
                    flag = false;
                    message = "Vui lòng nhập vào họ tên";
                    showErr("customer_name", message);
                } else {
                    showErr("customer_name", "");
                }
            } else {
                flag = false;
                message = "Vui lòng nhập vào họ tên";
                showErr("customer_name", message);
            }

            if (address == "") {
                flag = false;
                message = "Vui lòng nhập vào địa chỉ";
                showErr("customer_address", message);
            } else {
                showErr("customer_address", "");
            }

            if (phone != "") {
                if (!/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im.test(phone)) {
                    flag = false;
                    message = "Vui lòng kiểm tra lại số điện thoại";
                    showErr("customer_phone", message);
                } else {
                    showErr("customer_phone", "");
                }
            } else {
                flag = false;
                message = "Vui lòng nhập vào số điện thoại";
                showErr("customer_phone", message);
            }

            if (email != '') {
                if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
                    flag = false;
                    message = "Vui lòng kiểm tra email"
                    showErr("customer_email", message);
                } else {
                    showErr("customer_email", '');
                }
            } else {
                flag = false;
                message = "Vui lòng nhập vào địa chỉ"
                showErr("customer_email", message);
            }

            if (password == "") {
                flag = false;
                message = "Vui lòng nhập vào mật khẩu";
                showErr("customer_password", message);
            } else {
                showErr("customer_password", "");
            }
            if (repassword != "") {
                if (repassword != password) {
                    flag = false;
                    message = "Vui lòng kiểm tra lại Mật khẩu nhập lại";
                    showErr("customer_repassword", message);
                } else {
                    showErr("customer_repassword", "");
                }
            } else {
                flag = false;
                message = "Trường này không được để trống";
                showErr("customer_repassword", message);
            }
            return flag;
        }


        // Ajax
        // Insert Brand
        // $("#form-ins-customer").submit(function(event) {
        //     event.preventDefault();
        //     $.ajax({
        //         type: "POST",
        //         url: "./process.php?ins-customer",
        //         data: $(this).serializeArray(),
        //         success: function(response) {
        //             response = JSON.parse(response);
        //             if (response.status == "0") {
        //                 alert(response.message);
        //                 console.log(response.message);
        //             } else {
        //                 alert(response.message);
        //                 location.reload();
        //             }
        //         }
        //     });
        // });
    </script>
</body>

</html>