<?php

function selectAll($key){
    include("connection.php");
    
    $result = 0;
    if($key == "customer"){
        $sql = "SELECT MSKH FROM KhachHang";
        $rs = mysqli_query($conn, $sql);
    }
    return $rs;
}
$rs = selectAll('customer');
print_r($rs);
while($result = mysqli_fetch_object($rs)){
echo "<pre>";
print_r($result);
}
exit;
?>