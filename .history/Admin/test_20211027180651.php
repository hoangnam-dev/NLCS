<?php
include("./connection.php");
include("./function.php");
session_start();

if (isset($_GET['upd-prd'])) {
    if (isset($_POST['product_id']) && isset($_POST['product_name']) && isset($_POST['product_price']) && isset($_POST['product_quantity'])) {
        // Product Information
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_description = $_POST['product_description'];
        $product_price = str_replace(array('.', ','), '', $_POST['product_price']);
        $product_sale = str_replace(array('.', ','), '', $_POST['product_sale']);
        $product_img = $_POST['product_image'];
        $product_quantity = $_POST['product_quantity'];
        $product_debuts =  $_POST['product_debuts'];
        $product_madein = $_POST['product_madein'];
        $product_status = 1;
        $product_category = $_POST['product_category'];
        $product_brand = $_POST['product_brand'];
        // echo $product_id; exit;

        $sql = "UPDATE SanPham SET TenSP='$product_name', MoTa='$product_description', Gia='$product_price', GiaBan='$product_sale', Avatar='$product_img', SoLuongHang='$product_quantity', NgayRaMat='$product_debuts', XuatXu='$product_madein', MLSP='$product_category', MSTH='$product_brand' WHERE SanPham.MSSP='$product_id';";
        $rs = mysqli_query($conn, $sql);

        // Thêm Thông số kỹ thuật nếu có
        $flag = false;

        if (isset($_POST['screen'])) {
            $screen = (!empty($_POST['screen'])) ? $_POST['screen'] : 'Chưa rõ';
            $sqlscreen = "UPDATE ManHinh SET KichThuoc='$screen' WHERE SanPham.MSSP = '$product_id';";
            $rs_screen = mysqli_query($conn, $sqlscreen);
            if ($rs_screen) {
                $flag = true;
            } else {
                echo json_encode(array(
                    'status' => 0,
                    'message' => 'Cập nhật MH không thành công'
                ));
                exit;
            }
        }

        if (isset($_POST['camera']) && isset($_POST['camera_selfie'])) {
            $camera = (!empty($_POST['camera'])) ? $_POST['camera'] : 'Chưa rõ';
            $camera_selfie = (!empty($_POST['camera_selfie'])) ? $_POST['camera_selfie'] : 'Chưa rõ';
            $sqlcamera = "UPDATE Camera  SET CameraTruoc='$camera_selfie', CameraSau='$camera' WHERE SanPham.MSSP = '$product_id';";
            $rs_camera = mysqli_query($conn, $sqlcamera);
            if ($rs_camera) {
                $flag = true;
            } else {
                echo json_encode(array(
                    'status' => 0,
                    'message' => 'Cập nhật CAM không thành công'
                ));
                exit;
            }
        }

        if (isset($_POST['ram'])) {
            $ram = (!empty($_POST['ram'])) ? $_POST['ram'] : 'Chưa rõ';
            $sqlram = "UPDATE Ram SET DungLuongRam='$ram' WHERE SanPham.MSSP = '$product_id';";
            $rs_ram = mysqli_query($conn, $sqlram);
            if ($rs_ram) {
                $flag = true;
            } else {
                echo json_encode(array(
                    'status' => 0,
                    'message' => 'Cập nhật ram không thành công'
                ));
                exit;
            }
        }

        if (isset($_POST['rom'])) {
            $rom = (!empty($_POST['rom'])) ? $_POST['rom'] : 'Chưa rõ';
            $sqlrom = "UPDATE BoNho SET DungLuongRom='$rom' WHERE SanPham.MSSP = '$product_id';";
            $rs_rom = mysqli_query($conn, $sqlrom);
            if ($rs_rom) {
                $flag = true;
            } else {
                echo json_encode(array(
                    'status' => 0,
                    'message' => 'Cập nhật rom không thành công'
                ));
                exit;
            }
        }

        if (isset($_POST['cpu'])) {
            $cpu = (!empty($_POST['cpu'])) ? $_POST['cpu'] : 'Chưa rõ';
            $sqlcpu = "UPDATE CPU SET TenCPU='$cpu' WHERE SanPham.MSSP = '$product_id';";
            $rs_cpu = mysqli_query($conn, $sqlcpu);
            if ($rs_cpu) {
                $flag = true;
            } else {
                echo json_encode(array(
                    'status' => 0,
                    'message' => 'Cập nhật cpu không thành công'
                ));
                exit;
            }
        }

        if (isset($_POST['gpu'])) {
            $gpu = (!empty($_POST['gpu'])) ? $_POST['gpu'] : 'Chưa rõ';
            $sqlgpu = "UPDATE GPU SET TenGPU='$gpu' WHERE SanPham.MSSP = '$product_id';";
            $rs_gpu = mysqli_query($conn, $sqlgpu);
            if ($rs_gpu) {
                $flag = true;
            } else {
                echo json_encode(array(
                    'status' => 0,
                    'message' => 'Cập nhật gpu không thành công'
                ));
                exit;
            }
        }

        if (isset($_POST['battery'])) {
            $battery = (!empty($_POST['battery'])) ? $_POST['battery'] : 'Chưa rõ';
            $sqlbattery = "UPDATE Pin SET DungLuongPin='$battery' WHERE SanPham.MSSP = '$product_id';";
            $rs_battery = mysqli_query($conn, $sqlbattery);
            if ($rs_battery) {
                $flag = true;
            } else {
                echo json_encode(array(
                    'status' => 0,
                    'message' => 'Cập nhật pin không thành công'
                ));
                exit;
            }
        }

        if (isset($_POST['sim'])) {
            $sim = (!empty($_POST['sim'])) ? $_POST['sim'] : 'Chưa rõ';
            $sqlsim = "UPDATE Sim SET TheSim='$sim' WHERE SanPham.MSSP = '$product_id';";
            $rs_sim = mysqli_query($conn, $sqlsim);
            if ($rs_sim) {
                $flag = true;
            } else {
                echo json_encode(array(
                    'status' => 0,
                    'message' => 'Cập nhật sim không thành công'
                ));
                exit;
            }
        }

        if (isset($_POST['os'])) {
            $os = (!empty($_POST['os'])) ? $_POST['os'] : 'Chưa rõ';
            $sqlos = "UPDATE HeDieuHanh SET TenHDH='$os' WHERE SanPham.MSSP = '$product_id';";
            $rs_os = mysqli_query($conn, $sqlos);
            if ($rs_os) {
                $flag = true;
            } else {
                echo json_encode(array(
                    'status' => 0,
                    'message' => 'Cập nhật os không thành công'
                ));
                exit;
            }
        }

        if ($rs) {
            if ($flag == true) {
                echo json_encode(array(
                    'status' => 1,
                    'message' => 'Cập nhật sản phẩm thành công'
                ));
                exit;
            } else {
                echo json_encode(array(
                    'status' => 1,
                    'message' => 'Cập nhật sản phẩm thành công. Thông số kỹ thuật chưa đầy đủ'
                ));
                exit;
            }
        } else {
            echo json_encode(array(
                'status' => 0,
                'message' => 'Cập nhật sản phẩm không thành công'
            ));
            exit;
        }
    } else {
        echo json_encode(array(
            'status' => 0,
            'message' => 'Thông tin 1 không được trống'
        ));
        exit;
    }
}


// Upload Product Image
if (isset($_GET['upd-prd-img'])) {
    if (isset($_FILES['file']) && isset($_FILES['file']['name'])) {

        $image = $_FILES['file'];
        $result = upOneFile($image);
        if (!$result) {
            echo json_encode(array(
                'status' => 0,
                'message' => 'Thay đổi avatar sản phẩm không thành thành công'
            ));
            exit;
        } else {
            echo json_encode(array(
                'status' => 1,
                'message' => 'Thay đổi avatar sản phẩm thành công'
            ));
            exit;
        }
    } else {
        echo json_encode(array(
            'status' => 1,
            'message' => 'Avatar sản phẩm không thay đổi'
        ));
        exit;
    }
}
