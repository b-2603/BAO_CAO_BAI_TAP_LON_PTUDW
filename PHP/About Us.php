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
    <link rel="stylesheet" href="../CSS/modal_chi_tiet_san_pham.css">
    <script src="../JS/jquery-3.7.1.min.js" defer></script>
    <script src="../JS/bootstrap.bundle.min.js" defer></script>
    <script src="../JS/nav.js" defer></script>
    <script src="../JS/table.js" defer></script>
    <script src="../JS/passwordToggle.js" defer></script>
    <script src="../JS/login.js" defer></script>
    <script src="../JS/createAccount.js" defer></script>
    <script src="../JS/modalSwitch.js" defer></script>
    <link rel="stylesheet" href="../CSS/luxe.css">
</head>
<body class="about-sport">
    
<!-- header -->
<div class="container-header">
    <div class="banner row text-center text-white mb-0">
      <a id="shop-link" href="Category.php?id_chinh=1" style="text-decoration: none;">
          <p class="text-white mt-1">Đang mở:
              <span id="shop-name" class="text-white mt-1 fw-bold">BỘ SƯU TẬP THỂ THAO</span>
              <i class="bi bi-arrow-right text-white"></i>
          </p>
      </a>
    </div>
    <div class="ct5 pt-5 pb-5" style="display: flex; align-items: center; justify-content: center;">
        <hr class="mt-4 pt-2 mx-5" style="width: 20%; margin: 0;">
        <h5 class="text-uppercase text-center fw-bold" style="letter-spacing: 20px;">
          Chạy Đi Shop
        </h5>
        <hr class="mt-4 pt-2 mx-5" style="width: 20%; margin: 0;">
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
                          <input type="text" class="form-control" id="exampleInputFirstName" name="firstName" aria-describedby="firstNameError">
                          <span id="firstNameError" class="error-message" style="color: red;"></span>
                      </div>
                      <div class="mb-3 mt-4">
                          <label for="exampleInputLastName" class="form-label">Họ</label>
                          <input type="text" class="form-control" id="exampleInputLastName" name="lastName" aria-describedby="lastNameError">
                          <span id="lastNameError" class="error-message" style="color: red;"></span> 
                      </div>
                      <div class="mb-3 mt-4">
                          <label for="exampleInputEmail" class="form-label">Địa chỉ Email</label>
                          <input type="email" class="form-control" id="exampleInputEmail" name="email" aria-describedby="emailError">
                          <span id="emailError" class="error-message" style="color: red;"></span> 
                      </div>
                      <div class="mb-3 mt-4">
                          <label for="exampleInputPassword" class="form-label">Mật khẩu</label>
                          <input type="password" class="form-control" id="exampleInputPassword" name="password" aria-describedby="passwordError">
                          <span id="passwordError" class="error-message" style="color: red;"></span> 
                          <span onclick="togglePassword('exampleInputPassword', 'togglePasswordIcon')" class="eye-icon1" style="cursor: pointer;">
                              <img src="https://i.postimg.cc/1X6pBnHZ/eyeOpen.png" id="togglePasswordIcon" alt="Bật/tắt mật khẩu">
                          </span>
                      </div>
                      <button type="submit" class="btn mt-4">TẠO TÀI KHOẢN</button>
                      <p class="p_modal" style="font-size: 15px;">Đã có tài khoản?<a href="#" class="modal_link_login">Đăng nhập</a></p>
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
                          <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
                          <span id="emailError" class="text-danger error-message" style="color: red;"></span> 
                      </div>
                      <div class="mb-3">
                          <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
                          <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                          <span onclick="togglePassword('exampleInputPassword1', 'togglePasswordIcon1')" class="eye-icon" style="cursor: pointer;">
                            <img src="https://i.postimg.cc/1X6pBnHZ/eyeOpen.png" id="togglePasswordIcon1" alt="Bật/tắt mật khẩu" >
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

