<?php
include("connection.php");
session_start();
$order_id = (isset($_GET['id'])) ? $_GET['id'] : [];
$status = (isset($_GET['status'])) ? $_GET['status'] : [];

$err = (isset($_GET['err'])) ? $_GET['err'] : [];

if(!empty($err)){
    if($err=='date'){
        $err_message = "Ngày giao hàng phải lớn ngày đặt hàng.";
        echo"<script>alert('".$err_message."')</script>";
    }
    else{
        if($err!='date'){
            $err_message = "Có lỗi xảy ra. Hãy kiểm tra lại.";
            echo"<script>alert('".$err_message."')</script>";

        }
    }
}
    
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
                    <form action="process.php?order=<?php if($status==0){echo "confirm";}else{
                    if($status==1){echo"complete";}}?>&id=<?php echo $order_id?>" class="product_insert-form" method="POST" enctype="multipart/form-data" role="form">
                    <div class="order-title"><span class="order_title"><?php if($status==0){echo "Đơn hàng chờ xử lý:";}else{if($status==1){echo"Đơn hàng đã xử lý:";}else{echo "Đơn hàng chờ thanh toán:";}}?></span></div>
                        <div class="order-form">
                            <?php while ($order = mysqli_fetch_array($rs)) { ?>
                                <div class="main_form">
                                    <div class="main-form_left">
                                        <div class="form-input">
                                            <label class="form_label" for="fname">Số đơn ĐH:</label>
                                            <input type="text" class="form_input disable-input" id="fname" name="order_id" readonly value="<?php echo $order['SoDonDH'] ?>">
                                        </div>
                                        <div class="form-input">
                                            <label class="form_label" for="fname">Họ tên khách hàng:</label>
                                            <input type="text" class="form_input" id="fname" name="order_customer" readonly value="<?php echo $order['HoTenKH'] ?>">
                                        </div>
                                        <div class="form-input">
                                            <label class="form_label" for="fname">Địa chỉ giao hàng</label>
                                            <input type="text" class="form_input" id="fname" name="order_address" readonly value="<?php echo $order['DiaChiGH'] ?>">
                                        </div>
                                    </div>
                                    <div class="main-form_right">
                                        <?php if($order['TrangThaiDH']!='0'){
                                            $staff_id = $order['MSNV'];
                                            $find_staff = "SELECT * FROM NhanVien WHERE NhanVien.MSNV = '$staff_id'";
                                            $rs_staff = mysqli_query($conn, $find_staff);
                                            $staff = mysqli_fetch_assoc($rs_staff);    
                                        ?>
                                            
                                            <div class="form-input">
                                                <label class="form_label" for="fname">Nhân viên xử lý</label>
                                                <input type="text" class="form_input" id="fname" name="order_date" readonly value="<?php echo $staff['HoTenNV'] ?>">
                                            </div>
                                        <?php } ?>
                                        <div class="form-input">
                                            <label class="form_label" for="fname">Ngày đặt hàng</label>
                                            <input type="text" class="form_input" id="fname" name="order_date" readonly value="<?php echo $order['NgayDH'] ?>">
                                        </div>
                                        <div class="form-input">
                                            <label class="form_label" for="fname">Ngày giao hàng</label>
                                            <input type="date" class="form_input" id="fname" name="order_delivery" value="<?php echo $order['NgayGH'] ?>">
                                        </div>
                                        <div class="form-input">
                                            <label class="form_label" for="fname">Ghi chú</label>
                                            <textarea type="text" class="form_input" id="fname" name="product_description"><?php echo $order['GhiChu'] ?></textarea>
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
                                                $product = $order_prd['MSSP'];
                                                $sql_prd = "SELECT * FROM SanPham WHERE SanPham.MSSP = '$product'";
                                                $rs_prd = mysqli_query($conn, $sql_prd);
                                                while ($product = mysqli_fetch_array($rs_prd)) { 
                                                ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo $product['TenSP'] ?></td>
                                                        <td><img class="form-img" src="../img_upload/<?php echo $product['Avatar'];?>" alt="<?php echo $product['Avatar'];?>"></td>
                                                        <td><?php echo number_format($order_prd['GiaDatHang'], 0, ',', '.') ?></td>
                                                        <td><?php echo $order_prd['SoLuong'] ?></td>
                                                        <td>
                                                            <input type="text" name="saleoff<?php echo $order_prd['MSSP'];?>" class="tb_input" value="<?php echo number_format($order_prd['GiamGia'], 0, ',', '.');?>" <?php if($status!=0){echo "readonly";}?>>
                                                        </td>
                                                        <?php
                                                        $prd_cate = $product['MLSP'];
                                                        $sql_cate = "SELECT * FROM LoaiSanPham WHERE LoaiSanPham.MLSP = '$prd_cate'";
                                                        $rs_cate = mysqli_query($conn, $sql_cate);
                                                        while ($category_prd = mysqli_fetch_array($rs_cate)) { ?>
                                                            <td><?php echo $category_prd['TenLSP'] ?></td>
                                                        <?php }; ?>
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
                                            <td class="total-value" colspan="5"><?php echo number_format($total,0,',','.'); ?>&nbsp;VNĐ</td>
                                        </tbody>
                                    </table>
                                </div>
                            <?php } ?>
                        </div>
                        <?php if($status=="0"){?>
                        <div class="order_detail-control">
                            <input type="submit" class="button form-success_btn order-btn" name="submit" value="Xác nhận đơn hàng">
                            <a href="./process.php?order=<?php echo"delete";?>&id=<?php echo $order_id?>" class="button button-dangerous order_btn-del" >Hủy đơn hàng</a>
                        </div>
                        <?php }
                        else{if($status=="1"){?>
                        <input type="submit" class="button form-success_btn order-btn" name="submit" value="Xác nhận thanh toán">
                        <?php } }?>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- <script type="text/javascript" src="./asset/bootstrap/js/bootstrap.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>