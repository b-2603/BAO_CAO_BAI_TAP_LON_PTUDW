<?php
$conn = mysqli_connect("localhost", "root", "", "baitaplon");
if (!$conn) {
    echo "<div class='alert alert-danger'>Khong ket noi duoc CSDL: " . htmlspecialchars(mysqli_connect_error()) . "</div>";
    exit;
}
mysqli_set_charset($conn, "utf8");

function countTable($conn, $table)
{
    $res = mysqli_query($conn, "SELECT COUNT(*) AS c FROM $table");
    if (!$res) {
        return 0;
    }
    $row = mysqli_fetch_assoc($res);
    return (int) $row['c'];
}

function scalarNumber($conn, $sql, $field)
{
    $res = mysqli_query($conn, $sql);
    if (!$res) {
        return 0;
    }
    $row = mysqli_fetch_assoc($res);
    return isset($row[$field]) ? (float) $row[$field] : 0;
}

$tongUser = countTable($conn, "login_user");
$tongSanPham = countTable($conn, "sanpham");
$tongDon = countTable($conn, "donhang");
$tongDoanhThu = scalarNumber($conn, "SELECT COALESCE(SUM(dh_tongtien),0) AS tong FROM donhang", "tong");

$recentOrders = mysqli_query(
    $conn,
    "SELECT d.dh_id, d.dh_ngaytao, d.dh_tongtien, d.dh_trangthai,
            COALESCE(CONCAT(u.user_lastname, ' ', u.user_firstname), 'Khach le') AS ten_khach
     FROM donhang d
     LEFT JOIN login_user u ON d.user_id = u.user_id
     ORDER BY d.dh_id DESC
     LIMIT 5"
);

$recentProducts = mysqli_query(
    $conn,
    "SELECT sp_id, sp_ten, sp_gia FROM sanpham ORDER BY sp_id DESC LIMIT 6"
);
?>

<div style="display:block; max-width:100%; min-height:100%; box-sizing:border-box; padding:8px;">
  <div style="display:flex; justify-content:space-between; align-items:flex-start; gap:12px; flex-wrap:wrap;">
    <div>
      <h2 style="margin:0 0 8px 0;">Trang Khach (Admin)</h2>
      <p style="margin:0; color:#4b5563;">Tong quan du lieu thuc te tu CSDL cho khu vuc quan tri.</p>
    </div>
    <a href="QLSP/seed_admin_data.php" target="_blank" style="text-decoration:none; background:#2563eb; color:#fff; padding:10px 14px; border-radius:8px; font-weight:600;">
      Them du lieu mau
    </a>
  </div>

  <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap:12px; margin-top:16px;">
    <div style="background:#f8fbff; border:1px solid #dbe7ff; border-radius:10px; padding:12px;">
      <div style="font-size:12px; color:#64748b; text-transform:uppercase;">Nguoi dung</div>
      <div style="font-size:28px; font-weight:700; color:#0f172a;"><?php echo $tongUser; ?></div>
    </div>
    <div style="background:#f8fbff; border:1px solid #dbe7ff; border-radius:10px; padding:12px;">
      <div style="font-size:12px; color:#64748b; text-transform:uppercase;">San pham</div>
      <div style="font-size:28px; font-weight:700; color:#0f172a;"><?php echo $tongSanPham; ?></div>
    </div>
    <div style="background:#f8fbff; border:1px solid #dbe7ff; border-radius:10px; padding:12px;">
      <div style="font-size:12px; color:#64748b; text-transform:uppercase;">Don hang</div>
      <div style="font-size:28px; font-weight:700; color:#0f172a;"><?php echo $tongDon; ?></div>
    </div>
    <div style="background:#f8fbff; border:1px solid #dbe7ff; border-radius:10px; padding:12px;">
      <div style="font-size:12px; color:#64748b; text-transform:uppercase;">Doanh thu</div>
      <div style="font-size:28px; font-weight:700; color:#0f172a;"><?php echo number_format($tongDoanhThu, 0, ',', '.'); ?> d</div>
    </div>
  </div>

  <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap:12px; margin-top:16px;">
    <div style="background:#fff; border:1px solid #e5e7eb; border-radius:10px; padding:12px; overflow:auto;">
      <h4 style="margin:0 0 10px 0;">Don hang gan day</h4>
      <table style="width:100%; border-collapse:collapse; min-width:620px;">
        <thead>
          <tr>
            <th style="text-align:left; border-bottom:1px solid #e5e7eb; padding:8px;">ID</th>
            <th style="text-align:left; border-bottom:1px solid #e5e7eb; padding:8px;">Khach hang</th>
            <th style="text-align:left; border-bottom:1px solid #e5e7eb; padding:8px;">Ngay tao</th>
            <th style="text-align:right; border-bottom:1px solid #e5e7eb; padding:8px;">Tong tien</th>
            <th style="text-align:left; border-bottom:1px solid #e5e7eb; padding:8px;">Trang thai</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($recentOrders && mysqli_num_rows($recentOrders) > 0) { while ($o = mysqli_fetch_assoc($recentOrders)) { ?>
            <tr>
              <td style="border-bottom:1px solid #f1f5f9; padding:8px;">#<?php echo (int) $o['dh_id']; ?></td>
              <td style="border-bottom:1px solid #f1f5f9; padding:8px;"><?php echo htmlspecialchars($o['ten_khach']); ?></td>
              <td style="border-bottom:1px solid #f1f5f9; padding:8px;"><?php echo htmlspecialchars($o['dh_ngaytao']); ?></td>
              <td style="border-bottom:1px solid #f1f5f9; padding:8px; text-align:right;"><?php echo number_format((float) $o['dh_tongtien'], 0, ',', '.'); ?> d</td>
              <td style="border-bottom:1px solid #f1f5f9; padding:8px;"><?php echo htmlspecialchars($o['dh_trangthai']); ?></td>
            </tr>
          <?php } } else { ?>
            <tr><td colspan="5" style="padding:12px; color:#6b7280;">Chua co don hang. Bam "Them du lieu mau" de tao nhanh du lieu test.</td></tr>
          <?php } ?>
        </tbody>
      </table>
    </div>

    <div style="background:#fff; border:1px solid #e5e7eb; border-radius:10px; padding:12px;">
      <h4 style="margin:0 0 10px 0;">San pham moi</h4>
      <ul style="padding-left:18px; margin:0;">
        <?php if ($recentProducts && mysqli_num_rows($recentProducts) > 0) { while ($p = mysqli_fetch_assoc($recentProducts)) { ?>
          <li style="margin-bottom:8px;"><strong><?php echo htmlspecialchars($p['sp_ten']); ?></strong><br><span style="color:#64748b;"><?php echo number_format((float) $p['sp_gia'], 0, ',', '.'); ?> d</span></li>
        <?php } } else { ?>
          <li style="color:#6b7280;">Chua co san pham.</li>
        <?php } ?>
      </ul>
    </div>
  </div>
</div>

<?php mysqli_close($conn); ?>

