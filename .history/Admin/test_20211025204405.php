<?php
include("./connection.php");
session_start();

if (isset($_GET['ins-prd'])) {
    if (isset($_POST['product_name']) && isset($_POST['product_price']) && isset($_POST['product_quantity']) && isset($_POST['product_category']) && isset($_POST['product_brand'])) {
        // $product_id = rand(0, 9999) . rand(0, 9999);
        $product_name = $_POST['product_name'];
        $product_description = $_POST['product_description'];
        $product_price = str_replace(array('.', ','), '', $_POST['product_price']);
        $product_quantity = $_POST['product_quantity'];
        $product_category = $_POST['product_category'];

        if (isset($_FILES['image_name']) && !empty($_FILES['image_name']['name'][0])) {
            $image_name = $_FILES['image_name'];
            $product_img = $_FILES['image_name']['name'];

            $result = upOneFile($image_name);
            if (!$result) {
                echo json_encode(array(
                    'status' => 0,
                    'message' => 'Thêm ảnh sản phẩm không thành công'
                ));
                exit;
            } else {
                $sql1 = "INSERT INTO `HangHoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MLSP`) VALUES ($product_id, '$product_name', '$product_description', '$product_price', '$product_quantity', '$product_category'); ";
                $rs1 = mysqli_query($conn, $sql1);


                if ($rs1) {
                    $last_id = mysqli_insert_id($conn);
                    $sql_img = "INSERT INTO `HinhHangHoa` (`MaHinh`, `TenHinh`, `MSHH`) VALUES (NULL, '$product_img', '$product_id'); ";

                    $rs_img = mysqli_query($conn, $sql_img);

                    if ($rs_img) {
                        header('Location: product_manage.php?success=Thêm sản phẩm thành công');
                        exit;
                    }
                } else {
                    header('Location: product_manage.php?err=Thêm không thành công');
                    exit();
                }
            }
        } else {
            header('Location: product_insert.php?err=no-img');
            exit();
        }
    }
} else {
    echo json_encode(array(
        'status' => 0,
        'message' => 'Tên loại sản phẩm không được trống'
    ));
    exit;
}

?>