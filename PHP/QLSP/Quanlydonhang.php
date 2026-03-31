<<<<<<< HEAD
﻿<?php
$conn = mysqli_connect("localhost", "root", "", "baitaplon");
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8");

function seed_orders_if_empty($conn)
{
    $resCount = mysqli_query($conn, "SELECT COUNT(*) AS c FROM donhang");
    $rowCount = $resCount ? mysqli_fetch_assoc($resCount) : array("c" => 0);
    $countDon = isset($rowCount["c"]) ? (int)$rowCount["c"] : 0;
    if ($countDon > 0) {
        return;
    }

    $resUser = mysqli_query($conn, "SELECT user_id, user_firstname, user_lastname, user_email FROM login_user ORDER BY user_id ASC LIMIT 1");
    $user = $resUser ? mysqli_fetch_assoc($resUser) : null;
    if (!$user) {
        return;
    }

    $resSp = mysqli_query($conn, "SELECT sp_id, sp_ten, sp_gia, sp_anh1 FROM sanpham ORDER BY sp_id ASC LIMIT 3");
    $products = array();
    if ($resSp) {
        while ($r = mysqli_fetch_assoc($resSp)) {
            $products[] = $r;
        }
    }
    if (count($products) === 0) {
        return;
    }

    $statuses = array("Cho_xac_nhan", "Dang_giao", "Da_giao");

    mysqli_query($conn, "START TRANSACTION");
    $allOk = true;

    foreach ($statuses as $idx => $status) {
        $p = $products[$idx % count($products)];
        $user_id = (int)$user["user_id"];
        $sp_id = (int)$p["sp_id"];
        $gia = (float)$p["sp_gia"];
        $so_luong = $idx + 1;
        $tong = $gia * $so_luong;

        $statusEsc = mysqli_real_escape_string($conn, $status);
        $spTenEsc = mysqli_real_escape_string($conn, $p["sp_ten"]);
        $spAnhEsc = mysqli_real_escape_string($conn, $p["sp_anh1"]);
        $tenKh = mysqli_real_escape_string($conn, $user["user_lastname"] . " " . $user["user_firstname"]);
        $email = mysqli_real_escape_string($conn, $user["user_email"]);

        $ok1 = mysqli_query($conn, "INSERT INTO donhang (user_id, dh_tongtien, dh_trangthai) VALUES ($user_id, $tong, '$statusEsc')");
        if (!$ok1) { $allOk = false; break; }

        $dh_id = mysqli_insert_id($conn);

        $ok2 = mysqli_query($conn, "INSERT INTO donhang_chitiet (dh_id, dhct_soluong, dhct_giabansp, dhct_thanhtien, id_sanpham, dhct_tensp, dhct_anhsp)
                                    VALUES ($dh_id, $so_luong, $gia, $tong, $sp_id, '$spTenEsc', '$spAnhEsc')");

        $sdt = 900000000 + $idx;
        $ok3 = mysqli_query($conn, "INSERT INTO vanchuyen (user_id, dh_id, vc_tenKH, vc_email, vc_sdt, vc_diachi, vc_thanhpho)
                                    VALUES ($user_id, $dh_id, '$tenKh', '$email', $sdt, '123 Duong Test', 'Ho Chi Minh')");

        if (!$ok2 || !$ok3) {
            $allOk = false;
            break;
        }
    }

    if ($allOk) {
        mysqli_query($conn, "COMMIT");
    } else {
        mysqli_query($conn, "ROLLBACK");
    }
}

// cập nhật trạng thái đơn hàng
if (isset($_POST['update_status'])) {
    $dh_id = (int)$_POST['dh_id'];
    $trangthai = mysqli_real_escape_string($conn, $_POST['trangthai']);
    $sql_update = "UPDATE donhang SET dh_trangthai = '$trangthai' WHERE dh_id = $dh_id";
    mysqli_query($conn, $sql_update);
}

// xóa đơn hàng
if (isset($_POST['delete_order'])) {
    $dh_id = (int)$_POST['dh_id'];
    mysqli_query($conn, "DELETE FROM vanchuyen WHERE dh_id = $dh_id");
    mysqli_query($conn, "DELETE FROM donhang_chitiet WHERE dh_id = $dh_id");
    mysqli_query($conn, "DELETE FROM donhang WHERE dh_id = $dh_id");
}

// Nếu chưa có đơn hàng, tự tạo đơn mẫu theo liên kết: login_user -> donhang -> donhang_chitiet + vanchuyen
seed_orders_if_empty($conn);

$sql = "SELECT
            donhang.dh_id,
            donhang.dh_ngaytao,
            donhang.dh_tongtien,
            donhang.dh_trangthai,
            login_user.user_firstname,
=======
<?php
$conn = mysqli_connect("localhost", "usertmdt", "passtmdt", "baitaplon");
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

//cập nhật trạng thái đơn hàng
if (isset($_POST['update_status'])) {
    $dh_id = $_POST['dh_id'];
    $trangthai = $_POST['trangthai'];
    $sql_update = "UPDATE donhang SET dh_trangthai = '$trangthai' WHERE dh_id = '$dh_id'";
    mysqli_query($conn, $sql_update);
}

//xoá đơn hàng
if (isset($_POST['delete_order'])) {
    $dh_id = $_POST['dh_id'];
    mysqli_query($conn, "DELETE FROM vanchuyen WHERE dh_id = '$dh_id'");
    mysqli_query($conn, "DELETE FROM donhang_chitiet WHERE dh_id = '$dh_id'");
    mysqli_query($conn, "DELETE FROM donhang WHERE dh_id = '$dh_id'");
}

$sql = "SELECT 
            donhang.dh_id, 
            donhang.dh_ngaytao, 
            donhang.dh_tongtien, 
            donhang.dh_trangthai, 
            login_user.user_firstname, 
>>>>>>> 1e04d946ee1b11827e820da189420f51ca0a5a0e
            login_user.user_lastname
        FROM donhang
        INNER JOIN login_user ON donhang.user_id = login_user.user_id
        ORDER BY donhang.dh_id DESC";

$result = mysqli_query($conn, $sql);

<<<<<<< HEAD
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $hoten = $row['user_lastname'] . " " . $row['user_firstname'];
        $tongtien = number_format($row['dh_tongtien'], 0, ',', '.') . "đ";
        $trangthai = $row['dh_trangthai'];

        echo '<tr>
                <td>' . (int)$row['dh_id'] . '</td>
                <td>' . htmlspecialchars($hoten) . '</td>
                <td>' . htmlspecialchars($row['dh_ngaytao']) . '</td>
                <td>' . $tongtien . '</td>
                <td>
                  <form method="POST">
                    <input type="hidden" name="dh_id" value="' . (int)$row['dh_id'] . '">
=======
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $hoten = $row['user_lastname'] . " " . $row['user_firstname'];
        $tongtien = number_format($row['dh_tongtien'], 0, ',', '.') . "₫";
        $trangthai = $row['dh_trangthai'];

        echo '<tr>
                <td>' . $row['dh_id'] . '</td>
                <td>' . $hoten . '</td>
                <td>' . $row['dh_ngaytao'] . '</td>
                <td>' . $tongtien . '</td>
                <td>
                  <form method="POST">
                    <input type="hidden" name="dh_id" value="' . $row['dh_id'] . '">
>>>>>>> 1e04d946ee1b11827e820da189420f51ca0a5a0e
                    <select name="trangthai">
                      <option value="Cho_xac_nhan"' . ($trangthai == 'Cho_xac_nhan' ? ' selected' : '') . '>Cho_xac_nhan</option>
                      <option value="Da_thanh_toan"' . ($trangthai == 'Da_thanh_toan' ? ' selected' : '') . '>Da_thanh_toan</option>
                      <option value="Thanhtoan_Thatbai"' . ($trangthai == 'Thanhtoan_Thatbai' ? ' selected' : '') . '>Thanhtoan_Thatbai</option>
                      <option value="Dang_giao"' . ($trangthai == 'Dang_giao' ? ' selected' : '') . '>Dang_giao</option>
                      <option value="Da_giao"' . ($trangthai == 'Da_giao' ? ' selected' : '') . '>Da_giao</option>
                      <option value="Da_huy"' . ($trangthai == 'Da_huy' ? ' selected' : '') . '>Da_huy</option>
                    </select>
                    <button type="submit" name="update_status" class="update-btn">Cập nhật</button>
                  </form>
                </td>
                <td>
                   <div style="display: inline-flex; gap: 5px;">
<<<<<<< HEAD
                        <form method="POST" onsubmit="return confirm(\'Bạn có chắc chắn muốn xóa đơn này không?\');">
                            <input type="hidden" name="dh_id" value="' . (int)$row['dh_id'] . '">
                            <button type="submit" name="delete_order" class="delete-btn">Xóa</button>
                        </form>
                        <form method="GET" action="Admin_xem_donhang.php" class="btn-inline-form">
                            <input type="hidden" name="dh_id" value="' . (int)$row['dh_id'] . '">
                            <button type="submit" class="btn-detail">Chi tiết</button>
=======
                        <form method="POST" onsubmit="return confirm(\'Bạn có chắc chắn muốn xoá đơn này không?\');">
                            <input type="hidden" name="dh_id" value="' . $row['dh_id'] . '">
                            <button type="submit" name="delete_order" class="delete-btn">Xoá</button>
                        </form>
                        <form method="GET" action="Admin_xem_donhang.php" class="btn-inline-form">
                            <input type="hidden" name="dh_id" value="' . $row['dh_id'] . '">
                            <button type="submit" class="btn-detail">📝 Chi tiết</button>
>>>>>>> 1e04d946ee1b11827e820da189420f51ca0a5a0e
                        </form>
                    </div>
              </tr>';
    }
} else {
    echo "<tr><td colspan='6'>Không có đơn hàng nào.</td></tr>";
}

mysqli_close($conn);
?>
<<<<<<< HEAD

=======
>>>>>>> 1e04d946ee1b11827e820da189420f51ca0a5a0e
