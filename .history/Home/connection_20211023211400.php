<?php
$server= "localhost";
$username = "root";
$password = "";
$database = "QuanlyWebBDT";
$conn = mysqli_connect("$server", "$username", "$password", "$database");

if ($conn->connect_errno) {
    printf("Connection failed: %s\n", $conn->connect_error);
    exit();
}

?>
