<?php

session_start();
$id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : null; 
if (!isset($_SESSION['user_email']) || $_SESSION['user_role'] !== 'user') {
    echo '<meta http-equiv="refresh" content="0;url=Category.php">';
    exit(); 
}
?>
<?php

include("../CLASS/Xuatttsanpham.php");
$p = new dulieu(); 
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Chạy Đi Shop</title>
    <link rel="stylesheet" href="../CSS/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/base.css">
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/footer.css">
    <link rel="stylesheet" href="../CSS/modal_dk.css">
    <link rel="stylesheet" href="../CSS/modal_dn.css">
    <link rel="stylesheet" href="../CSS/sanphamm.css">
    <link rel="stylesheet" href="../CSS/thongtindonhang.css">
    <script src="../JS/jquery-3.7.1.min.js" defer></script>
    <script src="../JS/bootstrap.bundle.min.js" defer></script>
    <script src="../JS/nav.js" defer></script>
    <script src="../JS/table.js" defer></script>
    <script src="../JS/passwordToggle.js" defer></script>
    <script src="../JS/login.js" defer></script>
    <script src="../JS/createAccount.js" defer></script>
    <script src="../JS/modalSwitch.js" defer></script>
    <script src="../JS/donhangchitiet.js" defer></script>
    <link rel="stylesheet" href="../CSS/luxe.css">
</head>

<body>
 <!-- header -->
 <div class="container-header">
  <?php

      $p->linkheader()
    ?>
    <div class="top-nap row">
      <div class="row">
        <div class="col-3 map pt-1">
          <div class="icon-map">
            <span><img src="https://i.postimg.cc/9F7XQPxp/OIG3-0j-Nk7-1.jpg" alt="" style="width: 20px;height: 20px; border-radius: 50%;"></span>
            <a href="../PHP/About Us.php">&nbsp;Về chúng tôi</a>
          </div>
        </div>
        <div class="col-6 logo mt-2 pt-1 justify-content-center d-flex"  >
          <h4 class="text-uppercase text-center fw-bold">
            <?php

                $link = "index.php";
                if ($id_user) {
                    $link .= "?id_user=" . $id_user;
                }
              ?>
            <a href="<?php
 echo $link; ?>" style="text-decoration: none;">Chạy Đi Shop</a>
          </h4>
        </div>
        <div class=" col-3 icon d-flex justify-content-end pt-2" >
          <i class=" d-none d-md-inline">
            <a href="#" id="searchIcon">
              <img src="https://i.postimg.cc/jSYxwWmr/timkiem.png" alt="Tìm kiếm" id="timkiem" >
            </a>
          </i>
          <i>
            <?php

            if ($id_user) {
              $p->anhdaidien("SELECT * FROM login_user WHERE user_id = $id_user");
            } 
            else {
              echo '<a href="#"><img src="https://i.postimg.cc/kgNnxJPR/nutdangnhap.png" alt="Đăng nhập" id="nutdangnhap"></a>';
            }
            ?>
          </i>
          <i>
            <?php

                $links = "Bag.php";
                if ($id_user) {
                    $links .= "?id_user=".$id_user;
                }
                echo '<a href="'.$links.'"><img src="https://i.postimg.cc/pd2PCwPG/giohang.png" alt="Giỏ hàng" id="giohang"></a>';
            ?>
            
          </i>
        </div>
      </div>
      <div class="row">
        <div class="bottom-nap row col-12 d-flex justify-content-center">
          <ul>
            <li><a href="#">Bộ sưu tập thể thao</a></li>
            <li><a href="#">Đồ chạy bộ</a></li>
            <li><a href="#">Đồ gym & training</a></li>
            <li><a href="#">Giày & phụ kiện</a></li>
          </ul>
        </div>
      </div>
    </div>      
  </div>

<!-- nút tìm kiếm -->
<div id="searchTable" >
    <div class="row">
      <div class="col-12 d-flex justify-content-center "><input type="search" class="form-control" placeholder="Tìm kiếm..." aria-label="Tìm kiếm">
        <button type="button" class="btn-close pt-4 align-items-lg-start" data-bs-dismiss="modal" aria-label="Close"></button></div>
      
    </div>
