<?php
include("./connection.php");
session_start();

if (isset($_GET['order'])) {
    if (isset($_SESSION['cart']) && isset($_SESSION['user'])) {

        $order_id = rand(0, 9999) . rand(0, 9999);
        $customer_id = $_SESSION['user']['MSKH'];
        $day_order = date("Y-m-d");
        $order_address = $_POST['customer_address'];
        $order_note = $_POST['customer_note'];


        $sql_order = "INSERT INTO `dathang` (`SoDonDH`, `MSKH`, `MSNV`, `NgayDH`, `NgayGH`, `DiaChiGH`, `GhiChu`, `TrangThaiDH`) VALUES ($order_id, '$customer_id', NULL, '$day_order', '$order_address', NULL, '$order_note', '0');";
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

            }
            if ($rs_detail) {
                unset($_SESSION['cart']);
                echo json_encode(array(
                    'status' => 1,
                    'message' => 'Mua hàng thành công'
                ));
                exit;
            } else {
                echo json_encode(array(
                    'status' => 0,
                    'message' => 'Mua hàng không thành công'
                ));
                exit;
            }
        }
    }
}
/*===================================*/
