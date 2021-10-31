<?php
include("connection.php");

if(isset($_POST) && isset($_POST['ins-brand'])){
    $brand_name = $_POST['brand_name'];

    $sql = "INSERT INTO `NhanHieu`(`MaNH`, `TenNH`)
    VALUES (NULL, '$brand_name'); ";
    $rs = mysqli_query($conn, $sql);
    if($rs == true){
        header("Location: brand.php?success=Thêm loại hàng thành công");
    }
    else{
        header("Location: brand_insert.php?err=Thêm loại hàng không thành công");
        exit();
    }
}
?>