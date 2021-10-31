<?php
include("./connection.php");
include("./function.php");
session_start();
/*=================================*/
// Login
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
            } else {
                $data_admin = mysqli_fetch_assoc($rs);
                $_SESSION['admin'] = $data_admin;
            }

            if ($err != false || mysqli_num_rows($rs) == 0) {
                echo json_encode(array(
                    'status' => 0,
                    'message' => 'Thông tin đăng nhập không đúng'
                ));
                exit;
            } else {
                echo json_encode(array(
                    'status' => 1,
                    'message' => 'Đăng nhập thành công'
                ));
                exit;
            }
        } else {
            echo json_encode(array(
                'status' => 0,
                'message' => 'Thông tin đăng nhập không đúng'
            ));
            exit;
        }
    }
}

// Admin Logout
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    unset($_SESSION['admin']);
    header('location: ./index.php');
    exit;
}


/*=================================*/



/*=================================*/
// Category
// Add Category
if (isset($_GET['ins-category'])) {
    if (isset($_POST['category_name']) && $_POST['category_name'] != "") {
        $category_name = $_POST['category_name'];

        $sql = "INSERT INTO `LoaiSanPham`(`MLSP`, `TenLSP`) VALUES (NULL, '$category_name'); ";
        $rs = mysqli_query($conn, $sql);
        if ($rs) {
            echo json_encode(array(
                'status' => 1,
                'message' => 'Thêm loại sản phẩm thành công'
            ));
            exit;
        } else {
            echo json_encode(array(
                'status' => 0,
                'message' => 'Thêm loại sản phẩm không thành công'
            ));
            exit;
        }
    } else {
        echo json_encode(array(
            'status' => 0,
            'message' => 'Tên loại sản phẩm không được trống'
        ));
        exit;
    }
}


// Update Category
if (isset($_GET['upd-category'])) {
    if (isset($_POST['category_id']) && isset($_POST['category_name']) && $_POST['category_name'] != "") {
        $category_id = $_POST['category_id'];
        $category_name = $_POST['category_name'];

        $sql = "UPDATE `LoaiSanPham` SET `TenLSP` = '$category_name' WHERE `LoaiSanPham`.`MLSP` = '$category_id';";
        $rs = mysqli_query($conn, $sql);
        if ($rs) {
            echo json_encode(array(
                'status' => 1,
                'message' => 'Cập nhật loại sản phẩm thành công'
            ));
            exit;
        } else {
            echo json_encode(array(
                'status' => 0,
                'message' => 'Cập nhật loại sản phẩm không thành công'
            ));
            exit;
        }
    } else {
        echo json_encode(array(
            'status' => 0,
            'message' => 'Tên loại sản phẩm không được trống'
        ));
        exit;
    }
}


// Delete Category
if (isset($_GET['action']) && $_GET['action'] == 'delete-category') {
    if ($_REQUEST['id'] and $_REQUEST['id'] != '') {
        $category_id = $_GET['id'];
        // echo $category_id;exit;
        $find_prd = "SELECT * FROM `SanPham` WHERE `SanPham`.`MLSP` = '$category_id';";
        $rs_find = mysqli_query($conn, $find_prd);
        if (mysqli_num_rows($rs_find) > 0) {
            while ($product = mysqli_fetch_array($rs_find)) {
                $product_id = $product['MSSP'];
                $sql2 = "DELETE FROM `HinhSanPham` WHERE `HinhSanPham`.`MSSP` = '$product_id';";
                $rs1 = mysqli_query($conn, $sql2);
            }
            $sql = "DELETE FROM `SanPham` WHERE `SanPham`.`MLSP` = '$category_id';";
            $rs = mysqli_query($conn, $sql);

            if ($rs == true && $rs1 == true) {
                $sql2 = "DELETE FROM `LoaiSanPham` WHERE `LoaiSanPham`.`MLSP` = '$category_id';";
                $rs2 = mysqli_query($conn, $sql2);
                if ($rs2 == true) {
                    header('Location: category_manage.php?success=Xóa thành công');
                    exit;
                } else {
                    header('Location: category_manage.php?err=Xóa ' . $category_id . ' không thành công');
                    exit();
                }
            } else {
                header('Location: category_manage.php?err=Xóa hàng hóa có MLSP ' . $category_id . ' không thành công');
                exit();
            }
        } else {
            $sql2 = "DELETE FROM `LoaiSanPham` WHERE `LoaiSanPham`.`MLSP` = '$category_id';";
            $rs2 = mysqli_query($conn, $sql2);
            if ($rs2 == true) {
                header('Location: category_manage.php?success=Xóa thành công');
                exit;
            } else {
                header('Location: category_manage.php?err=Xóa ' . $category_id . ' không thành công');
                exit();
            }
        }
    }
}


