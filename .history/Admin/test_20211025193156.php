
<?php
if (isset($_GET['login'])) {
    if (isset($_POST['submit']) && $_POST['submit']=='submit') {
        $phone = $_POST['phone'];
        $password = $_POST['password'];

        // echo $phone;
        // echo $password;
        if ($phone != "" && $password != "") {
            $sql = "SELECT * FROM NhanVien WHERE NhanVien.SoDienThoai = '$phone' AND NhanVien.MatKhau = '$password';";
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
    }
}
?>