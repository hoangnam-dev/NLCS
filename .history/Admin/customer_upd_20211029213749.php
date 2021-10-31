<?php
include("connection.php");
session_start();
$customer_id = $_GET['id'];
$sql = "SELECT * FROM `KhachHang` WHERE KhachHang.MSKH = '$customer_id';";
$rs = mysqli_query($conn, $sql);
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
    <div class="main">
        <div class="grid_full-width wrapper">
            <?php
            include("sidebar.php");
            ?>
            <div class="container">
                <div class="container-title">
                    <h2>Cập nhật khách hàng</h2>
                </div>

                <div class="customer_insert-content">
                    <form action="process.php?action=update-customer&id=<?php echo $customer_id;?>" class="customer_insert-form" method="POST" role="form">
                        <div class="main_form">
                            <?php $customer = mysqli_fetch_assoc($rs) ?>
                            <div class="main-form_left">
                                <div class="form-input">
                                    <label class="form_label" for="fname">Mã số khách hàng:</label>
                                    <input type="text" class="form_input disable-input" id="fname" name="customer_id" readonly="true" value="<?php echo $customer['MSKH'] ?>">
                                </div>
                                <div class="form-input">
                                    <label class="form_label" for="fname">Tên khách hàng:</label>
                                    <input type="text" class="form_input" id="fname" name="customer_name" value="<?php echo $customer['HoTenKH'] ?>">
                                    <span id="error-customer_name" class="error-message"></span>
                                </div>
                                <div class="form-input">
                                    <label class="form_label" for="fname">Đia chỉ</label>
                                    <input type="text" class="form_input" id="fname" name="customer_address" value="<?php echo $customer['DiaChi'] ?>">
                                    <span id="error-customer_address" class="error-message"></span>
                                </div>
                                <div class="form-input">
                                    <label class="form_label" for="fname">Gioi tính:</label>
                                    <input type="text" class="form_input" id="fname" name="customer_sex" value="<?php echo $customer['GioiTinh'] ?>">
                                    <span id="error-customer_sex" class="error-message"></span>
                                </div>
                            </div>
                            <div class="main-form_right">
                                <div class="form-input">
                                    <label class="form_label" for="fname">Số điện thoại:</label>
                                    <input type="text" class="form_input" id="fname" name="customer_phone" value="<?php echo $customer['SoDienThoai'] ?>">
                                    <span id="error-customer_phone" class="error-message"></span>
                                </div>
                                <div class="form-input">
                                    <label class="form_label" for="fname">Email:</label>
                                    <input type="text" class="form_input" id="fname" name="customer_email" value="<?php echo $customer['Email'] ?>">
                                    <span id="error-customer_email" class="error-message"></span>
                                </div>
                                <div class="form-input">
                                    <label class="form_label" for="fname">Mật khẩu:</label>
                                    <input type="text" class="form_input" id="fname" name="customer_password" value="<?php echo $customer['MatKhau'] ?>">
                                    <span id="error-customer_password" class="error-message"></span>
                                </div>
                            </div>
                        </div>
                        <button id="submit" type="submit" class="button form-success_btn" name="submit" onclick="return validateCustomer();">Cập nhật khách hàng</button>
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
        function validateCustomer() {
            // var name = getElement("customer_name");
            var name = $("#customer_name").value();
            alert(name);
            var address =$("#customer_address").value();
            var phone =$("#customer_phone").value();
            var email =$("#customer_email").value();
            var password =$("#customer_password").value();
            var repassword =$("#customer_repassword").value();

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

            if (email != "") {
                if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
                    flag = false;
                    message = "Vui lòng kiểm tra email"
                    showErr("customer_email", message);
                } else {
                    showErr("customer_email", "");
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

            return flag;
        }

        // Ajax
        // Update Customer
        // $("#form-upd-customer").submit(function(event) {
        //     event.preventDefault();
        //     $.ajax({
        //         type: "POST",
        //         url: "./process.php?upd-customer",
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
    <!-- <script src="./asset/jquery/main.js"></script> -->
    <script src="./asset/jquery/jquery.js"></script>
</body>

</html>