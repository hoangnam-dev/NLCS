<?php
include('./connection.php');
session_start();
$cart = (isset($_SESSION['cart'])) ? $_SESSION['cart'] : [];
$user = (isset($_SESSION['user'])) ? $_SESSION['user'] : [];
if (empty($user)) {
    header("location: ./index.php");
    exit;
}
$notify = (isset($_GET['notify'])) ? $_GET['notify'] : [];
if (!empty($notify)) {
    if ($notify == 'success') {
        $notification = "Thao tác thành công";
    } elseif ($notify == 'qty-err') {
        $notification == "Số lượng mua không hợp lệ";
    }
    echo '<script>
            window.onload = function(){
                popupOpen("popup-error");
            };
        </script>';
}
$customer_id = $user['MSKH'];
$sql_address = "SELECT * FROM DiaChiKH WHERE DiaChiKH.MSKH = '$customer_id'";
$rs_address = mysqli_query($conn, $sql_address);
// echo'<pre>';
// print_r($_SESSION['cart']); exit;
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Shop Cart</title>
    <!--Reset CSS -->
    <link rel="stylesheet" href="./asset/normalize.css" />
    <!-- CSS and font of Web -->
    <link rel="stylesheet" href="./asset/base.css" />
    <link rel="stylesheet" href="./asset/main.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="./asset/fonts/fontawesome-free-5.15.4/css/all.min.css">
    <script src="./asset/jquery/jquery.js"></script>

</head>

