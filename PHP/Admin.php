<?php
session_start();
if (!isset($_SESSION['admin_email']) || $_SESSION['user_role'] !== 'admin') {
    echo '<meta http-equiv="refresh" content="0;url=index.php">';
    exit(); 
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Trang Quản Trị</title>
  <link rel="stylesheet" href="../CSS/bootstrap.min.css">
  <link rel="stylesheet" href="../CSS/base.css">
  <link rel="stylesheet" href="../CSS/footer.css">
  <link rel="stylesheet" href="../CSS/modal_dk.css">
  <link rel="stylesheet" href="../CSS/modal_dn.css">
  <link rel="stylesheet" href="../CSS/sanphamm.css">
  <link rel="stylesheet" href="../CSS/homee.css">
  <link rel="stylesheet" href="../CSS/chitietsanphamm.css">
  <link rel="stylesheet" href="../CSS/ad_qldonhang.css">
  <link rel="stylesheet" href="../CSS/ad_themsp.css">
  <link rel="stylesheet" href="../CSS/ad_thongkee.css">
  <link rel="stylesheet" href="../CSS/homee.css">
  <link rel="stylesheet" href="../CSS/admin.css">
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
<body>

<!-- Thanh Điều Hướng -->
  <nav class="qt-thanhdieuhuong navbar navbar-expand-lg navbar-dark px-4">
    <a class="qt-logo navbar-brand" href="#">BẢNG ĐIỀU KHIỂN ADMIN</a>
    <div class="ms-auto d-flex align-items-center gap-3">
      <span class="text-white">👤 Xin chào, Admin</span>
      <div class="btn qt-nutdangxuat"><a href="../CLASS/logout.php" id="dangxuat">Đăng xuất</a></div>
    </div>
  </nav>
  <!--phần nội dung -->
<<<<<<< HEAD
  <!-- Thanh Bên -->
  <div class="qt-thanhben">
    <a onclick="loadPage('ajax_load/trangkhach.php')">🏠 Trang Khách</a>
    <a onclick="loadPage('ajax_load/qlsanpham.php')">📦 Thêm sản phẩm</a>
    <a onclick="loadPage('ajax_load/qldonhang.php')">🧾 Quản lý đơn hàng</a>
    <a onclick="loadPage('ajax_load/thongke.php')">📊 Thống kê</a>
  </div>
  <!-- Nội Dung Chính -->
  <div class="qt-noidungchinh" id="content">
    <h4 class="mb-3">📋 Tổng Quan Hệ Thống</h4>
    <h2 class="fw-bold text-dark mb-3">👋 Xin chào, Admin!</h2>
=======
  <div class="container-fluid p-0 m-0">
    <div class="row gx-0">
      <!-- Thanh Bên -->
      <div class="col-md-3 qt-thanhben">
        <a onclick="loadPage('ajax_load/trangkhach.php')">🏠 Trang Khách</a>
        <a onclick="loadPage('ajax_load/qlsanpham.php')">📦 Thêm sản phẩm</a>
        <a onclick="loadPage('ajax_load/qldonhang.php')">🧾 Quản lý đơn hàng</a>
        <a onclick="loadPage('ajax_load/thongke.php')">📊 Thống kê</a>
      </div>
      <!-- Nội Dung Chính -->
      <div class="col-md-9 qt-noidungchinh" id="content">
        <h4 class="mb-3">📋 Tổng Quan Hệ Thống</h4>
        <h2 class="fw-bold text-dark mb-3">👋 Xin chào, Admin!</h2>
    </div>
>>>>>>> 1e04d946ee1b11827e820da189420f51ca0a5a0e
  </div>

<!-- xử lý để chiếu file điều hướng vào một chỗ cố định để không đẩy đi trang khác -->
  <script>
    function loadPage(file) {
      fetch(file)
        .then(res => res.text())
        .then(html => {
          document.getElementById('content').innerHTML = html;
        })
        .catch(err => {
          document.getElementById('content').innerHTML = "<div class='alert alert-danger'>Không thể tải nội dung.</div>";
        });
    }
    function xemChiTietDon(dh_id) {
    loadPage('ajax_load/chitietdonhang.php?dh_id=' + dh_id);
  }
  </script>

</body>
</html>




<<<<<<< HEAD
=======

>>>>>>> 1e04d946ee1b11827e820da189420f51ca0a5a0e
