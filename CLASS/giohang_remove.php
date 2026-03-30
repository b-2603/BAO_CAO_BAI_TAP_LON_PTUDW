<?php
session_start();
$id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : null;

if (!isset($_SESSION['user_email']) || $_SESSION['user_role'] !== 'user') {
    echo 'Bạn chưa đăng nhập !!!';
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $link = mysqli_connect('localhost', 'root', 'Shatou5114', 'baitaplon');
    if (!$link) {
        die("Kết nối thất bại: " . mysqli_connect_error());
    }

    $product_id = mysqli_real_escape_string($link, $_POST['product_id']);

    // Lấy giỏ hàng của user
    $query_giohang = "SELECT gh_id FROM giohang WHERE gh_iduser = '$id_user'";
    $result_giohang = mysqli_query($link, $query_giohang);
    
    if ($row_giohang = mysqli_fetch_assoc($result_giohang)) {
        $gh_id = $row_giohang['gh_id'];

        $query_delete = "DELETE FROM giohang_chitiet WHERE gh_id = '$gh_id' AND ctgh_id = '$product_id'";
        mysqli_query($link, $query_delete);

        // Cập nhật tổng tiền sau khi xóa sản phẩm
        $query_tongtien = "SELECT SUM(ctgh_tongtien) AS tongtien_giohang FROM giohang_chitiet WHERE gh_id = '$gh_id'";
        $result_tongtien = mysqli_query($link, $query_tongtien);
        
        if ($row_tongtien = mysqli_fetch_assoc($result_tongtien)) {
            $tongtien_giohang = $row_tongtien['tongtien_giohang'];
            $query_update_tongtien = "UPDATE giohang SET gh_tongtien = '$tongtien_giohang' WHERE gh_id = '$gh_id'";
            mysqli_query($link, $query_update_tongtien);
        } else {
            // đặt tổng tiền = 0 khi không có sản phẩm trong giỏ
            $query_update_tongtien = "UPDATE giohang SET gh_tongtien = 0 WHERE gh_id = '$gh_id'";
            mysqli_query($link, $query_update_tongtien);
        }

        echo "Sản phẩm đã được xóa khỏi giỏ hàng!";
    } else {
        echo "Không tìm thấy giỏ hàng!";
    }

    mysqli_close($link);
}
?>
