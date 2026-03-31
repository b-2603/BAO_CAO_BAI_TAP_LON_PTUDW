<?php
session_start();
ob_start();
$is_ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
if ($is_ajax) {
    header('Content-Type: application/json; charset=utf-8');
}

function respond_json($data)
{
    if (ob_get_length()) {
        ob_clean();
    }
    echo json_encode($data);
    exit();
}

function column_exists($conn, $table, $column)
{
    $table_safe = mysqli_real_escape_string($conn, $table);
    $column_safe = mysqli_real_escape_string($conn, $column);
    $rs = mysqli_query($conn, "SHOW COLUMNS FROM `$table_safe` LIKE '$column_safe'");
    if ($rs && mysqli_num_rows($rs) > 0) {
        return true;
    }
    return false;
}

/* ================= KIỂM TRA ĐĂNG NHẬP ================= */
$session_email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : '';
$session_role = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : '';
if ($session_email === '' || $session_role !== 'user') {
    if ($is_ajax) {
        respond_json(array("success" => false, "redirect" => "../PHP/Category.php"));
    } else {
        header("Location: ../PHP/Category.php");
        exit();
    }
}

$id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : null;
if (!$id_user) {
    if ($is_ajax) {
        respond_json(array("success" => false, "message" => "Session id_user không tồn tại!"));
    } else {
        echo "Session id_user không tồn tại!";
        exit();
    }
}

require_once "Ketnoi.php";

