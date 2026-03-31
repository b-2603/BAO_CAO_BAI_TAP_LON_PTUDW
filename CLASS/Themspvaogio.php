<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

/* ================= KIỂM TRA ĐĂNG NHẬP ================= */
if (!isset($_SESSION['user_email']) || $_SESSION['user_role'] !== 'user') {
    echo json_encode(["success" => false, "redirect" => "../PHP/Category.php"]);
    exit();
}

$id_user = $_SESSION['id_user'] ?? null;
if (!$id_user) {
    echo json_encode(["success" => false, "message" => "Session id_user không tồn tại!"]);
    exit();
}

require_once "Ketnoi.php";

/* ================= CHỈ XỬ LÝ KHI POST ================= */
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    /* ===== KẾT NỐI CSDL ===== */
    $db = new tmdt();
    $conn = $db->ketnoi();

    /* ===== NHẬN & LỌC DỮ LIỆU ===== */
    $sp_id       = mysqli_real_escape_string($conn, $_POST['sp_id'] ?? '');
    $ten         = mysqli_real_escape_string($conn, $_POST['ten'] ?? '');
    $anh         = mysqli_real_escape_string($conn, $_POST['mainImage'] ?? '');
    $kichThuoc   = mysqli_real_escape_string($conn, $_POST['kich_thuoc'] ?? '');
    $soLuong     = (int)($_POST['so_luong'] ?? 1);
    $giaSanPham  = (float)preg_replace('/[^0-9.]/', '', $_POST['gia_san_pham'] ?? '0');
    $tongtien    = (float)preg_replace('/[^0-9.]/', '', $_POST['tong_tien'] ?? '0');

    if ($sp_id === '' || $ten === '' || $soLuong <= 0) {
        echo json_encode(["success" => false, "message" => "Dữ liệu sản phẩm không hợp lệ."]);
        exit();
    }

    /* ===== KIỂM TRA GIỎ HÀNG ===== */
    $sql_giohang = "SELECT * FROM giohang WHERE gh_iduser = '$id_user'";
    $rs_giohang  = mysqli_query($conn, $sql_giohang);

    if (mysqli_num_rows($rs_giohang) == 0) {
        // Tạo giỏ hàng mới
        $sql_insert_gh = "INSERT INTO giohang (gh_iduser, gh_tongtien) VALUES ('$id_user', 0)";
        if (!mysqli_query($conn, $sql_insert_gh)) {
            echo json_encode(["success" => false, "message" => "Không thể tạo giỏ hàng: " . mysqli_error($conn)]);
            exit();
        }
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
        if (!mysqli_query($conn, $sql_update)) {
            echo json_encode(["success" => false, "message" => "Cập nhật sản phẩm thất bại: " . mysqli_error($conn)]);
            exit();
        }
    } else {
        // Thêm mới sản phẩm
        $sql_insert_ct = "
            INSERT INTO giohang_chitiet
            (gh_id, ctgh_idsp, ctgh_soluong, ctgh_tongtien, ctgh_kichthuoc, ctgh_gia, ghct_anhsp, ghct_tensp)
            VALUES
            ('$gh_id', '$sp_id', '$soLuong', '$tongtien', '$kichThuoc', '$giaSanPham', '$anh', '$ten')
        ";
        if (!mysqli_query($conn, $sql_insert_ct)) {
            echo json_encode(["success" => false, "message" => "Thêm sản phẩm thất bại: " . mysqli_error($conn)]);
            exit();
        }
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
    if (!mysqli_query($conn, $sql_update_gh)) {
        echo json_encode(["success" => false, "message" => "Cập nhật tổng giỏ hàng thất bại: " . mysqli_error($conn)]);
        exit();
    }

    mysqli_close($conn);

    echo json_encode(["success" => true, "redirect" => "../PHP/Bag.php"]);
    exit();
}
?>
