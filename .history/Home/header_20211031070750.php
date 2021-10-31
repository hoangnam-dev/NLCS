<?php
include("function.php");
$user = (/isset($_SESSION['user'])) ? $_SESSION['user'] : [];
$user_id = $_SESSION['user']['MSKH'];
$sql_user = selectDB('customer', $user_id);
$user = (mysqli_num_rows($sql_user)>0) ? $_SESSION['user'] : [];
$cart = (isset($_SESSION['cart'])) ? $_SESSION['cart'] : [];
// echo $user['MSKH'];exit;
$count_item = 0;
foreach ($cart as $item) :
    $count_item++;
endforeach;

$sql_category = "SELECT * FROM LoaiSanPham";
$rs_category = mysqli_query($conn, $sql_category);
$sql_brand = "SELECT * FROM ThuongHieu";
$rs_brand = mysqli_query($conn, $sql_brand);

$search = (isset($_GET['search'])) ? $_GET['search'] : [];

?>
<!DOCTYPE html>
<html lang="en">

<body>
    <header class="header">
        <div class="header_top">
            <div class="grid">

                <!-- Navbar -->
                <nav class="header_navbar">
                    <!-- Nav-Left -->
                    <ul class="header_navbar-list">
                        <li class="header_navbar-item">Hổ trợ</li>
                        <li class="header_navbar-item">
                            <span class="header_navbar-title-no-pointer">Kết nối</span>
                            <a href="" class="header_navbar-item-link">
                                <i class="fab fa-facebook header_navbar-icon"></i>
                            </a>
                            <a href="" class="header_navbar-item-link">
                                <i class="fab fa-instagram header_navbar-icon"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- Nav-Right -->
                    <ul class="header_navbar-list">

                        <?php
                        if (isset($user['HoTenKH'])) { ?>
                            <!-- Has Login -->
                            <li class="header_navbar-item header_navbar-user">
                                <img src="./asset/img/img-user.jpg" alt="user-img" class="user-img">
                                <span id="user" class="header_navbar-username"><?php echo $user['HoTenKH'] ?></span>
                                <ul class="user_menu">
                                    <li class="user_menu-item">
                                        <a href="./customer.php?id=<?php echo $user['MSKH'] ?>">Quản lý tài khoản</a>
                                    </li>
                                    <li class="user_menu-item">
                                        <a href="./order.php">Đơn hàng</a>
                                    </li>
                                    <li class="user_menu-item user_menu-item-separate">
                                        <a href="./process.php?action=logout">Đăng xuất</a>
                                    </li>
                                </ul>
                            </li>

                        <?php } else { ?>
                            <!-- Hasn't Login -->
                            <li class="header_navbar-item header_navbar-item-separate">
                                <a id="popupLogin" class="btn-modal header_navbar-item-link header_navbar-item-strong">Đăng nhập</a>
                            </li>
                            <li class="header_navbar-item">
                                <a id="popupRegister" class="btn-modal header_navbar-item-link header_navbar-item-strong">Đăng ký</a>
                            </li>

                            <!-- Start Modal Layout -->
                            <!--  Start Login Modal Layout -->
                            <div id="modalLg" class="modal">
                                <div class="modal_overlay"></div>
                                <div class="modal_body">
                                    <div class="form-general">
                                        <form id="form-login" class="form" method="POST" role="form">
                                            <div class="form-container">
                                                <div class="form_header">
                                                    <h3 class="form_heading">Đăng Nhập</h3>
                                                    <a id="popupRegisterForm" class="form_switch-btn">Đăng Ký</a>
                                                </div>
                                                <div class="form_group">
                                                    <input type="text" id="lg_phone" class="form_input" name="phone" placeholder="Số Điện thoại" />
                                                    <span id="error-lg_phone" class="error-message"></span>
                                                </div>
                                                <div class="form_group">
                                                    <input type="password" id="lg_password" class="form_input" name="password" placeholder="Mật Khẩu" />
                                                    <span id="error-lg_password" class="error-message"></span>
                                                </div>
                                                <div class="form_control">
                                                    <button type="button" id="lgclose" class="close button form_control-back button-normal">Trở Lại</button>
                                                    <input type="submit" name="submit" class="button button_general" value="Đăng Nhập" onclick="return validateLg();"></input>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- End Login Modal Layout -->

                            <!-- Start Modal Layout Register -->
                            <div id="modalRg" class="modal">
                                <div class="modal_overlay"></div>
                                <div class="modal_body">
                                    <div class="form-general">
                                        <form id="form-register" class="form" method="POST" id="form-register">
                                            <div class="form-container">
                                                <div class="form_header">
                                                    <h3 class="form_heading">Đăng Ký</h3>
                                                    <a id="popupLoginForm" class="form_switch-btn">Đăng Nhập</a>
                                                </div>
                                                <div class="form_group">
                                                    <input type="text" id="rg_phone" class="form_input" name="phone" placeholder="Số Điện thoại" />
                                                    <span id="error-rg_phone" class="error-message"></span>
                                                </div>
                                                <div class="form_group">
                                                    <input type="text" id="rg_username" class="form_input" name="name" placeholder="Họ và tên" />
                                                    <span id="error-rg_name" class="error-message"></span>
                                                </div>
                                                <div class="form_group">
                                                    <input type="text" id="rg_address" class="form_input" name="address" placeholder="Địa chỉ" />
                                                    <span id="error-rg_address" class="error-message"></span>
                                                </div>
                                                <div class="form_group">
                                                    <input type="password" id="rg_password" class="form_input" name="password" placeholder="Mật Khẩu" />
                                                    <span id="error-rg_password" class="error-message"></span>
                                                </div>
                                                <div class="form_group">
                                                    <input type="password" class="form_input" name="repassword" id="rg_repassword" placeholder="Nhập lại Mật Khẩu" />
                                                    <span id="error-rg_repassword" class="error-message"></span>
                                                </div>
                                                <div class="form_policy">
                                                    <span>
                                                        Bằng cách ấn vào nút “ĐĂNG KÝ”, tôi đồng ý với
                                                        <a href="" class="policy-link"> Điều Khoản Sử Dụng </a>và
                                                        <a href="" class="policy-link">Chính Sách Bảo Mật của chúng tôi</a></span>
                                                </div>
                                                <div class="form_control">
                                                    <button type="button" id="rgclose" class="close button form_control-back button-normal">Trở Lại</button>
                                                    <input type="submit" name="submit" class="button button_general lg_submit" value="Đăng Ký" onclick="return validateRg();"></input>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- End Register Modal Layout -->
                            <!-- End Modal Layout -->
                        <?php }; ?>
                    </ul>
                </nav>

                <!-- Search -->
                <div class="header-of-search">
                    <div onclick='window.open("./index.php", "_self")' class="header_logo">
                        <img class="logo_img" src="../images/web_logo.png" alt="logo">
                        <span class="store-name">HNStore</span>
                    </div>
                    <div class="header_search">
                        <form action="./search.php" class="header_search" method="GET">
                            <input type="text" name="search" value="<?php if ($search != []) {
                                                                        echo $search;
                                                                    } ?>" class="header_search-input" placeholder="Tìm kiếm...">
                            <button class="header_search-btn">
                                <i class="fas fa-search header_search-icon"></i>
                            </button>
                        </form>

                    </div>

                    <!-- Shopping Cart -->
                    <div class="header_cart">
                        <?php if (!empty($user)) { ?>
                            <a href="./cart.php" class="icon-of-cart">
                                <i class="header_cart-icon fas fa-shopping-cart"></i>
                                <?php
                                if ($count_item > 0) { ?>
                                    <span class="icon-of-cart-notice"><?php echo $count_item ?></span>
                                <?php }; ?>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="header_bottom">
            <div class="grid">
                <nav class="header_menu">
                    <ul class="header_menu-list">
                        <?php while ($brand = mysqli_fetch_array($rs_brand)) { ?>
                            <li class="header_menu-item">
                                <i class="hd_menu-icon fas fa-mobile-alt"></i>
                                <a href="./category.php?brand=<?php echo  $brand["MSTH"]; ?>" class="header_menu-item-link"><?php echo $brand["TenTH"]; ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </nav>
            </div>
        </div>
    </header>






    <!-- =============== SCRIPT =============== -->
    <script src="./asset/jquery/jquery.js"></script>
    <script src="./asset/jquery/main.js"></script>
    <script>
        // Ajax
        // Login
        $("#form-login").submit(function(event) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: "./process.php?login",
                data: $(this).serializeArray(),
                success: function(response) {
                    response = JSON.parse(response);
                    if (response.status == "0") {
                        alert(response.message);
                        console.log(response.message);
                    } else {
                        alert(response.message);
                        location.reload();
                    }
                }
            });
        });
        // Register
        $("#form-register").submit(function(event) {
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: "./process.php?register",
                data: $(this).serializeArray(),
                success: function(response) {
                    response = JSON.parse(response);
                    if (response.status == "0") {
                        alert(response.message);
                        console.log(response.message);
                    } else {
                        alert(response.message);
                        location.reload();
                    }
                }
            });
        });


        // Validate
        <?php if (empty($user)) { ?>
            // Lấy đối tượng Login
            var popupLogin = document.getElementById("popupLogin");
            var popupLoginClose = document.getElementById("lgclose");

            // Thêm sự kiện cho đối tượng
            popupLogin.addEventListener("click", function() {
                popupOpen("modalLg");
            });
            popupLoginClose.addEventListener("click", function() {
                popupClose("modalLg");
            });
            // Lấy đối tượng Register
            var popupRegister = document.getElementById("popupRegister");
            var popupRegisterClose = document.getElementById("rgclose");
            // Thêm sự kiện cho đối tượng
            popupRegister.addEventListener("click", function() {
                popupOpen("modalRg");
            });
            popupRegisterClose.addEventListener("click", function() {
                popupClose("modalRg");
            });

            // Mở Form Login từ Form Register 
            var popupRF = document.getElementById("popupRegisterForm");
            popupRF.addEventListener("click", function() {
                popupClose("modalLg");
                popupOpen("modalRg");
            });

            // Mở Form Register từ Form Login 
            var popupLF = document.getElementById("popupLoginForm");
            popupLF.addEventListener("click", function() {
                popupClose("modalRg");
                popupOpen("modalLg");
            });
        <?php } ?>


        function getElement(id) {
            return document.getElementById(id).value.trim();
        }

        function validateRg() {
            var phone = getElement("rg_phone");
            var name = getElement("rg_username");
            var address = getElement("rg_address");
            var password = getElement("rg_password");
            var repassword = getElement("rg_repassword");

            var flag = true;

            if (phone != "") {
                if (!/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im.test(phone)) {
                    flag = false;
                    message = "Vui lòng kiểm tra lại số điện thoại của bạn";
                    showErr("rg_phone", message);
                } else {
                    showErr("rg_phone", "");
                }
            } else {
                flag = false;
                message = "Vui lòng nhập vào số điện thoại của bạn";
                showErr("rg_phone", message);
            }

            if (name != "") {
                if (!/[a-zA-Z0-9]/.test(name)) {
                    flag = false;
                    message = "Vui lòng nhập vào họ tên của bạn";
                    showErr("rg_name", message);
                } else {
                    showErr("rg_name", "");
                }
            } else {
                flag = false;
                message = "Vui lòng nhập vào họ tên của bạn";
                showErr("rg_name", message);
            }

            if (address == "") {
                flag = false;
                message = "Vui lòng nhập vào địa chỉ của bạn";
                showErr("rg_address", message);
            } else {
                showErr("rg_address", "");
            }

            if (password == "") {
                flag = false;
                message = "Vui lòng nhập vào mật khẩu của bạn";
                showErr("rg_password", message);
            } else {
                showErr("rg_password", "");
            }
            if (repassword != "") {
                if (repassword != password) {
                    flag = false;
                    message = "Vui lòng kiểm tra lại Mật khẩu nhập lại";
                    showErr("rg_repassword", message);
                } else {
                    showErr("rg_repassword", "");
                }
            } else {
                flag = false;
                message = "Trường này không được để trống";
                showErr("rg_repassword", message);
            }
            return flag;
        }
        // Validate Login Form
        function validateLg() {
            var phone = getElement("lg_phone");
            var password = getElement("lg_password");

            var flag = true;

            if (phone != "") {
                if (!/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im.test(phone)) {
                    flag = false;
                    message = "Vui lòng kiểm tra lại số điện thoại của bạn";
                    showErr("lg_phone", message);
                } else {
                    showErr("lg_phone", "");
                }
            } else {
                flag = false;
                message = "Vui lòng nhập vào số điện thoại của bạn";
                showErr("lg_phone", message);
            }

            if (password == "") {
                flag = false;
                message = "Vui lòng nhập vào mật khẩu của bạn";
                showErr("lg_password", message);
            } else {
                showErr("lg_password", "");
            }
            return flag;
        }
    </script>
    <!-- <script src="./asset/jquery/jquery.js"></script> -->

</body>

</html>