<!-- Phần nội dung -->
<div class="content">
  <div class="ct1 row g-0 about-hero">
    <div class="row g-0">
        <div class="col-12 about-hero-inner">
          <!-- Video background -->
          <!-- <video autoplay muted loop style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
            <source src="../IMAGES/video giới thiệu website.mp4" type="video/mp4">
          </video> -->
            <img src="https://images.pexels.com/photos/163401/baseball-slide-second-base-player-163401.jpeg" alt="Vận động viên trượt base">

      
          <!-- Content over video -->
          <div class="about-hero-content">
            <h1 class="line-heading pb-3">
                THỜI TRANG THỂ THAO CÓ CÂU CHUYỆN
            </h1>
            <p>Trang phục hiệu năng cao cho mọi hành trình vận động.</p>
            <a class="pt-3" href="index.php" style="text-decoration: none;">
              <button type="button">
                <strong>TRANG CHỦ</strong>
              </button>
            </a>
          </div>
        </div>
      </div>
    <div class="col-12 about-intro">
      <p class="pt-4"> <em><strong>Người sáng lập website</strong></em></p>
      <p><em>Chúng tôi là những người sáng lập Chạy Đi Shop, một website thời trang thể thao giúp bạn tự tin vận động và thể hiện phong cách năng động. Chúng tôi cam kết mang đến sản phẩm chất lượng cao, tối ưu hiệu năng và cảm giác thoải mái.</em></p>
    </div>
</div>
  <div class="ct2 about-team">
    <div class="product-list">
      <div class="row px-5 g-5">
        <div class="col-12 col-md-4 px-2">
          <div class="product-item horizontal-product-item" style="position: relative;">
            <div class="product-image">
              <img src="https://images.pexels.com/photos/5384619/pexels-photo-5384619.jpeg" class="main-img" alt="Sản phẩm 1">
              <img src="https://images.pexels.com/photos/5384619/pexels-photo-5384619.jpeg" class="hover-img" alt="Sản phẩm 1">
            </div>
            <h2 class="product-name horizontal-product-item text-center" style="position: absolute; bottom: 10px; left: 50%; transform: translateX(-50%);">
              <a href="" target="_blank" style="text-decoration: none;">
                <button type="button" style="background-color: white; color: #6f4f37; padding: 10px 20px; border: none; border-radius: 5px; font-size: 1rem; cursor: pointer;">
                  <strong>Lê Quốc Khánh</strong>
                </button>
              </a>
            </h2>
          </div>
        </div>

        <div class="col-12 col-md-4 px-2">
          <div class="product-item horizontal-product-item" style="position: relative;">
            <div class="product-image">
              <img src="https://images.pexels.com/photos/1103833/pexels-photo-1103833.jpeg" class="main-img" alt="Sản phẩm 2">
              <img src="https://images.pexels.com/photos/1103833/pexels-photo-1103833.jpeg" class="hover-img" alt="Sản phẩm 2">
            </div>
            <h2 class="product-name horizontal-product-item text-center" style="position: absolute; bottom: 10px; left: 50%; transform: translateX(-50%);">
              <a href="" target="_blank" style="text-decoration: none;">
                <button type="button" style="background-color: white; color: #6f4f37; padding: 10px 20px; border: none; border-radius: 5px; font-size: 1rem; cursor: pointer;">
                  <strong>Nguyễn Trần Thái Bảo</strong>
                </button>
              </a>
            </h2>
          </div>
        </div>

        <div class="col-12 col-md-4 px-2">
          <div class="product-item horizontal-product-item" style="position: relative;">
            <div class="product-image">
              <img src="https://images.pexels.com/photos/27862760/pexels-photo-27862760.jpeg" class="main-img" alt="Sản phẩm 3">
              <img src="https://images.pexels.com/photos/27862760/pexels-photo-27862760.jpeg" class="hover-img" alt="Sản phẩm 3">
            </div>
            <h2 class="product-name horizontal-product-item text-center" style="position: absolute; bottom: 10px; left: 50%; transform: translateX(-50%);">
              <a href="https://www.facebook.com/share/186GNsqWSH/" target="_blank" style="text-decoration: none;">
                <button type="button" style="background-color: white; color: #6f4f37; padding: 10px 20px; border: none; border-radius: 5px; font-size: 1rem; cursor: pointer;">
                  <strong>Tống Hiểu Khiêm</strong>
                </button>
              </a>
            </h2>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="ct3">
    <div class="about-story">
      <img src="https://images.pexels.com/photos/5247137/pexels-photo-5247137.jpeg" alt="Không khí tập luyện thể thao">
  
      <div class="about-story-content">
          <h1 class="line-heading pb-3">  
            Hành trình của Chạy Đi Shop: Từ khởi đầu khiêm tốn đến phong cách thể thao dẫn đầu
          </h1>
          <p>Chạy Đi Shop bắt đầu từ một ý tưởng nhỏ, được thúc đẩy bởi mong muốn mang thời trang thể thao chất lượng đến mọi người. Những ngày đầu, chúng tôi chỉ có vài sản phẩm cơ bản, nhưng đằng sau mỗi thiết kế là niềm đam mê với sự linh hoạt, thoáng khí và cảm giác vận động. Với các sản phẩm được tuyển chọn kỹ lưỡng, Chạy Đi Shop dần xây dựng niềm tin và sự gắn bó với khách hàng. Chúng tôi không chỉ bán quần áo; chúng tôi truyền cảm hứng để mọi người sống năng động và tự tin hơn. Hành trình không phải lúc nào cũng dễ dàng, nhưng nhờ sự tận tâm và cam kết chất lượng, Chạy Đi Shop ngày càng vững mạnh. Từ một lựa chọn khiêm tốn, giờ đây chúng tôi đã mở rộng thành nhiều phong cách thể thao đa dạng. Mỗi bộ sưu tập kể một câu chuyện về nỗ lực và đam mê, giúp khách hàng tìm được món đồ hoàn hảo cho buổi tập và cuộc sống hằng ngày. Chúng tôi tự hào về chặng đường đã qua và luôn nỗ lực mang đến sản phẩm chất lượng cao, bền bỉ. Chạy Đi Shop là kết quả của ước mơ, sáng tạo và tình yêu dành cho thể thao. Chúng tôi sẽ tiếp tục tiến bước, mở rộng và cải thiện mỗi ngày để phục vụ khách hàng tốt hơn.</p>
          <a class="pt-3" href="Category.php?id_chinh=1" style="text-decoration: none;">
              <button type="button">
                  <strong>THỂ THAO</strong>
              </button>
          </a>
      </div>
  </div>
