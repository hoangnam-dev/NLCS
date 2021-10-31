<?php

function selectAll($key){
    include("./connection.php");
    
    $result = 0;
    if($key == "customer"){
        $sql = "SELECT * FROM KhachHang";
        $rs = mysqli_query($conn, $sql);
        $result = mysqli_fetch_array($rs);
    }

    return $result;
}
?>