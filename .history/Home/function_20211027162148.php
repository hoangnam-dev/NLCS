<?php

// Function SELECT DB form $key and $id
function selecttb(&$key,&$id){
    include("./connection.php");
    // Select Sản Phẩm là điện thoại
    if($key=='phone'){
        echo "oke"; exit;
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

?>