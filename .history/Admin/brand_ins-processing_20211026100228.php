<?php
include("connection.php");

if(isset($_POST) && isset($_POST['ins-brand'])){
    $brand_name = $_POST['brand_name'];

    $sql = "INSERT INTO `ThuongHieu`(`MSTH`, `TenTH`)
    VALUES (NULL, '$brand_name'); ";
    $rs = mysqli_query($conn, $sql);
    if($rs == true){
        echo json_encode(array(
            'status' => 1,
            'message' => 'Thêm thương hiệu thành công'
        ));
        exit;
    }
    else{
        echo json_encode(array(
            'status' => 0,
            'message' => 'Thêm thương hiệu không thành công'
        ));
        exit;
    }
}
?>