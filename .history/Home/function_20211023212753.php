<?php

function selectAll($key){
    include("connection.php");
    
    $result = 0;
    if($key == "customer"){
        $sql = "SELECT id FROM KhachHang";
        $rs = mysqli_query($conn, $sql);
    }
    return $rs;
}
while($result = mysqli_fetch_assoc(selectAll('customer'))){
echo "<pre>";
print_r($result);
}
exit;
?>