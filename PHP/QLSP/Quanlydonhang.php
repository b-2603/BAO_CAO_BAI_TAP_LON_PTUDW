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
            login_user.user_lastname
        FROM donhang
        INNER JOIN login_user ON donhang.user_id = login_user.user_id
        ORDER BY donhang.dh_id DESC";

$result = mysqli_query($conn, $sql);

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
                        <form method="POST" onsubmit="return confirm(\'Bạn có chắc chắn muốn xoá đơn này không?\');">
                            <input type="hidden" name="dh_id" value="' . $row['dh_id'] . '">
                            <button type="submit" name="delete_order" class="delete-btn">Xoá</button>
                        </form>
                        <form method="GET" action="Admin_xem_donhang.php" class="btn-inline-form">
                            <input type="hidden" name="dh_id" value="' . $row['dh_id'] . '">
                            <button type="submit" class="btn-detail">📝 Chi tiết</button>
                        </form>
                    </div>
              </tr>';
    }
} else {
    echo "<tr><td colspan='6'>Không có đơn hàng nào.</td></tr>";
}

mysqli_close($conn);
?>
