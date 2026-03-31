<?php
session_start();
$id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : null;
if (!isset($_SESSION['user_email']) || $_SESSION['user_role'] !== 'user') {
    echo '<meta http-equiv="refresh" content="0;url=Category.php">';
    exit();
}

include("../CLASS/Xuatttsanpham.php");
$p = new dulieu();

$dh_id = isset($_GET['dh_id']) ? (int)$_GET['dh_id'] : 0;
if ($dh_id <= 0) {
    echo "Không tìm thấy đơn hàng.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn hàng</title>
    <link rel="stylesheet" href="../CSS/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/base.css">
    <link rel="stylesheet" href="../CSS/thongtindonhang.css">
    <link rel="stylesheet" href="../CSS/donhangchitiet.css">
    <link rel="stylesheet" href="../CSS/luxe.css">
</head>
<body>
  <div class="detail-hero">
      <div class="detail-hero__inner">
          <div>
              <p class="detail-eyebrow">Chạy Đi Shop · Chi tiết đơn hàng</p>
              <h1>Đơn hàng #<?php echo $dh_id; ?></h1>
              <p class="detail-subtitle">Xem lại thông tin nhận hàng và lựa chọn phương thức thanh toán phù hợp.</p>
          </div>
          <div class="detail-actions">
              <a class="ghost-btn" href="User_dsdonhang.php">Quay lại danh sách</a>
              <button class="ghost-btn" type="button" onclick="window.print()">In hóa đơn</button>
          </div>
      </div>
  </div>

  <div class="container detail-shell">
      <div class="detail-steps">
          <div class="step active">
              <span class="step-dot"></span>
              <span class="step-text">Thông tin</span>
          </div>
          <div class="step active">
              <span class="step-dot"></span>
              <span class="step-text">Chi tiết đơn</span>
          </div>
          <div class="step">
              <span class="step-dot"></span>
              <span class="step-text">Thanh toán</span>
          </div>
      </div>

      <div class="detail-card">
          <div class="row">
              <?php $p->hienThiThongTinDonHang($id_user, $dh_id); ?>
          </div>
      </div>

      <div class="payment-card">
          <div class="payment-header">
              <div>
                  <h3>Thanh toán đơn hàng</h3>
                  <p>Chọn phương thức thanh toán qua MoMo phù hợp với bạn.</p>
              </div>
              <span class="card-badge">Bảo mật</span>
          </div>
          <div class="payment-grid">
              <form method="POST" action="../CLASS/confirm_momo.php?dh_id=<?php echo $dh_id; ?>">
                  <button type="submit" id="nut_momo_qr" class="primary-btn">Thanh toán MoMo (QR)</button>
              </form>
              <form method="POST" action="../CLASS/confirm_atm_momo.php?dh_id=<?php echo $dh_id; ?>">
                  <button type="submit" id="nut_momo_atm" class="primary-btn">Thanh toán MoMo (ATM)</button>
              </form>
          </div>
          <div class="payment-note">
              <p>Bạn sẽ được chuyển tới cổng thanh toán của MoMo để hoàn tất giao dịch.</p>
          </div>
      </div>
  </div>
</body>
</html>
