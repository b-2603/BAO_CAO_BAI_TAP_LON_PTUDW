<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Quản Lý Đơn Hàng</title>
  <link rel="stylesheet" href="../../CSS/ad_qldonhang.css">
  <link rel="stylesheet" href="../../CSS/luxe.css">
  <style>
    .order-toolbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 12px;
      margin-bottom: 16px;
      flex-wrap: wrap;
    }

    .back-btn {
      padding: 9px 14px;
      border-radius: 10px;
      border: 1px solid #2563eb;
      color: #1d4ed8;
      text-decoration: none;
      font-weight: 700;
      background: #eff6ff;
      transition: 0.2s ease;
    }

    .back-btn:hover {
      background: #dbeafe;
      transform: translateY(-1px);
    }
  </style>
</head>
<body>
  <div class="order-toolbar">
    <h2 style="margin: 0;">QUẢN LÝ ĐƠN HÀNG</h2>
    <a href="javascript:history.back()" class="back-btn">
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
    <?php include '../QLSP/Quanlydonhang.php'; ?>
  </table>
</body>
</html>
