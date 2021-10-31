<?php
include("./connection.php");
include("./function.php");
session_start();
// $action = ;
if (isset($_GET['action']) && $_GET['action'] == 'prd-detail' && isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $sql = "SELECT * FROM SanPham WHERE SanPham.MSSP = '$product_id'";
    $rs = mysqli_query($conn, $sql);
    $prd_detail = mysqli_fetch_assoc($rs);
}
$user = (isset($_SESSION['user'])) ? $_SESSION['user'] : [];
if (empty($user)) {
    $check = 0;
} else {
    $check = 1;
}
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
                <div class="grid_row main_content prd_content">
                    <div class="grid_col-12 ctn-mb">
                        <div class="prd_title">
                            <h2 class="prd_title-name"><?php echo $prd_detail['TenSP'] ?></h2>
                            <div class="prd_title_rating">
                                <i class="prd_title_rating-check fa fa-star"></i>
                                <i class="prd_title_rating-check fa fa-star"></i>
                                <i class="prd_title_rating-check fa fa-star"></i>
                                <i class="prd_title_rating-check fa fa-star"></i>
                                <i class="prd_title_rating-check fa fa-star"></i>
                                <span class="prd_title_rating-reviews">19 lượt đánh giá</span>
                            </div>
                        </div>
                        <div class="prd_info">
                            <div class="prd_info-left">
                                <div class="prd_info-img">
                                    <img class="prd_img" src="../img_upload/<?php echo $prd_detail['Avatar'] ?>" alt="Iphone 12 256GB">
                                </div>
                            </div>
                            <div class="prd_info-right">
                                <form id="form-order" method="POST">
                                    <div class="prd-price">
                                        <span class="prd_price-new"><?php echo number_format($prd_detail['GiaBan'], 0, ',', '.') ?></span>
                                        <span class="prd_price-old"><?php echo number_format($prd_detail['Gia'], 0, ',', '.') ?></span>
                                    </div>
                                    <div class="prd-color">
                                        <span class="item-color">Màu đen</span>
                                        <span class="item-color">Màu trắng</span>
                                    </div>
                                    <div class="prd_quantity <?php if ($prd_detail['SoLuongHang'] == 0) {echo "disable";} ?>">
                                        <div class="qty-btn_minus" id="minus">
                                            <span>-</span>
                                        </div>
                                        <input type="text" name="prd_quantity" class="qty_input" id="input" value="1" onblur="return changeQty();">
                                        <div class="qty-btn_plus" id="plus">
                                            <span>+</span>
                                        </div>
                                        <div id="error-qty" class="error-message err-qty"></div>
                                    </div>
                                    <div class="prd-sale-info">
                                        <span class="prd-sale-info-title">Nhận ngay khuyến mãi đặc biệt</span>
                                        <ul class="prd-list">
                                            <li class="prd-item">
                                                <i class="prd-icon fas fa-check-circle"></i>
                                                <span class="prd-item_link">Bảo hành 2 năm</span>
                                            </li>
                                            <li class="prd-item">
                                                <i class="prd-icon fas fa-check-circle"></i>
                                                <span class="prd-item_link">Trả góp 0%</span>
                                            </li>
                                            <li class="prd-item">
                                                <i class="prd-icon fas fa-check-circle"></i>
                                                <span class="prd-item_link">Phiếu mua hàng trị giá 200.000đ</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="prd_oder">
                                        <?php if ($prd_detail["SoLuongHang"] > 0) { ?>
                                            <input type="submit" id="btn-order" class="button button_general btn prd_oder-btn" onclick="return checkLogin();" name="submit" value="Thêm vào giỏ hàng">
                                        <?php } else { ?>
                                            <input type="text" id="btn-order" class="button button-warning" value="Tạm hết hàng">
                                        <?php } ?>
                                    </div>
                                </form>

                                <div class="prd-specification">
                                    <h2 class="prd-specification_title">Thông số kỹ thuật</h2>
                                    <div class="prd-specification_body">
                                        <table class="prd-specification_body-tb">
                                            <tbody>
                                                <tr>
                                                    <td class="prd-tb_td">Màn hình</td>
                                                    <td class="prd-tb_td">6.7", Super Retina XDR, OLED, 2778 x 1284 Pixel</td>
                                                </tr>
                                                <tr>
                                                    <td class="prd-tb_td">Camera sau</td>
                                                    <td class="prd-tb_td">12.0 MP + 12.0 MP + 12.0 MP</td>
                                                </tr>
                                                <tr>
                                                    <td class="prd-tb_td">Camera Selfie</td>
                                                    <td class="prd-tb_td">12.0 MP</td>
                                                </tr>
                                                <tr>
                                                    <td class="prd-tb_td">RAM </td>
                                                    <td class="prd-tb_td">6GB</td>
                                                </tr>
                                                <tr>
                                                    <td class="prd-tb_td">Bộ nhớ trong</td>
                                                    <td class="prd-tb_td">256GB</td>
                                                </tr>
                                                <tr>
                                                    <td class="prd-tb_td">CPU</td>
                                                    <td class="prd-tb_td">A14 Bionic</td>
                                                </tr>
                                                <tr>
                                                    <td class="prd-tb_td">GPU</td>
                                                    <td class="prd-tb_td">Apple GPU 4 nhân</td>
                                                </tr>
                                                <tr>
                                                    <td class="prd-tb_td">Dung lượng pin</td>
                                                    <td class="prd-tb_td">3687 mAh</td>
                                                </tr>
                                                <tr>
                                                    <td class="prd-tb_td">Thẻ SIM</td>
                                                    <td class="prd-tb_td">2, 1 eSIM, 1 Nano SIM</td>
                                                </tr>
                                                <tr>
                                                    <td class="prd-tb_td">Hệ điều hành</td>
                                                    <td class="prd-tb_td">IOS 14</td>
                                                </tr>
                                                <tr>
                                                    <td class="prd-tb_td">Xuất xứ</td>
                                                    <td class="prd-tb_td">Trung Quốc</td>
                                                </tr>
                                                <tr>
                                                    <td class="prd-tb_td">Thời gian ra mắt</td>
                                                    <td class="prd-tb_td">10/2020</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- <div class="prd-specification_more">
                                        <a href="#" class="prd-specification-link">Xem thêm
                                            <i class="prd-st_more-icon fas fa-caret-right"></i>
                                        </a>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include("./footer.php"); ?>
    </div>


    <script>
        // Ajax
        // Order
        $("#form-order").submit(function(event) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: "./process.php?order-prd&&id=<?php echo $product_id;?>",
                data: $(this).serializeArray(),
                success: function(response) {
                    response = JSON.parse(response);
                    if (response.status == "0") {
                        alert(response.message);
                        console.log(response.message);
                    } else {
                        alert(response.message);
                        console.log(response.qty);
                        location.reload();
                    }
                }
            });
        });
        // Check Login
        function checkLogin() {
            var flag = true;
            var check = <?php echo $check ?>;
            if (check == 0) {
                flag = false;
                var popupLogin = document.getElementById("btn-order");
                // Thêm sự kiện cho đối tượng
                popupLogin.addEventListener("click", function() {
                    popupOpen("modalLg");
                });
            } else {
                flag = true;
            }
            return flag;
        }


        // Quantity Product
        var qty = <?php echo $prd_detail['SoLuongHang'] ?>;
        var minus = document.getElementById("minus");
        var plus = document.getElementById("plus");
        var input = document.getElementById("input");

        function changeQty() {
            var quantity = parseInt(input.value);
            if (quantity <= qty && quantity >= 1) {
                inputQty = quantity;
                message = "";
                showErr("qty", message);
            } else {
                message = "Số lượng mua tối thiểu là 1 và không được vượt quá " + qty;
                showErr("qty", message);
                inputQty = 1;
            }
            input.value = inputQty;
        }

        plus.addEventListener("click", function() {
            var plus = parseInt(input.value);
            var plus = qty_plus(plus);
            if (plus <= qty) {
                input.value = plus;
                message = " ";
            } else {
                message = "Số lượng không được vượt quá " + qty;
            }
            showErr("qty", message);
        });

        minus.addEventListener("click", function() {
            var minus = parseInt(input.value);
            var minus = qty_minus(minus);
            if (minus <= qty) {
                input.value = minus;
                message = " ";
            } else {
                message = "Số lượng không được vượt quá " + qty;
            }
            showErr("qty", message);
        });
    </script>
    <script src="./asset/jquery/main.js"></script>
    <script src="./asset/jquery/jquery.js"></script>
</body>

</html>