/*=================================*/



/*=================================*/
// Brand Insert
if (isset($_POST) && isset($_GET['ins-brand'])) {
    $brand_name = $_POST['brand_name'];

    $sql = "INSERT INTO `ThuongHieu`(`MSTH`, `TenTH`)
    VALUES (NULL, '$brand_name'); ";
    $rs = mysqli_query($conn, $sql);
    if ($rs == true) {
        echo json_encode(array(
            'status' => 1,
            'message' => 'Thêm thương hiệu thành công'
        ));
        exit;
    } else {
        echo json_encode(array(
            'status' => 0,
            'message' => 'Thêm thương hiệu không thành công'
        ));
        exit;
    }
}


// Brand Update
if (isset($_GET['upd-brand'])) {
    if (isset($_POST['brand_id']) && isset($_POST['brand_name']) && $_POST['brand_name'] != "") {
        $brand_id = $_POST['brand_id'];
        $brand_name = $_POST['brand_name'];

        $sql = "UPDATE `ThuongHieu` SET `TenTH` = '$brand_name' WHERE `ThuongHieu`.`MSTH` = '$brand_id';";
        $rs = mysqli_query($conn, $sql);
        if ($rs) {
            echo json_encode(array(
                'status' => 1,
                'message' => 'Cập nhật thương hiệu thành công'
            ));
            exit;
        } else {
            echo json_encode(array(
                'status' => 0,
                'message' => 'Cập nhật thương hiệu không thành công'
            ));
            exit;
        }
    } else {
        echo json_encode(array(
            'status' => 0,
            'message' => 'Tên thương hiệu không được trống'
        ));
        exit;
    }
}

// Brand Delete
if (isset($_GET['action']) && $_GET['action'] == 'delete-brand') {
    if ($_REQUEST['id'] and $_REQUEST['id'] != '') {
        $brand_id = $_GET['id'];


        $find_prd = "SELECT * FROM `SanPham` WHERE `SanPham`.`MaNH` = '$brand_id';";
        $rs_find = mysqli_query($conn, $find_prd);
        if (mysqli_num_rows($rs) > 0) {
            while ($product = mysqli_fetch_array($rs_find)) {
                $product_id = $product['MSHH'];
                $sql = "DELETE FROM `SanPham` WHERE `SanPham`.`MaSP` = '$product_id';";
                $rs = mysqli_query($conn, $sql);
            }
            if ($rs == true) {
                $sql1 = "DELETE FROM `NhanHieu` WHERE `NhanHieu`.`MaNH` = '$brand_id';";
                $rs1 = mysqli_query($conn, $sql1);
                if ($rs1 == true) {
                    header('Location: brand.php?success=Xóa thành công');
                } else {
                    header('Location: brand.php?err=Xóa ' . $brand_id . ' không thành công');
                    exit();
                }
            } else {
                header('Location: brand.php?err=Xóa nhãn hiệu có MaNH ' . $brand_id . ' không thành công');
                exit();
            }
        } else {
            $sql = "DELETE FROM `NhanHieu` WHERE `NhanHieu`.`MaNH` = '$brand_id';";
            $rs = mysqli_query($conn, $sql);
            if ($rs == true) {
                header('Location: brand.php?success=Xóa thành công');
            } else {
                header('Location: brand.php?err=Xóa ' . $brand_id . ' không thành công');
                exit();
            }
        }
    }
}


/*=================================*/



