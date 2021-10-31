<?php
include("connection.php");
session_start();
$sql = "SELECT * FROM `KhachHang`";
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
                    <h2>Quản lý khách hàng</h2>
                    <a href="customer_insert.php" class="container-title_btn">
                        <div class="button button-general title-btn">Thêm khách hàng</div>
                    </a>
                </div>

                <div class="main-content">
                    <div class="main-list">
                        <div class="main-content_control">
                            <div class="content-title">Danh sách khách hàng:</div>
                        </div>
                        <div class="main-table">
                            <table class="main-table_content">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã số khách hàng</th>
                                        <th>Tên khách hàng</th>
                                        <th>Địa chỉ</th>
                                        <th>Số điện thoại</th>
                                        <th>Email</th>
                                        <th colspan="1" class="btn-edit">Tùy chọn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1;
                                    while($customer = mysqli_fetch_array($rs)){
                                    ?>
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $customer['MSKH']?></td>
                                        <td><?php echo $customer['HoTenKH']?></td>
                                        <td><?php echo $customer['DiaChi']?></td>
                                        <td><?php echo $customer['SoDienThoai']?></td>
                                        <td><?php echo $customer['Email']?></td>
                                        <td class="btn-edit">
                                            <a href="customer_upd.php?id=<?php echo $customer['MSKH']; ?>" class="button-edit btn-update">Chi tiếtt</a>
                                            <button class="button-edit btn-delete" value="<?php echo $staff['MSNV'];?>">Xóa</button><a href="process.php?action=delete-customer&id=<?php echo $customer['MSKH']; ?>" class="button-edit btn-delete">Xóa</a>
                                        </td>
                                    </tr>
                                    <?php $i++;}?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- =============== SCRIPT =============== -->
    <script src="./asset/jquery/jquery.js"></script>
    <!-- <script src="./asset/jquery/main.js"></script> -->
    <script>
        // Ajax
        // Delete Staff
        $(".btn-delete").click(function(event) {
            var id = $(this).val();
            event.preventDefault();
            $.ajax({
                type: "POST",
                url: "./process.php?del-staff",
                data: {id:id},
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
    </script>
</body>
</html>