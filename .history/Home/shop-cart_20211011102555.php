<?php
include('./connection.php');

$product = (isset($_SESSION['cart'])) ? $_SESSION['cart'] : [];
// echo'<pre>';
// print_r($_SESSION['cart']); exit;
?>

<!DOCTYPE html>
<html lang="vi">

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
    <script src="./asset/jquery/jquery.js"></script>
</head>

<body>
    <div class="main">
        <?php include("./header.php"); ?>
        <div class="main_container">
            <div class="grid">
                <div class="grid_row main_content cart_content">
                    <div class="grid_col-12 ctn-mb">
                        <div class="cart-title">
                            <!-- <div class="cart_title-checkbox">
                                    <input type="checkbox" class="cart_cb" name="cart-cb" id="">
                                    <span class="cart_title-name">Chọn tất cả sản phẩm</span>
                                </div> -->
                            <a href="./process.php?action=delall-cart" class="btn_cart-trash">
                                <div class="cart-title_trash">
                                    <span>Xóa tất cả</span>
                                    <i class="title_trash-icon far fa-trash-alt"></i>
                                </div>
                            </a>
                        </div>
                        <div class="cart_item-title">
                            <div class="cart_item-num">
                                <!-- <input type="checkbox" class="cart_cb" name="cart-cb" id=""> -->
                                <span class="cart-item_num">Số thứ tự</span>
                            </div>
                            <div class="cart_item-content">
                                <div class="cart-item_prd-name">Ảnh sản phẩm</div>
                                <div class="cart_item-prd">
                                    <span class="cart-item_prd-name">Tên sản phẩm</span>
                                    <span class="cart-item_prd-name">Giá san phẩm</span>
                                    <span class="cart-item_prd-quantity">Số lượng mua</span>
                                    <span class="cart-item_prd-name">Tạm tính</span>
                                    <span class="cart-item_prd-name">Xóa</span>
                                </div>
                            </div>
                            <!-- <a href="./process.php?action=delete-cart&id=<?= $item['id'] ?>" class="btn_cart-trash">
                                    <div class="cart-item_trash">
                                        <span>Xóa</span>
                                        <i class="item_trash-icon far fa-trash-alt"></i>
                                    </div>
                                </a> -->
                        </div>

                        <?php
                        $i = 1;
                        foreach ($product as $item) :
                            $checkout_item = $item['quantity'] * $item['price'];
                        ?>
                            <div class="cart_item">
                                <div class="cart_item-num">
                                    <!-- <input type="checkbox" class="cart_cb" name="cart-cb" id=""> -->
                                    <span class="cart-item_num"><?= $i; ?></span>
                                </div>
                                <div class="cart_item-content">
                                    <a href="#" class="cart-item_img">
                                        <div class="cart-item_prd-img" style="background-image: url('../img_upload/<?= $item['image'] ?>');"></div>
                                    </a>
                                    <div class="cart_item-prd">
                                        <span class="cart-item_prd-num"><?= $item['name'] ?></span>
                                        <!-- <input type="text"  id="prd_price" class="cart-item_prd-name" value="<?= number_format($item['price'], 0, ',', '.') ?>"> -->
                                        <div id="prd_price" class="cart-item_prd-name"><?= number_format($item['price'], 0, ',', '.') ?></div>
                                        <div class="cart-item_qty">
                                            <button class="qty-btn_minus" id="minus">
                                                <span>-</span>
                                            </button>
                                            <input type="text" class="qty_input" id="inputQty" value="<?php echo $item['quantity']?>" readonly>
                                            <!-- <input type="text" class="qty_input" id="inputQty" value="1" readonly> -->
                                            <button class="qty-btn_plus" id="plus">
                                                <span>+</span>
                                            </button>
                                        </div>

                                        <div id="prd_checkout" class="cart-item_prd-price"><?= number_format($checkout_item, 0, ',', '.') ?></div>
                                    </div>
                                </div>
                                <a href="./process.php?action=delete-cart&id=<?= $item['id'] ?>" class="btn_cart-trash">
                                    <div class="cart-item_trash">
                                        <span>Xóa</span>
                                        <i class="item_trash-icon far fa-trash-alt"></i>
                                    </div>
                                </a>
                            </div>
                        <?php $i++;
                        endforeach; ?>

                    </div>
                    <div class="cart_order-summary">
                        <form action="" class="cart_order-summary-form">
                            <div class="order-summary_heading">Thông tin đơn hàng</div>
                            <div class="order-summary-content">
                                <div class="order-summary-input">
                                    <label class="order-summary_label" for="fname">Họ tên người nhận:</label>
                                    <input type="text" class="order-summary_input" id="fname" name="cus_name">
                                </div>
                                <div class="order-summary-input">
                                    <label class="order-summary_label" for="fname">Địa chỉ nhận hàng:</label>
                                    <input type="text" class="order-summary_input" id="fname" name="cus_name">
                                </div>

                                <div class="summary-content_checkout">
                                    <div class="checkout-item">Tạm tính(1 sản phẩm)</div>
                                    <div class="checkout-value">20.999.99999999999999999đ</div>
                                </div>
                                <div class="summary-content_total">
                                    <span class="">Tổng tiền:</span>
                                    <div class="total-value">20.999.99999999999999999đ</div>
                                </div>
                                <div class="order-summary-input">
                                    <label class="order-summary_label" for="fname">Ghi chú đơn hàng:</label>
                                    <input type="text" class="order-summary_input" id="fname" name="cus_name">
                                </div>
                            </div>
                            <div class="cart_confirm">
                                <a href="#" class="button button_general btn cart_confirm-btn">Xác nhận đơn hàng</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("./footer.php"); ?>
    </div>


    <script>
        var minus = document.getElementById("minus");
        var plus = document.getElementById("plus");
        var inputPrice = document.getElementById("prd_price").innerText;
        var inputQty = document.getElementById("inputQty");
        var inputCheckOut = document.getElementById("prd_checkout");
        
        var quantity = parseInt(inputQty.value);
        // alert(typeof(inputPrice));

        plus.addEventListener("click", function(){
            var quantity = parseInt(inputQty.value);
            var plus = qty_plus(quantity);
            inputQty.value = plus;
            // var sum = sumItem(plus, price);
            // var price =  parseInt(inputPrice.replace(/\./g,""));
            // var plus = qty_plus(quantity, price);
            // alert(sum);
            // alert(price);
            // alert(plus);
            // inputCheckOut.innerHTML = sum;
        });
        
        minus.addEventListener("click", function(){
            var quantity = parseInt(inputQty.value);
            var minus = qty_minus(quantity);
            inputQty.value = minus;
        });
        console.log("<?php echo 'name';?>");
        </script>
        <script src="./asset/jquery/main.js"></script>
        <script src="./asset/jquery/jquery.js"></script>
</body>

</html>