/* ================= CHỈ XỬ LÝ KHI POST ================= */
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    /* ===== KẾT NỐI CSDL ===== */
    $db = new tmdt();
    $conn = $db->ketnoi();

    /* ===== NHẬN & LỌC DỮ LIỆU ===== */
    $sp_id       = mysqli_real_escape_string($conn, isset($_POST['sp_id']) ? $_POST['sp_id'] : '');
    $ten         = mysqli_real_escape_string($conn, isset($_POST['ten']) ? $_POST['ten'] : '');
    $anh         = mysqli_real_escape_string($conn, isset($_POST['mainImage']) ? $_POST['mainImage'] : '');
    $kichThuoc   = mysqli_real_escape_string($conn, isset($_POST['kich_thuoc']) ? $_POST['kich_thuoc'] : '');
    $soLuong     = (int)(isset($_POST['so_luong']) ? $_POST['so_luong'] : 1);
    $giaSanPham  = (float)preg_replace('/[^0-9.]/', '', isset($_POST['gia_san_pham']) ? $_POST['gia_san_pham'] : '0');
    $tongtien    = (float)preg_replace('/[^0-9.]/', '', isset($_POST['tong_tien']) ? $_POST['tong_tien'] : '0');

    if ($sp_id === '' || $soLuong <= 0) {
        if ($is_ajax) {
            respond_json(array("success" => false, "message" => "Dữ liệu sản phẩm không hợp lệ."));
        }
        echo "Dữ liệu sản phẩm không hợp lệ.";
        exit();
    }

    // Nếu thiếu dữ liệu, lấy từ DB để đảm bảo thêm giỏ được
    if ($ten === '' || $anh === '' || $giaSanPham <= 0) {
        $rs_sp = mysqli_query($conn, "SELECT sp_ten, sp_gia, sp_anh1 FROM sanpham WHERE sp_id = '$sp_id' LIMIT 1");
        if ($rs_sp && $row_sp = mysqli_fetch_assoc($rs_sp)) {
            if ($ten === '') { $ten = $row_sp['sp_ten']; }
            if ($giaSanPham <= 0) { $giaSanPham = (float)$row_sp['sp_gia']; }
            if ($anh === '') { $anh = $row_sp['sp_anh1']; }
        }
    }

    if ($kichThuoc === '') {
        $rs_ct = mysqli_query($conn, "SELECT ct_kichthuoc FROM sanpham_chitiet WHERE sp_id = '$sp_id' LIMIT 1");
        if ($rs_ct && $row_ct = mysqli_fetch_assoc($rs_ct)) {
            $sizes = explode(',', $row_ct['ct_kichthuoc']);
            $kichThuoc = trim($sizes[0]);
        }
    }

    if ($tongtien <= 0 && $giaSanPham > 0) {
        $tongtien = $giaSanPham * $soLuong;
    }

    // Xác định đúng tên cột theo cấu trúc DB hiện tại
    $col_tensp = column_exists($conn, 'giohang_chitiet', 'ctgh_tensp') ? 'ctgh_tensp' : 'ghct_tensp';
    $col_anhsp = column_exists($conn, 'giohang_chitiet', 'ghct_anhsp') ? 'ghct_anhsp' : 'ctgh_anhsp';

    /* ===== KIỂM TRA GIỎ HÀNG ===== */
    $sql_giohang = "SELECT * FROM giohang WHERE gh_iduser = '$id_user'";
    $rs_giohang  = mysqli_query($conn, $sql_giohang);
    if (!$rs_giohang) {
        if ($is_ajax) {
            respond_json(array("success" => false, "message" => "Lỗi truy vấn giỏ hàng: " . mysqli_error($conn)));
        }
        echo "Lỗi truy vấn giỏ hàng: " . mysqli_error($conn);
        exit();
    }

    if (mysqli_num_rows($rs_giohang) == 0) {
        // Tạo giỏ hàng mới
        $sql_insert_gh = "INSERT INTO giohang (gh_iduser, gh_tongtien) VALUES ('$id_user', 0)";
        if (!mysqli_query($conn, $sql_insert_gh)) {
            if ($is_ajax) {
                respond_json(array("success" => false, "message" => "Không thể tạo giỏ hàng: " . mysqli_error($conn)));
            }
            echo "Không thể tạo giỏ hàng: " . mysqli_error($conn);
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
    if (!$rs_check) {
        if ($is_ajax) {
            respond_json(array("success" => false, "message" => "Lỗi kiểm tra sản phẩm: " . mysqli_error($conn)));
        }
        echo "Lỗi kiểm tra sản phẩm: " . mysqli_error($conn);
        exit();
    }

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
            if ($is_ajax) {
                respond_json(array("success" => false, "message" => "Cập nhật sản phẩm thất bại: " . mysqli_error($conn)));
            }
            echo "Cập nhật sản phẩm thất bại: " . mysqli_error($conn);
            exit();
        }
    } else {
        // Thêm mới sản phẩm
        $sql_insert_ct = "
            INSERT INTO giohang_chitiet
            (gh_id, ctgh_idsp, ctgh_soluong, ctgh_tongtien, ctgh_kichthuoc, ctgh_gia, $col_anhsp, $col_tensp)
            VALUES
            ('$gh_id', '$sp_id', '$soLuong', '$tongtien', '$kichThuoc', '$giaSanPham', '$anh', '$ten')
        ";
        if (!mysqli_query($conn, $sql_insert_ct)) {
            if ($is_ajax) {
                respond_json(array("success" => false, "message" => "Thêm sản phẩm thất bại: " . mysqli_error($conn)));
            }
            echo "Thêm sản phẩm thất bại: " . mysqli_error($conn);
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
    if (!$rs_tong) {
        if ($is_ajax) {
            respond_json(array("success" => false, "message" => "Lỗi tính tổng giỏ hàng: " . mysqli_error($conn)));
        }
        echo "Lỗi tính tổng giỏ hàng: " . mysqli_error($conn);
        exit();
    }
    $row_tong = mysqli_fetch_assoc($rs_tong);
    $tongtien_giohang = $row_tong ? $row_tong['tongtien_giohang'] : 0;

    $sql_update_gh = "
        UPDATE giohang
        SET gh_tongtien = '$tongtien_giohang'
        WHERE gh_id = '$gh_id'
    ";
    if (!mysqli_query($conn, $sql_update_gh)) {
        if ($is_ajax) {
            respond_json(array("success" => false, "message" => "Cập nhật tổng giỏ hàng thất bại: " . mysqli_error($conn)));
        }
        echo "Cập nhật tổng giỏ hàng thất bại: " . mysqli_error($conn);
        exit();
    }

    mysqli_close($conn);

    if ($is_ajax) {
        respond_json(array("success" => true, "redirect" => "../PHP/Bag.php"));
    }
    header("Location: ../PHP/Bag.php");
    exit();
}

if ($is_ajax) {
    respond_json(array("success" => false, "message" => "Yêu cầu không hợp lệ."));
}
echo "Yêu cầu không hợp lệ.";
exit();
?>
