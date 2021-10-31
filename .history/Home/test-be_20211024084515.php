<?php
include("./connection.php");
session_start();

if (isset($_GET['update-cart'])) {
        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $value) {
                $prd_id = $_SESSION['cart'][$value['id']]['id'];
                $sql_prd = "SELECT * FROM SanPham WHERE SanPham.MSSP = '$prd_id'";
                $rs_prd = mysqli_query($conn, $sql_prd);

                while ($prd_qty = mysqli_fetch_assoc($rs_prd)) {
                    $prd_qtyold = $prd_qty['SoLuongHang'];
                    $old_qty = $_SESSION['cart'][$value['id']]['quantity'];
                    $new_qty = $_POST['qty' . $value['id']];
                    $prd_quantity = $prd_qtyold - ($new_qty - $old_qty);
                    // echo $prd_quantity;exit;
                    $_SESSION['cart'][$value['id']]['quantity'] = $new_qty;
                    $update_prd = "UPDATE SanPham  SET SanPham.SoLuongHang = '$prd_quantity' WHERE SanPham.MSSP = $prd_id";
                    $rs_update = mysqli_query($conn, $update_prd);
                }
            }
            if ($rs_update) {
                echo json_encode(array(
                    'status' => 1,
                    'message' => 'Cập nhật giỏ hàng thành công'
                ));
                exit;
            } else {
                echo json_encode(array(
                    'status' => 0,
                    'message' => 'Cập nhật giỏ hàng không thành công'
                ));
                exit;
            }
        }
}
/*===================================*/
