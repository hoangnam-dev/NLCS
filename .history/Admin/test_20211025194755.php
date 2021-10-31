<?php
include("./connection.php");
session_start();

if (isset($_GET['login'])) {
    if (isset($_POST['phone']) && isset($_POST['password'])) {
        $admin_phone = $_POST['phone'];
        $admin_password = $_POST['password'];
        $err = false;

        if ($admin_phone != "" && $admin_password != "") {
            $sql = "SELECT * FROM NhanVien WHERE NhanVien.SoDienThoai = '$admin_phone' 
            AND NhanVien.MatKhau = '$admin_password'";
            $rs = mysqli_query($conn, $sql);
            if (!$rs) {
                $err = mysqli_error($conn);
            }
            else{
                $data_admin = mysqli_fetch_assoc($rs);
                $_SESSION['admin'] = $data_admin;
            }
    
            if($err != false || mysqli_num_rows($rs) == 0){
                echo json_encode(array(
                    'status' => 0,
                    'message' => 'Thông tin đăng nhập không đúng'
                ));
                exit;
            }else{
                echo json_encode(array(
                    'status' => 1,
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
    }else{
        echo json_encode(array(
            'status' => 0,
            'message' => 'Thông tin đăng nhập không đúng'
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
?>