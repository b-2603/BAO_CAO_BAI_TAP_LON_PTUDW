
<?php
<<<<<<< HEAD
$conn = mysqli_connect("localhost", "root", "", "baitaplon");
=======
$conn = mysqli_connect("localhost", "usertmdt", "passtmdt", "baitaplon");
>>>>>>> 1e04d946ee1b11827e820da189420f51ca0a5a0e
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

$id_donhang = isset($_GET['dh_id']) ? $_GET['dh_id'] : '';

// Cập nhật trạng thái
if (isset($_POST['capnhat_trangthai'])) {
    $trangthai = $_POST['trangthai'];
    mysqli_query($conn, "UPDATE donhang SET dh_trangthai = '$trangthai' WHERE dh_id = '$id_donhang'");
}

// Xóa đơn hàng
if (isset($_POST['xoa_donhang'])) {
    mysqli_query($conn, "DELETE FROM donhang_chitiet WHERE dh_id = '$id_donhang'");
    mysqli_query($conn, "DELETE FROM vanchuyen WHERE dh_id = '$id_donhang'");
    mysqli_query($conn, "DELETE FROM donhang WHERE dh_id = '$id_donhang'");
    echo "<script>alert('Đã xóa đơn hàng thành công!'); window.location.href='../Chucnang_Admin/ManageOrders.php';</script>";
    exit;
}

// Lấy dữ liệu đơn hàng
$sql_donhang = "SELECT * FROM donhang WHERE dh_id = '$id_donhang'";
$donhang = mysqli_fetch_assoc(mysqli_query($conn, $sql_donhang));
$trangthai = isset($donhang['dh_trangthai']) ? $donhang['dh_trangthai'] : '';

$user_id = $donhang['user_id'];
$sql_vc = "SELECT * FROM vanchuyen WHERE user_id = '$user_id' AND dh_id = '$id_donhang' LIMIT 1";
$vanchuyen = mysqli_fetch_assoc(mysqli_query($conn, $sql_vc));

$sql_sp = "SELECT * FROM donhang_chitiet WHERE dh_id = '$id_donhang'";
$result_sp = mysqli_query($conn, $sql_sp);
?>
