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

        $sql = "INSERT INTO `SanPham` (`MSSP`, `TenSP`, `MoTa`, `Gia`, `GiaBan`,  `Avatar`,`SoLuongHang`, `NgayRaMat`, `XuatXu`, `NgayTao`, `TrangThai`, `MLSP`,`MSTH`) VALUES (NULL, '$product_name', '$product_description', '$product_price','$product_sale', '$product_img', '$product_quantity','$product_debuts','$product_madein','$create_at','$product_status','$product_category','$product_brand'); ";
        $rs = mysqli_query($conn, $sql);

        // Thêm Thông số kỹ thuật nếu có
        $last_id = mysqli_insert_id($conn);
        $flag = false;

        if (isset($_POST['screen'])) {
            $screen = (!empty($_POST['screen'])) ? $_POST['screen'] : 'Chưa rõ';
            echo json_encode(array(
                'status' => 0,
                'message' => $screen
            ));
            exit;
            $sqlscreen = "INSERT INTO `ManHinh` (`id`, `KichThuoc`, `MSSP`) VALUES (NULL, '$screen', '$last_id'); ";
            $rs_screen = mysqli_query($conn, $sqlscreen);
            if ($rs_screen) {
                $flag = true;
            }
        }
        if (isset($_POST['camera']) && isset($_POST['camera_selfie'])) {
            $camera = (!empty($_POST['camera'])) ? $_POST['camera'] : 'Chưa rõ';
            $camera_selfie = (!empty($_POST['camera_selfie'])) ? $_POST['camera_selfie'] : 'Chưa rõ';
            $sqlcamera = "INSERT INTO `Camera` (`id`, `CameraTruoc`, `CameraSau`, `MSSP`) VALUES (NULL, '$camera_selfie', '$camera', '$last_id'); ";
            $rs_camera = mysqli_query($conn, $sqlcamera);
            if ($rs) {
                $flag = true;
            }
        }
        if (isset($_POST['ram'])) {
            $ram = (!empty($_POST['ram'])) ? $_POST['ram'] : 'Chưa rõ';
            $sqlram = "INSERT INTO `Ram` (`id`, `DungLuong`, `MSSP`) VALUES (NULL, '$ram', '$last_id'); ";
            $rs_ram = mysqli_query($conn, $sqlram);
            if ($rs_ram) {
                $flag = true;
            }
        }
        if (isset($_POST['rom'])) {
            $rom = (!empty($_POST['rom'])) ? $_POST['rom'] : 'Chưa rõ';
            $sqlrom = "INSERT INTO `BoNho` (`id`, `DungLuong`, `MSSP`) VALUES (NULL, '$rom', '$last_id'); ";
            $rs_rom = mysqli_query($conn, $sqlrom);
            if ($rs_rom) {
                $flag = true;
            }
        }
        if (isset($_POST['cpu'])) {
            $cpu = (!empty($_POST['cpu'])) ? $_POST['cpu'] : 'Chưa rõ';
            $sqlcpu = "INSERT INTO `CPU` (`id`, `TenCPU`, `MSSP`) VALUES (NULL, '$cpu', '$last_id'); ";
            $rs_cpu = mysqli_query($conn, $sqlcpu);
            if ($rs_cpu) {
                $flag = true;
            }
        }
        if (isset($_POST['scrgpueen'])) {
            $gpu = (!empty($_POST['gpu'])) ? $_POST['gpu'] : 'Chưa rõ';
            $sqlgpu = "INSERT INTO `GPU` (`id`, `TenGPU`, `MSSP`) VALUES (NULL, '$gpu', '$last_id'); ";
            $rs_gpu = mysqli_query($conn, $sqlgpu);
            if ($rs_gpu) {
                $flag = true;
            }
        }
        if (isset($_POST['battery'])) {
            $battery = (!empty($_POST['battery'])) ? $_POST['battery'] : 'Chưa rõ';
            $sqlbattery = "INSERT INTO `Pin` (`id`, `DungLuong`, `MSSP`) VALUES (NULL, '$battery', '$last_id'); ";
            $rs_battery = mysqli_query($conn, $sqlbattery);
            if ($rs_battery) {
                $flag = true;
            }
        }
        if (isset($_POST['sim'])) {
            $sim = (!empty($_POST['sim'])) ? $_POST['sim'] : 'Chưa rõ';
            $sqlsim = "INSERT INTO `SIM` (`id`, `Sim`, `MSSP`) VALUES (NULL, '$sim', '$last_id'); ";
            $rs_sim = mysqli_query($conn, $sqlsim);
            if ($rs_sim) {
                $flag = true;
            }
        }
        if (isset($_POST['os'])) {
            $os = (!empty($_POST['os'])) ? $_POST['os'] : 'Chưa rõ';
            $sqlos = "INSERT INTO `HeDieuHanh` (`id`, `TenHDH`, `MSSP`) VALUES (NULL, '$os', '$last_id'); ";
            $rs_os = mysqli_query($conn, $sqlos);
            if ($rs_os) {
                $flag = true;
            }
        }

        if ($rs) {
            if ($flag == true) {
                echo json_encode(array(
                    'status' => 1,
                    'message' => 'Thêm sản phẩm thành công'
                ));
                exit;
            } else {
                echo json_encode(array(
                    'status' => 1,
                    'message' => 'Thêm sản phẩm thành công. Thông số kỹ thuật chưa có hoặc chưa đầy đủ'
                ));
                exit;
            }
        } else {
            echo json_encode(array(
                'status' => 0,
                'message' => 'Thêm sản phẩm không thành công'
            ));
            exit;
        }
    }
    else {
        echo json_encode(array(
            'status' => 0,
            'message' => 'Thông tin sản phẩm không được trống'
        ));
        exit;
    }
}


// Upload Product Image
if (isset($_GET['ins-prd-img'])) {
    if (isset($_FILES['file']) && isset($_FILES['file']['name'])) {

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
