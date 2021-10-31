<?php
include("./connection.php");
session_start();

if (isset($_GET['upd-category'])) {
    if (isset($_POST['category_id']) && isset($_POST['category_name']) && $_POST['category_name']!="") {
        $category_id = $_POST['category_id'];
        $category_name = $_POST['category_name'];

        $sql = "UPDATE `LoaiSanPham` SET `TenLSP` = '$category_name' WHERE `LoaiSanPham`.`MLSP` = '$category_id';";
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

?>