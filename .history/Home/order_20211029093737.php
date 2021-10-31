<?php

use function PHPSTORM_META\type;

include("./connection.php");
session_start();
$user = (isset($_SESSION['user'])) ? $_SESSION['user'] : [];
if (empty($user)) {
    header("location: ./index.php");
    exit;
} else {
    $customer_id = $user['MSKH'];
}
$sql = "SELECT * FROM dathang WHERE dathang.TrangThaiDH = '0' AND dathang.MSKH = '$customer_id'";
$rs = mysqli_query($conn, $sql);
$sql1 = "SELECT * FROM dathang WHERE dathang.TrangThaiDH = '1' AND dathang.MSKH = '$customer_id'";
$rs1 = mysqli_query($conn, $sql1);
$sql2 = "SELECT * FROM dathang WHERE dathang.TrangThaiDH Like 'completed' AND dathang.MSKH = '$customer_id'";
$rs2 = mysqli_query($conn, $sql2);
// $order = mysqli_num_rows($rs);
// echo"<pre>";
// print_r($customer_id);
// exit;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Index Demo</title>
    <!--Reset CSS -->
    <link rel="stylesheet" href="./asset/normalize.css" />
    <!-- CSS and font of Web -->
    <link rel="stylesheet" href="./asset/base.css" />
    <link rel="stylesheet" href="./asset/main.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="./asset/fonts/fontawesome-free-5.15.4/css/all.min.css">

</head>

