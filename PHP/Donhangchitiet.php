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
<div class="container mt-4">
    <h2>Chi tiết đơn hàng</h2>
    <div class="row">
        <?php $p->hienThiThongTinDonHang($id_user, $dh_id); ?>
    </div>
    <div class="payment-methods">
        <form method="POST" action="../CLASS/confirm_momo.php?dh_id=<?php echo $dh_id; ?>">
            <input type="submit" id="nut_momo_qr" value="Thanh toán MoMo (QR)">
        </form>
        <form method="POST" action="../CLASS/confirm_atm_momo.php?dh_id=<?php echo $dh_id; ?>">
            <input type="submit" id="nut_momo_atm" value="Thanh toán MoMo (ATM)">
        </form>
    </div>
</div>
</body>
</html>
