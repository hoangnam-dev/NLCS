<?php
include("./connection.php");
session_start();
$search = (isset($_GET['search'])) ? $_GET['search'] : "";
// echo'<pre>';
// print_r($search); exit;
 
$sql_prd = "SELECT * FROM SanPham WHERE SanPham.TenSP LIKE '%$search%';";
$rs_prd = mysqli_query($conn, $sql_prd);
$rs = 0;
if(mysqli_num_rows($rs_prd)<0){
    $rs = 1;
}

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
<?php 
include("./header.php");
?>
<div class="main_container">
            <div class="grid">
                <div class="grid_row main_content">
                    <div class="grid_col-12 ctn-box ctn-mb">
                        <div class="cnt_title">
                            <h2>Kết quả tìm kiếm:
                                <?php if($rs == 1){
                                    echo "Không tìm kết quả của ". "<b>". $search . "</b>";
                                }else{
                                ?>
                                <span class="search-rs"><?php echo "Tìm thấy " . mysqli_num_rows($rs_prd)." sản phẩm:"; ?></span>
                            </h2>
                        </div>
                        <div class="main_product">
                            <div class="grid_row">
                                <!-- Product Item -->
                                <?php
                                
                                while ($product = mysqli_fetch_assoc($rs_prd)) {

                                ?>
                                    <div class="grid_col-3">
                                        <div class="product-item">
                                            <a href="./product-detail.php" class="product-img">
                                                <div class="product-item_img" style="background-image: url('../img_upload/<?php echo $product['AnhSP'] ?>');"></div>
                                            </a>
                                            <h3 class="product-item_name"><?php echo $product['TenSP'] ?></h3>
                                            <div class="product-item_price">
                                                <span class="product-item_price-old"><?php echo number_format($product['Gia'], 0, ',', '.') ?></span>
                                                <span class="product-item_price-new"><?php echo number_format($product['GiaBan'], 0, ',', '.') ?></span>
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
                                            <div class="product-item_sale-off">
                                                <span class="product-item_sale-off-label">GIẢM</span>
                                                <span class="product-item_sale-off-precent">10%</span>
                                            </div>
                                            <div class="product-item_oder">
                                            <a href="./product-detail.php" class="button button_general btn product-item_oder-btn">Chi tiết sản phẩm</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                                } ?> 
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
<?php 
include("./footer.php");
?>
</body>
</html>