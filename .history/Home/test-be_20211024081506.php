<?php
include("./connection.php");
session_start();

if (isset($_GET['order-prd'])) {
    if (isset($_POST['prd_quantity']) && isset($_GET['id'])) {
        $prd_quantity = $_POST['prd_quantity'];
        $prd_id = $_GET['id'];
        $err = false;
        echo $prd_id;
        echo $prd_quantity;
        echo json_encode(array(
            'status' => 0,
            'message' => 'OKE'
        ));
        exit;
    }
}
/*===================================*/
