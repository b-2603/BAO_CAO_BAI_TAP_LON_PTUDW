<?php include '../QLSP/Ad_xulydonchitiet.php'; ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết đơn hàng</title>
    <link rel="stylesheet" href="../../CSS/ad_xulydonchitiet.css">
    <link rel="stylesheet" href="../../CSS/luxe.css">
</head>
<body>
    <div class="order-container">
        <div class="header">
            <a href="javascript:history.back()" class="back-btn">&#8592; Trở lại</a>
            <h2>🧾 Chi tiết đơn hàng #<?php echo $id_donhang; ?></h2>
        </div>

        <div class="info">
            <p><strong>👤 Người nhận:</strong> <?php echo $vanchuyen['vc_tenKH']; ?></p>
            <p><strong>📞 SĐT:</strong> <?php echo $vanchuyen['vc_sdt']; ?></p>
            <p><strong>📍 Địa chỉ:</strong> <?php echo $vanchuyen['vc_diachi']; ?></p>
            <p><strong>🗓️ Ngày đặt:</strong> <?php echo $donhang['dh_ngaytao']; ?></p>
            <p><strong>📦 Trạng thái:</strong> <?php echo $donhang['dh_trangthai']; ?></p>
        </div>

        <table class="product-table">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Tổng</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($sp = mysqli_fetch_assoc($result_sp)) { ?>
                <tr>
                    <td><?php echo $sp['dhct_tensp']; ?></td>
                    <td><?php echo number_format($sp['dhct_giabansp'], 0, ',', '.') . '₫'; ?></td>
                    <td><?php echo $sp['dhct_soluong']; ?></td>
                    <td><?php echo number_format($sp['dhct_thanhtien'], 0, ',', '.') . '₫'; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <div class="total">
            <strong>Tổng tiền:</strong>
            <span><?php echo number_format($donhang['dh_tongtien'], 0, ',', '.') . '₫'; ?> 💰</span>
        </div>

        <div class="actions">
            <form method="POST" class="status-form">
                <label for="trangthai"><strong>🛠️ Trạng thái:</strong></label>
                <select name="trangthai">
                    <?php
<<<<<<< HEAD
                    $options = array('Cho_xac_nhan', 'Da_thanh_toan', 'Thanhtoan_Thatbai', 'Dang_giao', 'Da_giao', 'Da_huy');
=======
                    $options = ['Cho_xac_nhan', 'Da_thanh_toan', 'Thanhtoan_Thatbai', 'Dang_giao', 'Da_giao', 'Da_huy'];
>>>>>>> 1e04d946ee1b11827e820da189420f51ca0a5a0e
                    foreach ($options as $opt) {
                        echo "<option value='$opt'" . ($trangthai == $opt ? " selected" : "") . ">$opt</option>";
                    }
                    ?>
                </select>
                <button type="submit" name="capnhat_trangthai">Cập nhật</button>
            </form>

            <form method="POST" onsubmit="return confirm('Bạn có chắc muốn xoá đơn hàng này không?');">
                <button type="submit" name="xoa_donhang" class="delete-btn">🗑️ Xóa đơn</button>
            </form>
        </div>
    </div>
</body>
</html>
<<<<<<< HEAD
=======

>>>>>>> 1e04d946ee1b11827e820da189420f51ca0a5a0e
