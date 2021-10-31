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
                    <h2>Thêm nhân viên</h2>
                </div>

                <div class="main_insert-content">
                        <form action="process.php?action=add-staff" class="staff_insert-form" method="POST" role="form">
                        <div class="main_form">
                            <div class="main-form_left">
                                <div class="form-input">
                                    <label class="form_label">Họ và tên(*):</label>
                                    <input id="staff_name" type="text" class="form_input" name="staff_name">
                                    <span id="error-staff_name" class="error-message"></span>
                                </div>
                                <div class="form-input">
                                    <label class="form_label">Địa chỉ(*):</label>
                                    <input id="staff_address" type="text" class="form_input" name="staff_address">
                                    <span id="error-staff_address" class="error-message"></span>
                                </div>
                                <div class="form-input">
                                    <label class="form_label">Số điện thoại(*):</label>
                                    <input id="staff_phone" type="text" class="form_input" name="staff_phone">
                                    <span id="error-staff_phone" class="error-message"></span>
                                </div>
                                <div class="form-input">
                                    <label class="form_label">Email:</label>
                                    <input id="staff_email" type="text" class="form_input" name="staff_email">
                                    <span id="error-staff_email" class="error-message"></span>
                                </div>
                            </div>
                            <div class="main-form_right">
                                <div class="form-input">
                                    <label class="form_label">Giới tính:</label>
                                    <input id="staff_sex" type="text" class="form_input" name="staff_sex">
                                </div>
                                <div class="form-input">
                                    <label class="form_label">Mật khẩu(*):</label>
                                    <input id="staff_password" type="text" class="form_input" name="staff_password">
                                    <span id="error-staff_password" class="error-message"></span>
                                </div>
                                <div class="form-input">
                                    <label class="form_label">Nhập lại mật khẩu(*):</label>
                                    <input id="staff_repassword" type="text" class="form_input" name="staff_repassword">
                                    <span id="error-staff_repassword" class="error-message"></span>
                                </div>
                            </div>
                        </div>
                        <button id="submit" type="submit" class="button form-success_btn" name="submit" onclick="return validateStaff();">Thêm nhân viên</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- =============== SCRIPT =============== -->
    
    <script>
        function showErr(key, message) {
            document.getElementById("error-" + key).innerHTML = message;
        }
        // Validate Form
        function validateStaff() {
            // var name = getElement("staff_name");
            var name = $("#staff_name").text();
            // alert(name);
            var address =$("#staff_address").text();
            var phone =$("#staff_phone").text();
            var email =$("#staff_email").text();
            var password =$("#staff_password").text();
            var repassword =$("#staff_repassword").text();

            var flag = true;

            if (name != "") {
                if (!/[a-zA-Z0-9]/.test(name)) {
                    flag = false;
                    message = "Vui lòng nhập vào họ tên";
                    showErr("staff_name", message);
                } else {
                    showErr("staff_name", "");
                }
            } else {
                flag = false;
                message = "Vui lòng nhập vào họ tên";
                showErr("staff_name", message);
            }

            if (address == "") {
                flag = false;
                message = "Vui lòng nhập vào địa chỉ";
                showErr("staff_address", message);
            } else {
                showErr("staff_address", "");
            }

            if (phone != "") {
                if (!/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im.test(phone)) {
                    flag = false;
                    message = "Vui lòng kiểm tra lại số điện thoại";
                    showErr("staff_phone", message);
                } else {
                    showErr("staff_phone", "");
                }
            } else {
                flag = false;
                message = "Vui lòng nhập vào số điện thoại";
                showErr("staff_phone", message);
            }

            if (email != "") {
                if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
                    flag = false;
                    message = "Vui lòng kiểm tra email"
                    showErr("staff_email", message);
                } else {
                    showErr("staff_email", "");
                }
            } else {
                flag = false;
                message = "Vui lòng nhập vào địa chỉ"
                showErr("staff_email", message);
            }

            if (password == "") {
                flag = false;
                message = "Vui lòng nhập vào mật khẩu";
                showErr("staff_password", message);
            } else {
                showErr("staff_password", "");
            }
            if (repassword != "") {
                if (repassword != password) {
                    flag = false;
                    message = "Vui lòng kiểm tra lại Mật khẩu nhập lại";
                    showErr("staff_repassword", message);
                } else {
                    showErr("staff_repassword", "");
                }
            } else {
                flag = false;
                message = "Trường này không được để trống";
                showErr("staff_repassword", message);
            }
            return flag;
        }

        // Ajax
        // Insert staff
        $("#form-ins-staff").submit(function(event) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: "./process.php?ins-staff",
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
    <!-- <script src="./asset/jquery/main.js"></script> -->
    <script src="./asset/jquery/jquery.js"></script>
</body>
</html>