</div>
<div class="ct4 pt-3 about-values" style="position: relative; min-height: 520px; display: flex; background: linear-gradient(to bottom, white 0%, rgba(255, 255, 255, 0.82) 40%, rgba(255, 255, 255, 0.55) 60%, rgba(255, 255, 255, 0) 100%), url('https://images.pexels.com/photos/9153332/pexels-photo-9153332.jpeg'); background-size: cover; background-position: center center; background-repeat: no-repeat; text-align: center; color: #6f4f37; padding: 5rem 1rem;"> 
  <div class="pt-5 about-values-inner">
    <p style="margin-bottom: 1rem;">Chúng tôi tin rằng trang phục thể thao chỉ thật sự tốt khi cảm giác vận động cũng tuyệt vời.</p>
    <p>Mỗi bộ sưu tập đều sử dụng chất liệu cao cấp, bền bỉ và thoáng khí cho hiệu năng tối ưu.</p>
  </div>
</div>

<div class="ct5 pt-5 pb-5" style="display: flex; align-items: center; justify-content: center;">
  <hr class="mt-4 pt-2 mx-5" style="width: 20%; margin: 0;">
  <h5 class="text-uppercase text-center fw-bold" style="letter-spacing: 20px;">
    Chạy Đi Shop
  </h5>
  <hr class="mt-4 pt-2 mx-5" style="width: 20%; margin: 0;">
</div>
</div>

</body>
</html>


