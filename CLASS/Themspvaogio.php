<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

/* ================= KIỂM TRA ĐĂNG NHẬP ================= */
if (!isset($_SESSION['user_email']) || $_SESSION['user_role'] !== 'user') {
    die('Bạn chưa đăng nhập!');
}

$id_user = $_SESSION['id_user'] ?? null;
if (!$id_user) {
    die('Session id_user không tồn tại!');
}

/* ================= DEBUG POST ================= */
echo "<pre>";
echo "Session id_user: $id_user\n";
echo "POST nhận được:\n";
print_r($_POST);
echo "</pre>";

// 👉 MỞ comment dòng dưới khi test xong
// die('Debug dừng tại đây - kiểm tra Network tab');

/* ================= CHỈ XỬ LÝ KHI POST ================= */
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    /* ===== KẾT NỐI CSDL ===== */
    $conn = mysqli_connect("localhost", "root", "Shatou5114", "baitaplon");
    if (!$conn) {
        die("Lỗi kết nối CSDL: " . mysqli_connect_error());
    }

    /* ===== NHẬN & LỌC DỮ LIỆU ===== */
    $sp_id       = mysqli_real_escape_string($conn, $_POST['sp_id']);
    $ten         = mysqli_real_escape_string($conn, $_POST['ten']);
    $anh         = mysqli_real_escape_string($conn, $_POST['mainImage']);
    $kichThuoc   = mysqli_real_escape_string($conn, $_POST['kich_thuoc']);
    $soLuong     = (int)$_POST['so_luong'];
    $giaSanPham  = (float)$_POST['gia_san_pham'];
    $tongtien    = (float)$_POST['tong_tien'];

    /* ===== KIỂM TRA GIỎ HÀNG ===== */
    $sql_giohang = "SELECT * FROM giohang WHERE gh_iduser = '$id_user'";
    $rs_giohang  = mysqli_query($conn, $sql_giohang);

    if (mysqli_num_rows($rs_giohang) == 0) {
        // Tạo giỏ hàng mới
        $sql_insert_gh = "INSERT INTO giohang (gh_iduser) VALUES ('$id_user')";
        mysqli_query($conn, $sql_insert_gh);
        $gh_id = mysqli_insert_id($conn);
    } else {
        $row = mysqli_fetch_assoc($rs_giohang);
        $gh_id = $row['gh_id'];
    }

    /* ===== KIỂM TRA SẢN PHẨM TRÙNG ===== */
    $sql_check = "
        SELECT * FROM giohang_chitiet 
        WHERE gh_id = '$gh_id' 
        AND ctgh_idsp = '$sp_id' 
        AND ctgh_kichthuoc = '$kichThuoc'
    ";
    $rs_check = mysqli_query($conn, $sql_check);

    if (mysqli_num_rows($rs_check) > 0) {
        // Cộng thêm số lượng
        $sql_update = "
            UPDATE giohang_chitiet 
            SET ctgh_soluong = ctgh_soluong + $soLuong,
                ctgh_tongtien = ctgh_tongtien + $tongtien
            WHERE gh_id = '$gh_id'
            AND ctgh_idsp = '$sp_id'
            AND ctgh_kichthuoc = '$kichThuoc'
        ";
        mysqli_query($conn, $sql_update);
    } else {
        // Thêm mới sản phẩm
        $sql_insert_ct = "
            INSERT INTO giohang_chitiet
            (gh_id, ctgh_idsp, ctgh_soluong, ctgh_tongtien, ctgh_kichthuoc, ctgh_gia, ghct_anhsp, ghct_tensp)
            VALUES
            ('$gh_id', '$sp_id', '$soLuong', '$tongtien', '$kichThuoc', '$giaSanPham', '$anh', '$ten')
        ";
        mysqli_query($conn, $sql_insert_ct);
    }

    /* ===== CẬP NHẬT TỔNG TIỀN GIỎ ===== */
    $sql_tong = "
        SELECT SUM(ctgh_tongtien) AS tongtien_giohang
        FROM giohang_chitiet
        WHERE gh_id = '$gh_id'
    ";
    $rs_tong = mysqli_query($conn, $sql_tong);
    $row_tong = mysqli_fetch_assoc($rs_tong);
    $tongtien_giohang = $row_tong['tongtien_giohang'];

    $sql_update_gh = "
        UPDATE giohang
        SET gh_tongtien = '$tongtien_giohang'
        WHERE gh_id = '$gh_id'
    ";
    mysqli_query($conn, $sql_update_gh);

    mysqli_close($conn);

    /* ===== CHUYỂN TRANG ===== */
    header("Location: ../PHP/Bag.php?id_user=$id_user");
    exit();
}
?>
