<?php
include("./connection.php");


?>


<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Index Demo-Modal</title>
  <!--Reset CSS -->
  <link rel="stylesheet" href="./asset/normalize.css" />
  <!-- CSS and font of Web -->
  <link rel="stylesheet" href="./asset/base.css" />
  <link rel="stylesheet" href="./asset/main.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="./asset/fonts/fontawesome-free-5.15.4/css/all.min.css" />
</head>

<body>
  <!-- Modal Layout -->
  <div class="modal" style="display: flex;">
    <!-- <div class="modal_overlay"></div> -->
    <div class="modal_body">
      <div class="form-general">
        <form id="form-login" class="form" method="POST" role="form">
          <div class="form-container">
            <div class="form_header">
              <h3 class="form_heading">Đăng Nhập</h3>
              <span class="form_switch-btn">Đăng Ký</span>
            </div>
            <div class="form_group">
              <input type="text" class="form_input" name="phone" placeholder="Số Điện thoại" />
            </div>
            <div class="form_group">
              <input type="password" class="form_input" name="password" placeholder="Mật Khẩu" />
            </div>

            <div class="form_support">
              <a href="" class="form_support-link form_support-forgot">Quên Mật Khẩu</a>
            </div>
            <div class="button form_control">
              <button type="button" onclick='window.open("./index-demo.php", "_self");' class="button form_control-back button-normal">Trở Lại</button>
              <input type="submit" name="submit" class="button button_general" value="Đăng Nhập"></input>
            </div>
          </div>
          <div class="form_socials">
            <a href="" class="button button-s button-icon button_socials-icon-fb">
              <i class="button_socials-icon  fab fa-facebook-f"></i>
              <span class="button_socials-title">Facebook</span>
            </a>
            <a href="" class="button button-s button-icon button_socials-icon-google">
              <i class="button_socials-icon fab fa-google"></i>
              <span class="button_socials-title">Google</span>
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>





  <script src="./asset/jquery/jquery.js"></script>
  <script src="./asset/jquery/main.js"></script>
  <script>
    // Ajax
    var id = "#form-login";
    var url = "./test-be.php?login"
    $(id).submit(function(event) {
      event.preventDefault();
      $.ajax({
        type: "POST",
        url: ủl,
        data: $(this).serializeArray(),
        success: function(response) {
          response = JSON.parse(response);
          if (response.status == '0') {
            alert(response.message);
            console.log(response.message);
          }else{
            alert(response.message);
            location.reload();
          }
        }
      });
    });
  </script>

</body>

</html>