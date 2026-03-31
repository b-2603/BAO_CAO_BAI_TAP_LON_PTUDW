<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

require_once "Ketnoi.php";

function respond_json($data)
{
    echo json_encode($data);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new tmdt();
    $conn = $db->ketnoi();

    $id_user = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : null;
    if (!$id_user) {
        respond_json(array("status" => "not_logged_in"));
    }

    if (!isset($_SESSION['donhang_tam'])) {
        respond_json(array("status" => "empty_cart"));
    }

    $donhang_tam = $_SESSION['donhang_tam'];
    $tong_tien = $donhang_tam['tong_tien'];
    $selected_items = $donhang_tam['san_pham'];

    $query_insert_dh = "INSERT INTO donhang (user_id, dh_tongtien, dh_trangthai) 
                        VALUES ('$id_user', $tong_tien, 'Cho_xac_nhan')";
    if (!mysqli_query($conn, $query_insert_dh)) {
        respond_json(array("status" => "error_donhang", "message" => mysqli_error($conn)));
    }

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
        if (!mysqli_query($conn, $query_insert_ctdh)) {
            respond_json(array("status" => "error_ctdh", "message" => mysqli_error($conn)));
        }
    }

    foreach ($selected_items as $item) {
        $id_sanpham = $item['id_sanpham'];
        $query_delete_chitiet = "DELETE FROM giohang_chitiet 
                                 WHERE gh_id IN (SELECT gh_id FROM giohang WHERE gh_iduser = '$id_user') 
                                 AND ctgh_idsp = '$id_sanpham'";
        mysqli_query($conn, $query_delete_chitiet);
    }

    unset($_SESSION['donhang_tam']);

    $ten = mysqli_real_escape_string($conn, $_POST['ho_va_ten']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $dia_chi = mysqli_real_escape_string($conn, $_POST['dia_chi']);
    $sdt = mysqli_real_escape_string($conn, $_POST['so_dien_thoai']);
    $thanh_pho = mysqli_real_escape_string($conn, $_POST['thanh_pho']);

    $query_vanchuyen = "INSERT INTO vanchuyen 
        (user_id, dh_id, vc_tenKH, vc_email, vc_sdt, vc_diachi, vc_thanhpho) 
        VALUES ('$id_user', '$id_donhang', '$ten', '$email', '$sdt', '$dia_chi', '$thanh_pho')";

    if (!mysqli_query($conn, $query_vanchuyen)) {
        respond_json(array("status" => "error_vanchuyen", "message" => mysqli_error($conn)));
    }

    mysqli_close($conn);

    respond_json(array("status" => "success", "dh_id" => $id_donhang));
}

respond_json(array("status" => "invalid_method"));
?>
