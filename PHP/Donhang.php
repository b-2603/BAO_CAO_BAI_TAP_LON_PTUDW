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
<div class="container py-4" id="hop_dung_noidung">
    <div class="row g-4">
        <div class="col-md-7">
            <div id="thongtin_donhang">
                <h3>Thông tin đơn hàng</h3>
                <div id="danh_sach_giohang">
                    <?php if (!$donhang_tam): ?>
                        <p>Chưa có đơn hàng tạm. Vui lòng chọn sản phẩm trong giỏ hàng.</p>
                        <a href="Bag.php">Quay lại giỏ hàng</a>
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
                            <div class="muc_giohang">
                                <img src="<?php echo $anh; ?>" alt="<?php echo $ten; ?>">
                                <div>
                                    <p><strong>Sản phẩm:</strong> <?php echo $ten; ?></p>
                                    <p><strong>Số lượng:</strong> <?php echo $soluong; ?></p>
                                    <p><strong>Giá:</strong> <?php echo $gia; ?> VND</p>
                                    <p><strong>Tổng:</strong> <?php echo $sp_tongtien; ?> VND</p>
                                </div>
                            </div>
                        <?php } ?>
                    <?php endif; ?>
                </div>
                <?php if ($donhang_tam): ?>
                    <div id="tong_tien" style="text-align: center;">
                        Tổng tiền: <span><?php echo $tong_tien; ?> VND</span>
                    </div>
                    <div style="text-align: center; margin-top: 10px;">
                        <form method="POST">
                            <button type="submit" name="huy_donhang" class="nut_bam nut_huy">Hủy đơn hàng</button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-5">
            <div id="khung_nhap_thongtin">
                <h3>Thông tin giao hàng</h3>
                <form id="form_thanhtoan" method="POST">
                    <div class="khoang_cach_duoi">
                        <input class="o_nhap" type="text" id="ho_va_ten" name="ho_va_ten" placeholder="Họ và tên" required>
                    </div>
                    <div class="khoang_cach_duoi">
                        <input class="o_nhap" type="email" id="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="khoang_cach_duoi">
                        <input class="o_nhap" type="text" id="dia_chi" name="dia_chi" placeholder="Địa chỉ" required>
                    </div>
                    <div class="khoang_cach_duoi">
                        <input class="o_nhap" type="text" id="so_dien_thoai" name="so_dien_thoai" placeholder="Số điện thoại" required>
                    </div>
                    <div class="khoang_cach_duoi">
                        <input class="o_nhap" type="text" id="thanh_pho" name="thanh_pho" placeholder="Thành phố" required>
                    </div>
                    <button type="submit" id="xacnhan_donhang" class="nut_bam" disabled>Xác nhận đơn hàng</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="../JS/jquery-3.7.1.min.js"></script>
<script src="../JS/donhangchitiet.js"></script>
</body>
</html>
