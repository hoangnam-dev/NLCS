<?php
include("./connection.php");
session_start();

if (isset($_GET['ins-category'])) {
    // echo"oke";exit;
    if (isset($_POST['submit'])) {
        $category_name = $_POST['category_name'];

        $sql = "INSERT INTO `LoaiSanPham`(`MLSP`, `TenLSP`) VALUES (NULL, '$category_name'); ";
        $rs = mysqli_query($conn, $sql);
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