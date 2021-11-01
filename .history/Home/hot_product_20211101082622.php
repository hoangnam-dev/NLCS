<?php
include("./connection.php");
$brand_id = $_GET['brand'];
$sql = "SELECT * FROM ThuongHieu WHERE ThuongHieu.MSTH = '$brand_id'";
$rs = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="vi">

<body>
    <div class="grid_row">
        <!-- Hot Products Item -->
        <?php
        $brand_id = $brand["MSTH"];
        $sql_prd = "SELECT * FROM `sanpham` WHERE sanpham.MSTH = '$brand_id' AND SanPham.NoiBat = '1';";
        $rs_prd = mysqli_query($conn, $sql_prd);
        while ($product = mysqli_fetch_array($rs_prd)) {
        ?>
            <div class="grid_col-4">
                <div class="product-item">
                    <a href="./product-detail.php?action=prd-detail&id=<?php echo $product["MSSP"]; ?>" class="product-img">
                        <div class="product-item_img" style="background-image: url('../img_upload/<?php echo $product["Avatar"] ?>');"></div>
                    </a>
                    <h3 class="product-item_name"><?php echo $product["TenSP"] ?></h3>
                    <div class="product-item_price">
                        <?php if ($product["GiaBan"] > 0) { ?>
                            <span class="product-item_price-old"><?php echo number_format($product["Gia"], 0, ',', '.'); ?>&nbsp; VNĐ</span>
                            <span class="product-item_price-new"><?php echo number_format($product["GiaBan"], 0, ',', '.'); ?>&nbsp; VNĐ</span>
                        <?php } else { ?>
                            <span class="product-item_price-new"><?php echo number_format($product["GiaBan"], 0, ',', '.'); ?>&nbsp; VNĐ</span>
                        <?php } ?>
                    </div>
                    <span class="product-item_description"><?php echo $product['MoTa'] ?></span>
                    <div class="product-item_rating">
                        <i class="product-item_rating-check fa fa-star"></i>
                        <i class="product-item_rating-check fa fa-star"></i>
                        <i class="product-item_rating-check fa fa-star"></i>
                        <i class="product-item_rating-check fa fa-star"></i>
                        <i class="product-item_rating-check fa fa-star"></i>
                        <span class="product-item_rating-reviews">19 lượt đánh giá</span>
                    </div>
                    <div class="product-item_oder">
                        <a href="./product-detail.php?action=prd-detail&id=<?php echo $product["MSSP"] ?>" class="button button_general btn product-item_oder-btn">Chi tiết sản phẩm</a>
                    </div>
                    <div class="product-item_sale-off">
                        <span class="product-item_sale-off-label">GIẢM</span>
                        <span class="product-item_sale-off-precent">10%</span>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</body>

</html>