<body>
    <div class="main">
        <?php include("./header.php"); ?>
        <div class="main_container">
            <div class="grid">
                <div class="grid_row main_content order_content">
                    <div class="grid_col-12 ctn-mb">
                        <div class="order-top">
                            <span>Đơn hàng của bạn</span>
                        </div>
                        <div class="tab">
                            <button class="tablinks active" data-electronic="waiting">Chờ xử lý</button>
                            <button class="tablinks" data-electronic="processed">Đã xử lý</button>
                            <button class="tablinks" data-electronic="completed">Hoàn thành</button>
                        </div>
                        <div id="waiting" class="tabcontent active">
                            <h3 class="tabcontent-header">Đơn hàng chờ xử lý</h3>
                            <?php
                            if (mysqli_num_rows($rs) > 0) {
                                while ($order = mysqli_fetch_array($rs)) {
                                    $order_id = $order['SoDonDH'];
                                    $sql_detail = "SELECT * FROM chitietdathang WHERE chitietdathang.SoDonDH = '$order_id';";
                                    $rs_detail = mysqli_query($conn, $sql_detail);
                                    $odrday = date_create_from_format('d-M-Y', $odrday);exit;
                            ?>
                                    <div class="order-content">
                                        <div class="order_content-title">
                                            <span class="order-content_title">Ngày đặt hàng: <span class="order-date"><?php echo $odrday?></span></span>
                                            <button type="submit" onclick='window.open("./process.php?order=cancel&id=<?php echo $order_id ?>","_self")' class="button button-dangerous">Hủy đặt hàng</button>
                                        </div>
                                        <table class="order_body">
                                            <tr>
                                                <th class="order-th">Tên sản phẩm</th>
                                                <th class="order-th">Ảnh sản phẩm</th>
                                                <th class="order-th">Số lượng mua</th>
                                                <th class="order-th">Thành tiền</th>
                                                <th class="order-th">Ghi chú</th>
                                            </tr>
                                            <?php
                                            $total = 0;
                                            while ($detail = mysqli_fetch_array($rs_detail)) {
                                                $price = $detail['SoLuong'] * $detail['GiaDatHang'];
                                                $detail_id = $detail['MSSP'];
                                                $sql_prd = "SELECT * FROM SanPham WHERE SanPham.MSSP = '$detail_id';";
                                                $rs_prd = mysqli_query($conn, $sql_prd);
                                                while ($prd = mysqli_fetch_array($rs_prd)) {
                                            ?>
                                                    <tr>
                                                        <td class="order-td">
                                                            <span class="order-item_text">
                                                                <?php echo $prd['TenSP'] ?>
                                                            </span>
                                                        </td>
                                                        <td class="order-td">
                                                            <a href="#" class="cart-item_img">
                                                                <img class="cart_img" src="../img_upload/<?php echo $prd['Avatar']; ?>">
                                                            </a>
                                                        </td>
                                                        <td class="order-td">
                                                            <span class="order-item_text"><?php echo $detail["SoLuong"]; ?></span>
                                                        </td>
                                                        <td class="order-td">
                                                            <span class="order-item_text"><?php echo number_format($price, 0, ',', '.'); ?> VNĐ</span>
                                                        </td>
                                                        <td class="order-td">
                                                            <span class="order-item_text"><?php echo $order["GhiChu"]; ?></span>
                                                        </td>
                                                    </tr>
                                            <?php
                                                    $total += $price;
                                                }
                                            }
                                            ?>
                                            <tr>
                                                <td colspan="5" class="order-td">
                                                    <div class="order-delivery">
                                                    Địa chỉ giao hàng:
                                                        <span class="order-item_text item-delivery_time"><?php echo $order['DiaChiGH']?></span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="order-td">
                                                    <div class="order-delivery">
                                                        Ngày giao hàng:
                                                        <span class="order-item_text item-delivery_time">Đang xử lý</span>
                                                    </div>
                                                </td>
                                                <td class="order-td">
                                                    <span class="order-item_text">Tổng tiền:</span>
                                                </td>
                                                <td class="order-td">
                                                    <span class="order-item_total"><?php echo number_format($total, 0, ',', '.'); ?> VNĐ</span>
                                                </td>
                                                <td></td>
                                            </tr>
                                        </table>
                                    </div>

                            <?php
                                } //  end while
                            } else {?>
                                <div class="order-content">
                                    <div class="order-content">
                                        <span class="order-content_noitem">Không có đơn hàng nào</span>
                                    </div>
                                </div>
                                <?php }?>
                        </div>

                        <div id="processed" class="tabcontent">
                            <h3 class="tabcontent-header">Đơn hàng đã xử lý</h3>
                            <?php
                            if (mysqli_num_rows($rs1) > 0) {
                                while ($order = mysqli_fetch_array($rs1)) {
                                    $order_id = $order['SoDonDH'];
                                    $sql_detail = "SELECT * FROM chitietdathang WHERE chitietdathang.SoDonDH = '$order_id';";
                                    $rs1_detail = mysqli_query($conn, $sql_detail);
                                    $odrday = $order['NgayDH'];
                                    $delivery = $order['NgayGH'];
                            ?>
                                    <div class="order-content">
                                        <div class="order_content-title processed-title">
                                            <span class="order-content_title">Ngày đặt hàng: <span class="order-date"></span></span>
                                        </div>
                                        <table class="order_body">
                                            <tr>
                                                <th class="order-th">Tên sản phẩm</th>
                                                <th class="order-th">Ảnh sản phẩm</th>
                                                <th class="order-th">Số lượng mua</th>
                                                <th class="order-th">Thành tiền</th>
                                                <th class="order-th">Ghi chú</th>
                                            </tr>
                                            <?php
                                            $total = 0;
                                            while ($detail = mysqli_fetch_array($rs1_detail)) {
                                                $price = $detail['SoLuong'] * $detail['GiaDatHang'];
                                                $detail_id = $detail['MSSP'];
                                                $sql_prd = "SELECT * FROM SanPham WHERE SanPham.MSSP = '$detail_id';";
                                                $rs1_prd = mysqli_query($conn, $sql_prd);
                                                while ($prd = mysqli_fetch_array($rs1_prd)) {
                                            ?>
                                                    <tr>
                                                        <td class="order-td">
                                                            <span class="order-item_text">
                                                                <?php echo $prd['TenSP'] ?>
                                                            </span>
                                                        </td>
                                                        <td class="order-td">
                                                            <a href="#" class="cart-item_img">
                                                                <img class="cart_img" src="../img_upload/<?php echo $prd['Avatar']; ?>">
                                                            </a>
                                                        </td>
                                                        <td class="order-td">
                                                            <span class="order-item_text"><?php echo $detail["SoLuong"]; ?></span>
                                                        </td>
                                                        <td class="order-td">
                                                            <span class="order-item_text"><?php echo number_format($price, 0, ',', '.'); ?> VNĐ</span>
                                                        </td>
                                                        <td class="order-td">
                                                            <span class="order-item_text"><?php echo $order["GhiChu"]; ?></span>
                                                        </td>
                                                    </tr>
                                            <?php
                                                    $total += $price;
                                                }
                                            }
                                            ?>
                                            <tr>
                                                <td colspan="5" class="order-td">
                                                    <div class="order-delivery">
                                                    Địa chỉ giao hàng:
                                                        <span class="order-item_text item-delivery_time"><?php echo $order['DiaChiGH']?></span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="order-td">
                                                    <div class="order-delivery">
                                                        Ngày giao hàng:
                                                        <span id="delivery" class="order-item_text item-delivery_time"></span>
                                                    </div>
                                                </td>
                                                <td class="order-td">
                                                    <span class="order-item_text">Tổng tiền:</span>
                                                </td>
                                                <td class="order-td">
                                                    <span class="order-item_total"><?php echo number_format($total, 0, ',', '.'); ?> VNĐ</span>
                                                </td>
                                                <td></td>
                                            </tr>
                                        </table>
                                    </div>

                            <?php
                                } //  end while
                            } else {?>
                                <div class="order-content">
                                    <div class="order-content">
                                        <span class="order-content_noitem">Không có đơn hàng nào</span>
                                    </div>
                                </div>
                                <?php }?>
                        </div>
                        <div id="completed" class="tabcontent">
                            <h3 class="tabcontent-header">Đơn hàng đã thanh toán</h3>
                            <?php
                            if (mysqli_num_rows($rs2) > 0) {
                                while ($order = mysqli_fetch_array($rs2)) {
                                    $order_id = $order['SoDonDH'];
                                    $sql_detail = "SELECT * FROM chitietdathang WHERE chitietdathang.SoDonDH = '$order_id';";
                                    $rs2_detail = mysqli_query($conn, $sql_detail);
                            ?>
                                    <div class="order-content">
                                        <div class="order_content-title processed-title">
                                            <span class="order-content_title">Ngày đặt hàng: <span class="order-date"></span></span>
                                        </div>
                                        <table class="order_body">
                                            <tr>
                                                <th class="order-th">Tên sản phẩm</th>
                                                <th class="order-th">Ảnh sản phẩm</th>
                                                <th class="order-th">Số lượng mua</th>
                                                <th class="order-th">Thành tiền</th>
                                                <th class="order-th">Ghi chú</th>
                                            </tr>
                                            <?php
                                            $total = 0;
                                            while ($detail = mysqli_fetch_array($rs2_detail)) {
                                                $price = $detail['SoLuong'] * $detail['GiaDatHang'];
                                                $detail_id = $detail['MSSP'];
                                                $sql_prd = "SELECT * FROM SanPham WHERE SanPham.MSSP = '$detail_id';";
                                                $rs2_prd = mysqli_query($conn, $sql_prd);
                                                while ($prd = mysqli_fetch_array($rs2_prd)) {
                                            ?>
                                                    <tr>
                                                        <td class="order-td">
                                                            <span class="order-item_text">
                                                                <?php echo $prd['TenSP'] ?>
                                                            </span>
                                                        </td>
                                                        <td class="order-td">
                                                            <a href="#" class="cart-item_img">
                                                                <img class="cart_img" src="../img_upload/<?php echo $prd['Avatar']; ?>">
                                                            </a>
                                                        </td>
                                                        <td class="order-td">
                                                            <span class="order-item_text"><?php echo $detail["SoLuong"]; ?></span>
                                                        </td>
                                                        <td class="order-td">
                                                            <span class="order-item_text"><?php echo number_format($price, 0, ',', '.'); ?> VNĐ</span>
                                                        </td>
                                                        <td class="order-td">
                                                            <span class="order-item_text"><?php echo $order["GhiChu"]; ?></span>
                                                        </td>
                                                    </tr>
                                            <?php
                                                    $total += $price;
                                                }
                                            }
                                            ?>
                                            <tr>
                                                <td colspan="5" class="order-td">
                                                    <div class="order-delivery">
                                                    Địa chỉ giao hàng:
                                                        <span class="order-item_text item-delivery_time"><?php echo $order['DiaChiGH']?></span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="order-td">
                                                    <div class="order-delivery">
                                                        Trạng thái:
                                                        <span class="order-item_text item-delivery_time"><?php echo "Đã thanh toán"?></span>
                                                    </div>
                                                </td>
                                                <td class="order-td">
                                                    <span class="order-item_text">Tổng tiền:</span>
                                                </td>
                                                <td class="order-td">
                                                    <span class="order-item_total"><?php echo number_format($total, 0, ',', '.'); ?> VNĐ</span>
                                                </td>
                                                <td></td>
                                            </tr>
                                        </table>
                                    </div>

                            <?php
                                } //  end while
                            } else {?>
                                <div class="order-content">
                                    <div class="order-content">
                                        <span class="order-content_noitem">Không có đơn hàng nào</span>
                                    </div>
                                </div>
                                <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include("./footer.php"); ?>
    </div>

    
    <!-- =============== SCRIPT =============== -->
    <script src="./asset/jquery/jquery.js"></script>
    <!-- <script src="./asset/jquery/main.js"></script> -->
    <script type="text/javascript">
        // Day
        // $(document).ready(function() {
        //     // Ngày đặt hàng
        //     var dbday = "<?php echo $odrday?>";
        //     var dateodr = new Date(dbday);
        //     var dayodr = dateodr.getDate();
        //     var monthodr = dateodr.getMonth()+1;
        //     var yearodr = dateodr.getFullYear();
        //     var orderDay = dayodr+"-"+monthodr+"-"+yearodr;
        //     $('.order-date').text(orderDay);
            
        //     // Ngày giao hàng
        //     var dbdelivery = "<?php echo $delivery?>";
        //     var datedelivery = new Date(dbday);
        //     var daydelivery = datedelivery.getDate();
        //     var monthdelivery = datedelivery.getMonth()+1;
        //     var yeardelivery = datedelivery.getFullYear();
        //     var deliveryDay = daydelivery+"-"+monthdelivery+"-"+yeardelivery;
        //     // alert(date);
        //     $('#delivery').text(deliveryDay);

        // });


        // Tab
        var tabLinks = document.querySelectorAll(".tablinks");
        var tabContent =document.querySelectorAll(".tabcontent");

        tabLinks.forEach(function(el) {
        el.addEventListener("click", openTabs);
        });


        function openTabs(el) {
        var btn = el.currentTarget; // lắng nghe sự kiện và hiển thị các element
        var electronic = btn.dataset.electronic; // lấy giá trị trong data-electronic
        
        tabContent.forEach(function(el) {
            el.classList.remove("active");
        }); //lặp qua các tab content để remove class active

        tabLinks.forEach(function(el) {
            el.classList.remove("active");
        }); //lặp qua các tab links để remove class active

        document.querySelector("#" + electronic).classList.add("active");
        // trả về phần tử đầu tiên có id="" được add class active
        
        btn.classList.add("active");
        // các button mà chúng ta click vào sẽ được add class active
        }
    </script>

</body>

</html>