<?php
include("./connection.php");
session_start();

if (isset($_GET['order'])) {
        if (isset($_SESSION['cart']) && isset($_SESSION['user'])) {
            
            $customer_id = $_SESSION['user']['MSKH'];
            $order_id = rand(0, 9999) . rand(0, 9999);
            $day_order = date("Y-m-d");
            $order_address = $_POST['customer_address'];
            $order_note = $_POST['customer_note'];


            $sql_order = "INSERT INTO `dathang` (`SoDonDH`, `MSKH`, `MSNV`, `DiaChiGH`, `NgayDH`, `NgayGH`, `GhiChu`, `TrangThaiDH`) VALUES ($order_id, '$customer_id', NULL, '$order_address', '$day_order', NULL, '$order_note', '0');";
            $rs_order = mysqli_query($conn, $sql_order);
            if ($rs_order) {
                // echo'<pre>';
                // print_r($day_order); 
                // exit;
                foreach ($_SESSION['cart'] as $value) {
                    $prd_id = $_SESSION['cart'][$value['id']]['id'];
                    $prd_qty = $_SESSION['cart'][$value['id']]['quantity'];
                    $prd_price = $_SESSION['cart'][$value['id']]['price'];
                    $prd_sale = $_POST['prd_sale'];

                    $sql_detail = "INSERT INTO `chitietdathang` (`SoDonDH`, `MSSP`, `SoLuong`, `GiaDatHang`, `GiamGia`) VALUES ('$order_id', '$prd_id', '$prd_qty', '$prd_price', NULL); ";
                    $rs_detail = mysqli_query($conn, $sql_detail);

                    // $update_prd = "UPDATE sanpham INNER JOIN chitietdathang ON sanpham.MSSP = chitietdathang.MSSP SET sanpham.SoLuongHang = sanpham.SoLuongHang - '$prd_qty' WHERE chitietdathang.SoDonDH = '$order_id';";
                    // $rs_update = mysqli_query($conn, $update_prd);
                }
                // if ($rs_detail && $rs_update) {
                if ($rs_detail) {
                    unset($_SESSION['cart']);
                    header("location: ./cart.php?notify=success");
                    exit;
                } else {
                    header("location: ./cart.php?notify=error");
                    exit;
                }
            }
        }
    }
/*===================================*/
