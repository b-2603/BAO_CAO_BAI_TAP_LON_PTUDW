<?php
<<<<<<< HEAD
$conn = mysqli_connect('localhost', 'root', '', 'baitaplon');
=======
$conn = mysqli_connect('localhost', 'root', 'Shatou5114', 'baitaplon');
>>>>>>> 1e04d946ee1b11827e820da189420f51ca0a5a0e
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

if (isset($_POST['dh_id'])) {
    $dh_id = $_POST['dh_id'];

// Xóa chi tiết đơn hàng
    $query_xoa_ctdh = "DELETE FROM donhang_chitiet WHERE dh_id = '$dh_id'";
    $result_xoa_ctdh = mysqli_query($conn, $query_xoa_ctdh);
    if (!$result_xoa_ctdh) {
        echo "Lỗi xóa chi tiết đơn hàng!";
        exit;
    }

// Xóa đơn hàng
    $query_xoa_dh = "DELETE FROM donhang WHERE dh_id = '$dh_id'";
    $result_xoa_dh = mysqli_query($conn, $query_xoa_dh);
    if (!$result_xoa_dh) {
        echo "Lỗi xóa đơn hàng!";
        exit;
    }

// Xóa vận chuyển
    $query_xoa_vc = "DELETE FROM vanchuyen WHERE dh_id = '$dh_id'";
    $result_xoa_vc = mysqli_query($conn, $query_xoa_vc);
    if (!$result_xoa_vc) {
        echo "Lỗi xóa thông tin vận chuyển!";
        exit;
    }

    echo "Đơn hàng đã được hủy thành công!";
} else {
    echo "Không nhận được ID đơn hàng!";
}

mysqli_close($conn);
?>
