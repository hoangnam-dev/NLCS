<?php
include("./connection.php");
$brand_id = $_GET['brand'];
$sql = "SELECT * FROM ThuongHieu WHERE ThuongHieu.MSTH = '$brand_id'";
$rs = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>HNStore</title>
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
                <div class="grid_row main_content">
                    <div class="grid_col-3">
                        <nav class="category">
                            <h3 class="category-heading">
                                <!-- <i class="fas fa-list"></i> -->
                                Hãng sản xuất
                            </h3>
                            <ul class="category-list">
                                <?php
                                $sql_brand = "SELECT * FROM `ThuongHieu`";
                                $rs_brand = mysqli_query($conn, $sql_brand);
                                while ($brands = mysqli_fetch_assoc($rs_brand)) { ?>
                                    <li class="category-item">
                                        <a href="./category.php?brand=<?php echo $brands['MSTH'];?>" 
                                            class="category_link 
                                            <?php if ($brands['MSTH'] == $brand_id) {
                                            echo 'category_item-active';} ?>">
                                            <?php echo $brands['TenTH']; ?>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </nav>
                    </div>
                    <div class="grid_col-9 ctn-box ctn-mb">
                        <div class="cnt_title product-category_title">
                            <?php while ($brand = mysqli_fetch_assoc($rs)) { ?>
                                <h2><?php echo $brand["TenTH"]; ?></h2>
                        </div>
                        <div class="ctn_filter">
                            <span class="ctn_filter-title">Sắp xếp</span>
                            <button class="button ctn_btn">Phổ biến</button>
                            <button class="button ctn_btn">Mới nhất</button>
                            <!-- <button class="button ctn_btn" onclick='location.assign("./hot_category.php?brand=<?php echo $brand_id; ?>&hot")'>Nổi bật</button> -->
                            <button class="button ctn_btn" onclick='location.assign("./category.php?brand=<?php echo $brand_id; ?>&hot")'>Nổi bật</button>
                            <div class="select-input">
                                <span class="select-input_label">Giá</span>
                                <i class="fas fa-angle-down select-input_icon"></i>
                                <ul class="select-input_list">
                                    <li class="select-input_option"><a href="" class="select-input_link">Thấp tới cao</a></li>
                                    <li class="select-input_option"><a href="" class="select-input_link">Cao tới thấp</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="main_product">
                            
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include("./footer.php"); ?>
    </div>
</body>

</html>