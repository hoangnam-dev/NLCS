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
</head>

<body>
    <header class="lg_header">
        <div class="lg_header-img">
            <img src="../images/web_logo.png" alt="HNShop">
        </div>
        <h1 class="lg-heading">HNStore</h1>
    </header>
    <div class="lg_main">
        <div class="lg-main_overlay"></div>
        <div class="lg-main_body">
            <div class="form-general">
                <form id="form-login" class="form-login" method="POST" role="form">
                    <div class="form-container">
                        <div class="form_header">
                            <h3 class="form_heading">Đăng nhập</h3>
                        </div>
                        <div class="form_group">
                            <input type="text" id="lg_phone" name="phone" class="form-login_input" placeholder="Số điện thoại">
                            <span id="error-lg_phone" class="error-message"></span>
                        </div>
                        <div class="form_group">
                            <input type="password" id="lg_password" name="password" class="form-login_input" placeholder="Password">
                            <span id="error-lg_password" class="error-message"></span>
                        </div>

                        <div class="form_control">
                            <button type="submit" onclick="return validateLg();" name="submit" class="button adm_btn-login">Đăng nhập</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>









    <!-- =============== SCRIPT =============== -->
    <script src="./asset/jquery/jquery.js"></script>
    <!-- <script src="./asset/jquery/main.js"></script> -->
    <script>
        // Ajax
        // Login
        $("#form-login").submit(function(event) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: './test.php?login',
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

        function getElement(id) {
            return document.getElementById(id).value.trim();
        }

        function showErr(key, message) {
            document.getElementById("error-" + key).innerHTML = message;
        }

        // Validate Login Form
        function validateLg() {
            var phone = getElement("lg_phone");
            var password = getElement("lg_password");

            var flag = true;

            if (phone != "") {
                if (!/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im.test(phone)) {
                    flag = false;
                    message = "Vui lòng kiểm tra lại số điện thoại của bạn";
                    showErr("lg_phone", message);
                } else {
                    showErr("lg_phone", "");
                }
            } else {
                flag = false;
                message = "Vui lòng nhập vào số điện thoại của bạn";
                showErr("lg_phone", message);
            }

            if (password == "") {
                flag = false;
                message = "Vui lòng nhập vào mật khẩu của bạn";
                showErr("lg_password", message);
            } else {
                showErr("lg_password", "");
            }
            return flag;
        }
    </script>
</body>

</html>