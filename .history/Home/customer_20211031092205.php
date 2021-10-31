<?php
include("./connection.php");
$user = (isset($_SESSION['user'])) ? $_SESSION['user'] : [];
if(empty($user)){
    header("location: ./index.php");
    exit;
}
// $customer_id = $user['MSKH'];
// $sql = "SELECT * FROM KhachHang WHERE KhachHang.MSKH = '$customer_id'";
// $rs = mysqli_query($conn, $sql);
// $customer = mysqli_fetch_assoc($rs);
// $customer_id = $user['MSKH'];
// $sql_address = "SELECT * FROM DiaChiKH WHERE DiaChiKH.MSKH = '$customer_id'";
// $rs_address = mysqli_query($conn, $sql_address);
// echo "<pre>";
// print_r($user);
// exit;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Index Demo</title>
    <!--Reset CSS -->
    <link rel="stylesheet" href="./asset/normalize.css" />
    <!-- CSS and font of Web -->
    <link rel="stylesheet" href="./asset/base.css" />
    <link rel="stylesheet" href="./asset/main.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="./asset/fonts/fontawesome-free-5.15.4/css/all.min.css">

</head>

<body>
    <div class="main">
        <?php
        include("./header.php");
        ?>

        <div class="main_container">
            <div class="grid">
                <div class="grid_row main_content customer_content">
                    <div class="grid_col-12 ctn-box ctn-mb">
                        <div class="customer_title">
                            <h2 class="customer_title-name">Thông tin tài khoản</h2>
                        </div>
                        <div class="customer_info">
                            <form action="process.php?user=update&id=<?php echo $user['MSKH']?>" method="POST" class="customer_form" role="form">
                                <div class="customer-info_account">
                                    <div class="account_title">
                                        <h2 class="account_title-name">Thông tin tài khoản</h2>
                                    </div>
                                    <div class="account_info-input">
                                        <label class="info-input_label">Số điện thoại:</label>
                                        <input type="text" class="info-input_input" name="customer-phone" value="<?php echo $user['SoDienThoai']?>">
                                    </div>
                                    <div class="account_info-input">
                                        <label class="info-input_label">Mật khẩu:</label>
                                        <div class="info-input_input info-password">
                                            <input id="password" type="password" class="info_input" name="customer-password" value="<?php echo $user['MatKhau']?>" readonly>
                                            <input type="button" id="showPassword" value="Hiển thị" class="btn-showPass"></input>
                                        </div>
                                    </div>
                                    <div class="account_info-input">
                                        <label class="info-input_label">Đổi mật khẩu:</label>
                                        <div class="info-input_input info-password">
                                            <input id="repassword" type="password" class="info_input input-repass" name="customer-newpass">
                                            <input type="button" id="showRePassword" value="Hiển thị" class="btn-showPass showrepass"></input>
                                        </div>
                                    </div>
                                </div>
                                <div class="customer-info_personal">
                                    <div class="account_title">
                                        <h2 class="account_title-name">Thông tin cá nhân</h2>
                                    </div>
                                    <div class="account_info-input">
                                        <label class="info-input_label">Họ và tên:</label>
                                        <input type="text" class="info-input_input" name="customer-name" value="<?php echo $user['HoTenKH']?>">
                                    </div>
                                    <div class="account_info-input">
                                        <label class="info-input_label">Giới tính:</label>
                                        <div class="info-choose  info-radio">
                                            <div class="info-choose_input">
                                                <input type="radio" class="info_radio-check" name="customer-sex" value="Nam">Nam
                                            </div>
                                            <div class="info-choose_input">
                                                <input type="radio" class="info_radio-check" name="customer-sex" value="Nu">Nữ
                                            </div>
                                        </div>
                                    </div>
                                    <div class="account_info-input">
                                        <label class="info-input_label">Địa chỉ:</label>
                                        <!-- <select class="order-summary_input summary_input" name="customer_address" id="address">
                                            <?php
                                            while ($address = mysqli_fetch_array($rs_address)){?>
                                            <option value="<?php echo $address['DiaChi'] ?>"><?php echo $address['DiaChi'] ?></option>
                                            <?php }; ?>
                                        </select> -->
                                        <input type="text" class="info-input_input" name="customer_address" readonly value="<?= $user['DiaChi'] ?>">
                                    </div>
                                    <div class="account_info-input">
                                        <label class="info-input_label">Thêm địa chỉ:</label>
                                        <input type="text" class="info-input_input" name="new-address">
                                    </div>
                                        <!-- <div class="account_info-input">
                                            <label class="info-input_label">Quận/Huyên:</label>
                                            <select name="customer_district" class="info-choose">
                                                <option class="info-choose_option" value="">Ninh Kiều</option>
                                            </select>
                                        </div>
                                        <div class="account_info-input">
                                            <label class="info-input_label">Tỉnh/Thành phố:</label>
                                            <select name="customer_city" class="info-choose">
                                                <option class="info-choose_option" value="">Cần Thơ</option>
                                            </select>
                                        </div> -->
                                </div>
                                <div class="customer_control">
                                    <input type="submit" name="submit" class="button  customer_control-btn" value="Cập nhật">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        include("./footer.php");
        ?>


    </div>

    <script>
        $(document).ready(function() {
            $('#showPassword').on('click', function() {

                var passwordField = $('#password');
                var passwordFieldType = passwordField.attr('type');
                if (passwordFieldType == 'password') {
                    passwordField.attr('type', 'text');
                    $(this).val('Ẩn');
                } else {
                    passwordField.attr('type', 'password');
                    $(this).val('Hiển thị');
                }
            });
        });
        $(document).ready(function() {
            $('#showRePassword').on('click', function() {

                var passwordField = $('#repassword');
                var passwordFieldType = passwordField.attr('type');
                if (passwordFieldType == 'password') {
                    passwordField.attr('type', 'text');
                    $(this).val('Ẩn');
                } else {
                    passwordField.attr('type', 'password');
                    $(this).val('Hiển thị');
                }
            });
        });
    </script>
    <script src="./asset/jquery/main.js"></script>
    <script src="./asset/jquery/jquery.js"></script>
</body>

</html>