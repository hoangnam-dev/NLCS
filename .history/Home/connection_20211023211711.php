<?php
$server= "localhost";
$username = "root";
$password = "";
$database = "QuanlyWebBDT";
$conn = mysqli_connect($server, $username, $password, $database);
 
if (!$conn) {
    die('Connect Error (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
}

?>
