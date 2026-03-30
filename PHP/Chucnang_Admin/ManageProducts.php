<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Quản Lý Sản Phẩm</title>
  <link rel="stylesheet" href="../../CSS/ad_themsp.css">
    <link rel="stylesheet" href="../../CSS/luxe.css">
</head>
<body>
  
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
  <h2 style="margin: 0;">THÊM SẢN PHẨM MỚI</h2>
  <a href="javascript:history.back()" style="padding: 8px 16px; background-color: transparent; color: #6D4C41; text-decoration: none; font-weight: bold; border: 2px solid #6D4C41; border-radius: 5px;">
    <span style="margin-right: 6px;">&#8592;</span>Trở lại
  </a>
</div>
  <!-- Form thêm sản phẩm -->
  <form action="../QLSP/them_sanpham.php" method="POST">
    <h3>Thêm Sản Phẩm</h3>

    <div class="form-group">
      <input type="text" name="sp_ten" placeholder="Tên sản phẩm" required>
      <input type="number" step="0.01" name="sp_gia" placeholder="Giá (VND)" required>
      <input type="text" name="sp_thuoctinh" placeholder="Thuộc tính (VD: mới, hot)">
    </div>

    <div class="form-group">
      <select name="dm_iddanhmuc" required>
        <option value="">Chọn danh mục</option>
        <?php
          $conn = mysqli_connect("localhost", "usertmdt", "passtmdt", "baitaplon");
          $sql_dm = "SELECT * FROM danhmuc";
          $result_dm = mysqli_query($conn, $sql_dm);
          while ($row = mysqli_fetch_assoc($result_dm)) {
              echo '<option value="' . $row['dm_iddanhmuc'] . '">' . $row['dm_ten'] . '</option>';
          }
        ?>
      </select>
    </div>

    <div class="form-group">
      <select name="dmc_idcon" required>
        <option value="">Chọn danh mục con</option>
        <?php
          $sql_dmc = "SELECT * FROM danhmuccon";
          $result_dmc = mysqli_query($conn, $sql_dmc);
          while ($row = mysqli_fetch_assoc($result_dmc)) {
              echo '<option value="' . $row['dmc_idcon'] . '">' . $row['dmc_tencon'] . '</option>';
          }
          mysqli_close($conn);
        ?>
      </select>
    </div>

    <h4>Ảnh sản phẩm</h4>
    <div class="form-group column">
      <input type="text" name="sp_anh1" placeholder="Đường dẫn ảnh chính 1" required>
      <input type="text" name="sp_anh2" placeholder="Đường dẫn ảnh chính 2">
      <input type="text" name="ct_album1" placeholder="Ảnh chi tiết 1">
      <input type="text" name="ct_album2" placeholder="Ảnh chi tiết 2">
      <input type="text" name="ct_album3" placeholder="Ảnh chi tiết 3">
    </div>

    <h4>Mô tả</h4>
    <div class="form-group">
      <textarea name="ct_motangan" placeholder="Mô tả ngắn"></textarea>
      <textarea name="ct_motachitiet" placeholder="Mô tả chi tiết"></textarea>
      <textarea name="ct_kichthuoc" placeholder="Kích thước (nếu có)"></textarea>
    </div>

    <div class="form-group">
      <input type="text" name="ct_xuatxu" placeholder="Xuất xứ">
    </div>

    <button type="submit">Thêm sản phẩm</button>
  </form>

</body>
</html>

