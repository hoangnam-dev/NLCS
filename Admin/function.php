<?php

// Function SELECT DB form $key and $id
function selecttb(&$key,&$id){
    include("./connection.php");
    // Select Sản Phẩm là điện thoại
    if($key=='phone'){
        $sql="SELECT * FROM SanPham 
            INNER JOIN ManHinh ON ManHinh.MSSP = SanPham.MSSP 
            INNER JOIN Camera ON Camera.MSSP = SanPham.MSSP 
            INNER JOIN Ram ON Ram.MSSP = SanPham.MSSP 
            INNER JOIN BoNho ON BoNho.MSSP = SanPham.MSSP 
            INNER JOIN CPU ON CPU.MSSP = SanPham.MSSP 
            INNER JOIN GPU ON GPU.MSSP = SanPham.MSSP 
            INNER JOIN Pin ON Pin.MSSP = SanPham.MSSP 
            INNER JOIN Sim ON Sim.MSSP = SanPham.MSSP 
            INNER JOIN HeDieuHanh ON HeDieuHanh.MSSP = SanPham.MSSP 
            WHERE SanPham.MSSP = '$id';";
        $rs = mysqli_query($conn, $sql);
        $data = mysqli_fetch_assoc($rs);
    }

    // Select Loại Sản Phẩm
    if($key=='category'){
        $sql="SELECT * FROM LoaiSanPham WHERE LoaiSanPham.MLSP = '$id';";
        $rs = mysqli_query($conn, $sql);
        $data = mysqli_fetch_assoc($rs);
    }

    // Select Thương Hiệu Sản Phẩm
    if($key=='brand'){
        $sql="SELECT * FROM ThuongHieu WHERE ThuongHieu.MSTH = '$id';";
        $rs = mysqli_query($conn, $sql);
        $data = mysqli_fetch_assoc($rs);
    }

    // Select Khách Hàng
    if($key=='customer'){
        $sql="SELECT * FROM KhachHang WHERE KhachHang.MSKH = '$id';";
        $rs = mysqli_query($conn, $sql);
        $data = mysqli_fetch_assoc($rs);
    }

    // Select Nhân Viên
    if($key=='staff'){
        $sql="SELECT * FROM NhanVien WHERE NhanVien.MSNV = '$id';";
        $rs = mysqli_query($conn, $sql);
        $data = mysqli_fetch_assoc($rs);
    }

    // Select Đơn Hàng
    if($key=='order'){
        $sql="SELECT * FROM DatHang WHERE DatHang.SoDonDH = '$id';";
        $rs = mysqli_query($conn, $sql);
        $data = mysqli_fetch_assoc($rs);
    }

    // Select Chi Tiết Đơn Hàng
    if($key=='order-detail'){
        $sql="SELECT * FROM ChiTietDatHang WHERE ChiTietDatHang.SoDonDH = '$id';";
        $rs = mysqli_query($conn, $sql);
        $data = mysqli_fetch_assoc($rs);
    }


    return $data;
}

// Upload một file
function upOneFile($uploadfile){
    $filePath = "../img_upload";
    $errors = true;
    if(!is_dir($filePath)){
        mkdir($filePath, 0777, true);
    }
    $file = validateUploadFiles($uploadfile, $filePath);
    if($file != false){
        move_uploaded_file($file['tmp_name'], $filePath.'/'.$file['name']);
        $errors = true;
    }
    else{
        // $errors[] = "The file ".basename($file['name'])." isn't valid.";
        $errors = false;
    }
    return $errors;
}

// Kiểm tra tính hợp lệ của file

function validateUploadFiles($file, $filePath){
    // Kiểm tra có phải là file ảnh không
    $validTypes = array("jpg", "png", "git", "jpeg", "bmp");
    $fileType = substr($file['name'], strrpos($file['name'], '.') + 1 );
    if(!in_array($fileType, $validTypes)){
        return false;
    }

    // Kiểm tra file đã tồn tại chưa, nếu có thì đổi tên
    $num = 1;
    $fileName = substr($file['name'], 0, strrpos($file['name'], '.'));
    while(file_exists($filePath.'/'.$fileName.'.'.$fileType)){
        $fileName = $fileName.'('.$num.')';
        $num++;
    }
    $file['name'] = $fileName . '.' . $fileType;
    return $file;
}

// Kiểm tra tính hợp lệ của file
function uploadFiles($uploadfiles){
    $files = array();
    $errors = array();
    //Xử lý dữ liêu 
    foreach($uploadfiles as $key => $values){
        foreach ($values as $index => $value) {
            $files[$index][$key] = $value;
        }

    }
    //Kiểm tra thư mục lưu trữ file uplaod đã tồn tại chưa
    $filePath = "../img_upload/";
    if(!is_dir($filePath)){
        mkdir($filePath, 0777, true);
    }
    foreach ($files as $file) {
        $file = validateUploadFiles($file, $filePath);
        if($file != false){
            move_uploaded_file($file['tmp_name'], $filePath.'/'.$file['name']);
        }
        else{
            // $errors[] = "The file ".basename($file['name'])." isn't valid.";
            $errors[] = $file['name'];
        }
    }
    return $errors;
}

?>