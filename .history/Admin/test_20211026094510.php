<?php
include("./connection.php");
session_start();

if (isset($_GET['ins-prd'])) {
    // var_dump($_POST); 
    // echo json_encode(array(
    //     'status' => 0,
    //     'message' => 'Thêm ảnh sản phẩm không thành công'
    // ));
    // exit;
    if ( isset($_FILES['file'])) {
    // if ( isset($_POST) && isset($_FILES['file']) && !empty($_FILES['file']['name']) && isset($_POST['product_name']) && isset($_POST['product_price']) && isset($_POST['product_quantity'])) {
        // echo "oke";exit;
        // $product_id = rand(0, 9999) . rand(0, 9999);
          echo json_encode(array(
            'status' => 1,
            'message' => 'Oke'
        ));
        exit;
        $product_name = $_POST['product_name'];
        $product_description = $_POST['product_description'];
        $product_price = str_replace(array('.', ','), '', $_POST['product_price']);
        $product_sale = str_replace(array('.', ','), '', $_POST['product_sale']);
        $image_name = $_FILES['image_name'];
        $product_img = $_FILES['image_name']['name'];
        $product_quantity = $_POST['product_quantity'];
        $product_debuts =  $_POST['product_debuts'];
        $product_madein = $_POST['product_madein'];
        $create_at = date("Y-m-d");
        $product_status = 1;
        $product_category = $_POST['product_category'];
        $product_brand = $_POST['product_brand'];
        // echo $product_debuts;exit;

        // if (!empty($_FILES['image_name']['name'])) {
            // $image_name = $_FILES['image_name'];
            // $product_img = $_FILES['image_name']['name'];
            // echo $product_img;exit;

            $result = upOneFile($image_name);
            if (!$result) {
                echo json_encode(array(
                    'status' => 0,
                    'message' => 'Thêm ảnh sản phẩm không thành công'
                ));
                exit;
            } else {
                $sql1 = "INSERT INTO `SanPham` (`MSSP`, `TenSP`, `MoTa`, `Gia`, `GiaBan`,  `Avatar`,`SoLuongHang`, `NgayRaMat`, `XuatXu`, `NgayTao`, `TrangThai`, `MLSP`,`MSTH`) VALUES (NULL, '$product_name', '$product_description', '$product_price','$product_sale', '$product_img', '$product_quantity','$product_debuts','$product_madein','$create_at','$product_status','$product_category','$product_brand'); ";
                $rs1 = mysqli_query($conn, $sql1);

                if ($rs1) {
                    $last_id = mysqli_insert_id($conn);
                    $sql_img = "INSERT INTO `HinhSanPham` (`MaHinh`, `TenHinh`, `MSSP`) VALUES (NULL, '$product_img', '$last_id'); ";

                    $rs_img = mysqli_query($conn, $sql_img);

                    if ($rs_img) {
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
            }
        // } 
        // else {
        //     echo json_encode(array(
        //         'status' => 0,
        //         'message' => 'Ảnh sản phẩm không được trống'
        //     ));
        //     exit;
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


?>