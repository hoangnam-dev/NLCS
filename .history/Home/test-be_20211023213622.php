<?php
include("./connection.php");

    if (isset($_POST['submit']) && isset($_POST['phone']) && isset($_POST['password'])) {
    $customer_phone = $_POST['phone'];
    $customer_password = $_POST['password'];

    if ($customer_phone != " " && $customer_password != " ") {
        $sql = "SELECT * FROM KhachHang WHERE KhachHang.SoDienThoai = '$customer_phone' 
        AND KhachHang.MatKhau = '$customer_password'";
        $rs = mysqli_query($conn, $sql);
        $data_user = mysqli_fetch_assoc($rs);
        if (mysqli_num_rows($rs) > 0) {
            $_SESSION['user'] = $data_user;
            header("location: ./index.php");
            exit;
        } else {
            header("location: ./index.php?error=validate");
            exit;
        }
    } else {
        header("location: ./index.php?error=input-is-null");
        exit;
    }
}
/*===================================*/
?>