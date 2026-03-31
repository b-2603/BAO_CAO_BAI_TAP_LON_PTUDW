<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
<<<<<<< HEAD
    $conn = mysqli_connect('localhost', 'root', '', 'baitaplon');
=======
    $conn = mysqli_connect('localhost', 'root', 'Shatou5114', 'baitaplon');
>>>>>>> 1e04d946ee1b11827e820da189420f51ca0a5a0e
    if (!$conn) {
        die("Kết nối thất bại: " . mysqli_connect_error());
    }

    $id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : null;
    if (!$id_user) {
        echo "not_logged_in";
        exit;
    }

    if (isset($_SESSION['donhang_tam'])) {
        $donhang_tam = $_SESSION['donhang_tam'];
        $tong_tien = $donhang_tam['tong_tien'];
        $selected_items = $donhang_tam['san_pham'];

        $query_insert_dh = "INSERT INTO donhang (user_id, dh_tongtien, dh_trangthai) 
                            VALUES ('$id_user', $tong_tien, 'Cho_xac_nhan')";
        if (mysqli_query($conn, $query_insert_dh)) {
            $id_donhang = mysqli_insert_id($conn);
            $_SESSION['dh_id_moi'] = $id_donhang;

            foreach ($selected_items as $item) {
                $id_sanpham = $item['id_sanpham'];
                $so_luong = $item['so_luong'];
                $gia_ban = $item['gia_ban'];
                $thanh_tien = $item['thanh_tien'];
                $tensp = mysqli_real_escape_string($conn, $item['tensp']);
                $anhsp = mysqli_real_escape_string($conn, $item['anhsp']);

                $query_insert_ctdh = "INSERT INTO donhang_chitiet 
                    (dh_id, id_sanpham, dhct_soluong, dhct_giabansp, dhct_thanhtien, dhct_tensp, dhct_anhsp) 
                    VALUES ('$id_donhang', '$id_sanpham', $so_luong, $gia_ban, $thanh_tien, '$tensp', '$anhsp')";
                mysqli_query($conn, $query_insert_ctdh) or die("Lỗi thêm chi tiết đơn hàng: " . mysqli_error($conn));
            }

            foreach ($selected_items as $item) {
                $id_sanpham = $item['id_sanpham'];
                $query_delete_chitiet = "DELETE FROM giohang_chitiet 
                                         WHERE gh_id IN (SELECT gh_id FROM giohang WHERE gh_iduser = '$id_user') 
                                         AND ctgh_idsp = '$id_sanpham'";
                mysqli_query($conn, $query_delete_chitiet);
            }

            unset($_SESSION['donhang_tam']);
        } else {
            echo "error_donhang";
            exit;
        }
    } else {
        echo "empty_cart";
        exit;
    }

    // Lưu thông tin vận chuyển
    $ten = mysqli_real_escape_string($conn, $_POST['ho_va_ten']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $dia_chi = mysqli_real_escape_string($conn, $_POST['dia_chi']);
    $sdt = mysqli_real_escape_string($conn, $_POST['so_dien_thoai']);
    $thanh_pho = mysqli_real_escape_string($conn, $_POST['thanh_pho']);

    $query_vanchuyen = "INSERT INTO vanchuyen 
        (user_id, dh_id, vc_tenKH, vc_email, vc_sdt, vc_diachi, vc_thanhpho) 
        VALUES ('$id_user', '$id_donhang', '$ten', '$email', '$sdt', '$dia_chi', '$thanh_pho')";

    if (!mysqli_query($conn, $query_vanchuyen)) {
        echo "error_vanchuyen";
        exit;
    }

    mysqli_close($conn);

    echo json_encode(["status" => "success", "dh_id" => $id_donhang]);

}
?>
