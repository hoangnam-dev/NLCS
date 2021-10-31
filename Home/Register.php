<?php
include("./connection.php");
// $user = (isset($_SESSION['user'])) ? $_SESSION['user'] : [];
// if(empty($user)){
//   $check = 0;
// }else{
//   $check = 1;
// }
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
  // include("./header.php");


  ?>

  <!-- Modal Layout -->
  <div class="modal" style="display: flex;">
    <div class="modal_overlay"></div>
    <div class="modal_body">
      <div class="form-general">
        <form action="./process.php" class="form" method="POST" role="form">
          <div class="form-container">
            <div class="form_header">
              <h3 class="form_heading">Đăng Ký</h3>
              <span class="form_switch-btn">Đăng Nhập</span>
            </div>
            <div class="form_group">
              <input id="phone" type="text" class="form_input" name="phone" placeholder="Số Điện thoại" />
              <span class="error-message" id="error-phone"></span>
            </div>
            <div class="form_group">
              <input id="name" type="text" class="form_input" name="name" placeholder="Họ và tên" />
              <span class="error-message" id="error-name"></span>
            </div>
            <div class="form_group">
              <input id="address" type="text" class="form_input" name="address" placeholder="Địa chỉ" />
              <span class="error-message" id="error-address"></span>
            </div>
            <div class="form_group">
              <input id="password" type="password" class="form_input" name="password" placeholder="Mật Khẩu" />
              <span class="error-message" id="error-password"></span>
            </div>
            <div class="form_group">
              <input id="repassword" type="password" class="form_input" name="repassword" placeholder="Nhập lại Mật Khẩu" />
              <span class="error-message" id="error-repassword"></span>
            </div>
            <div class="form_policy">
              <span>
                Bằng cách ấn vào nút “ĐĂNG KÝ”, tôi đồng ý với
                <a href="" class="policy-link"> Điều Khoản Sử Dụng </a>và
                <a href="" class="policy-link">Chính Sách Bảo Mật của chúng tôi</a></span>
            </div>
            <div class="form_control">
              <button type="button" onclick='window.open("./index-demo.php", "_self");' class="button form_control-back button-normal">
                Trở Lại
              </button>
              <input type="submit" onclick="return Validate();" class="button button_general lg_submit" value="Đăng Ký"></input>
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
  <!-- <div>
  <form action="./cart.php" class="fromtest" method="POST">
    <input type="submit" id="btntest" class="button button-general" onclick="return userlogin();"> test</input>
  </form>
</div> -->





  <script>
    // function userlogin(){
    //   // var user = getElement('user');
    //   if(userlg == 0){
    //     var popupLogin = document.getElementById("btntest");
    //     // Thêm sự kiện cho đối tượng
    //     popupLogin.addEventListener("click", function() {
    //         popupOpen("modalLg");
    //     });

    //   }else{
    //     alert('oke');
    //   }
    // return false
    // }


    function getElement(id) {
      return document.getElementById(id).value.trim();
    }

    function showwErr(key, message) {
      document.getElementById('error-' + key).innerHTML = message;
    }

    function Validate() {
      var phone = getElement('phone');
      var name = getElement('name');
      var address = getElement('address');
      var password = getElement('password');
      var repassword = getElement('repassword');
      // alert(phone);
      // alert(name);
      // alert(address);
      // alert(password);
      // alert(repassword);
      var flag = true;

      if (phone != '') {
        if (!/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im.test(phone)) {
          flag = false;
          message = "Vui lòng kiểm tra lại số điện thoại của bạn"
          showwErr('phone', message);
        } else {
          showwErr('phone', '');
        }
      } else {
        flag = false;
        message = "Vui lòng nhập vào số điện thoại của bạn"
        showwErr('phone', message);
      }

      if (name != '') {
        if (!/[a-zA-Z0-9]/.test(name)) {
          flag = false;
          message = "Vui lòng nhập vào họ tên của bạn"
          showwErr('name', message);
        } else {
          showwErr('name', '');
        }
      } else {
        flag = false;
        message = "Vui lòng nhập vào họ tên của bạn"
        showwErr('name', message);
      }

      if (address == '') {
        flag = false;
        message = "Vui lòng nhập vào địa chỉ của bạn"
        showwErr('address', message);
      } else {
        showwErr('address', '');
      }

      if (password == '') {
        flag = false;
        message = "Vui lòng nhập vào mật khẩu của bạn"
        showwErr('password', message);
      } else {
        showwErr('password', '');
      }
      if (repassword != '') {
        if (repassword != password) {
          flag = false;
          message = "Vui lòng kiểm tra lại Mật khẩu nhập lại"
          showwErr('repassword', message);
        } else {
          showwErr('repassword', '');
        }
      } else {
        flag = false;
        message = "Trường này không được để trống"
        showwErr('repassword', message);
      }
      return flag;
    }
  </script>
  <!-- <script src="./asset/jquery/main.js"></script> -->
  <script src="./asset/jquery/jquery.js"></script>
</body>

</html>