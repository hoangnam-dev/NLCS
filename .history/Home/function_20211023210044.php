<?php
include("./connection.php");

function selectAll($key){
    
    if($key == "customer"){
        $sql = "SELECT * FROM KhachHang";
        $rs = mysqli_query($conn, $sql);
        $result = mysqli_fetch_array($rs);
    }
}
?>