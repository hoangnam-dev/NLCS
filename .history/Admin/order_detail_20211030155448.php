<?php
include("connection.php");
session_start();
$order_id = (isset($_GET['id'])) ? $_GET['id'] : [];
$status = (isset($_GET['status'])) ? $_GET['status'] : [];

$err = (isset($_GET['err'])) ? $_GET['err'] : [];

// if (!empty($err)) {
//     if ($err == 'date') {
//         $err_message = "Ngày giao hàng phải lớn ngày đặt hàng.";
//         echo "<script>alert('" . $err_message . "')</script>";
//     } else {
//         if ($err != 'date') {
//             $err_message = "Có lỗi xảy ra. Hãy kiểm tra lại.";
//             echo "<script>alert('" . $err_message . "')</script>";
//         }
//     }
// }

$sql = "SELECT * FROM `dathang` INNER JOIN KhachHang ON KhachHang.MSKH = dathang.MSKH WHERE dathang.SoDonDH= $order_id AND DatHang.TrangThaiDH LIKE '$status';";
$rs = mysqli_query($conn, $sql);

$sql2 = "SELECT * FROM `dathang` INNER JOIN chitietdathang ON chitietdathang.SoDonDH = dathang.SoDonDH WHERE dathang.SoDonDH= $order_id;";
$rs2 = mysqli_query($conn, $sql2);

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
                    <h2>Xử lý đơn đặt hàng</h2>
                </div>

                <div class="product_insert-content">
                    <form id="form-order-detail" class="product_insert-form" method="POST" enctype="multipart/form-data" role="form">
                        <div class="order-title">
                            <span class="order_title">
                                <!-- Nếu Trạng thái ĐH = 0 => Chờ xử lý -->
                                <!-- Nếu Trạng thái ĐH = 1 => Đã xử lý -->
                                <!-- Nếu Trạng thái ĐH = completed => Hoàn thành -->
                                <?php if ($status == 0) {
                                    echo "Đơn hàng chờ xử lý:";
                                } else {
                                    if ($status == 1) {
                                        echo "Đơn hàng đã xử lý:";
                                    } else {
                                        echo "Đơn hàng chờ thanh toán:";
                                    }
                                } ?>
                            </span>
                        </div>
                        <div class="order-form">
                            <?php while ($order = mysqli_fetch_array($rs)) { ?>
                                <div class="main_form">
                                    <div class="main-form_left">
                                        <div class="form-input">
                                            <label class="form_label" for="fname">Số đơn ĐH:</label>
                                            <input type="text" class="form_input input_readonly disable-input" id="fname" name="order_id" readonly value="<?php echo $order['SoDonDH'] ?>">
                                        </div>
                                        <div class="form-input">
                                            <label class="form_label" for="fname">Họ tên khách hàng:</label>
                                            <input type="text" class="form_input input_readonly" id="fname" name="order_customer" readonly value="<?php echo $order['HoTenKH'] ?>">
                                        </div>
                                        <div class="form-input">
                                            <label class="form_label" for="fname">Địa chỉ giao hàng</label>
                                            <input type="text" class="form_input input_readonly" id="fname" name="order_address" readonly value="<?php echo $order['DiaChiGH'] ?>">
                                        </div>
                                    </div>
                                    <div class="main-form_right">
                                        <!-- Hiển thị tên nhân viên đã xủ lý đơn hàng -->
                                        <?php if ($order['TrangThaiDH'] != '0') {
                                            $staff_id = $order['MSNV'];
                                            $find_staff = "SELECT * FROM NhanVien WHERE NhanVien.MSNV = '$staff_id'";
                                            $rs_staff = mysqli_query($conn, $find_staff);
                                            $staff = mysqli_fetch_assoc($rs_staff);
                                        ?>
                                            <div class="form-input">
                                                <label class="form_label" for="fname">Nhân viên xử lý</label>
                                                <input type="text" class="form_input input_readonly" id="fname" name="order_date" readonly value="<?php echo $staff['HoTenNV'] ?>">
                                            </div>
                                        <?php } ?>
                                        <div class="form-input">
                                            <label class="form_label" for="fname">Ngày đặt hàng</label>
                                            <input type="text" class="form_input input_readonly" id="fname" name="order_date" readonly value="<?php echo date_format(date_create($order['NgayDH']), 'd-m-Y') ?>">
                                        </div>
                                        <div class="form-input">
                                            <label class="form_label" for="fname">Ngày giao hàng</label>
                                            <!-- Nếu ĐH có trạng thái = 0 thì intput[type=date] ngược lại input[type=text]-->
                                            <input <?php if ($order['TrangThaiDH'] != '0') {
                                                        echo 'type="text" readonly';
                                                    } else {
                                                        echo 'type="date"';
                                                    } ?> 
                                            class="form_input input_readonly" id="delivery_ord" name="order_delivery"
                                            <?php $delivery =  date_format(date_create($order['NgayGH']), 'd-m-Y');
                                                echo 'value="'.$delivery.'"';
                                             ?>
                                            >
                                            <span id="error-order_delivery" class="error-message"></span>
                                        </div>
                                        <div class="form-input">
                                            <label class="form_label" for="fname">Ghi chú của khách hàng:</label>
                                            <textarea type="text" class="form_input input_readonly" id="fname" readonly name="product_description"><?php echo $order['GhiChu'] ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="main-table order-tb">
                                    <table class="main-table_content">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Tên sản phẩm</th>
                                                <th>Ảnh sản phẩm</th>
                                                <th>Giá bán (VNĐ)</th>
                                                <th>Số lượng mua</th>
                                                <th>Giảm giá</th>
                                                <th>Loại sản phẩm</th>
                                                <th>Thương hiệu</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            $total = 0;
                                            while ($order_prd = mysqli_fetch_array($rs2)) {
                                                // Thành tiền của một hàng hóa
                                                $checkout = ($order_prd['SoLuong'] * $order_prd['GiaDatHang']) - $order_prd['GiamGia'];
                                                // Hiển thị sản phẩm
                                                $product = $order_prd['MSSP'];
                                                $sql_prd = "SELECT * FROM SanPham WHERE SanPham.MSSP = '$product'";
                                                $rs_prd = mysqli_query($conn, $sql_prd);
                                                while ($product = mysqli_fetch_array($rs_prd)) {
                                            ?>
                                                    <tr>

                                                        <!-- STT -->
                                                        <td><?php echo $i; ?></td>

                                                        <!-- Tên SP -->
                                                        <td><?php echo $product['TenSP'] ?></td>

                                                        <!-- Ảnh SP -->
                                                        <td><img class="form-img" src="../img_upload/<?php echo $product['Avatar']; ?>" alt="<?php echo $product['Avatar']; ?>">
                                                        </td>

                                                        <!-- Giá đặt hàng -->
                                                        <td><?php echo number_format($order_prd['GiaDatHang'], 0, ',', '.') ?></td>

                                                        <!-- Số lương mua -->
                                                        <td><?php echo $order_prd['SoLuong'] ?></td>

                                                        <!-- Giảm giá -->
                                                        <!-- Nêu ĐH chưa đươc xử lý thì có thể thay đổi -->
                                                        <td>
                                                            <input type="text" name="saleoff<?php echo $order_prd['MSSP']; ?>" value="<?php echo number_format($order_prd['GiamGia'], 0, ',', '.'); ?>"
                                                            <?php if ($status != 0) {
                                                                echo 'class="tb_input input_readonly" readonly';} 
                                                            else {echo 'class="tb_input"';}?> 
                                                            >
                                                        </td>

                                                        <!-- Loại SP -->
                                                        <?php
                                                        $prd_cate = $product['MLSP'];
                                                        $sql_cate = "SELECT * FROM LoaiSanPham WHERE LoaiSanPham.MLSP = '$prd_cate'";
                                                        $rs_cate = mysqli_query($conn, $sql_cate);
                                                        while ($category_prd = mysqli_fetch_array($rs_cate)) { ?>
                                                            <td><?php echo $category_prd['TenLSP'] ?></td>
                                                        <?php }; ?>

                                                        <!-- Thương hiệu -->
                                                        <?php
                                                        $prd_cate = $product['MSTH'];
                                                        $sql_cate = "SELECT * FROM ThuongHieu WHERE ThuongHieu.MSTH = '$prd_cate'";
                                                        $rs_cate = mysqli_query($conn, $sql_cate);
                                                        while ($category_prd = mysqli_fetch_array($rs_cate)) { ?>
                                                            <td><?php echo $category_prd['TenTH'] ?></td>
                                                        <?php }; ?>
                                                    </tr>
                                                <?php
                                                    // Tổng tiền phải thanh toán
                                                    $total += $checkout;
                                                    $i++;
                                                }
                                                ?>
                                            <?php } ?>
                                            <td class="total" colspan="4">Tổng tiền:</td>

                                            <!-- Tổng tiền -->
                                            <td class="total-value" colspan="5"><?php echo number_format($total, 0, ',', '.'); ?>&nbsp;VNĐ</td>
                                        </tbody>
                                    </table>
                                </div>
                            <?php } ?>
                        </div>
                        <!-- Cho phép hủy đơn hàng khi chưa xác nhân ĐH -->
                        <?php if ($status == "0") { ?>
                            <div class="order_detail-control">
                                <input id="confirm-order" class="button form-success_btn order-btn" onclick="return validateOrderDelivery();">Xác nhận đơn hàng</input>
                                <button id="del-order" value="<?php echo $order_id; ?>" class="button button-dangerous order_btn-del">Hủy đơn hàng</button>
                            </div>
                            <?php } else {
                            if ($status == "1") { ?>
                                <button id="complete-order" class="button form-success_btn order-btn">Hoàn thành đơn hàng</button>
                        <?php }
                        } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- =============== SCRIPT =============== -->
    <script src="./asset/jquery/jquery.js"></script>
    <!-- <script src="./asset/jquery/main.js"></script> -->
    <script>
        function showErr(key, message) {
            document.getElementById("error-" + key).innerHTML = message;
        }
        function validateOrderDelivery() {
            var day = $("#delivery_ord").val();
            var flag = true;

            if (day != "") {
                    flag = false;
                    showErr("order_delivery", "");
            } else {
                flag = false;
                message = "Vui lòng chọn ngày giao hàng";
                showErr("order_delivery", message);
            }
            return flag;
        }
        // Ajax
        // Confirm Order
        $("#form-order-detail").submit(function(event) {
            var id = $(this).val();
            var notify = "Bạn có chắc xác nhận ĐH";
            if(confirm(notify)){
                event.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "./process.php?order-comfirm",
                    data: $(this).serializeArray(),
                    success: function(response) {
                        response = JSON.parse(response);
                        if (response.status == "0") {
                            alert(response.message);
                            console.log(response.message);
                        } else {
                            alert(response.message);
                            location.assign("./order.php?status=<?php echo $status;?>");
                        }
                    }
                });
            }
        });

        // Complete Order
        $("#form-order-detail").submit(function(event) {
            var id = $(this).val();
            var notify = "Bạn có chắc xác nhận ĐH";
            if(confirm(notify)){
                event.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "./process.php?order-complete",
                    data: $(this).serializeArray(),
                    success: function(response) {
                        response = JSON.parse(response);
                        if (response.status == "0") {
                            alert(response.message);
                            console.log(response.message);
                        } else {
                            alert(response.message);
                            location.assign("./order.php?status=<?php echo $status;?>");
                        }
                    }
                });
            }
        });
        // Delete Order
        $("#del-order").click(function(event) {
            var id = $(this).val();
            var notify = "Bạn có chắc muốn Hủy ĐH";
            if(confirm(notify)){
                event.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "./process.php?del-order",
                    data: {id:id},
                    success: function(response) {
                        response = JSON.parse(response);
                        if (response.status == "0") {
                            alert(response.message);
                            console.log(response.message);
                        } else {
                            alert(response.message);
                            location.assign("./order.php?status=<?php echo $status;?>");
                        }
                    }
                });
            }
        });
    </script>
</body>

</html>