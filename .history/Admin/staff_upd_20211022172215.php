<?php
include("connection.php");
$staff_id = $_GET['id'];
$sql = "SELECT * FROM `NhanVien` WHERE NhanVien.MSNV = '$staff_id';";
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
                    <h2>Cập nhật nhân viên</h2>
                </div>

                <div class="staff_insert-content">
                    <form action="process.php?action=update-staff&id=<?php echo $staff_id;?>" class="staff_insert-form" method="POST" role="form">
                        <div class="main_form">
                            <?php $staff = mysqli_fetch_assoc($rs) ?>
                            <div class="main-form_left">
                                <div class="form-input">
                                    <label class="form_label" for="fname">Mã số nhân viên:</label>
                                    <input type="text" class="form_input disable-input" id="fname" name="staff_id" readonly="true" value="<?php echo $staff['MSNV'] ?>">
                                </div>
                                <div class="form-input">
                                    <label class="form_label" for="fname">Họ và tên nhân viên:</label>
                                    <input type="text" class="form_input" id="fname" name="staff_name" value="<?php echo $staff['HoTenNV'] ?>">
                                </div>
                                <div class="form-input">
                                    <label class="form_label" for="fname">Chức vụ:</label>
                                    <input type="text" class="form_input" id="fname" name="staff_jobtitle" value="<?php echo $staff['ChucVu'] ?>">
                                </div>
                                <div class="form-input">
                                    <label class="form_label" for="fname">Giới tính:</label>
                                    <input type="text" class="form_input" id="fname" name="staff_sex" value="<?php echo $staff['GioiTinh'] ?>">
                                </div>
                            </div>
                            <div class="main-form_right">
                                <div class="form-input">
                                    <label class="form_label" for="fname">Địa chỉ:</label>
                                    <input type="text" class="form_input" id="fname" name="staff_new_address" value="<?php echo $staff['DiaChi']?>">
                                </div>
                                <div class="form-input">
                                    <label class="form_label" for="fname">Số điện thoại:</label>
                                    <input type="text" class="form_input" id="fname" name="staff_phone" value="<?php echo $staff['SoDienThoai'] ?>">
                                </div>
                                <div class="form-input">
                                    <label class="form_label" for="fname">Email:</label>
                                    <input type="text" class="form_input" id="fname" name="staff_email" value="<?php echo $staff['Email'] ?>">
                                </div>
                                <div class="form-input">
                                    <label class="form_label" for="fname">Mật khẩu:</label>
                                    <input type="text" class="form_input" id="fname" name="staff_password" value="<?php echo $staff['MatKhau'] ?>">
                                </div>
                            </div>
                        </div>
                        <!-- <div class="main-table">
                            <table class="main-table_content detail-table">
                                <thead>
                                    <tr>
                                        <th>Tùy chọn</th>
                                        <th>STT</th>
                                        <th>Mã địa chỉ</th>
                                        <th>Địa chỉ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $n = 1;
                                    while ($address = mysqli_fetch_array($rs_address)) { ?>
                                        <tr>
                                            <td>
                                                <a href="./process.php?action=delete-staff-address&staff-id=<?php echo $staff_id ?>&id=<?php echo $address['MaDC']; ?>" class="button-edit btn-delete">Xóa</a>
                                            </td>
                                            <td><?php echo $n; ?></td>
                                            <td><?php echo $address['MaDC'] ?></td>
                                            <td><?php echo $address['DiaChi'] ?></td>
                                        </tr>
                                    <?php $n++;} ?>
                                </tbody>
                            </table>
                        </div> -->
                        <input type="submit" class="button form-success_btn" name="submit" value="Cập nhật">
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- <script type="text/javascript" src="./asset/bootstrap/js/bootstrap.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>