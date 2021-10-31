<?php
$admin = (isset($_SESSION['admin'])) ? $_SESSION['admin'] : [];
if(empty($admin)){
    header("location: ./index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<body>
<div class="sidebar">
    <a href="index.php" class="sidebar-header">
        <div class="logo-img">
            <img src="../images/web_logo.png" alt="">
        </div>
        <h2>HNStore</h2>
    </a>
    <div class="admin">
    <div class="admin-img">
            <img src="./asset/images/img-admlogin.jpg">
        </div>
        <span class="adm-name"><?php echo $admin['HoTenNV']?></span>
    </div>
    <nav class="sidebar-menu">
        <ul class="sidebar_menu-list">
            <li class="sidebar_menu-item">
            <li class="sidebar_menu-item">
                <div class="sidebar_menu-link" onclick="window.open('product_manage.php','_self')">Quản lý sản phẩm</div>
            </li>
            </li>
            <li class="sidebar_menu-item">
                <div class="sidebar_menu-link" onclick="window.open('category_manage.php','_self')">Quản lý loại sản phẩm</div>
            </li>
            <li class="sidebar_menu-item">
                <div class="sidebar_menu-link" onclick="window.open('brand_manage.php','_self')">Quản lý thương hiệu</div>
            </li>
            <li class="sidebar_menu-item">
                <div class="sidebar_menu-link sub-btn">Quản lý khách hàng
                    <i class="sidebar-dropdown fas fa-caret-right"></i>
                </div>
                <div class="sidebar_sub-menu">
                    <a href="customer_manage.php" class="sidebar_submenu-link">Khách hàng</a>
                    <a href="address.php" class="sidebar_submenu-link">Địa chỉ khách hàng</a>
                </div>
            </li>
            <li class="sidebar_menu-item">
                <div class="sidebar_menu-link" onclick="window.open('staff_manage.php','_self')">Quản lý nhân viên</div>
            </li>
            <li class="sidebar_menu-item">
            <div class="sidebar_menu-link sub-btn">Quản lý đơn hàng
                    <i class="sidebar-dropdown fas fa-caret-right"></i>
                </div>
                <div class="sidebar_sub-menu">
                    <a href="./order.php?status=0" class="sidebar_submenu-link">ĐH chờ xử lý</a>
                    <a href="./order.php?status=1" class="sidebar_submenu-link">ĐH đã xử lý</a>
                    <a href="./order.php?status=completed" class="sidebar_submenu-link">ĐH đã thanh toán</a>
                </div>
            </li>
        </ul>
        <div class="btn-admin">
            <a href="./process.php?action=logout" class="adm-logout">
                <i class="logout_icon fas fa-sign-out-alt"></i>
                Đăng xuất
            </a>
        </div>
    </nav>
</div>




    <!-- =============== SCRIPT =============== -->
    <script src="./asset/jquery/jquery.js"></script>
    <!-- <script src="./asset/jquery/main.js"></script> -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('.sub-btn').click(function() {
                $(this).next('.sidebar_sub-menu').slideToggle();
                $(this).find('.sidebar-dropdown').toggleClass("rotate");
            });
        });
    </script>
</body>
</html>