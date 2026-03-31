<?php
$conn = mysqli_connect("localhost", "root", "", "baitaplon");
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

$ngay_tu = isset($_GET['ngay_tu']) ? $_GET['ngay_tu'] : '';
$ngay_den = isset($_GET['ngay_den']) ? $_GET['ngay_den'] : '';
$trangthai = isset($_GET['trangthai']) ? $_GET['trangthai'] : '';

$condition = "WHERE 1";
if ($ngay_tu && $ngay_den) {
    $ngay_tu .= " 00:00:00";
    $ngay_den .= " 23:59:59";
    $condition .= " AND donhang.dh_ngaytao BETWEEN '$ngay_tu' AND '$ngay_den'";
}

if ($trangthai) {
    $condition .= " AND donhang.dh_trangthai = '$trangthai'";
}

$sql_thongke = "SELECT COUNT(*) AS tong_don, SUM(donhang.dh_tongtien) AS tong_tien FROM donhang $condition";
$thongke_query = mysqli_query($conn, $sql_thongke);
$thongke = $thongke_query ? mysqli_fetch_assoc($thongke_query) : array('tong_don' => 0, 'tong_tien' => 0);
if (!$thongke) {
    $thongke = array('tong_don' => 0, 'tong_tien' => 0);
}
if (!isset($thongke['tong_don']) || $thongke['tong_don'] === null) {
    $thongke['tong_don'] = 0;
}
if (!isset($thongke['tong_tien']) || $thongke['tong_tien'] === null) {
    $thongke['tong_tien'] = 0;
}

$sql_banchay = "
SELECT dhct_tensp, SUM(dhct_soluong) AS tong_so_luong
FROM donhang_chitiet
JOIN donhang ON donhang.dh_id = donhang_chitiet.dh_id
$condition
GROUP BY dhct_tensp
ORDER BY tong_so_luong DESC
LIMIT 5";
$result_banchay = mysqli_query($conn, $sql_banchay);
if (!$result_banchay) {
    $result_banchay = false;
}
?>
