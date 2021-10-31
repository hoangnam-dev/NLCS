
<?php
if (isset($_GET['login'])) {
    if (isset($_POST['submit'])) {
        $phone = $_POST['phone'];
        $password = $_POST['password'];

        // echo $phone;
        // echo $password;
        if ($phone != "" && $password != "") {
            $sql = "SELECT * FROM NhanVien WHERE NhanVien.SoDienThoai = '$phone' AND NhanVien.MatKhau = '$password';";
            $rs = mysqli_query($conn, $sql);
            $data_admin = mysqli_fetch_assoc($rs);
            if (mysqli_num_rows($rs) > 0) {
                $_SESSION['admin'] = $data_admin;
                header("location: product_manage.php");
                exit;
            } else {
                header("location: login.php?SĐT hoặc mật khẩu không đúng hay chưa có tài khoản");
                exit();
            }
        } else {
            header("location: login.php?SĐT và mật khẩu không được để trống");
            exit();
        }
    }
}
?>