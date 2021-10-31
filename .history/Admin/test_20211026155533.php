<?php
include("./connection.php");
include("./function.php");
session_start();

if (isset($_GET['ins-prd'])) {

    if (isset($_POST['product_name']) && isset($_POST['product_price']) && isset($_POST['product_quantity']) && isset($_POST['product_image'])) {
        // Product Information
        $product_name = $_POST['product_name'];
        $product_description = $_POST['product_description'];
        $product_price = str_replace(array('.', ','), '', $_POST['product_price']);
        $product_sale = str_replace(array('.', ','), '', $_POST['product_sale']);
        $product_img = $_POST['product_image'];
        $product_quantity = $_POST['product_quantity'];
        $product_debuts =  $_POST['product_debuts'];
        $product_madein = $_POST['product_madein'];
        $create_at = date("Y-m-d");
        $product_status = 1;
        $product_category = $_POST['product_category'];
        $product_brand = $_POST['product_brand'];

        // Specifications
        $screen = $_POST['screen'];
        $camera_selfie = $_POST['camera_selfie'];
        $camera_back = $_POST['camera_back'];
        $ram = $_POST['ram'];
        $rom = $_POST['rom'];
        $cpu = $_POST['cpu'];
        $gpu = $_POST['gpu'];
        $pin = $_POST['pin'];
        $sim = $_POST['sim'];
        $os = $_POST['os'];

        $sql1 = "INSERT INTO `SanPham` (`MSSP`, `TenSP`, `MoTa`, `Gia`, `GiaBan`,  `Avatar`,`SoLuongHang`, `NgayRaMat`, `XuatXu`, `NgayTao`, `TrangThai`, `MLSP`,`MSTH`) VALUES (NULL, '$product_name', '$product_description', '$product_price','$product_sale', '$product_img', '$product_quantity','$product_debuts','$product_madein','$create_at','$product_status','$product_category','$product_brand'); ";
        $rs1 = mysqli_query($conn, $sql1);

        if ($rs1) {
            $last_id = mysqli_insert_id($conn);
            $screen = "INSERT INTO `ManHinh` (`id`, `KichThuoc`, `MSSP`) VALUES (NULL, '$screen', '$last_id'); ";
            $screen = mysqli_query($conn, $screen);
            
            $camera = "INSERT INTO `ManHinh` (`id`, `KichThuoc`, `MSSP`) VALUES (NULL, '$camera_camera', '$last_id'); ";
            $camera = mysqli_query($conn, $camera);
            
            $ram = "INSERT INTO `ManHinh` (`id`, `KichThuoc`, `MSSP`) VALUES (NULL, '$ram', '$last_id'); ";
            $ram = mysqli_query($conn, $ram);
            
            $rom = "INSERT INTO `ManHinh` (`id`, `KichThuoc`, `MSSP`) VALUES (NULL, '$rom', '$last_id'); ";
            $rom = mysqli_query($conn, $rom);
            
            $screen = "INSERT INTO `ManHinh` (`id`, `KichThuoc`, `MSSP`) VALUES (NULL, '$screen', '$last_id'); ";
            $screen = mysqli_query($conn, $screen);
            
            $screen = "INSERT INTO `ManHinh` (`id`, `KichThuoc`, `MSSP`) VALUES (NULL, '$screen', '$last_id'); ";
            $screen = mysqli_query($conn, $screen);
            
            $screen = "INSERT INTO `ManHinh` (`id`, `KichThuoc`, `MSSP`) VALUES (NULL, '$screen', '$last_id'); ";
            $screen = mysqli_query($conn, $screen);
            
            $screen = "INSERT INTO `ManHinh` (`id`, `KichThuoc`, `MSSP`) VALUES (NULL, '$screen', '$last_id'); ";
            $screen = mysqli_query($conn, $screen);
            
            $screen = "INSERT INTO `ManHinh` (`id`, `KichThuoc`, `MSSP`) VALUES (NULL, '$screen', '$last_id'); ";
            $screen = mysqli_query($conn, $screen);
            
            $screen = "INSERT INTO `ManHinh` (`id`, `KichThuoc`, `MSSP`) VALUES (NULL, '$screen', '$last_id'); ";
            $screen = mysqli_query($conn, $screen);
            
            $screen = "INSERT INTO `ManHinh` (`id`, `KichThuoc`, `MSSP`) VALUES (NULL, '$screen', '$last_id'); ";
            $screen = mysqli_query($conn, $screen);

            if ($screen) {
                echo json_encode(array(
                    'status' => 1,
                    'message' => 'Thêm sản phẩm thành công'
                ));
                exit;
            }
            else {
                echo json_encode(array(
                    'status' => 0,
                    'message' => 'Insert image failed'
                ));
                exit;
            }
        } 
        else {
            echo json_encode(array(
                'status' => 0,
                'message' => 'Thêm sản phẩm không thành công'
            ));
            exit;
        }
    // }
    }
    else {
        echo json_encode(array(
            'status' => 0,
            'message' => 'Thông tin sản phẩm không được trống'
        ));
        exit;
    }
}
if (isset($_GET['ins-prd-img'])) {
    if(isset($_FILES['file']) && !empty($_FILES['file']['name'])){
        // echo json_encode(array(
        //     'status' => 1,
        //     'message' => 'OKE'
        // ));
        // exit;

        $image = $_FILES['file'];
        $result = upOneFile($image);
        if (!$result) {
            echo json_encode(array(
                'status' => 0,
                'message' => 'Thêm ảnh sản phẩm không thành thành công'
            ));
            exit;
        } else {
            echo json_encode(array(
                'status' => 1,
                'message' => 'Thêm ảnh sản phẩm thành công'
            ));
            exit;
        }
    } else {
        echo json_encode(array(
            'status' => 0,
            'message' => 'File not found'
        ));
        exit;
    }
}
