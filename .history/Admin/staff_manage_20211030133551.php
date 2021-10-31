<?php
include("connection.php");
session_start();
$sql = "SELECT * FROM `NhanVien`";
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
                    <h2>Quản lý nhân viên</h2>
                    <a href="staff_insert.php" class="container-title_btn">
                        <div class="button button-general title-btn">Thêm nhân viên</div>
                    </a>
                </div>

                <div class="main-content">
                    <div class="main-list">
                        <div class="main-content_control">
                            <div class="content-title">Danh sách nhân viên:</div>
                        </div>
                        <div class="main-table">
                            <table id="staff-list" class="main-table_content">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã số nhân viên</th>
                                        <th>Tên nhân viên</th>
                                        <th>Địa chỉ</th>
                                        <th>Số điện thoại</th>
                                        <th colspan="1" class="btn-edit">Tùy chọn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1;
                                    while($staff = mysqli_fetch_array($rs)){
                                    ?>
                                    <tr>
                                        <td><?php echo $i;?></td>
                                        <td><?php echo $staff['MSNV']?></td>
                                        <td><?php echo $staff['HoTenNV']?></td>
                                        <td><?php echo $staff['DiaChi']?></td>
                                        <td><?php echo $staff['SoDienThoai']?></td>
                                        <td class="btn-edit">
                                            <a href="staff_upd.php?id=<?php echo $staff['MSNV']; ?>" class="button-edit btn-update">Chi tiếtt</a>
                                            <button id="del-staff" class="button-edit btn-delete" value="<?php echo $staff['MSNV'];?>">Xóa</button>
                                            <!-- <a id="del-staff" href="process.php?action=delete-staff&id=<?php echo $staff['MSNV'];?>" class="button-edit btn-delete">Xóa</a> -->
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
        // Insert Brand
        $("#del-staff").click(function(event) {
            var id = $(this).val();
            alert(id);
            event.preventDefault();
            // $.ajax({
            //     type: "POST",
            //     url: "./process.php?del-staff",
            //     data: (id:id),
            //     success: function(response) {
            //         response = JSON.parse(response);
            //         if (response.status == "0") {
            //             alert(response.message);
            //             console.log(response.message);
            //         } else {
            //             alert(response.message);
            //             location.reload();
            //         }
            //     }
            // });
        });
    </script>
</body>
</html>