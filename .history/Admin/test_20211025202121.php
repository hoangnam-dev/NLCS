<?php
include("./connection.php");
session_start();

if (isset($_GET['ins-category'])) {
    if (isset($_POST['category_name'])) {
        $category_id = $_POST['category_id'];
        $category_name = $_POST['category_name'];

        $sql = "UPDATE `LoaiSanPham` SET `TenLSp` = '$category_name' WHERE `LoaiSanPham`.`MLSP` = '$category_id';";
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
    }
}

?>