<?php
session_start();
$id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : null;
if (!isset($_SESSION['user_email']) || $_SESSION['user_role'] !== 'user') {
    echo '<meta http-equiv="refresh" content="0;url=Category.php">';
    exit();
}

include("../CLASS/Xuatttsanpham.php");
$p = new dulieu();

// Lưu trạng thái thanh toán nếu MoMo redirect về
$p->luuthongtinthanhtoan();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đơn hàng của tôi</title>
    <link rel="stylesheet" href="../CSS/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/base.css">
    <link rel="stylesheet" href="../CSS/thongtindonhang.css">
    <link rel="stylesheet" href="../CSS/ds_donhangg.css">
    <link rel="stylesheet" href="../CSS/luxe.css">
</head>
<body>
<div class="container py-4">
    <?php $p->xuatlichsudonhang(); ?>
</div>
<script src="../JS/xoadonhang.js"></script>
</body>
</html>
