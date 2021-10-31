<?php

// Function SELECT DB form $key and $id
function selecttb(&$key,&$id){
    include("./connection.php");
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
    return $data;
}
?>