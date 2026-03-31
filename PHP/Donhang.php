<?php
session_start();
$id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : null;
if (!isset($_SESSION['user_email']) || $_SESSION['user_role'] !== 'user') {
    echo '<meta http-equiv="refresh" content="0;url=Category.php">';
    exit();
}

include("../CLASS/Xuatttsanpham.php");
$p = new dulieu();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['huy_donhang'])) {
    $p->xoaDonHang();
    exit();
}

$donhang_tam = isset($_SESSION['donhang_tam']) ? $_SESSION['donhang_tam'] : null;
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin đơn hàng</title>
    <link rel="stylesheet" href="../CSS/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/base.css">
    <link rel="stylesheet" href="../CSS/thongtindonhang.css">
    <link rel="stylesheet" href="../CSS/luxe.css">
</head>
<body>
<div class="checkout-hero">
    <div class="checkout-hero__inner">
        <div class="checkout-title">
            <p class="checkout-eyebrow">Chạy Đi Shop · Thanh toán an toàn</p>
            <h1>Hoàn tất đơn hàng</h1>
            <p class="checkout-subtitle">Xác nhận thông tin giao hàng và kiểm tra lại sản phẩm trước khi thanh toán.</p>
        </div>
        <div class="checkout-actions">
            <a class="ghost-btn" href="Bag.php">Quay lại giỏ hàng</a>
            <a class="ghost-btn" href="Category.php">Tiếp tục mua sắm</a>
        </div>
    </div>
</div>

<div class="container checkout-shell">
    <div class="checkout-steps">
        <div class="step active">
            <span class="step-dot"></span>
            <span class="step-text">Giỏ hàng</span>
        </div>
        <div class="step active">
            <span class="step-dot"></span>
            <span class="step-text">Thông tin</span>
        </div>
        <div class="step">
            <span class="step-dot"></span>
            <span class="step-text">Thanh toán</span>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-7">
            <div id="thongtin_donhang" class="card-surface">
                <div class="card-header">
                    <h3>Thông tin đơn hàng</h3>
                    <span class="card-badge"><?php echo $donhang_tam ? count($donhang_tam['san_pham']) : 0; ?> sản phẩm</span>
                </div>
                <div id="danh_sach_giohang" class="order-list">
                    <?php if (!$donhang_tam): ?>
                        <div class="empty-state">
                            <p>Chưa có đơn hàng tạm. Vui lòng chọn sản phẩm trong giỏ hàng.</p>
                            <a class="primary-btn" href="Bag.php">Về giỏ hàng</a>
                        </div>
                    <?php else: ?>
                        <?php
                        $tong_tien = 0;
                        foreach ($donhang_tam['san_pham'] as $sp) {
                            $anh = $sp['anhsp'];
                            $ten = $sp['tensp'];
                            $soluong = $sp['so_luong'];
                            $gia = $sp['gia_ban'];
                            $sp_tongtien = $sp['thanh_tien'];
                            $tong_tien += $sp_tongtien;
                        ?>
                            <div class="muc_giohang order-item">
                                <img src="<?php echo $anh; ?>" alt="<?php echo $ten; ?>">
                                <div class="order-item__content">
                                    <p class="order-item__name"><?php echo $ten; ?></p>
                                    <p class="order-item__meta">Số lượng: <?php echo $soluong; ?> · Giá: <?php echo $gia; ?> VND</p>
                                    <p class="order-item__total">Thành tiền: <?php echo $sp_tongtien; ?> VND</p>
                                </div>
                            </div>
                        <?php } ?>
                    <?php endif; ?>
                </div>
                <?php if ($donhang_tam): ?>
                    <div class="order-summary">
                        <div class="summary-row">
                            <span>Tạm tính</span>
                            <span><?php echo $tong_tien; ?> VND</span>
                        </div>
                        <div class="summary-row">
                            <span>Phí vận chuyển</span>
                            <span>Miễn phí</span>
                        </div>
                        <div class="summary-total">
                            <span>Tổng thanh toán</span>
                            <span><?php echo $tong_tien; ?> VND</span>
                        </div>
                        <div class="summary-actions">
                            <form method="POST">
                                <button type="submit" name="huy_donhang" class="ghost-btn danger">Hủy đơn hàng</button>
                            </form>
                            <button class="ghost-btn" type="button" onclick="window.print()">In đơn hàng</button>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-lg-5">
            <div id="khung_nhap_thongtin" class="card-surface">
                <div class="card-header">
                    <h3>Thông tin giao hàng</h3>
                    <span class="card-badge">Bắt buộc</span>
                </div>
                <form id="form_thanhtoan" method="POST">
                    <div class="field-group">
                        <label for="ho_va_ten">Họ và tên</label>
                        <input class="o_nhap" type="text" id="ho_va_ten" name="ho_va_ten" placeholder="Nguyễn Văn A" required>
                    </div>
                    <div class="field-group">
                        <label for="email">Email</label>
                        <input class="o_nhap" type="email" id="email" name="email" placeholder="email@example.com" required>
                    </div>
                    <div class="field-group">
                        <label for="dia_chi">Địa chỉ</label>
                        <input class="o_nhap" type="text" id="dia_chi" name="dia_chi" placeholder="Số nhà, đường, phường/xã" required>
                    </div>
                    <div class="field-group">
                        <label for="so_dien_thoai">Số điện thoại</label>
                        <input class="o_nhap" type="text" id="so_dien_thoai" name="so_dien_thoai" placeholder="0xxxxxxxxx" required>
                    </div>
                    <div class="field-group">
                        <label for="thanh_pho">Thành phố</label>
                        <input class="o_nhap" type="text" id="thanh_pho" name="thanh_pho" placeholder="TP.HCM / Hà Nội" required>
                    </div>
                    <div class="field-group">
                        <label for="ghi_chu">Ghi chú</label>
                        <textarea class="o_nhap" id="ghi_chu" name="ghi_chu" rows="3" placeholder="Giao giờ hành chính, gọi trước khi giao..."></textarea>
                    </div>
                    <div class="form-actions">
                        <button type="submit" id="xacnhan_donhang" class="primary-btn" disabled>Xác nhận đơn hàng</button>
                        <p class="form-note">Bằng việc xác nhận, bạn đồng ý với chính sách đổi trả và điều khoản dịch vụ.</p>
                    </div>
                </form>
            </div>
            <div class="card-surface support-card">
                <h4>Cần hỗ trợ nhanh?</h4>
                <p>Hotline: 097.114.1140 · Email: hotro@chaydi.shop</p>
                <div class="support-actions">
                    <a class="ghost-btn" href="tel:0971141140">Gọi ngay</a>
                    <a class="ghost-btn" href="mailto:hotro@chaydi.shop">Gửi email</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../JS/jquery-3.7.1.min.js"></script>
<script src="../JS/donhangchitiet.js"></script>
</body>
</html>
