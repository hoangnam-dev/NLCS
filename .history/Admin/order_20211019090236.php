<?php
include("connection.php");
$status = (isset($_GET['status'])) ? $_GET['status'] : [];
// echo $status; exit;
$sql = "SELECT * FROM `dathang` INNER JOIN khachhang ON khachhang.MSKH = dathang.MSKH WHERE dathang.TrangThaiDH Like '$status';";
$rs = mysqli_query($conn,$sql);

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
                    <h2>Quản lý đơn đặt hàng</h2>
                    <?php if(empty($status)){?>
                    <!-- <a href="./brand_insert.php" class="container-title_btn">
                        <div class="button button-general title-btn">Thêm nhãn hiệu</div>
                    </a> -->
                    <?php } ?>
                </div>

                <div class="main-content">
                    <div class="main-list">
                        <div class="main-content_control">
                            <?php if($status=='0'){
                               echo '<div class="content-title">Danh sách đơn đặt hàng chờ xử lý:</div>';
                            }else{
                                if($status=='1'){
                                    echo '<div class="content-title">Danh sách đơn đặt hàng đã xử lý:</div>';
                                }
                                else echo '<div class="content-title">Danh sách đơn đặt hàng đã thanh toán:</div>';
                            }
                            ?>
                        </div>
                        <?php if(mysqli_num_rows($rs)>0){?>
                        <div class="main-table">
                            <table class="main-table_content">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Số đơn ĐH</th>
                                        <th>Tên khách kàng</th>
                                        <th>Địa chỉ giao hàng</th>
                                        <th>Ngày đặt hàng</th>
                                        <th>Tuỳ Chọn</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; while($order = mysqli_fetch_array($rs)){ 
                                        // $customer_id = $order['MSKH']  ;
                                        // $sql_cus = "SELECT * FROM `dathang` INNER JOIN khachhang ON khachhang.MSKH = '$customer_id';";
                                        // $rs_cus = mysqli_query($conn, $sql_cus);
                                        // while($customer = mysqli_fetch_array($rs_cus)){
                                    ?>
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $order['SoDonDH']?></td>
                                        <td><?php echo $order['HoTenKH']?></td>
                                        <td><?php echo $order['DiaChiGH']?></td>
                                        <td><?php echo $order['NgayDH']?></td>
                                        <td class="btn-edit">
                                            <a href="order_detail.php?id=<?php echo $order['SoDonDH']; ?>&status=<?php echo $status;?>" class="button-edit btn-update">Chi tiết</a>
                                        </td>
                                    </tr>
                                    <?php
                                            // }
                                            $i++;
                                        }
                                     ?>
                                </tbody>
                            </table>
                        </div>
                            <?php }else
                                echo '<div class="no-item"><h2 class="no_item-title">Không có đơn hàng nào</h2></div>';
                            ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- <script type="text/javascript" src="./asset/bootstrap/js/bootstrap.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>