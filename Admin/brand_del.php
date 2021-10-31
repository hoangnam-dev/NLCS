<?php
include("connection.php");

if($_REQUEST['id'] and $_REQUEST['id']!=''){
    $brand_id = $_GET['id'];
    
    
    $find_prd = "SELECT * FROM `SanPham` WHERE `SanPham`.`MaNH` = '$brand_id';";
    $rs_find = mysqli_query($conn, $find_prd);
    if(mysqli_num_rows($rs)>0){
        while($product = mysqli_fetch_array($rs_find)){
            $product_id = $product['MSHH'];
            $sql = "DELETE FROM `SanPham` WHERE `SanPham`.`MaSP` = '$product_id';";
            $rs = mysqli_query($conn, $sql);       
        }
        if($rs == true){
            $sql1 = "DELETE FROM `NhanHieu` WHERE `NhanHieu`.`MaNH` = '$brand_id';";
            $rs1 = mysqli_query($conn, $sql1);       
            if($rs1 == true){
                header('Location: brand.php?success=Xóa thành công');
            }else{
                header('Location: brand.php?err=Xóa '.$brand_id.' không thành công');
            exit();
            }
        }
        else{
            header('Location: brand.php?err=Xóa nhãn hiệu có MaNH '.$brand_id.' không thành công');
            exit();
        }       
    }
    else{
        $sql = "DELETE FROM `NhanHieu` WHERE `NhanHieu`.`MaNH` = '$brand_id';";
        $rs = mysqli_query($conn, $sql);       
        if($rs == true){
            header('Location: brand.php?success=Xóa thành công');
        }else{
            header('Location: brand.php?err=Xóa '.$brand_id.' không thành công');
        exit();
        }
    }
}
?>
