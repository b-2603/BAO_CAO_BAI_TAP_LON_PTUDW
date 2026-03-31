<?php
session_start();
$id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : null;
$sp_id = isset($_GET['sp_id']) ? (int)$_GET['sp_id'] : 0;

include("../CLASS/Xuatttsanpham.php");
$p = new dulieu();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chạy Đi Shop</title>
    <link rel="stylesheet" href="../CSS/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/base.css">
    <link rel="stylesheet" href="../CSS/header.css">
    <link rel="stylesheet" href="../CSS/footer.css">
    <link rel="stylesheet" href="../CSS/modal_dk.css">
    <link rel="stylesheet" href="../CSS/modal_dn.css">
    <link rel="stylesheet" href="../CSS/sanphamm.css">
    <link rel="stylesheet" href="../CSS/chitietsanphamm.css">
    <link rel="stylesheet" href="../CSS/luxe.css">
    <script src="../JS/jquery-3.7.1.min.js" defer></script>
    <script src="../JS/bootstrap.bundle.min.js" defer></script>
    <script src="../JS/nav.js" defer></script>
    <script src="../JS/table.js" defer></script>
    <script src="../JS/passwordToggle.js" defer></script>
    <script src="../JS/login.js" defer></script>
    <script src="../JS/createAccount.js" defer></script>
    <script src="../JS/modalSwitch.js" defer></script>
