<?php
include("./connection.php");
session_start();

if (isset($_GET['order-prd'])) {
    if (isset($_POST['prd_quantity']) && isset($_GET['id'])) {
        $prd_quantity = $_POST['prd_quantity'];
        $prd_id = $_GET['id'];
        $err = false;
        $sql = "SELECT * FROM SanPham WHERE SanPham.MSSP = '$prd_id'";
        $rs = mysqli_query($conn, $sql);
        $data = mysqli_fetch_assoc($rs);

        // Check quantity 
        if ($data && ($prd_quantity <= $data['SoLuongHang'])) {
            $old_qty = $data['SoLuongHang'];

            $update_prd = "UPDATE sanpham  SET sanpham.SoLuongHang = '$old_qty' - '$prd_quantity' WHERE sanpham.MSSP = '$prd_id';";
            $rs_update = mysqli_query($conn, $update_prd);

            // Check product
            // Nếu có thì tăng số lương của SP trong giỏ hàng
            if ($rs_update && isset($_SESSION['cart'][$prd_id])) {
                $_SESSION['cart'][$prd_id]['quantity'] += $prd_quantity;
                // echo($prd_id);
                // echo($prd_quantity);
                // echo("fail");
                header("location: ./cart.php");
                exit;
            } else {
                $item = [
                    'id' => $data['MSSP'],
                    'name' => $data['TenSP'],
                    'image' => $data['Avatar'],
                    'price' => $data['GiaBan'] > 0 ? $data['GiaBan'] : $data['Gia'],
                    'quantity' => $prd_quantity,

                ];
                $_SESSION['cart'][$prd_id] = $item;
                // echo"<pre>";
                // print_r($_SESSION['cart']);
                // exit;
                header("location: ./cart.php?notify=success");
                exit;
            }
        } else {
            // echo $prd_id; exit;
            header("location: ./product-detail.php?action=prd-detail&id=$prd_id&notify=qty-err");
            exit;
        }
    }
}
/*===================================*/
