<?php
include("connection.php");
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
                            <div class="insert_form">
                            <!-- <div class="form-input">
                                <label class="form_label" for="fname">Mã nhân viên  <i>(Mã nhân viên không được trùng nhau)</i>:</label>
                                    <input type="text" class="form_input" name="staff_id">
                            </div> -->
                            <div class="form-input">
                                <label class="form_label" for="fname">Họ và tên nhân viên(*):</label>
                                <input type="text" class="form_input" name="staff_name">
                            </div>
                            <div class="form-input">
                                <label class="form_label" for="fname">Chức vụ:</label>
                                <input type="text" class="form_input" name="staff_post">
                            </div>
                            <div class="form-input">
                                <label class="form_label" for="fname">Địa chỉ(*):</label>
                                <input type="text" class="form_input" name="staff_address">
                            </div>
                            <div class="form-input">
                                <label class="form_label" for="fname">Số điện thoại(*):</label>
                                <input type="text" class="form_input" name="staff_phone">
                            </div>
                            <div class="form-input">
                                <label class="form_label" for="fname">Mật khẩu(*):</label>
                                <input type="text" class="form_input" name="staff_password">
                            </div>
                        </div>
                        <input type="submit" class="button form-success_btn" name="submit" value="Thêm nhân viên">
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- <script type="text/javascript" src="./asset/bootstrap/js/bootstrap.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>