</head>
<body>
 <!-- header -->
 <div class="container-header">
  <?php $p->linkheader(); ?>
    <div class="top-nap row">
      <div class="row">
        <div class="col-3 map pt-1">
          <div class="icon-map">
            <span><img src="https://i.postimg.cc/9F7XQPxp/OIG3-0j-Nk7-1.jpg" alt="" style="width: 20px;height: 20px; border-radius: 50%;"></span>
            <a href="../PHP/About Us.php">&nbsp;Về chúng tôi</a>
          </div>
        </div>
        <div class="col-6 logo mt-2 pt-1 justify-content-center d-flex">
          <h4 class="text-uppercase text-center fw-bold">
            <?php
                $link = "index.php";
                if ($id_user) {
                    $link .= "?id_user=" . $id_user;
                }
            ?>
            <a href="<?php echo $link; ?>" style="text-decoration: none;">Chạy Đi Shop</a>
          </h4>
        </div>
        <div class="col-3 icon d-flex justify-content-end pt-2">
          <i class="d-none d-md-inline">
            <a href="#" id="searchIcon">
              <img src="https://i.postimg.cc/jSYxwWmr/timkiem.png" alt="Tìm kiếm" id="timkiem">
            </a>
          </i>
          <i>
            <?php
              if ($id_user) {
                $p->anhdaidien("SELECT * FROM login_user WHERE user_id = $id_user");
              } else {
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
<div id="searchTable">
  <div class="row">
    <div class="col-12 d-flex justify-content-center">
      <input type="search" class="form-control" placeholder="Tìm kiếm..." aria-label="Tìm kiếm">
      <button type="button" class="btn-close pt-4 align-items-lg-start" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
  </div>
</div>

<!-- nav màn hình to -->
<nav class="navbar navbar-expand-lg" id="navbar-bottom">
  <div class="container-fluid">
    <div class="row">
      <div class="col-1 mx-3 custom-padding">
        <button class="navbar-toggler" type="button" data-bs-toggle="modal" data-bs-target="#navbarModal" aria-controls="navbarModal" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
      <div class="col-6 custom-padding">
        <div class="input-group d-block d-md-none" id="searchBar" style="flex-grow: 1; margin-top: 0;">
          <input type="search" class="form-control" placeholder="Tìm kiếm..." aria-label="Tìm kiếm" style="width: 520px; margin: 0;">
        </div>
      </div>
    </div>
    <div class="nav collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav m-auto mb-2 mb-lg-0">
        <?php $p->xuatdsdanhmuc("select * from danhmuc"); ?>
      </ul>
    </div>
  </div>
</nav>

<!-- Modal menu khi mở màn hình nhỏ -->
<div class="modal fade" id="navbarModal" tabindex="-1" aria-labelledby="navbarModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title mx-3" id="navbarModalLabel" style="color: #504f4f;">DANH MỤC</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <ul class="navbar-nav">
          <?php $p->xuatmenumannho("select * from danhmuc"); ?>
        </ul>
      </div>
    </div>
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
            echo '<td><a href="../CLASS/logout.php" id="dangxuat">Đăng xuất</a></td>';
          } else {
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
          <button type="button" class="btn-close" id="dong_dk" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="myform bg-white">
            <h1 class="text-center text-uppercase">trở thành thành viên</h1>
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
              <button type="submit" class="btn mt-4 disabled" id="createAccountBtn">TẠO TÀI KHOẢN</button>
              <p class="p_modal" style="font-size: 15px;">Đã có tài khoản?<a href="#" class="modal_link_login">Đăng nhập</a></p>
              <p class="status-message" id="statusMessage" style="font-size: 15px;"></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- modal đăng nhập -->
<div class="row">
  <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="ModalFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content" id="register-modal-content">
        <div class="modal-body" id="register-modal-body">
          <button type="button" class="btn-close" id="dong_dn" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="myform bg-white">
            <h1 class="text-center text-uppercase">Xin chào</h1>
            <form id="loginForm">
              <div class="mb-3 mt-5">
                <label for="exampleInputEmail1" class="form-label">Địa chỉ Email</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="exampleInputEmail1" required>
                <span id="emailError" class="text-danger error-message" style="color: red;"></span>
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="exampleInputPassword1" required>
                <span onclick="togglePassword('exampleInputPassword1', 'togglePasswordIcon1')" class="eye-icon" style="cursor: pointer;">
                  <img src="https://i.postimg.cc/1X6pBnHZ/eyeOpen.png" id="togglePasswordIcon1" alt="Bật/tắt mật khẩu">
                </span>
                <span id="passwordError" class="text-danger error-message" style="color: red;"></span>
                <p class="mt-1 text-end" style="font-size: 12px;">Quên mật khẩu?
                  <a href="#">Đặt lại</a>
                </p>
              </div>
              <button type="submit" class="btn mt-4">ĐĂNG NHẬP</button>
              <p style="font-size: 14px;">Chưa là thành viên? <a href="#" class="modal_link_createAccount">Đăng ký tài khoản</a></p>
              <div id="loginMessage" class="text-center mt-3 text-success"></div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- phần nội dung -->
<div class="content">
  <div class="container pt-4">
    <?php
      if ($sp_id > 0) {
        $p->xuatthongtinchitiet("SELECT * FROM sanpham WHERE sp_id = $sp_id");
      } else {
        echo '<div class="text-center py-5">Không tìm thấy sản phẩm.</div>';
      }
    ?>
  </div>
</div>

<!-- footer -->
<footer id="footer">
  <div class="footer-top border-top">
    <div class="container-fluid">
      <div class="row d-flex flex-wrap">
        <div class="col-12 col-md-4 footer-contact text-center g-0" style="width: 39.5%;">
          <div class="footernav_contact d-flex align-items-center justify-content-center">
            <ul class="footernav_contact_list">
              <li class="footernav_contact_title text-uppercase pt-4"><strong>Liên hệ</strong></li>
              <li class="footernav_contact_li" id="id1">
                <p>
                  Thứ 2 - Thứ 6: 8:00 - 20:00
                  <br>
                  Thứ 7: 11:00 - 16:00
                </p>
              </li>
              <li class="footernav_contact_li"><a href="" class="footernav_contact_us_phone">Gọi chúng tôi: <span class="footerlink_contact_us_phone">097.114.1140</span></a></li>
              <li class="footernav_contact_li"><a href="" class="footernav_contact_us_email">Email: <span class="footerlink_contact_us_email">hotro@chaydi.shop</span></a></li>
            </ul>
          </div>

          <div class="footernav_NewSeller">
            <h2 class="label">Đăng ký nhận tin</h2>
            <p id="p">Nhận thông báo sớm về bộ sưu tập mới và ưu đãi độc quyền.</p>
            <div class="row mb-3">
              <div class="col">
                <div class="input-group">
                  <input type="email" class="form-control email-input" placeholder="Nhập email" aria-label="Nhập email">
                  <div class="input-group-append">
                    <button class="btn submit-button" type="button">
                      <span>&rarr;</span>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-6 col-md-2 footer-contact" id="footer_contact_help" style="width: 15%;">
          <div class="footer-columns ms-4">
            <strong class="footer-columns_contact_title text-uppercase" style="margin-right: 80px;">Hỗ trợ</strong>
            <ul class="footer-columns_contact_list text-start mt-3">
              <li class="footer-columns_contact_li mt-2"><a href="" class="footer-columns_link">Câu hỏi thường gặp</a></li>
              <li class="footer-columns_contact_li mt-2"><a href="" class="footer-columns_link">Giao hàng & Đổi trả</a></li>
              <li class="footer-columns_contact_li mt-2"><a href="" class="footer-columns_link">Thẻ quà tặng</a></li>
              <li class="footer-columns_contact_li mt-2"><a href="" class="footer-columns_link">Bảo quản & Lắp ráp</a></li>
              <li class="footer-columns_contact_li mt-2"><a href="" class="footer-columns_link">Danh mục</a></li>
            </ul>
          </div>
        </div>

        <div class="col-6 col-md-2 footer-contact" style="width: 17%;">
          <div class="footer-columns ms-2">
            <strong class="footer-columns_contact_title text-uppercase" style="margin-right: 35px;">Chạy Đi Shop</strong>
            <ul class="footer-columns_contact_list text-start mt-3">
              <li class="footer-columns_contact_li mt-2"><a href="" class="footer-columns_link">Câu chuyện</a></li>
              <li class="footer-columns_contact_li mt-2"><a href="" class="footer-columns_link">Đối tác</a></li>
              <li class="footer-columns_contact_li mt-2"><a href="" class="footer-columns_link">Báo chí</a></li>
              <li class="footer-columns_contact_li mt-2"><a href="" class="footer-columns_link">Tuyển dụng</a></li>
              <li class="footer-columns_contact_li mt-2"><a href="" class="footer-columns_link">Chương trình đại sứ</a></li>
              <li class="footer-columns_contact_li mt-2"><a href="" class="footer-columns_link">Chạy Đi Shop - Ký gửi</a></li>
              <li class="footer-columns_contact_li mt-2"><a href="" class="footer-columns_link">Bán sỉ & Quà tặng doanh nghiệp</a></li>
              <li class="footer-columns_contact_li mt-2"><a href="" class="footer-columns_link">Chương trình đối tác</a></li>
            </ul>
          </div>
        </div>

        <div class="col-6 col-md-2 footer-contact" style="width: 13%;">
          <div class="footer-columns ms-2">
            <strong class="footer-columns_contact_title text-uppercase" style="margin-right: 30px;">Thương hiệu</strong>
            <ul class="footer-columns_contact_list text-start mt-3">
              <li class="footer-columns_contact_li mt-2"><a href="" class="footer-columns_link text-start">Havenly</a></li>
              <li class="footer-columns_contact_li mt-2"><a href="" class="footer-columns_link">Intrior Define</a></li>
              <li class="footer-columns_contact_li mt-2"><a href="" class="footer-columns_link">The Inside</a></li>
              <li class="footer-columns_contact_li mt-2"><a href="" class="footer-columns_link">St.Frank</a></li>
            </ul>
          </div>
        </div>

        <div class="col-6 col-md-2 footer-contact" style="width: 14%;">
          <div class="footer-columns ms-2">
            <strong class="footer-columns_contact_title text-uppercase" style="margin-right: 40px;">Cửa hàng</strong>
            <ul class="footer-columns_contact_list text-start mt-3">
              <li class="footer-columns_contact_li mt-2"><a href="" class="footer-columns_link">Quận 1, TP.HCM</a></li>
              <li class="footer-columns_contact_li mt-2"><a href="" class="footer-columns_link">Quận Cầu Giấy, Hà Nội</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid border-top">
      <div class="row" style="width: 100%; height: 50px; position: relative;">
        <div class="col-md-8 col-12 footer_section footer_section">
          <div class="footernav_legal">
            <ul class="footernav_legal_ul">
              <li class="footernav_legal_li"><a href="" class="footernav_legal_link">Điều khoản</a></li>
              <li class="footernav_legal_li"><a href="" class="footernav_legal_link">Bảo mật</a></li>
              <li class="footernav_legal_li"><a href="" class="footernav_legal_link">Trợ năng</a></li>
              <li class="footernav_legal_li"><a href="" class="footernav_legal_link">Không bán thông tin của tôi</a></li>
              <li class="footernav_legal_li"><p href="" class="footernav_legal_copyright">&#169; Chạy Đi Shop 2026, Bản quyền thuộc về cửa hàng</p></li>
            </ul>
          </div>
        </div>
        <div class="col-md-4 col-12 footernav_section_social text-center order-md-last order-first mt-3 mt-md-0">
          <ul class="fooernav_social_ul">
            <li class="footernav_social_li"><a href="" class="footernav_social_link"><img src="https://i.postimg.cc/C12YFdkX/instagram.png" class="bi" alt=""></a></li>
            <li class="footernav_social_li"><a href="" class="footernav_social_link"><img src="https://i.postimg.cc/j52t0ywy/facebook.png" class="bi" id="bi-facebook" alt=""></a></li>
            <li class="footernav_social_li"><a href="" class="footernav_social_link"><i class="bi"> TikTok</i></a></li>
            <li class="footernav_social_li"><a href="" class="footernav_social_link"><img src="https://i.postimg.cc/mZc17HXc/pinterest.png" class="bi" id="bi-pinterest" alt=""></a></li>
            <li class="footernav_social_li"><a href="" class="footernav_social_link"><i class="bi">Journal</i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</footer>

<script>
  function changeImage(el) {
    var main = document.getElementById('mainImage');
    if (main && el && el.src) {
      main.src = el.src;
    }
  }
</script>
<script src="../JS/themsp.js"></script>
<script src="../JS/timkiem.js"></script>
</body>
</html>
