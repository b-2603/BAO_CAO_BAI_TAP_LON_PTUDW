
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Quản Lý Đơn Hàng</title>
  <link rel="stylesheet" href="../../CSS/ad_qldonhang.css">
    <link rel="stylesheet" href="../../CSS/luxe.css">
</head>
<body>
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
  <h2 style="margin: 0;">QUẢN LÝ ĐƠN HÀNG</h2>
  <a href="javascript:history.back()" style="padding: 8px 16px; background-color: transparent; color: #6D4C41; text-decoration: none; font-weight: bold; border: 2px solid #6D4C41; border-radius: 5px;">
    <span style="margin-right: 6px;">&#8592;</span>Trở lại
  </a>
</div>
<table>
  <tr>
    <th>ID</th>
    <th>Người đặt</th>
    <th>Ngày đặt</th>
    <th>Tổng tiền</th>
    <th>Trạng thái</th>
    <th>Hành động</th>
  </tr>
  <tr>
    <?php include '../QLSP/Quanlydonhang.php'; ?>
  </tr>
</table>

</body>
</html>

