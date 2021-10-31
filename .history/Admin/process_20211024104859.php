<?php
include("./connection.php");
include("./function.php");

/*=================================*/
// Login
if (isset($_GET['action']) && $_GET['action'] == 'login') {
    if (isset($_POST['submit'])) {
        $phone = $_POST['phone'];
        $password = $_POST['password'];

        // echo $phone;
        // echo $password;
        if ($phone != "" && $password != "") {
            $sql = "SELECT * FROM NhanVien WHERE NhanVien.SoDienThoai = '$phone' AND NhanVien.MatKhau = '$password';";
            $rs = mysqli_query($conn, $sql);
            $data_admin = mysqli_fetch_assoc($rs);
            if (mysqli_num_rows($rs) > 0) {
                $_SESSION['admin'] = $data_admin;
                header("location: product_manage.php");
                exit;
            } else {
                header("location: login.php?SĐT hoặc mật khẩu không đúng hay chưa có tài khoản");
                exit();
            }
        } else {
            header("location: login.php?SĐT và mật khẩu không được để trống");
            exit();
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
if (isset($_GET['action']) && $_GET['action'] == 'add-category') {
    if (isset($_POST['submit'])) {
        $category_name = $_POST['category_name'];

        $sql = "INSERT INTO `LoaiHangHoa`(`MaLoaiHang`, `TenLoaiHang`)
            VALUES (NULL, '$category_name'); ";
        $rs = mysqli_query($conn, $sql);
        if ($rs) {
            header("Location: category_manage.php?success=Thêm loại hàng thành công");
            exit;
        } else {
            header("Location: customer_insert.php?err=Thêm loại hàng không thành công");
            exit;
        }
    }
}


// Update Category
if (isset($_GET['action']) && $_GET['action'] == 'update-category') {
    if (isset($_POST['submit'])) {
        $category_id = $_POST['category_id'];
        $category_name = $_POST['category_name'];

        $sql = "UPDATE `loaihanghoa` SET `TenLoaiHang` = '$category_name' WHERE `loaihanghoa`.`MaLoaiHang` = '$category_id';";

        if (mysqli_query($conn, $sql) == true) {
            header('Location: category_manage.php?success=Cập nhật thành công');
            exit;
        }
    }
}


// Delete Category
if (isset($_GET['action']) && $_GET['action'] == 'delete-category') {
    if ($_REQUEST['id'] and $_REQUEST['id'] != '') {
        $category_id = $_GET['id'];
        // echo $category_id;exit;
        $find_prd = "SELECT * FROM `HangHoa` WHERE `HangHoa`.`MaLoaiHang` = '$category_id';";
        $rs_find = mysqli_query($conn, $find_prd);
        if (mysqli_num_rows($rs_find) > 0) {
            while ($product = mysqli_fetch_array($rs_find)) {
                $product_id = $product['MSHH'];
                $sql2 = "DELETE FROM `HinhHangHoa` WHERE `HinhHangHoa`.`MSHH` = '$product_id';";
                $rs1 = mysqli_query($conn, $sql2);
            }
            $sql = "DELETE FROM `HangHoa` WHERE `HangHoa`.`MaLoaiHang` = '$category_id';";
            $rs = mysqli_query($conn, $sql);

            if ($rs == true && $rs1 == true) {
                $sql2 = "DELETE FROM `LoaiHangHoa` WHERE `LoaiHangHoa`.`MaLoaiHang` = '$category_id';";
                $rs2 = mysqli_query($conn, $sql2);
                if ($rs2 == true) {
                    header('Location: category_manage.php?success=Xóa thành công');
                    exit;
                } else {
                    header('Location: category_manage.php?err=Xóa ' . $category_id . ' không thành công');
                    exit();
                }
            } else {
                header('Location: category_manage.php?err=Xóa hàng hóa có MaLoaiHang ' . $category_id . ' không thành công');
                exit();
            }
        } else {
            $sql2 = "DELETE FROM `LoaiHangHoa` WHERE `LoaiHangHoa`.`MaLoaiHang` = '$category_id';";
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
// Product
// Add Product
if (isset($_GET['action']) && $_GET['action'] == 'add-prd') {
    if (isset($_POST['submit'])) {
        $product_id = rand(0, 9999) . rand(0, 9999);
        $product_name = $_POST['product_name'];
        $product_description = $_POST['product_description'];
        $product_price = str_replace(array('.', ','), '', $_POST['product_price']);
        $product_quantity = $_POST['product_quantity'];
        $product_category = $_POST['product_category'];

        if (isset($_FILES['image_name']) && !empty($_FILES['image_name']['name'][0])) {
            $image_name = $_FILES['image_name'];
            $product_img = $_FILES['image_name']['name'];

            $result = upOneFile($image_name);
            if (!$result) {
                header("location: product_insert.php?err=Upload ảnh không thành công");
                exit;
            } else {
                $sql1 = "INSERT INTO `HangHoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`) VALUES ($product_id, '$product_name', '$product_description', '$product_price', '$product_quantity', '$product_category'); ";
                $rs1 = mysqli_query($conn, $sql1);


                if ($rs1) {
                    $sql_img = "INSERT INTO `HinhHangHoa` (`MaHinh`, `TenHinh`, `MSHH`) VALUES (NULL, '$product_img', '$product_id'); ";

                    $rs_img = mysqli_query($conn, $sql_img);

                    if ($rs_img) {
                        header('Location: product_manage.php?success=Thêm sản phẩm thành công');
                        exit;
                    }
                } else {
                    header('Location: product_manage.php?err=Thêm không thành công');
                    exit();
                }
            }
        } else {
            header('Location: product_insert.php?err=no-img');
            exit();
        }
    }
}


// Update Product
if (isset($_GET['action']) && $_GET['action'] == 'update-prd') {
    if (isset($_POST['submit'])) {
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_description = $_POST['product_description'];
        $product_price = str_replace(array('.', ','), '', $_POST['product_price']);
        $product_quantity = $_POST['product_quantity'];
        $product_category = $_POST['product_category'];
        // echo $product_price; exit;

        $sql1 = "UPDATE `HangHoa` SET `TenHH` = '$product_name', `QuyCach` = '$product_description',`Gia` = '$product_price', `SoLuongHang` = '$product_quantity', `MaLoaiHang` = '$product_category'  WHERE `HangHoa`.`MSHH` = '$product_id'; ";
        $rs1 = mysqli_query($conn, $sql1);

        if (isset($_FILES['image_newname']) && !empty($_FILES['image_newname']['name'][0])) {
            $image_newname = $_FILES['image_newname'];
            $product_newimg = $_FILES['image_newname']['name'];

            $result = upOneFile($image_newname);

            $sql_img = "INSERT INTO `HinhHangHoa` (`MaHinh`, `TenHinh`, `MSHH`) VALUES (NULL, '$product_newimg', '$product_id'); ";
            $rs_img = mysqli_query($conn, $sql_img);

            if ($rs1 && $rs_img) {
                header('Location: product_upd.php?id=' . $product_id . '&success=Cập nhật sản phẩm thành công');
                exit;
            } else {
                header('Location: product_upd.php?id=' . $product_id . '&err=Cập nhật không thành công');
                exit();
            }
        } else {
            if ($rs1) {
                header('Location: product_manage.php?id=' . $product_id . '&success=Cập nhật sản phẩm thành công');
                exit;
            } else {
                header('Location: product_upd.php?id=' . $product_id . '&err=Cập nhật không thành công');
                exit();
            }
        }
    }
}


// Delete Product
if (isset($_GET['action']) && $_GET['action'] == 'delete-prd') {
    // echo "oke";
    // exit;
    if ($_REQUEST['id'] and $_REQUEST['id'] != '') {
        $product_id = $_GET['id'];

        $sql_img = "DELETE FROM `HinhHangHoa` WHERE `HinhHangHoa`.`MSHH` = '$product_id';";
        $rs_img = mysqli_query($conn, $sql_img);
        if ($rs_img) {
            $sql = "DELETE FROM `HangHoa` WHERE `HangHoa`.`MSHH` = '$product_id';";
            mysqli_query($conn, $sql);
            if (mysqli_query($conn, $sql) == true) {
                header('Location: product_manage.php?success=Xóa thành công');
                exit;
            } else {
                header('Location: product_manage.php?err=Xóa ' . $product_id . ' không thành công');
                exit;
            }
        }
    }
}


// Delete Product Image
if (isset($_GET['action']) && $_GET['action'] == 'delete-prd-img') {
    if ($_REQUEST['id'] and $_REQUEST['id'] != '') {
        $img_id = $_GET['id'];
        $prd_id = $_GET['prd-id'];

        $sql_img = "DELETE FROM `HinhHangHoa` WHERE `HinhHangHoa`.`MaHinh` = '$img_id';";
        $rs_img = mysqli_query($conn, $sql_img);
        if ($rs_img) {
            header('Location: product_upd.php?id=' . $prd_id . '&success=Xóa thành công');
            exit;
        } else {
            header('Location: product_upd.php?id=' . $prd_id . '&err=del-img');
            exit;
        }
    }
}


/*=================================*/



/*=================================*/
// Customer

// Add Customer
if (isset($_GET['action']) && $_GET['action'] == 'add-customer') {
    if (isset($_POST['submit'])) {
        $customer_id = rand(0, 9999) . rand(0, 9999);
        $customer_name = $_POST['customer_name'];
        $customer_company = $_POST['customer_company'];
        $customer_address = $_POST['customer_address'];
        $customer_phone = $_POST['customer_phone'];
        $customer_fax = $_POST['customer_fax'];
        $customer_password = $_POST['customer_password'];

        $sql = "INSERT INTO `khachhang` (`MSKH`, `HoTenKH`, `TenCongTy`, `SoDienThoai`, `SoFax`, `MatKhau`) VALUES ($customer_id, '$customer_name', '$customer_company', '$customer_phone', '$customer_fax', '$customer_password');";
        $rs = mysqli_query($conn, $sql);
        if ($rs) {
            $sql_address = "INSERT INTO `DiaChiKH` (`MaDC`, `DiaChi`, `MSKH`) VALUES (NULL, '$customer_address', '$customer_id');";
            $rs_address = mysqli_query($conn, $sql_address);
            if ($rs_address) {
                header("Location: customer_manage.php?success=Thêm khách hàng thành công");
                exit;
            } else {
                header("Location: customer_insert.php?err=add-address");
                exit;
            }
        } else {
            header("Location: customer_insert.php?err=add-customer");
            exit;
        }
    }
}


// Update Customer
if (isset($_GET['action']) && $_GET['action'] == 'update-customer') {
    if (isset($_POST['submit'])) {
        $customer_id = $_POST['customer_id'];
        $customer_name = $_POST['customer_name'];
        $customer_company = $_POST['customer_company'];
        $customer_phone = $_POST['customer_phone'];
        $customer_fax = $_POST['customer_fax'];
        $customer_password = $_POST['customer_password'];

        $sql = "UPDATE KhachHang SET `HoTenKH` = '$customer_name', `TenCongTy` = '$customer_company', `SoDienThoai` = '$customer_phone', `SoFax` = '$customer_fax', `MatKhau` = '$customer_password' WHERE KhachHang.`MSKH` = '$customer_id';";
        $rs = mysqli_query($conn, $sql);

        if (!empty($_POST['customer_new_address'])) {
            if ($rs) {
                // echo $customer_id;exit;
                $new_address = $_POST['customer_new_address'];

                $sql_address = "INSERT INTO `DiaChiKH` (`MaDC`, `DiaChi`, `MSKH`) VALUES (NULL, '$new_address', '$customer_id');";
                $rs_address = mysqli_query($conn, $sql_address);

                if ($rs_address) {
                    header('Location: customer_upd.php?id=' . $customer_id . '&success=Cập nhật khách hàng thành công');
                    exit;
                } else {
                    header('Location: customer_upd.php?id=' . $customer_id . '&err=add-address');
                    exit;
                }
            } else {
                header('Location: customer_upd.php?id=' . $customer_id . '&err=update-address');
                exit;
            }
        } else {
            if ($rs) {
                header('Location: customer_manage.php?id=' . $customer_id . '&success=Cập nhật khách hàng thành công');
                exit;
            } else {
                header('Location: customer_upd.php?id=' . $customer_id . '&err=update-address');
                exit;
            }
        }
    }
}


// Delete Customer
if (isset($_GET['action']) && $_GET['action'] == 'delete-customer') {
    if ($_REQUEST['id'] and $_REQUEST['id'] != '') {
        $customer_id = $_GET['id'];
        $sql_address = "DELETE FROM `DiaChiKH` WHERE `DiaChiKH`.`MSKH` = '$customer_id';";
        $rs_address = mysqli_query($conn, $sql_address);

        $find_order = "SELECT * FROM DatHang WHERE DatHang.MSKH = '$customer_id'";
        $rs_find = mysqli_query($conn, $find_order);
        if (mysqli_num_rows($rs_find) > 0) {
            $sql_order = "DELETE FROM `DatHang` WHERE `DatHang`.`MSKH` = '$customer_id';";
            $rs_order = mysqli_query($conn, $sql_order);
            if ($rs_address && $rs_order) {
                $sql = "DELETE FROM `KhachHang` WHERE `Khachhang`.`MSKH` = '$customer_id';";
                $rs = mysqli_query($conn, $sql);
                if ($rs) {
                    header('Location: customer_manage.php?success=Xóa thành công');
                    exit;
                } else {
                    header('Location: customer_manage.php?err=del-customer');
                    exit;
                }
            } else {
                header('Location: customer_manage.php?err=del-addr-order');
                exit;
            }
        } else {
            if ($rs_address) {
                $sql = "DELETE FROM `KhachHang` WHERE `Khachhang`.`MSKH` = '$customer_id';";
                $rs = mysqli_query($conn, $sql);
                if ($rs) {
                    header('Location: customer_manage.php?success=Xóa thành công');
                    exit;
                } else {
                    header('Location: customer_manage.php?err=del-address');
                    exit;
                }
            }
        }
    }
}


// Delete Customer Address
if (isset($_GET['action']) && $_GET['action'] == 'delete-customer-address') {
    if ($_REQUEST['id'] and $_REQUEST['id'] != '') {
        $address_id = $_GET['id'];
        $customer_id = $_GET['customer-id'];

        $sql_address = "DELETE FROM `DiaChiKH` WHERE `DiaChiKH`.`MaDC` = '$address_id';";
        $rs_address = mysqli_query($conn, $sql_address);
        if ($rs_address) {
            header('Location: customer_upd.php?id=' . $customer_id . '&success=Xóa thành công');
            exit;
        } else {
            header('Location: customer_upd.php?id=' . $customer_id . '&err=del-address');
            exit;
        }
    }
}


/*=================================*/



/*=================================*/
// Staff
// Add Staff
if (isset($_GET['action']) && $_GET['action'] == 'add-staff') {
    if (isset($_POST['submit'])) {
        $staff_name = $_POST['staff_name'];
        $staff_post = $_POST['staff_post'];
        $staff_address = $_POST['staff_address'];
        $staff_phone = $_POST['staff_phone'];
        $staff_password = $_POST['staff_password'];

        $sql = "INSERT INTO `NhanVien` (`MSNV`, `HoTenNV`, `ChucVu`, `DiaChi`, `SoDienThoai`, `MatKhau`) VALUES (NULL, '$staff_name', '$staff_post', '$staff_address', '$staff_phone','$staff_password');";
        $rs = mysqli_query($conn, $sql);
        if ($rs) {
            header("Location: staff_manage.php?success=Thêm nhân viên thành công");
            exit;
        } else {
            header("Location: staff_insert.php?err=add-staff");
            exit;
        }
    }
}


// Update staff
if (isset($_GET['action']) && $_GET['action'] == 'update-staff') {
    if (isset($_POST['submit'])) {
        $staff_id = $_POST['staff_id'];
        $staff_name = $_POST['staff_name'];
        $staff_post = $_POST['staff_post'];
        $staff_address = $_POST['staff_new_address'];
        $staff_phone = $_POST['staff_phone'];
        $staff_password = $_POST['staff_password'];

        $sql = "UPDATE NhanVien SET `HoTenNV` = '$staff_name', `Chucvu` = '$staff_post', `DiaChi` = '$staff_address',`SoDienThoai` = '$staff_phone', `MatKhau` = '$staff_password' WHERE NhanVien.`MSNV` = '$staff_id';";

        if (mysqli_query($conn, $sql) == true) {
            header('Location: staff_manage.php?success=Cập nhật thành công');
            exit;
        } else {
            header('Location: staff_upd.php?success=Cập nhật không thành công');
            exit();
        }
    }
}


// Delete staff
if (isset($_GET['action']) && $_GET['action'] == 'delete-staff') {
    if ($_REQUEST['id'] and $_REQUEST['id'] != '') {
        $staff_id = $_GET['id'];
        $sql = "DELETE FROM `NhanVien` WHERE `NhanVien`.`MSNV` = '$staff_id';";
        mysqli_query($conn, $sql);
        if (mysqli_query($conn, $sql) == true) {
            header('Location: staff_manage.php?success=Xóa thành công');
            exit;
        } else {
            header('Location: staff.php?err=del-staff&id=' . $staff_id);
            exit;
        }
    }
}


/*=================================*/




/*=================================*/
// Order
// Confirm Order
if (isset($_GET['order']) && isset($_GET['id']) && isset($_SESSION['admin']) && $_GET['order'] == "confirm") {
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
        while($item = mysqli_fetch_assoc($rs_find)){
            $prd_id = $item['MSHH'];
            $item_saleoff = str_replace(array('.', ','), '', $_POST['saleoff'.$prd_id]);
            // echo $item_saleoff;
            // echo $_POST['saleoff'.$item['MSHH']];
            // echo"<pre>";
            print_r($item_saleoff);
            $sql_detail = "UPDATE ChiTietDatHang SET GiamGia = '$item_saleoff' WHERE ChiTietDatHang.SoDonDH = '$order_id' AND ChiTietDatHang.MSHH = $prd_id;";
            $rs_detail = mysqli_query($conn, $sql_detail);    
            if($rs_detail){
                $flag = 1;
            }else{
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
        $prd_id =  $detai_value['MSHH'];
        $order_qty =  $detai_value['SoLuong'];
        // echo "CTDH: ".$prd_id."-";
        // echo $order_qty."- SP: ";

        // Tim SP can update SL
        $sql_qty = "SELECT * FROM HangHoa WHERE HangHoa.MSHH = '$prd_id'";
        $rs_qty = mysqli_query($conn, $sql_qty);
        $prd_values = mysqli_fetch_assoc($rs_qty);
        $old_qty = $prd_values['SoLuong'];
        // echo $old_qty;
        // echo $prd_id."-";

        // Update SL: SL-ton + SL-mua
        $sql_update_qty = "UPDATE HangHoa  SET HangHoa.SoLuong = '$old_qty' + '$order_qty' 
            WHERE HangHoa.MSHH = '$prd_id';";
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
