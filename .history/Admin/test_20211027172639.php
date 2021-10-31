<?php
include("./connection.php");
include("./function.php");
session_start();

if (isset($_GET['update-prd'])) {
    if (isset($_POST['submit']) && isset($_FILES['image_newname']) && !empty($_FILES['image_newname']['name'][0])) {
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_description = $_POST['product_description'];
        $product_price = str_replace(array('.', ','), '', $_POST['product_price']);
        $product_quantity = $_POST['product_quantity'];
        $product_category = $_POST['product_category'];
        // echo $product_price; exit;

        $image_newname = $_FILES['image_newname'];
        $product_newimg = $_FILES['image_newname']['name'];

        $result = upOneFile($image_newname);

        $sql1 = "UPDATE `SanPham` SET `TenSP` = '$product_name', `MoTa` = '$product_description',`Gia` = '$product_price', `SoLuongHang` = '$product_quantity', `MLSP` = '$product_category'  WHERE `SanPham`.`MSSP` = '$product_id'; ";
        $rs1 = mysqli_query($conn, $sql1);



        // $sql_img = "INSERT INTO `HinhSanPham` (`MaHinh`, `TenHinh`, `MSSP`) VALUES (NULL, '$product_newimg', '$product_id'); ";
        // $rs_img = mysqli_query($conn, $sql_img);

        if ($rs1 && $rs_img) {
            echo "<script>alert(Cập nhật sản phẩm thành công);</script>";
            header('Location: product_upd.php?id=' . $product_id);
            exit;
        } else {
            echo "<script>alert(Cập nhật sản phẩm không thành công);</script>";
            header('Location: product_upd.php?id=' . $product_id);
            exit();
        }
    }
}


// Delete Product
if (isset($_GET['action']) && $_GET['action'] == 'delete-prd') {
    // echo "oke";
    // exit;
    if ($_REQUEST['id'] and $_REQUEST['id'] != '') {
        $product_id = $_GET['id'];

        $sql_img = "DELETE FROM `HinhSanPham` WHERE `HinhSanPham`.`MSSP` = '$product_id';";
        $rs_img = mysqli_query($conn, $sql_img);
        if ($rs_img) {
            $sql = "DELETE FROM `SanPham` WHERE `SanPham`.`MSSP` = '$product_id';";
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


?>
