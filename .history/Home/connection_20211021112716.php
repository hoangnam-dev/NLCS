<?php
$server= "localhost";
$username = "root";
$password = "";
$database = "QuanlyWebBDT";
$conn = new mysqli("$server", "$username", "$password", "$database");
mysqli_set_charset($conn,"utf8");

if ($conn->connect_errno) {
    printf("Connection failed: %s\n", $conn->connect_error);
    exit();
}

/* Kiểm tra server có tồn tại*/
if ($conn->ping()) {
    // printf ("Kết nối thành công!\n");
} else {
    printf ("Error: %s\n", $conn->error);
}
session_start();
?>
