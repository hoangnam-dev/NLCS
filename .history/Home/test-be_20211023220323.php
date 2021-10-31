<?php
include("./connection.php");
session_start();
$err = false;

if (isset($_POST['phone']) && isset($_POST['password'])) {
    $customer_phone = $_POST['phone'];
    $customer_password = $_POST['password'];

    if ($customer_phone != "" && $customer_password != "") {
        $sql = "SELECT * FROM KhachHang WHERE KhachHang.SoDienThoai = '$customer_phone' 
        AND KhachHang.MatKhau = '$customer_password'";
        $rs = mysqli_query($conn, $sql);
        if (!$rs) {
            $err = mysqli_error($conn);
        }
        else{
            $data_user = mysqli_fetch_assoc($rs);
            $_SESSION['user'] = $data_user;
        }

        if($err != false || mysqli_num_rows($rs) == 0){
            echo json_encode(array(
                'status' => 1,
                'message' => 'Thông tin đăng nhập không đúng'
            ));
            exit;
        }else{
            echo json_encode(array(
                'status' => 0,
                'message' => 'Đăng nhập thành công'
            ));
            exit;
        }
    }else{
        echo json_encode(array(
            'status' => 0,
            'message' => 'Thông tin đăng nhập không đúng'
        ));
        exit;
    }
}
/*===================================*/
