<?php
include("./connection.php");

    if (isset($_POST['submit']) && isset($_POST['phone']) && isset($_POST['password'])) {
    $customer_phone = $_POST['phone'];
    $customer_password = $_POST['password'];

    if ($customer_phone != "" && $customer_password != "") {
        $sql = "SELECT * FROM KhachHang WHERE KhachHang.SoDienThoai = '$customer_phone' 
        AND KhachHang.MatKhau = '$customer_password'";
        $rs = mysqli_query($conn, $sql);
        $data_user = mysqli_fetch_assoc($rs);
        if (!$rs) {
            
        }
}
/*===================================*/
?>