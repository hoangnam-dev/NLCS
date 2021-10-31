<?php
include("connection.php");
include("function.php");
session_start();
$product_id = $_GET['id'];
$sql_key = "SELECT * FROM SanPham INNER JOIN LoaiSanPham ON LoaiSanPham.MLSP = SanPham.MLSP WHERE SanPham.MSSP = $product_id";
$rs_key = mysqli_query($conn, $sql_key);
$dt = mysqli_fetch_assoc($rs_key);
if($dt['TenLSP']=='Điện thoại'){
    $key = 'phone';
}
$product = selecttb($key,$product_id);
// echo $product['KichThuoc']; exit;

$sql_img = "SELECT * FROM HinhSanPham WHERE HinhSanPham.MSSP = '$product_id';";
$rs_img = mysqli_query($conn, $sql_img);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Main</title>
    <link rel="stylesheet" type="text/css" href="./asset/base.css">
    <link rel="stylesheet" type="text/css" href="./asset/main1.css">
    <link rel="stylesheet" href="./asset/fonts/fontawesome-free-5.15.4/css/all.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="./asset/bootstrap/css/bootstrap.min.css"> -->
</head>

<body>
    <div class="main">
        <div class="grid_full-width wrapper">
            <?php
            include("sidebar.php");
            ?>
            <div class="container">
                <div class="container-title">
                    <h2>Chi tiết sản phẩm</h2>
                </div>

                <div class="main_insert-content">
                    <!-- <form id="from-upd-prd" class="product_insert-form" method="POST" enctype="multipart/form-data" role="form"> -->
                    <form action="process.php?upd-prd" class="product_insert-form" method="POST" enctype="multipart/form-data" role="form">
                    <div class="content-title">
                        <h2>Thông tin sản phẩm</h2>
                    </div>
                        <div class="main_form">
                                <div class="main-form_left">
                                    <div class="form-input">
                                        <label class="form_label" for="fname">Mã sản phẩm:</label>
                                        <input type="text" class="form_input disable-input" id="fname" name="product_id" readonly value="<?php echo $product['MSSP'] ?>">
                                    </div>
                                    <div class="form-input">
                                        <label class="form_label" for="fname">Tên sản phẩm:</label>
                                        <input type="text" class="form_input" id="fname" name="product_name" value="<?php echo $product['TenSP'] ?>">
                                    </div>
                                    <div class="form-input">
                                        <label class="form_label" for="fname">Giá</label>
                                        <input type="text" class="form_input" id="fname" name="product_price" value="<?php echo number_format($product['Gia'], 0, ',', '.') ?>">
                                    </div>
                                    <div class="form-input">
                                        <label class="form_label" for="fname">Giá bán</label>
                                        <input type="text" class="form_input" id="fname" name="product_sale" value="<?php echo number_format($product['GiaBan'], 0, ',', '.') ?>">
                                    </div>
                                    <div class="form-input">
                                        <label class="form_label" for="fname">Số lượng hàng</label>
                                        <input type="text" class="form_input" name="product_quantity" value="<?php echo $product['SoLuongHang'] ?>">
                                    </div>
                                    <div class="form-input">
                                        <label class="form_label" for="fname">Mô tả</label>
                                        <textarea type="text" class="form_input" id="fname" name="product_description"><?php echo $product['MoTa'] ?></textarea>
                                    </div>
                                </div>
                                <div class="main-form_right">
                                    <div class="form-input">
                                        <label class="form_label" for="fname">Ảnh đại diện sản phẩm:</label>
                                        <div class="prd-avatar">
                                            <img class="prd_img" src="../img_upload/<?php echo $product['Avatar']?>" alt="<?php echo $product['Avatar']?>">
                                        </div>
                                    </div>
                                    <div class="form-input">
                                        <label class="form_label" for="fname">Thêm ảnh sản phẩm:</label>
                                        <input id="image" type="file" onchange="return getImg();" class="form_input" name="image_name">
                                        <input id="input-img" type="hidden" class="form_input" name="product_image" value="<?php echo $product['Avatar']?>">
                                    </div>
                                    <div class="form-input">
                                        <label class="form_label" for="fname">Xuất xứ</label>
                                        <input type="text" class="form_input" name="product_quantity" value="<?php echo $product['XuatXu'] ?>">
                                    </div>
                                    <div class="form-input">
                                        <label class="form_label" for="fname">Ngày ra mắt</label>
                                        <input type="text" class="form_input" name="product_quantity" value="<?php echo $product['NgayRaMat'] ?>">
                                    </div>
                                    <div class="form-input">
                                        <label class="form_label" for="fname">Loại sản phẩm</label>
                                        <select class="form_input" name="product_category" id="category">
                                            <?php
                                            $prd_cate = $product['MLSP'];
                                            $sql_cate = "SELECT * FROM LoaiSanPham WHERE LoaiSanPham.MLSP = '$prd_cate'";
                                            $rs_cate = mysqli_query($conn, $sql_cate);
                                            while ($categry_prd = mysqli_fetch_array($rs_cate)) { ?>
                                                <option value="<?php echo $categry_prd['MLSP'] ?>"><?php echo $categry_prd['TenLSP'] ?></option>
                                            <?php }; ?>
                                            <?php
                                            $sql1 = "SELECT * FROM LoaiSanPham WHERE NOT LoaiSanPham.MLSP =  '$prd_cate';";
                                            $rs1 = mysqli_query($conn, $sql1);
                                            while ($categry_prd = mysqli_fetch_array($rs1)) { ?>
                                                <option value="<?php echo $categry_prd['MLSP'] ?>"><?php echo $categry_prd['TenLSP'] ?></option>
                                            <?php }; ?>
                                        </select>
                                    </div>
                                    <div class="form-input">
                                        <label class="form_label" for="fname">Thương hiệu</label>
                                        <select class="form_input" name="product_category" id="category">
                                            <?php
                                            $prd_cate = $product['MSTH'];
                                            $sql_cate = "SELECT * FROM ThuongHieu WHERE ThuongHieu.MSTH = '$prd_cate'";
                                            $rs_cate = mysqli_query($conn, $sql_cate);
                                            while ($categry_prd = mysqli_fetch_array($rs_cate)) { ?>
                                                <option value="<?php echo $categry_prd['MSTH'] ?>"><?php echo $categry_prd['TenTH'] ?></option>
                                            <?php }; ?>
                                            <?php
                                            $sql1 = "SELECT * FROM ThuongHieu WHERE NOT ThuongHieu.MSTH =  '$prd_cate';";
                                            $rs1 = mysqli_query($conn, $sql1);
                                            while ($categry_prd = mysqli_fetch_array($rs1)) { ?>
                                                <option value="<?php echo $categry_prd['MSTH'] ?>"><?php echo $categry_prd['TenTH'] ?></option>
                                            <?php }; ?>
                                        </select>
                                    </div>
                                </div>
                        </div>
                        <div class="content-title">
                            <h2>Thông số kỹ thuật</h2>
                        </div>
                        <div class="main_form">
                            <div class="main-form_left">
                                <div class="form-input">
                                    <label class="form_label">Màn hình:</label>
                                    <input type="text" class="form_input" value='<?php echo $product['KichThuoc'];?>' name="screen">
                                </div>
                                <div class="form-input">
                                    <label class="form_label">Camera sau:</label>
                                    <input type="text" class="form_input" value="<?php echo $product['CameraSau']?>" name="camera">
                                </div>
                                <div class="form-input">
                                    <label class="form_label">Camera trước:</label>
                                    <input type="text" class="form_input" value="<?php echo $product['CameraTruoc']?>" name="camera_selfie">
                                </div>
                                <div class="form-input">
                                    <label class="form_label">Ram:</label>
                                    <input type="text" class="form_input" value="<?php echo $product['DungLuongRam']?>" name="ram">
                                </div>
                                <div class="form-input">
                                    <label class="form_label">Bộ nhớ trong:</label>
                                    <input type="text" class="form_input" value="<?php echo $product['DungLuongRom']?>" name="rom">
                                </div>
                                
                            </div>
                            <div class="main-form_right">
                                <div class="form-input">
                                    <label class="form_label">CPU</label>
                                    <input type="text" class="form_input" value="<?php echo $product['TenCPU']?>" name="cpu">
                                </div>
                                <div class="form-input">
                                    <label class="form_label">GPU</label>
                                    <input type="text" class="form_input" value="<?php echo $product['TenGPU']?>" name="gpu">
                                </div>
                                <div class="form-input">
                                    <label class="form_label">Dung lượng Pin:</label>
                                    <input type="text" class="form_input" value="<?php echo $product['DungLuongPin']?>" name="battery">
                                </div>
                                <div class="form-input">
                                    <label class="form_label">Thẻ SIM:</label>
                                    <input type="text" class="form_input" value="<?php echo $product['TheSim']?>" name="sim">
                                </div>
                                <div class="form-input">
                                    <label class="form_label">Hệ điều hành</label>
                                    <input type="text" class="form_input" value="<?php echo $product['TenHDH']?>" name="os">
                                </div>
                            </div>
                        </div>
                        <div class="main-table">
                            <table class="main-table_content detail-table">
                                <thead>
                                    <tr>
                                        <th>Tùy chọn</th>
                                        <th>STT</th>
                                        <th>Tên hình</th>
                                        <th>Hình ảnh</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $n = 1;
                                    while ($prd_img = mysqli_fetch_array($rs_img)) { ?>
                                        <tr>
                                            <td>
                                            <a href="./process.php?action=delete-prd-img&prd-id=<?php echo $product_id?>&id=<?php echo $prd_img['MaHinh']; ?>" class="button-edit btn-delete">Xóa</a>
                                            </td>
                                            <td><?php echo $n; ?></td>
                                            <td><?php echo $prd_img['TenHinh'] ?></td>
                                            <td class="prd_td-img">
                                                <div class="prd-img">
                                                    <img class="prd_img" src="../img_upload/<?php echo $prd_img['TenHinh'] ?>" alt="">
                                                </div>
                                            </td>
                                        </tr>
                                    <?php $n++;} ?>
                                </tbody>
                            </table>
                        </div>
                        <input type="submit" class="button form-success_btn" name="submit" value="Cập nhật">
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- <script type="text/javascript" src="./asset/bootstrap/js/bootstrap.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- <script>
        // Lấy tên ảnh của input[type=file]
        function getImg() {
            var name = $("#image").prop('files')[0];
            // console.log(name['name']);
            // Gán tên lấy được vào input[type=hidden]
            document.getElementById('input-img').value = name['name'];
            return true;
        }
        // Ajax
        // Upload Product Image + Product
        $("#from-upd-prd").submit(function(event) {
            event.preventDefault();
            var file_data = $("#image").prop('files')[0];
            // // Khởi tạo form data
            var img_data = new FormData();
            // Thêm file_data vào img_data
            img_data.append('file', file_data);
            $.ajax({
                type: "POST",
                url: "./test.php?upd-prd-img",
                data: img_data, // Gửi dữ liệu của ảnh trong img_data
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    response = JSON.parse(response);
                    if (response.status == "0") {
                        alert(response.message);
                        console.log(response.message);
                    } else {
                        // alert(response.message);
                        console.log(response.message);
                        $.ajax({
                        type: "POST",
                        url: './test.php?ins-prd',
                        data: $("#from-upd-prd").serializeArray(), // Gửi dữ liệu của form
                        success: function(response) {
                            response = JSON.parse(response);
                            if (response.status == "0") {
                                alert(response.message);
                                console.log(response.message);
                            } else {
                                alert(response.message);
                                console.log(response.message);

                            }
                        }
                    });
                    }
                }
            });
        });
        // $("#from-upd-prd").submit(function(event) {
        //     event.preventDefault();
        //     $.ajax({
        //         type: "POST",
        //         url: './test.php?upd-prd',
        //         data: $("#from-upd-prd").serializeArray(), // Gửi dữ liệu của form
        //         success: function(response) {
        //             response = JSON.parse(response);
        //             if (response.status == "0") {
        //                 alert(response.message);
        //                 console.log(response.message);
        //             } else {
        //                 alert(response.message);
        //                 console.log(response.message);
        //             }
        //         }
        //     });
        // });
    </script> -->
</body>

</html>