/*=================================*/
// Product
// Add Product
if (isset($_GET['ins-prd'])) {
    if (isset($_POST['product_name']) && isset($_POST['product_price']) && isset($_POST['product_quantity'])) {
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
        // $last_id = 1;
        $flag = false;

        if (isset($_POST['screen'])) {
            $screen = (!empty($_POST['screen'])) ? $_POST['screen'] : 'Chưa rõ';
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
            if ($rs_camera) {
                $flag = true;
            }
        }

        if (isset($_POST['ram'])) {
            $ram = (!empty($_POST['ram'])) ? $_POST['ram'] : 'Chưa rõ';
            $sqlram = "INSERT INTO `Ram` (`id`, `DungLuongRam`, `MSSP`) VALUES (NULL, '$ram', '$last_id'); ";
            $rs_ram = mysqli_query($conn, $sqlram);
            if ($rs_ram) {
                $flag = true;
            }
        }

        if (isset($_POST['rom'])) {
            $rom = (!empty($_POST['rom'])) ? $_POST['rom'] : 'Chưa rõ';
            $sqlrom = "INSERT INTO `BoNho` (`id`, `DungLuongRom`, `MSSP`) VALUES (NULL, '$rom', '$last_id'); ";
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

        if (isset($_POST['gpu'])) {
            $gpu = (!empty($_POST['gpu'])) ? $_POST['gpu'] : 'Chưa rõ';
            $sqlgpu = "INSERT INTO `GPU` (`id`, `TenGPU`, `MSSP`) VALUES (NULL, '$gpu', '$last_id'); ";
            $rs_gpu = mysqli_query($conn, $sqlgpu);
            if ($rs_gpu) {
                $flag = true;
            }
        }

        if (isset($_POST['battery'])) {
            $battery = (!empty($_POST['battery'])) ? $_POST['battery'] : 'Chưa rõ';
            $sqlbattery = "INSERT INTO `Pin` (`id`, `DungLuongPin`, `MSSP`) VALUES (NULL, '$battery', '$last_id'); ";
            $rs_battery = mysqli_query($conn, $sqlbattery);
            if ($rs_battery) {
                $flag = true;
            }
        }

        if (isset($_POST['sim'])) {
            $sim = (!empty($_POST['sim'])) ? $_POST['sim'] : 'Chưa rõ';
            $sqlsim = "INSERT INTO `SIM` (`id`, `TheSim`, `MSSP`) VALUES (NULL, '$sim', '$last_id'); ";
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
    } else {
        echo json_encode(array(
            'status' => 0,
            'message' => 'Thông tin sản phẩm không được trống'
        ));
        exit;
    }
}

// Upload Product Image
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


// Update Product
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
        $product_status = $_POST['product_status'];
        $product_category = $_POST['product_category'];
        $product_brand = $_POST['product_brand'];
        // echo $product_id; exit;

        $sql = "UPDATE SanPham SET TenSP='$product_name', MoTa='$product_description', Gia='$product_price', GiaBan='$product_sale', Avatar='$product_img', SoLuongHang='$product_quantity', NgayRaMat='$product_debuts', XuatXu='$product_madein',TrangThai='$product_status', MLSP='$product_category', MSTH='$product_brand' WHERE SanPham.MSSP='$product_id';";
        $rs = mysqli_query($conn, $sql);

        // Thêm Thông số kỹ thuật nếu có
        $flag = false;

        if (isset($_POST['screen'])) {
            $screen = (!empty($_POST['screen'])) ? $_POST['screen'] : 'Chưa rõ';
            $sqlscreen = "UPDATE ManHinh SET KichThuoc='$screen' WHERE ManHinh.MSSP = '$product_id';";
            $rs_screen = mysqli_query($conn, $sqlscreen);
            if ($rs_screen) {
                $flag = true;
            } else {
                echo json_encode(array(
                    'status' => 0,
                    'message' => 'Cập nhật kích thước Màn hình không thành công'
                ));
                exit;
            }
        }

        if (isset($_POST['camera']) && isset($_POST['camera_selfie'])) {
            $camera = (!empty($_POST['camera'])) ? $_POST['camera'] : 'Chưa rõ';
            $camera_selfie = (!empty($_POST['camera_selfie'])) ? $_POST['camera_selfie'] : 'Chưa rõ';
            $sqlcamera = "UPDATE Camera  SET CameraTruoc='$camera_selfie', CameraSau='$camera' WHERE Camera.MSSP = '$product_id';";
            $rs_camera = mysqli_query($conn, $sqlcamera);
            if ($rs_camera) {
                $flag = true;
            } else {
                echo json_encode(array(
                    'status' => 0,
                    'message' => 'Cập nhật Camera không thành công'
                ));
                exit;
            }
        }

        if (isset($_POST['ram'])) {
            $ram = (!empty($_POST['ram'])) ? $_POST['ram'] : 'Chưa rõ';
            $sqlram = "UPDATE Ram SET DungLuongRam='$ram' WHERE Ram.MSSP = '$product_id';";
            $rs_ram = mysqli_query($conn, $sqlram);
            if ($rs_ram) {
                $flag = true;
            } else {
                echo json_encode(array(
                    'status' => 0,
                    'message' => 'Cập nhật Ram không thành công'
                ));
                exit;
            }
        }

        if (isset($_POST['rom'])) {
            $rom = (!empty($_POST['rom'])) ? $_POST['rom'] : 'Chưa rõ';
            $sqlrom = "UPDATE BoNho SET DungLuongRom='$rom' WHERE BoNho.MSSP = '$product_id';";
            $rs_rom = mysqli_query($conn, $sqlrom);
            if ($rs_rom) {
                $flag = true;
            } else {
                echo json_encode(array(
                    'status' => 0,
                    'message' => 'Cập nhật Bộ nhớ không thành công'
                ));
                exit;
            }
        }

        if (isset($_POST['cpu'])) {
            $cpu = (!empty($_POST['cpu'])) ? $_POST['cpu'] : 'Chưa rõ';
            $sqlcpu = "UPDATE CPU SET TenCPU='$cpu' WHERE CPU.MSSP = '$product_id';";
            $rs_cpu = mysqli_query($conn, $sqlcpu);
            if ($rs_cpu) {
                $flag = true;
            } else {
                echo json_encode(array(
                    'status' => 0,
                    'message' => 'Cập nhật CPU không thành công'
                ));
                exit;
            }
        }

        if (isset($_POST['gpu'])) {
            $gpu = (!empty($_POST['gpu'])) ? $_POST['gpu'] : 'Chưa rõ';
            $sqlgpu = "UPDATE GPU SET TenGPU='$gpu' WHERE GPU.MSSP = '$product_id';";
            $rs_gpu = mysqli_query($conn, $sqlgpu);
            if ($rs_gpu) {
                $flag = true;
            } else {
                echo json_encode(array(
                    'status' => 0,
                    'message' => 'Cập nhật GPU không thành công'
                ));
                exit;
            }
        }

        if (isset($_POST['battery'])) {
            $battery = (!empty($_POST['battery'])) ? $_POST['battery'] : 'Chưa rõ';
            $sqlbattery = "UPDATE Pin SET DungLuongPin='$battery' WHERE Pin.MSSP = '$product_id';";
            $rs_battery = mysqli_query($conn, $sqlbattery);
            if ($rs_battery) {
                $flag = true;
            } else {
                echo json_encode(array(
                    'status' => 0,
                    'message' => 'Cập nhật Pin không thành công'
                ));
                exit;
            }
        }

        if (isset($_POST['sim'])) {
            $sim = (!empty($_POST['sim'])) ? $_POST['sim'] : 'Chưa rõ';
            $sqlsim = "UPDATE Sim SET TheSim='$sim' WHERE Sim.MSSP = '$product_id';";
            $rs_sim = mysqli_query($conn, $sqlsim);
            if ($rs_sim) {
                $flag = true;
            } else {
                echo json_encode(array(
                    'status' => 0,
                    'message' => 'Cập nhật Sim không thành công'
                ));
                exit;
            }
        }

        if (isset($_POST['os'])) {
            $os = (!empty($_POST['os'])) ? $_POST['os'] : 'Chưa rõ';
            $sqlos = "UPDATE HeDieuHanh SET TenHDH='$os' WHERE HeDieuHanh.MSSP = '$product_id';";
            $rs_os = mysqli_query($conn, $sqlos);
            if ($rs_os) {
                $flag = true;
            } else {
                echo json_encode(array(
                    'status' => 0,
                    'message' => 'Cập nhật Hệ điều hành không thành công'
                ));
                exit;
            }
        }

        if ($rs) {
            if ($flag == true) {
                echo json_encode(array(
                    'status' => 1,
                    'message' => 'Cập nhật Sản phẩm thành công'
                ));
                exit;
            } else {
                echo json_encode(array(
                    'status' => 1,
                    'message' => 'Cập nhật Sản phẩm thành công. Thông số kỹ thuật chưa đầy đủ'
                ));
                exit;
            }
        } else {
            echo json_encode(array(
                'status' => 0,
                'message' => 'Cập nhật Sản phẩm không thành công'
            ));
            exit;
        }
    } else {
        echo json_encode(array(
            'status' => 0,
            'message' => 'Thông tin Sản phẩm không được trống'
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


// Status Product
if (isset($_GET['stt-prd'])) {
    // echo "oke";
    // exit;
    $product_id = $_POST['id'];
    $product_stt = $_POST['stt'];
    // echo json_encode(array(
    //     'status' => 0,
    //     'message' => $product_stt
    // ));
    // exit;
    $sql = "UPDATE SanPham SET TrangThai='$product_stt' WHERE `SanPham`.`MSSP` = '$product_id';";
    mysqli_query($conn, $sql);
    if (mysqli_query($conn, $sql) == true) {
        echo json_encode(array(
            'status' => 1,
            'message' => 'Thao tác thành công'
        ));
        exit;
    } else {
        echo json_encode(array(
            'status' => 0,
            'message' => 'Thao tác thất bại'
        ));
        exit;
    }
}


// Delete Product Image
// if (isset($_GET['delete-prd-img'])) {
//     if ($_REQUEST['id'] and $_REQUEST['id'] != '') {
//         $img_id = $_GET['id'];

//         $sql_img = "DELETE FROM `HinhSanPham` WHERE `HinhSanPham`.`MaHinh` = '$img_id';";
//         $rs_img = mysqli_query($conn, $sql_img);
//         if ($rs_img) {
//             echo json_encode(array(
                //     'status' => 1,
                //     'message' => 'Thao tác thành công'
                // ));
                // exit;
//         } else {
//             echo json_encode(array(
                //     'status' => 0,
                //     'message' => 'Thao tác không thành công'
                // ));
                // exit;
//         }
//     }
// }


/*=================================*/



/*=================================*/
// Customer

// Add Customer
if (isset($_GET['ins-customer'])) {
    if (isset($_POST['customer_name'])&&isset($_POST['customer_phone'])&&isset($_POST['customer_address'])&&isset($_POST['customer_password'])) {
        $customer_name = $_POST['customer_name'];
        $customer_address = $_POST['customer_address'];
        $customer_phone = $_POST['customer_phone'];
        $customer_email = isset($_POST['customer_email']) ? $_POST['email'] : 'NULL';
        $customer_sex = isset($_POST['customer_sex']) ? $_POST['sex'] : 'NULL';
        $customer_password = $_POST['customer_password'];

        $sql = "INSERT INTO `khachhang` (`MSKH`, `HoTenKH`, `DiaChi`, `SoDienThoai`, `GioiTinh`, `Email`, `MatKhau`) VALUES (NULL, '$customer_name', '$customer_address', '$customer_phone', '$customer_sex', '$customer_email','$customer_password');";
        $rs = mysqli_query($conn, $sql);
        if ($rs) {
            echo json_encode(array (
                'status' => 1,
                'message' => 'Thêm Khách hàng thành công' 
            ));
            exit;
        } else {
            echo json_encode(array (
                'status' => 0,
                'message' => 'Thêm Khách hàng KHÔNG thành công' 
            ));
            exit;
        }
    } else{
        echo json_encode(array (
            'status' => 0,
            'message' => 'Thông tin Khách hàng không được trống' 
        ));
        exit;
    }
}


// Update Customer
if (isset($_GET['upd-customer'])) {
    if (isset($_POST['customer_id'])&&isset($_POST['customer_name'])&&isset($_POST['customer_phone'])&&isset($_POST['customer_address'])&&isset($_POST['customer_password'])) {
        $customer_id = $_POST['customer_id'];
        $customer_name = $_POST['customer_name'];
        $customer_address = $_POST['customer_address'];
        $customer_phone = $_POST['customer_phone'];
        $customer_email = isset($_POST['customer_email']) ? $_POST['email'] : 'NULL';
        $customer_sex = isset($_POST['customer_sex']) ? $_POST['sex'] : 'NULL';
        $customer_password = $_POST['customer_password'];

        $sql = "UPDATE KhachHang SET `HoTenKH` = '$customer_name', `address` = '$customer_address', `SoDienThoai` = '$customer_phone', `Email` = '$customer_email', `GioiTinh` = '$customer_sex', `MatKhau` = '$customer_password' WHERE KhachHang.`MSKH` = '$customer_id';";
        $rs = mysqli_query($conn, $sql);

        if($rs){
            echo json_encode(array (
                'status' => 1,
                'message' => 'Cập nhật Khách hàng thành công' 
            ));
            exit;
        } else{
            echo json_encode(array (
                'status' => 0,
                'message' => 'Cập nhật Khách hàng KHÔNG thành công'  
            ));
            exit;
        }
    } else{
        echo json_encode(array (
            'status' => 0,
            'message' => 'Thông tin Khách hàng không được trống' 
        ));
        exit;
    }
}


// Delete Customer
if (isset($_GET['action']) && $_GET['action'] == 'delete-customer') {
    if ($_REQUEST['id'] and $_REQUEST['id'] != '') {
        $customer_id = $_GET['id'];
           
        $sql = "DELETE FROM `KhachHang` WHERE `Khachhang`.`MSKH` = '$customer_id';";
        $rs = mysqli_query($conn, $sql);
        if ($rs) {
            echo json_encode(array (
                'status' => 1,
                'message' => 'Xóa Khách hàng thành công' 
            ));
            exit;
        } else {
            echo json_encode(array (
                'status' => 0,
                'message' => 'Xóa Khách hàng KHÔNG thành công' 
            ));
            exit;
        }
    } else {
        echo json_encode(array (
            'status' => 0,
            'message' => 'Không tìm thấy Khách hàng' 
        ));
        exit;
    }
}


/*=================================*/



/*=================================*/
// Staff
// Add Staff
if (isset($_GET['ins-staff'])) {
    if (isset($_POST['staff_name'])&&isset($_POST['staff_jobtitle'])&&isset($_POST['staff_address'])&&isset($_POST['staff_phone'])&&isset($_POST['staff_password'])) {
        $staff_name = $_POST['staff_name'];
        $staff_jobtitle = $_POST['staff_jobtitle'];
        $staff_address = $_POST['staff_address'];
        $staff_phone = $_POST['staff_phone'];
        $staff_password = $_POST['staff_password'];

        $sql = "INSERT INTO `NhanVien` (`MSNV`, `HoTenNV`, `ChucVu`, `DiaChi`, `SoDienThoai`, `MatKhau`) VALUES (NULL, '$staff_name', '$staff_jobtitle', '$staff_address', '$staff_phone','$staff_password');";
        $rs = mysqli_query($conn, $sql);
        if ($rs) {
            echo json_encode(array (
                'status' => 1,
                'message' => 'Thêm Nhân viên thành công' 
            ));
            exit;
        } else {
            echo json_encode(array (
                'status' => 0,
                'message' => 'Thêm Nhân viên KHÔNG thành công' 
            ));
            exit;
        }
    } else {
        echo json_encode(array (
            'status' => 0,
            'message' => 'Thông tin Nhân viên không được rỗng' 
        ));
        exit;
    }
}


// Update staff
if (isset($_GET['upd-staff'])) {
    if (isset($_POST['staff_name'])&&isset($_POST['staff_jobtitle'])&&isset($_POST['staff_address'])&&isset($_POST['staff_phone'])&&isset($_POST['staff_password'])) {
        $staff_id = $_POST['staff_id'];
        $staff_name = $_POST['staff_name'];
        $staff_jobtitle = $_POST['staff_jobtitle'];
        $staff_address = $_POST['staff_new_address'];
        $staff_phone = $_POST['staff_phone'];
        $staff_password = $_POST['staff_password'];

        $sql = "UPDATE NhanVien SET `HoTenNV` = '$staff_name', `Chucvu` = '$staff_jobtitle', `DiaChi` = '$staff_address',`SoDienThoai` = '$staff_phone', `MatKhau` = '$staff_password' WHERE NhanVien.`MSNV` = '$staff_id';";
        $rs = mysqli_query($conn, $sql);
        if ($rs) {
            echo json_encode(array (
                'status' => 1,
                'message' => 'Cập nhật Nhân viên thành công' 
            ));
            exit;
        } else {
            echo json_encode(array (
                'status' => 0,
                'message' => 'Cập nhật Nhân viên KHÔNG thành công' 
            ));
            exit;
        }
    } else {
        echo json_encode(array (
            'status' => 0,
            'message' => 'Thông tin Nhân viên không được rỗng' 
        ));
        exit;
    }
}


// Delete staff
if (isset($_GET['del-staff'])) {
    if ($_REQUEST['id'] and $_REQUEST['id'] != '') {
        $staff_id = $_GET['id'];
        $sql = "DELETE FROM `NhanVien` WHERE `NhanVien`.`MSNV` = '$staff_id';";
        mysqli_query($conn, $sql);
        if ($rs) {
            echo json_encode(array (
                'status' => 1,
                'message' => 'Xóa Nhân viên thành công' 
            ));
            exit;
        } else {
            echo json_encode(array (
                'status' => 0,
                'message' => 'Xóa Nhân viên KHÔNG thành công' 
            ));
            exit;
        }
    }
}


/*=================================*/




/*=================================*/
// Order
// Confirm Order
if(isset($_GET['order-comfirm'])){
    if (isset($_GET['id'])) {
        $order_id = $_GET['id'];
        $order_date = $_POST['order_date'];
        $order_delivery = $_POST['order_delivery'];
        $admin_id = $_SESSION['admin']['MSNV'];

        if ($order_delivery < $order_date) {
            header("location: order_detail.php?id=$order_id&status=0&err=date");
            exit;
        } else {
            $find_item = "SELECT * FROM ChiTietDatHang WHERE ChiTietDatHang.SoDonDH = '$order_id'";
            $rs_find = mysqli_query($conn, $find_item);
            while ($item = mysqli_fetch_assoc($rs_find)) {
                $prd_id = $item['MSSP'];
                $item_qty = $item['SoLuong'];
                $item_saleoff = str_replace(array('.', ','), '', $_POST['saleoff' . $prd_id])*$item_qty;
                // echo $item_saleoff;
                // echo $_POST['saleoff'.$item['MSSP']];
                // echo"<pre>";
                // print_r($item_saleoff);
                // exit;
                $sql_detail = "UPDATE ChiTietDatHang SET GiamGia = '$item_saleoff' WHERE ChiTietDatHang.SoDonDH = '$order_id' AND ChiTietDatHang.MSSP = $prd_id;";
                $rs_detail = mysqli_query($conn, $sql_detail);
                if ($rs_detail) {
                    $flag = 1;
                } else {
                    $flag = 0;
                }
            }
            // exit;

            if ($flag == 1) {
                $sql = "UPDATE `dathang` SET `MSNV` = '$admin_id', `NgayGH` = '$order_delivery', `TrangThaiDH` = '1' WHERE `dathang`.`SoDonDH` = '$order_id';";
                $rs = mysqli_query($conn, $sql);
                if ($rs) {
                    header("location: order.php?status=1&success=confirm");
                    exit;
                } else {
                    header("location: order_detail.php?id=$order_id&status=0&err=other");
                    exit;
                }
            }
        }
    }
}


// Completed Order
if (isset($_GET['order']) && isset($_GET['id']) && isset($_SESSION['admin']) && $_GET['order'] == "complete") {
    $order_id = $_GET['id'];
    $admin_id = $_SESSION['admin']['MSNV'];

    $sql = "UPDATE `dathang` SET `MSNV` = '$admin_id', `TrangThaiDH` = 'completed' WHERE `dathang`.`SoDonDH` = '$order_id';";
    $rs = mysqli_query($conn, $sql);
    if ($rs) {
        header("location: order.php?status=completed&success=complete");
        exit;
    } else {
        header("location: order_detail.php?id=$order_id&err=other&status=1");
        exit;
    }
}


// Delete Order
if (isset($_GET['order']) && isset($_GET['id']) && isset($_SESSION['admin']) && $_GET['order'] == "delete") {
    $order_id = $_GET['id'];
    $admin_id = $_SESSION['admin']['MSNV'];
    // Tim CTDH can update SL
    $sql_detail = "SELECT * FROM ChiTietDatHang WHERE ChiTietDatHang.SoDonDH = '$order_id'";
    $rs_detail = mysqli_query($conn, $sql_detail);

    // Duyet tung SP trong DH
    while ($detai_value = mysqli_fetch_assoc($rs_detail)) {
        $prd_id =  $detai_value['MSSP'];
        $order_qty =  $detai_value['SoLuong'];
        // echo "CTDH: ".$prd_id."-";
        // echo $order_qty."- SP: ";

        // Tim SP can update SL
        $sql_qty = "SELECT * FROM SanPham WHERE SanPham.MSSP = '$prd_id'";
        $rs_qty = mysqli_query($conn, $sql_qty);
        $prd_values = mysqli_fetch_assoc($rs_qty);
        $old_qty = $prd_values['SoLuong'];
        // echo $old_qty;
        // echo $prd_id."-";

        // Update SL: SL-ton + SL-mua
        $sql_update_qty = "UPDATE SanPham  SET SanPham.SoLuong = '$old_qty' + '$order_qty' 
            WHERE SanPham.MSSP = '$prd_id';";
        $rs_update_qty = mysqli_query($conn, $sql_update_qty);
    }
    if ($rs_update_qty) {
        $sql_detail = "DELETE FROM ChiTietDatHang WHERE `ChiTietDatHang`.`SoDonDH` = '$order_id';";
        $rs_sql = mysqli_query($conn, $sql_detail);
        if ($rs_sql) {
            $sql = "DELETE FROM DatHang WHERE `dathang`.`SoDonDH` = '$order_id';";
            $rs = mysqli_query($conn, $sql);
            if ($rs) {
                header("location: order.php?status=0&success=delete");
                exit;
            } else {
                header("location: order_detail.php?id=$order_id&err=del&status=0");
                exit;
            }
        } else {
            header("location: order_detail.php?id=$order_id&err=del&status=0");
            exit;
        }
    } else {
        header("location: order_detail.php?id=$order_id&err=updateqty&status=0");
        exit;
    }
}


/*=================================*/




/*=================================*/
// Login

/*=================================*/



/*===================================*/
// Upload File
// function uploadFiles($uploadfile)
// {
//     $files = array();
//     $errors = array();
//     //Xử lý dữ liêu 
//     foreach ($uploadfile as $key => $values) {
//         foreach ($values as $index => $value) {
//             $files[$index][$key] = $value;
//         }
//     }
//     //Kiểm tra thư mục lưu trữ file uplaod đã tồn tại chưa
//     $filePath = "../img_upload/";;
//     if (!is_dir($filePath)) {
//         mkdir($filePath, 0777, true);
//     }
//     foreach ($files as $file) {
//         $file = validateUploadFiles($file, $filePath);
//         if ($file != false) {
//             move_uploaded_file($file['tmp_name'], $filePath . '/' . $file['name']);
//         } else {
//             $errors[] = "The file " . basename($file['name']) . " isn't valid.";
//         }
//     }
//     return $errors;
// }

// // Kiểm tra tính hợp lệ của file
// function validateUploadFiles($file, $filePath)
// {
//     // Kiểm tra có phải là file ảnh không
//     $validTypes = array("jpg", "png", "git", "jpeg", "bmp");
//     $fileType = substr($file['name'], strrpos($file['name'], '.') + 1);
//     if (!in_array($fileType, $validTypes)) {
//         return false;
//     }

//     // Kiểm tra file đã tồn tại chưa, nếu có thì đổi tên
//     $num = 1;
//     $fileName = substr($file['name'], 0, strrpos($file['name'], '.'));
//     while (file_exists($filePath . '/' . $fileName . '.' . $fileType)) {
//         $fileName = $fileName . '(' . $num . ')';
//         $num++;
//     }
//     $file['name'] = $fileName . '.' . $fileType;
//     return $file;
// }

/*=================================*/
