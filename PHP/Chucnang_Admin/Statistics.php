<<<<<<< HEAD
﻿<?php include '../QLSP/Thongkedonhang.php'; ?>
=======
<?php include '../QLSP/Thongkedonhang.php'; ?>
>>>>>>> 1e04d946ee1b11827e820da189420f51ca0a5a0e
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thống kê đơn hàng</title>
    <link rel="stylesheet" href="../../CSS/ad_thongkee.css">
    <link rel="stylesheet" href="../../CSS/luxe.css">
</head>
<body>
<div class="container">
    <h2>📊 THỐNG KÊ ĐƠN HÀNG</h2>

    <form method="GET" class="filter-form">
        <div>
            <label><strong>Từ ngày:</strong></label><br>
<<<<<<< HEAD
            <input type="date" name="ngay_tu" value="<?php echo htmlspecialchars($ngay_tu); ?>">
        </div>
        <div>
            <label><strong>Đến ngày:</strong></label><br>
            <input type="date" name="ngay_den" value="<?php echo htmlspecialchars($ngay_den); ?>">
=======
            <input type="date" name="ngay_tu" value="<?php echo $ngay_tu; ?>">
        </div>
        <div>
            <label><strong>Đến ngày:</strong></label><br>
            <input type="date" name="ngay_den" value="<?php echo $ngay_den; ?>">
>>>>>>> 1e04d946ee1b11827e820da189420f51ca0a5a0e
        </div>
        <div>
            <label><strong>Trạng thái:</strong></label><br>
            <select name="trangthai">
                <option value="">Tất cả</option>
                <option value="Cho_xac_nhan" <?php if($trangthai == 'Cho_xac_nhan') echo 'selected'; ?>>Chờ xác nhận</option>
                <option value="Da_thanh_toan" <?php if($trangthai == 'Da_thanh_toan') echo 'selected'; ?>>Đã thanh toán</option>
                <option value="Thanhtoan_Thatbai" <?php if($trangthai == 'Thanhtoan_Thatbai') echo 'selected'; ?>>Thanh toán thất bại</option>
                <option value="Dang_giao" <?php if($trangthai == 'Dang_giao') echo 'selected'; ?>>Đang giao</option>
                <option value="Da_giao" <?php if($trangthai == 'Da_giao') echo 'selected'; ?>>Đã giao</option>
                <option value="Da_huy" <?php if($trangthai == 'Da_huy') echo 'selected'; ?>>Đã hủy</option>
            </select>
        </div>
        <div class="submit-btn">
<<<<<<< HEAD
            <button type="submit">Lọc</button>
=======
            <button type="submit">🔍 Lọc</button>
>>>>>>> 1e04d946ee1b11827e820da189420f51ca0a5a0e
        </div>
    </form>

    <div class="summary">
<<<<<<< HEAD
        <p><strong>🧾 Tổng số đơn:</strong> <?php echo (int)$thongke['tong_don']; ?></p>
        <p><strong>💰 Tổng doanh thu:</strong> <?php echo number_format((float)$thongke['tong_tien'], 0, ',', '.'); ?> ₫</p>
=======
        <p><strong>🧾 Tổng số đơn:</strong> <?php echo $thongke['tong_don']; ?></p>
        <p><strong>💰 Tổng doanh thu:</strong> <?php echo number_format($thongke['tong_tien'], 0, ',', '.'); ?> ₫</p>
>>>>>>> 1e04d946ee1b11827e820da189420f51ca0a5a0e
    </div>

    <h3>🔥 Top 5 sản phẩm bán chạy:</h3>
    <table>
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Số lượng đã bán</th>
            </tr>
        </thead>
        <tbody>
<<<<<<< HEAD
            <?php if ($result_banchay && mysqli_num_rows($result_banchay) > 0) {
                while ($row = mysqli_fetch_assoc($result_banchay)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['dhct_tensp']); ?></td>
                        <td><?php echo (int)$row['tong_so_luong']; ?></td>
=======
            <?php if (mysqli_num_rows($result_banchay) > 0) {
                while ($row = mysqli_fetch_assoc($result_banchay)) { ?>
                    <tr>
                        <td><?php echo $row['dhct_tensp']; ?></td>
                        <td><?php echo $row['tong_so_luong']; ?></td>
>>>>>>> 1e04d946ee1b11827e820da189420f51ca0a5a0e
                    </tr>
                <?php }
            } else { ?>
                <tr><td colspan="2">Không có dữ liệu</td></tr>
            <?php } ?>
        </tbody>
    </table>
<<<<<<< HEAD
</div>
</body>
</html>
=======

    <div class="back">
        <a href="../Admin.php">
            <button>🔙 Trở về trang quản lý</button>
        </a>
    </div>
</div>
</body>
</html>

>>>>>>> 1e04d946ee1b11827e820da189420f51ca0a5a0e
