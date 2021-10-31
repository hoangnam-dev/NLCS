<?php
include("./connection.php");

/*===================================*/

// Submit Form Register
if(isset($_GET['action']) && $_GET['action'] == 'register'){
    $customer_name=$_POST['name'];
    $customer_phone=$_POST['phone'];
    $customer_address=$_POST['address'];
    $customer_password=$_POST['password'];
    $customer_repassword=$_POST['repassword'];
    if(isset($_POST) && $customer_name != "" && $customer_phone != "" && $customer_password != "" && $customer_repassword != ""){

        if($customer_password == $customer_repassword){
            $sql = "SELECT * FROM KhachHang WHERE KhachHang.SoDienThoai = '$customer_phone'";
            $rs = mysqli_query($conn, $sql);
            if(mysqli_num_rows($rs)>0){
                header("location: ./index.php?Số điện thoại đã được đăng ký");
                exit; 
            }
            else{
                $sql_insert = "INSERT INTO `khachhang` (`MSKH`, `HoTenKH`, `DiaChi`, `SoDienThoai`, `Password`) VALUES (NULL, '$customer_name', '$customer_address', '$customer_phone', '$customer_password');";
                $rs_sqlinsert = mysqli_query($conn, $sql_insert);
                if($rs==true){
                    header("location: ./index.php?success");
                    exit;
                }
                else{
                    header("location: ./index.php?error");
                    exit;
                }
            }
        }
        else{
            header("location: ./index.php?Mật khẩu nhập lại không chính xác");
            exit;
        }
    }
}

/*===================================*/

/*===================================*/

// Submit Form Login
if(isset($_GET['action']) && $_GET['action'] == 'login'){
    if(isset($_POST)){
        $customer_phone=$_POST['phone'];
        $customer_password=$_POST['password'];

        if($customer_phone != " " && $customer_password != " "){
            $sql = "SELECT * FROM KhachHang WHERE KhachHang.SoDienThoai = '$customer_phone' 
            AND KhachHang.Password = '$customer_password'";
            $rs = mysqli_query($conn, $sql);
            $data_user = mysqli_fetch_assoc($rs);
            if(mysqli_num_rows($rs)>0){
                $_SESSION['user'] = $data_user;
                header("location: ./index.php");
                exit;
            }
            else{
                header("location: ./index.php?error=validate");
                exit;
            }
        }
        else{
            header("location: ./index.php?error=input-is-null");
            exit; 
        }
    }

}
/*===================================*/
?>