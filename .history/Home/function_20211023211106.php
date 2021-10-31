<?php

function selectAll($key){
    include("connection.php");
    
    $sql = "SELECT * FROM KhachHang";
    $rs = mysqli_query($conn, $sql);
    $result = mysqli_fetch_array($rs);
    echo "<pre>";
    print_r($result);
    $result = 0;
    if($key == "customer"){

    }
    exit;
    return $result;
}
?>