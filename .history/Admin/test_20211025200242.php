<?php
include("./connection.php");
session_start();

if (isset($_GET['in-prd'])) {
    if (isset($_POST['submit'])) {
        $category_name = $_POST['category_name'];

        $sql = "INSERT INTO `LoaiSanPham`(`MLSP`, `TenLSP`)
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
?>