<body>
    <div class="main">
        <?php include("./header.php"); ?>
        <div class="main_container">
            <div class="grid">
                <div class="grid_row main_content cart_content">
                    <div class="grid_col-12 ctn-mb">
                        <div class="cart-top">
                            <span>Thông tin giỏ hàng</span>
                        </div>
                        <?php if (!empty($cart)) { ?>
                            <div class="cart-title">
                                <div class="cart_title-">
                                    <span class="cart_title-name">Danh sách sản phẩm</span>
                                </div>
                                <a href="./process.php?action=delall-cart" class="btn_cart-trash">
                                    <div class="cart-title_trash">
                                        <span>Xóa tất cả</span>
                                        <i class="title_trash-icon far fa-trash-alt"></i>
                                    </div>
                                </a>
                            </div>
                            <form id="form-cart" method="POST" name="form-update">
                                <table class="cart_body">
                                    <thead>
                                        <tr>
                                            <th class="cart-th">STT</th>
                                            <th class="cart-th">Tên sản phẩm</th>
                                            <th class="cart-th">Ảnh sản phẩm</th>
                                            <th class="cart-th">Giá sản phẩm (VNĐ)</th>
                                            <th class="cart-th">Số lượng</th>
                                            <th class="cart-th">Tạm tính</th>
                                            <th class="cart-th" class="btn-edit"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        $total = 0;
                                        foreach ($cart as $item) :
                                            $checkout_item = $item['quantity'] * $item['price'];
                                        ?>
                                            <tr>
                                                <td class="cart-td"><?= ++$i; ?></td>
                                                <td class="cart-td">
                                                    <a href="./product-detail.php?action=prd-detail&id=<?php echo $item['id'] ?>" class="cart-item_img">
                                                        <img class="cart_img" src="../img_upload/<?= $item['image'] ?>" alt="<?= $item['image'] ?>">
                                                    </a>
                                                </td>
                                                <td class="cart-td"><span class="cart-item_prd-num"><?= $item['name'] ?></span></td>
                                                <td class="cart-td"><span class="cart-item_prd-num"><?= number_format($item['price'], 0, ',', '.') ?></span></td>
                                                <td class="cart-td">
                                                    <div class="cart-item_qty">
                                                        <button type="button" class="qty-btn_minus" id="minus_<?php echo $item['id']; ?>" onclick=" minusQty(<?php echo $item['id']; ?>)">
                                                            <span>-</span>
                                                        </button>

                                                        <input type="text" min="1" name="qty<?php echo $item['id']; ?>" class="qty_input" id="inputQty_<?php echo $item['id']; ?>" readonly value="<?php echo $item['quantity'] ?>">

                                                        <button type="button" class="qty-btn_plus" id="plus_<?php echo $item['id']; ?>" onclick=" plusQty(<?php echo $item['id']; ?>)">
                                                            <span>+</span>
                                                        </button>
                                                        <div id="error-qty" class="error-message err-qty"></div>
                                                    </div>
                                                    <!-- <input type="number" min="1" name="qty<?php echo $item['id']; ?>" class="qty_input" id="inputQty" value="<?php echo $item['quantity'] ?>">
                                            </td> -->
                                                <td id="price_<?php echo $item['id']; ?>" class="cart-td cart-item_prd-price"><?= $checkout_item ?></td>
                                                <!-- <td id="price_<?php echo $item['id']; ?>" class="cart-td cart-item_prd-price"><?= number_format($checkout_item, 0, ',', '.') ?></td> -->
                                                <td class="cart-td ">
                                                    <a href="./process.php?action=delete-cart&id=<?= $item['id'] ?>" class="btn_cart-trash">
                                                        <div class="cart-item_trash">
                                                            <span>Xóa</span>
                                                            <i class="cart-item_trash-icon far fa-trash-alt"></i>
                                                        </div>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php
                                            $total += $checkout_item;
                                        endforeach;
                                        ?>
                                    </tbody>
                                </table>
                                <?php if ($i > 0) { ?>
                                    <div class="cart_update">
                                        <input type="submit" name="submit" class="button button_general btn cart_confirm-btn" value="Cập nhật giỏ hàng">
                                    </div>
                                <?php } ?>

                    </div>

                    <div class="cart_order-summary">
                            <div class="order-summary_heading">Thông tin đơn hàng</div>
                            <div class="order-summary-content">
                                <div class="order-summary-input">
                                    <label class="order-summary_label">Họ tên khách hàng:</label>
                                    <input type="text" class="order-summary_input" readonly name="customer_name" value="<?= $user['HoTenKH'] ?>">
                                </div>
                                <div class="order-summary-input">
                                    <label class="order-summary_label">Địa chỉ nhận hàng:</label>
                                    <!-- <select class="order-summary_input summary_input" name="customer_address" id="address">
                                            <?php
                                            while ($address = mysqli_fetch_array($rs_address)) { ?>
                                            <option value="<?php echo $address['DiaChi'] ?>"><?php echo $address['DiaChi'] ?></option>
                                            <?php }; ?>
                                    </select> -->
                                    <input type="text" class="order-summary_input" name="customer_address" readonly value="<?= $user['DiaChi'] ?>">
                                </div>
                                <div class="order-summary-input">
                                    <label class="order-summary_label">SĐT khách hàng:</label>
                                    <input type="text" class="order-summary_input" name="customer_phone" readonly value="<?= $user['SoDienThoai'] ?>">
                                </div>
                                <div class="order-summary-input">
                                    <label class="order-summary_label">Mã giảm giá:</label>
                                    <input type="text" class="order-summary_input summary_input" name="prd_sale" value="0">
                                </div>
                                <div class="summary-content_total">
                                    <span class="">Tổng tiền:</span>
                                    <input type="text" class="order-summary_input total-value" name="oder-total" readonly value="<?php echo number_format($total, 0, ',', '.') ?>&nbsp;VNĐ">
                                </div>
                                <div class="order-summary-input summary-note">
                                    <label class="order-summary_label">Ghi chú đơn hàng:</label>
                                    <textarea type="text" name="customer_note" class="order-summary_note"></textarea>
                                </div>
                            </div>
                            <div class="cart_confirm">
                                <input type="submit" name="submit" class="button button_general btn cart_confirm-btn <?php if (empty($cart)) {echo "disable";} ?>" value="Đặt hàng">
                            </div>
                        </form>
                    </div>
                <?php } else { ?>
                    <div class="no-item">
                        <span>Không có sản phẩm nào trog giỏ hàng!!!</span>
                        <a href="./index.php" class="cart-link">Đi mua hàng
                            <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                <?php } ?>
                </div>
            </div>
        </div>
        <div id="popup-error" class="modal">
            <div class="modal_overlay"></div>
            <div class="modal_body">
                <div class="notify">
                    <?php if ($notify != 'success') { ?>
                        <h3 class="notify-header">Có lỗi xảy ra!!!</h3>
                    <?php } ?>
                    <div class="blank"></div>
                    <div class="notify-container">
                        <span class="notify_content"><?php echo $notification; ?></span>
                    </div>
                    <div class="notify-control">
                        <button id="popup-close" class="button button-back">Trỏ lại</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php include("./footer.php"); ?>
    </div>

    <script>
        // Popup Error
        var popupClose = document.getElementById("popup-close");

        // Thêm sự kiện cho đối tượng
        popupClose.addEventListener("click", function() {
            popupClose("popup-error");
        });
        function qtyChange() {
            $("#form-cart").click(function(event) {
                event.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "./test-be.php?update-cart",
                    data: $(this).serializeArray(),
                    success: function(response) {
                        response = JSON.parse(response);
                        if (response.status == "0") {
                            // alert(response.message);
                            console.log(response.message);
                        } else {
                            // alert(response.message);
                            console.log(response.qty);
                            location.reload();
                        }
                    }
                });
            });
        }
        // Cart Item Quantity
        function plusQty(id) {
            var plus = document.getElementById("plus_" + id);
            var inputQty = document.getElementById("inputQty_" + id);
            var item_price = document.getElementById("price_"+id).innerHTML
;

            var quantity = parseInt(inputQty.value);
            var plus = qty_plus(quantity);
            var price = parseInt(item_price);
            alert(plus);
            alert(price);
            var newprice = sumItem(plus,price);
            alert(newprice);
            alert(formatCash('1234567'));
            inputQty.value = plus;
            // item_price.innerText = formatCash(String(newprice));
            // qtyChange();
            return true;
        }

        function minusQty(id) {
            var inputQty = document.getElementById("inputQty_" + id);
            var minus = document.getElementById("minus_" + id)
            var item_price = document.getElementById("price_"+id).innerHTML

            var quantity = parseInt(inputQty.value);
            var price = parseInt(item_price);
            var minus = qty_minus(quantity);
            var newprice = sumItem(minus,price);
            inputQty.value = minus;
            item_price.innerText = formatCash(String(newprice));
            // qtyChange();
            return true;
        }

        //Update  Quantity  Cart Item
        // $("#form-cart-item").submit(function(event) {
        //     event.preventDefault();
        //     $.ajax({
        //         type: "POST",
        //         url: "./test-be.php?update-cart",
        //         data: $(this).serializeArray(),
        //         success: function(response) {
        //             response = JSON.parse(response);
        //             if (response.status == "0") {
        //                 alert(response.message);
        //                 console.log(response.message);
        //             } else {
        //                 alert(response.message);
        //                 console.log(response.qty);
        //                 location.reload();
        //             }
        //         }
        //     });
        // });


    </script>
    <script src="./asset/jquery/main.js"></script>
    <script src="./asset/jquery/jquery.js"></script>
</body>

</html>