</div>
  <!-- table đăng kí, đăng nhập -->
  <div id="loginTable" class="d-none">
    <div class="table-container" style="position: absolute; top: 50px; right: 0;">
      <h5 class="table-title" style="color: #504f4f;">CHÀO MỪNG</h5>
      <div class="row">
        <tr>
          <?php

            if ($id_user) {
              echo'<td><a href="../CLASS/logout.php" id="dangxuat">Đăng xuất</a></td>';
              ;
            } 
            else {
              echo '<td><a href="#" id="dangnhap">Đăng nhập</a></td>';
            }
          ?>
        </tr>
      </div>
      <div class="row">
        <tr>
          <td>
            <a href="#" id="dangky">Tạo tài khoản</a>
            <p style="font-size: 9px;">Thành viên nhận ưu đãi VIP và được xem trước sản phẩm mới</p>
          </td>
        </tr>
      </div>
    </div>
  </div>
  <!-- modal đăng kí -->
  <div class="row">
    <div class="modal fade" id="createAccountModal" tabindex="-1" aria-labelledby="ModalFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content" id="register-modal-content">
            <div class="modal-body" id="register-modal-body">
                <button type="button" class="btn-close " id="dong_dk" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="myform bg-white">
                    <h1 class="text-center text-uppercase ">trở thành thành viên</h1>
                    <div class="bullet-container">
                        <div class="bullet-item">
                            <div class="buller-point"></div>
                            <div class="post-header-text">Theo dõi tác động của đơn hàng</div>
                        </div>
                        <div class="bullet-item">
                            <div class="buller-point"></div>
                            <div class="post-header-text">Đăng ký nhận ưu đãi VIP</div>
                        </div>
                        <div class="bullet-item">
                            <div class="buller-point"></div>
                            <div class="post-header-text">Nhận quyền truy cập sớm sản phẩm mới</div>
                        </div>
                    </div>
  
                    <form id="registerForm">
                      <div class="mb-3 mt-5">
                          <label for="exampleInputFirstName" class="form-label">Tên</label>
                          <input type="text" class="form-control" id="exampleInputFirstName" name="exampleInputFirstName" aria-describedby="firstNameError">
                          <span id="firstNameError" class="error-message" style="color: red;"></span>
                      </div>
                      <div class="mb-3 mt-4">
                          <label for="exampleInputLastName" class="form-label">Họ</label>
                          <input type="text" class="form-control" id="exampleInputLastName" name="exampleInputLastName" aria-describedby="lastNameError">
                          <span id="lastNameError" class="error-message" style="color: red;"></span> 
                      </div>
                      <div class="mb-3 mt-4">
                          <label for="exampleInputEmail" class="form-label">Địa chỉ Email</label>
                          <input type="email" class="form-control" id="exampleInputEmail" name="exampleInputEmail" aria-describedby="emailError">
                          <span id="emailError" class="error-message" style="color: red;"></span> 
                      </div>
                      <div class="mb-3 mt-4">
                          <label for="exampleInputPassword" class="form-label">Mật khẩu</label>
                          <input type="password" class="form-control" id="exampleInputPassword" name="exampleInputPassword" aria-describedby="passwordError">
                          <span id="passwordError" class="error-message" style="color: red;"></span> 
                          <span onclick="togglePassword('exampleInputPassword', 'togglePasswordIcon')" class="eye-icon1" style="cursor: pointer;">
                              <img src="https://i.postimg.cc/1X6pBnHZ/eyeOpen.png" id="togglePasswordIcon" alt="Bật/tắt mật khẩu">
                          </span>
                      </div>
                      <div class="mb-3 mt-4">
                          <label for="<div class="mb-3 mt-4">
                          <div class="d-flex align-items-center gap-2">
<?php

session_start();
$id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : null; 
if (!isset($_SESSION['user_email']) || $_SESSION['user_role'] !== 'user') {
    echo '<meta http-equiv="refresh" content="0;url=Category.php">';
    exit(); 
}
?>
<?php

include("../CLASS/Xuatttsanpham.php");
$p = new dulieu(); 
?>









