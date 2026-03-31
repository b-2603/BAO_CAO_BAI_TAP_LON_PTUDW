<?php
$conn = mysqli_connect("localhost", "root", "", "baitaplon");
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8");

function esc($conn, $key)
{
    return isset($_POST[$key]) ? mysqli_real_escape_string($conn, trim($_POST[$key])) : "";
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = isset($_POST["action"]) ? $_POST["action"] : "";
    $msg = "";

    if ($action === "add_product") {
        $sp_ten = esc($conn, "sp_ten");
        $sp_gia = (float) (isset($_POST["sp_gia"]) ? $_POST["sp_gia"] : 0);
        $sp_anh1 = esc($conn, "sp_anh1");
        $sp_anh2 = esc($conn, "sp_anh2");
        $sp_thuoctinh = esc($conn, "sp_thuoctinh");
        $dm_iddanhmuc = (int) (isset($_POST["dm_iddanhmuc"]) ? $_POST["dm_iddanhmuc"] : 0);
        $dmc_idcon = (int) (isset($_POST["dmc_idcon"]) ? $_POST["dmc_idcon"] : 0);

        $ct_motangan = esc($conn, "ct_motangan");
        $ct_motachitiet = esc($conn, "ct_motachitiet");
        $ct_kichthuoc = esc($conn, "ct_kichthuoc");
        $ct_xuatxu = esc($conn, "ct_xuatxu");
        $ct_album1 = esc($conn, "ct_album1");
        $ct_album2 = esc($conn, "ct_album2");
        $ct_album3 = esc($conn, "ct_album3");

        mysqli_query($conn, "START TRANSACTION");

        $ok1 = mysqli_query(
            $conn,
            "INSERT INTO sanpham (dmc_idcon, sp_ten, sp_gia, sp_anh1, sp_anh2, sp_thuoctinh, dm_iddanhmuc)
             VALUES ($dmc_idcon, '$sp_ten', $sp_gia, '$sp_anh1', '$sp_anh2', '$sp_thuoctinh', $dm_iddanhmuc)"
        );

        if ($ok1) {
            $sp_id = mysqli_insert_id($conn);
            $ok2 = mysqli_query(
                $conn,
                "INSERT INTO sanpham_chitiet (sp_id, ct_motachitiet, ct_danhgia, ct_motangan, ct_luotdanhgia, ct_kichthuoc, ct_album1, ct_album2, ct_album3, ct_xuatxu)
                 VALUES ($sp_id, '$ct_motachitiet', '', '$ct_motangan', 0, '$ct_kichthuoc', '$ct_album1', '$ct_album2', '$ct_album3', '$ct_xuatxu')"
            );

            if ($ok2) {
                mysqli_query($conn, "COMMIT");
                $msg = "add_ok";
            } else {
                mysqli_query($conn, "ROLLBACK");
                $msg = "add_err";
            }
        } else {
            mysqli_query($conn, "ROLLBACK");
            $msg = "add_err";
        }
    }

    if ($action === "edit_product") {
        $sp_id = (int) (isset($_POST["sp_id"]) ? $_POST["sp_id"] : 0);

        $sp_ten = esc($conn, "sp_ten");
        $sp_gia = (float) (isset($_POST["sp_gia"]) ? $_POST["sp_gia"] : 0);
        $sp_anh1 = esc($conn, "sp_anh1");
        $sp_anh2 = esc($conn, "sp_anh2");
        $sp_thuoctinh = esc($conn, "sp_thuoctinh");
        $dm_iddanhmuc = (int) (isset($_POST["dm_iddanhmuc"]) ? $_POST["dm_iddanhmuc"] : 0);
        $dmc_idcon = (int) (isset($_POST["dmc_idcon"]) ? $_POST["dmc_idcon"] : 0);

        $ct_motangan = esc($conn, "ct_motangan");
        $ct_motachitiet = esc($conn, "ct_motachitiet");
        $ct_kichthuoc = esc($conn, "ct_kichthuoc");
        $ct_xuatxu = esc($conn, "ct_xuatxu");
        $ct_album1 = esc($conn, "ct_album1");
        $ct_album2 = esc($conn, "ct_album2");
        $ct_album3 = esc($conn, "ct_album3");

        mysqli_query($conn, "START TRANSACTION");

        $ok1 = mysqli_query(
            $conn,
            "UPDATE sanpham
             SET dmc_idcon = $dmc_idcon,
                 sp_ten = '$sp_ten',
                 sp_gia = $sp_gia,
                 sp_anh1 = '$sp_anh1',
                 sp_anh2 = '$sp_anh2',
                 sp_thuoctinh = '$sp_thuoctinh',
                 dm_iddanhmuc = $dm_iddanhmuc
             WHERE sp_id = $sp_id"
        );

        $existsCt = mysqli_query($conn, "SELECT sp_id FROM sanpham_chitiet WHERE sp_id = $sp_id LIMIT 1");
        $hasCt = $existsCt && mysqli_num_rows($existsCt) > 0;

        if ($hasCt) {
            $ok2 = mysqli_query(
                $conn,
                "UPDATE sanpham_chitiet
                 SET ct_motachitiet = '$ct_motachitiet',
                     ct_motangan = '$ct_motangan',
                     ct_kichthuoc = '$ct_kichthuoc',
                     ct_album1 = '$ct_album1',
                     ct_album2 = '$ct_album2',
                     ct_album3 = '$ct_album3',
                     ct_xuatxu = '$ct_xuatxu'
                 WHERE sp_id = $sp_id"
            );
        } else {
            $ok2 = mysqli_query(
                $conn,
                "INSERT INTO sanpham_chitiet (sp_id, ct_motachitiet, ct_danhgia, ct_motangan, ct_luotdanhgia, ct_kichthuoc, ct_album1, ct_album2, ct_album3, ct_xuatxu)
                 VALUES ($sp_id, '$ct_motachitiet', '', '$ct_motangan', 0, '$ct_kichthuoc', '$ct_album1', '$ct_album2', '$ct_album3', '$ct_xuatxu')"
            );
        }

        if ($ok1 && $ok2) {
            mysqli_query($conn, "COMMIT");
            $msg = "edit_ok";
        } else {
            mysqli_query($conn, "ROLLBACK");
            $msg = "edit_err";
        }
    }

    if ($action === "delete_product") {
        $sp_id = (int) (isset($_POST["sp_id"]) ? $_POST["sp_id"] : 0);

        mysqli_query($conn, "START TRANSACTION");
        $okA = mysqli_query($conn, "DELETE FROM giohang_chitiet WHERE ctgh_idsp = $sp_id");
        $okB = mysqli_query($conn, "DELETE FROM donhang_chitiet WHERE id_sanpham = $sp_id");
        $okC = mysqli_query($conn, "DELETE FROM sanpham_chitiet WHERE sp_id = $sp_id");
        $okD = mysqli_query($conn, "DELETE FROM sanpham WHERE sp_id = $sp_id");

        if ($okA && $okB && $okC && $okD) {
            mysqli_query($conn, "COMMIT");
            $msg = "del_ok";
        } else {
            mysqli_query($conn, "ROLLBACK");
            $msg = "del_err";
        }
    }

    header("Location: ManageProducts.php?msg=" . $msg);
    exit;
}

$msg = isset($_GET["msg"]) ? $_GET["msg"] : "";

$sql_dm = "SELECT dm_iddanhmuc, dm_ten FROM danhmuc ORDER BY dm_iddanhmuc ASC";
$result_dm = mysqli_query($conn, $sql_dm);
$ds_danhmuc = array();
while ($r = mysqli_fetch_assoc($result_dm)) {
    $ds_danhmuc[] = $r;
}

$sql_dmc = "SELECT dmc_idcon, dmc_tencon, dm_iddanhmuc FROM danhmuccon ORDER BY dmc_idcon ASC";
$result_dmc = mysqli_query($conn, $sql_dmc);
$ds_danhmuccon = array();
while ($r = mysqli_fetch_assoc($result_dmc)) {
    $ds_danhmuccon[] = $r;
}

$search = isset($_GET["search"]) ? trim($_GET["search"]) : "";
$sort = isset($_GET["sort"]) ? $_GET["sort"] : "newest";
$search_sql = mysqli_real_escape_string($conn, $search);

$where_clause = "";
if ($search_sql !== "") {
    $where_clause = " WHERE (sp.sp_ten LIKE '%$search_sql%' OR dm.dm_ten LIKE '%$search_sql%' OR dmc.dmc_tencon LIKE '%$search_sql%') ";
}

$order_clause = " ORDER BY sp.sp_id DESC ";
if ($sort === "name_asc") {
    $order_clause = " ORDER BY sp.sp_ten ASC ";
} elseif ($sort === "name_desc") {
    $order_clause = " ORDER BY sp.sp_ten DESC ";
} elseif ($sort === "price_asc") {
    $order_clause = " ORDER BY sp.sp_gia ASC ";
} elseif ($sort === "price_desc") {
    $order_clause = " ORDER BY sp.sp_gia DESC ";
}

$sql_sp_list = "SELECT sp.sp_id, sp.sp_ten, sp.sp_gia, sp.sp_thuoctinh, sp.sp_anh1, sp.sp_anh2,
                       sp.dm_iddanhmuc, sp.dmc_idcon,
                       dm.dm_ten, dmc.dmc_tencon,
                       ct.ct_motachitiet, ct.ct_motangan, ct.ct_kichthuoc,
                       ct.ct_album1, ct.ct_album2, ct.ct_album3, ct.ct_xuatxu
                FROM sanpham sp
                LEFT JOIN danhmuc dm ON sp.dm_iddanhmuc = dm.dm_iddanhmuc
                LEFT JOIN danhmuccon dmc ON sp.dmc_idcon = dmc.dmc_idcon
                LEFT JOIN sanpham_chitiet ct ON sp.sp_id = ct.sp_id
                $where_clause
                $order_clause";
$result_sp_list = mysqli_query($conn, $sql_sp_list);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Quản Lý Sản Phẩm</title>
  <link rel="stylesheet" href="../../CSS/ad_themsp.css">
  <link rel="stylesheet" href="../../CSS/luxe.css">
  <style>
    .toolbar { display:flex; justify-content:space-between; align-items:center; margin-bottom:16px; gap:12px; flex-wrap:wrap; }
    .btn-action { border:1px solid #2563eb; background:#eff6ff; color:#1d4ed8; padding:9px 14px; border-radius:10px; font-weight:700; cursor:pointer; transition:0.2s ease; }
    .btn-primary { border:0; background:linear-gradient(135deg, #2563eb 0%, #0891b2 100%); color:#fff; padding:10px 16px; border-radius:10px; font-weight:700; cursor:pointer; box-shadow:0 8px 18px rgba(37,99,235,0.28); transition:0.2s ease; }
    .btn-danger { border:1px solid #fca5a5; background:#fef2f2; color:#b91c1c; padding:4px 10px; border-radius:999px; cursor:pointer; font-weight:700; font-size:12px; transition:0.2s ease; box-shadow:none; }
    .btn-edit { border:1px solid #86efac; background:#f0fdf4; color:#166534; padding:4px 10px; border-radius:999px; cursor:pointer; font-weight:700; font-size:12px; transition:0.2s ease; box-shadow:none; }
    .btn-primary, .btn-danger, .btn-edit, .btn-filter { margin-top:0 !important; }
    .btn-edit:hover, .btn-danger:hover { transform:translateY(-1px); }
    .msg { padding:10px 12px; border-radius:8px; margin-bottom:12px; }
    .msg-ok { background:#ecfdf3; color:#065f46; border:1px solid #a7f3d0; font-weight:600; }
    .msg-err { background:#fef2f2; color:#991b1b; border:1px solid #fecaca; font-weight:600; }
    .table-wrap { overflow:auto; border:1px solid #ddd; border-radius:8px; }
    .table-wrap table { width:100%; border-collapse:collapse; min-width:1000px; }
    .table-wrap th, .table-wrap td { border-bottom:1px solid #e6e6e6; padding:8px; text-align:left; vertical-align:top; }
    .table-wrap th { background:#f1f5f9; color:#0f172a; font-weight:800; }
    .filter-bar { display:flex; gap:10px; align-items:center; flex-wrap:wrap; margin:0 0 14px 0; background:none !important; border:none !important; box-shadow:none !important; padding:0 !important; }
    .filter-input, .filter-select { border:1px solid #cbd5e1; border-radius:9px; padding:8px 10px; font-size:14px; background:#fff; }
    .filter-input { min-width:260px; }
    .filter-select { min-width:135px; max-width:150px; }
    .btn-filter { border:1px solid #0ea5e9; background:#e0f2fe; color:#075985; border-radius:9px; padding:8px 12px; font-weight:700; cursor:pointer; }
    .btn-clear { border:1px solid #cbd5e1; background:#f8fafc; color:#334155; border-radius:9px; padding:8px 12px; font-weight:700; text-decoration:none; display:inline-block; }
    .table-wrap form { background:none !important; border:none !important; box-shadow:none !important; padding:0 !important; margin:0 !important; }

    .modal-overlay { display:none; position:fixed; inset:0; background:rgba(15,23,42,0.55); z-index:2000; padding:20px; overflow:auto; }
    .modal-box { background:#fff; max-width:900px; margin:20px auto; border-radius:14px; padding:18px; border:1px solid #dbeafe; box-shadow:0 24px 60px rgba(2,6,23,0.28); }
    .modal-head { display:flex; justify-content:space-between; align-items:center; margin-bottom:10px; }
    .grid-2 { display:grid; grid-template-columns: 1fr 1fr; gap:10px; }
    .grid-1 { display:grid; grid-template-columns: 1fr; gap:10px; }
    .modal-box input, .modal-box select, .modal-box textarea { width:100%; padding:9px; border:1px solid #ccc; border-radius:6px; box-sizing:border-box; }
    .modal-foot { display:flex; justify-content:flex-end; gap:8px; margin-top:12px; }
  </style>
</head>
<body>

<div class="toolbar">
  <h2 style="margin:0;">QUẢN LÝ SẢN PHẨM</h2>
  <div style="display:flex; gap:8px; align-items:center;">
    <button class="btn-primary" type="button" onclick="openAddModal()">+ Thêm sản phẩm</button>
    <a href="javascript:history.back()" class="btn-action"><span style="margin-right:6px;">&#8592;</span>Trở lại</a>
  </div>
</div>

<form method="GET" class="filter-bar" id="filterForm">
  <input
    type="text"
    class="filter-input"
    id="searchInput"
    name="search"
    placeholder="Tìm theo tên sản phẩm, danh mục..."
    value="<?php echo htmlspecialchars($search); ?>"
  >
  <select class="filter-select" id="sortSelect" name="sort">
    <option value="newest" <?php if ($sort === "newest") echo "selected"; ?>>Mới nhất</option>
    <option value="name_asc" <?php if ($sort === "name_asc") echo "selected"; ?>>Tên A → Z</option>
    <option value="name_desc" <?php if ($sort === "name_desc") echo "selected"; ?>>Tên Z → A</option>
    <option value="price_asc" <?php if ($sort === "price_asc") echo "selected"; ?>>Giá tăng dần</option>
    <option value="price_desc" <?php if ($sort === "price_desc") echo "selected"; ?>>Giá giảm dần</option>
  </select>
  <a href="ManageProducts.php" class="btn-clear">Xóa lọc</a>
</form>

<?php if ($msg === "add_ok" || $msg === "edit_ok" || $msg === "del_ok") { ?>
  <div class="msg msg-ok">Cập nhật dữ liệu thành công.</div>
<?php } ?>
<?php if ($msg === "add_err" || $msg === "edit_err" || $msg === "del_err") { ?>
  <div class="msg msg-err">Có lỗi xảy ra khi cập nhật dữ liệu. Kiểm tra tên sản phẩm trùng hoặc dữ liệu đầu vào.</div>
<?php } ?>

<div class="table-wrap">
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Tên sản phẩm</th>
        <th>Giá</th>
        <th>Danh mục</th>
        <th>Danh mục con</th>
        <th>Thuộc tính</th>
        <th>Kích thước</th>
        <th>Hành động</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($result_sp_list && mysqli_num_rows($result_sp_list) > 0) { ?>
        <?php while ($sp = mysqli_fetch_assoc($result_sp_list)) { ?>
          <tr>
            <td><?php echo (int)$sp['sp_id']; ?></td>
            <td><?php echo htmlspecialchars($sp['sp_ten']); ?></td>
            <td><?php echo number_format((float)$sp['sp_gia'], 0, ',', '.'); ?> đ</td>
            <td><?php echo htmlspecialchars($sp['dm_ten'] ? $sp['dm_ten'] : '-'); ?></td>
            <td><?php echo htmlspecialchars($sp['dmc_tencon'] ? $sp['dmc_tencon'] : '-'); ?></td>
            <td><?php echo htmlspecialchars($sp['sp_thuoctinh'] ? $sp['sp_thuoctinh'] : '-'); ?></td>
            <td><?php echo htmlspecialchars($sp['ct_kichthuoc'] ? $sp['ct_kichthuoc'] : '-'); ?></td>
            <td>
              <div style="display:flex; gap:6px;">
                <button
                  type="button"
                  class="btn-edit"
                  onclick="openEditModal(this)"
                  data-sp_id="<?php echo (int)$sp['sp_id']; ?>"
                  data-sp_ten="<?php echo htmlspecialchars($sp['sp_ten'], ENT_QUOTES); ?>"
                  data-sp_gia="<?php echo (float)$sp['sp_gia']; ?>"
                  data-sp_anh1="<?php echo htmlspecialchars($sp['sp_anh1'], ENT_QUOTES); ?>"
                  data-sp_anh2="<?php echo htmlspecialchars($sp['sp_anh2'], ENT_QUOTES); ?>"
                  data-sp_thuoctinh="<?php echo htmlspecialchars($sp['sp_thuoctinh'], ENT_QUOTES); ?>"
                  data-dm_iddanhmuc="<?php echo (int)$sp['dm_iddanhmuc']; ?>"
                  data-dmc_idcon="<?php echo (int)$sp['dmc_idcon']; ?>"
                  data-ct_motangan="<?php echo htmlspecialchars($sp['ct_motangan'], ENT_QUOTES); ?>"
                  data-ct_motachitiet="<?php echo htmlspecialchars($sp['ct_motachitiet'], ENT_QUOTES); ?>"
                  data-ct_kichthuoc="<?php echo htmlspecialchars($sp['ct_kichthuoc'], ENT_QUOTES); ?>"
                  data-ct_xuatxu="<?php echo htmlspecialchars($sp['ct_xuatxu'], ENT_QUOTES); ?>"
                  data-ct_album1="<?php echo htmlspecialchars($sp['ct_album1'], ENT_QUOTES); ?>"
                  data-ct_album2="<?php echo htmlspecialchars($sp['ct_album2'], ENT_QUOTES); ?>"
                  data-ct_album3="<?php echo htmlspecialchars($sp['ct_album3'], ENT_QUOTES); ?>"
                >Sửa</button>

                <form method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này? Dữ liệu liên quan giỏ hàng/chi tiết đơn sẽ bị xóa theo.');">
                  <input type="hidden" name="action" value="delete_product">
                  <input type="hidden" name="sp_id" value="<?php echo (int)$sp['sp_id']; ?>">
                  <button type="submit" class="btn-danger">Xóa</button>
                </form>
              </div>
            </td>
          </tr>
        <?php } ?>
      <?php } else { ?>
        <tr>
          <td colspan="8">Chưa có dữ liệu sản phẩm.</td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<div id="addModal" class="modal-overlay">
  <div class="modal-box">
    <div class="modal-head">
      <h3 style="margin:0;">Thêm sản phẩm mới</h3>
      <button type="button" class="btn-action" onclick="closeModal('addModal')">Đóng</button>
    </div>

    <form method="POST">
      <input type="hidden" name="action" value="add_product">
      <div class="grid-2">
        <input type="text" name="sp_ten" placeholder="Tên sản phẩm" required>
        <input type="number" step="0.01" name="sp_gia" placeholder="Giá" required>
      </div>
      <div class="grid-2">
        <select name="dm_iddanhmuc" required>
          <option value="">Chọn danh mục</option>
          <?php foreach ($ds_danhmuc as $dm) { ?>
            <option value="<?php echo (int)$dm['dm_iddanhmuc']; ?>"><?php echo htmlspecialchars($dm['dm_ten']); ?></option>
          <?php } ?>
        </select>
        <select name="dmc_idcon" required>
          <option value="">Chọn danh mục con</option>
          <?php foreach ($ds_danhmuccon as $dmc) { ?>
            <option value="<?php echo (int)$dmc['dmc_idcon']; ?>"><?php echo htmlspecialchars($dmc['dmc_tencon']); ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="grid-2">
        <input type="text" name="sp_anh1" placeholder="Ảnh chính 1" required>
        <input type="text" name="sp_anh2" placeholder="Ảnh chính 2">
      </div>
      <div class="grid-2">
        <input type="text" name="ct_album1" placeholder="Album 1">
        <input type="text" name="ct_album2" placeholder="Album 2">
      </div>
      <div class="grid-2">
        <input type="text" name="ct_album3" placeholder="Album 3">
        <input type="text" name="sp_thuoctinh" placeholder="Thuộc tính (banchay/moi/hot)">
      </div>
      <div class="grid-2">
        <input type="text" name="ct_kichthuoc" placeholder="Kích thước (vd: S,M,L)">
        <input type="text" name="ct_xuatxu" placeholder="Xuất xứ">
      </div>
      <div class="grid-1">
        <textarea name="ct_motangan" rows="2" placeholder="Mô tả ngắn"></textarea>
        <textarea name="ct_motachitiet" rows="4" placeholder="Mô tả chi tiết"></textarea>
      </div>

      <div class="modal-foot">
        <button type="button" class="btn-action" onclick="closeModal('addModal')">Hủy</button>
        <button type="submit" class="btn-primary">Lưu sản phẩm</button>
      </div>
    </form>
  </div>
</div>

<div id="editModal" class="modal-overlay">
  <div class="modal-box">
    <div class="modal-head">
      <h3 style="margin:0;">Sửa sản phẩm</h3>
      <button type="button" class="btn-action" onclick="closeModal('editModal')">Đóng</button>
    </div>

    <form method="POST" id="editForm">
      <input type="hidden" name="action" value="edit_product">
      <input type="hidden" name="sp_id" id="e_sp_id">
      <div class="grid-2">
        <input type="text" name="sp_ten" id="e_sp_ten" placeholder="Tên sản phẩm" required>
        <input type="number" step="0.01" name="sp_gia" id="e_sp_gia" placeholder="Giá" required>
      </div>
      <div class="grid-2">
        <select name="dm_iddanhmuc" id="e_dm_iddanhmuc" required>
          <option value="">Chọn danh mục</option>
          <?php foreach ($ds_danhmuc as $dm) { ?>
            <option value="<?php echo (int)$dm['dm_iddanhmuc']; ?>"><?php echo htmlspecialchars($dm['dm_ten']); ?></option>
          <?php } ?>
        </select>
        <select name="dmc_idcon" id="e_dmc_idcon" required>
          <option value="">Chọn danh mục con</option>
          <?php foreach ($ds_danhmuccon as $dmc) { ?>
            <option value="<?php echo (int)$dmc['dmc_idcon']; ?>"><?php echo htmlspecialchars($dmc['dmc_tencon']); ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="grid-2">
        <input type="text" name="sp_anh1" id="e_sp_anh1" placeholder="Ảnh chính 1" required>
        <input type="text" name="sp_anh2" id="e_sp_anh2" placeholder="Ảnh chính 2">
      </div>
      <div class="grid-2">
        <input type="text" name="ct_album1" id="e_ct_album1" placeholder="Album 1">
        <input type="text" name="ct_album2" id="e_ct_album2" placeholder="Album 2">
      </div>
      <div class="grid-2">
        <input type="text" name="ct_album3" id="e_ct_album3" placeholder="Album 3">
        <input type="text" name="sp_thuoctinh" id="e_sp_thuoctinh" placeholder="Thuộc tính">
      </div>
      <div class="grid-2">
        <input type="text" name="ct_kichthuoc" id="e_ct_kichthuoc" placeholder="Kích thước">
        <input type="text" name="ct_xuatxu" id="e_ct_xuatxu" placeholder="Xuất xứ">
      </div>
      <div class="grid-1">
        <textarea name="ct_motangan" id="e_ct_motangan" rows="2" placeholder="Mô tả ngắn"></textarea>
        <textarea name="ct_motachitiet" id="e_ct_motachitiet" rows="4" placeholder="Mô tả chi tiết"></textarea>
      </div>

      <div class="modal-foot">
        <button type="button" class="btn-action" onclick="closeModal('editModal')">Hủy</button>
        <button type="submit" class="btn-primary">Cập nhật</button>
      </div>
    </form>
  </div>
</div>

<script>
function openAddModal() {
  document.getElementById('addModal').style.display = 'block';
}

function closeModal(id) {
  document.getElementById(id).style.display = 'none';
}

function openEditModal(btn) {
  var d = btn.dataset;
  document.getElementById('e_sp_id').value = d.sp_id || '';
  document.getElementById('e_sp_ten').value = d.sp_ten || '';
  document.getElementById('e_sp_gia').value = d.sp_gia || '';
  document.getElementById('e_sp_anh1').value = d.sp_anh1 || '';
  document.getElementById('e_sp_anh2').value = d.sp_anh2 || '';
  document.getElementById('e_sp_thuoctinh').value = d.sp_thuoctinh || '';
  document.getElementById('e_dm_iddanhmuc').value = d.dm_iddanhmuc || '';
  document.getElementById('e_dmc_idcon').value = d.dmc_idcon || '';
  document.getElementById('e_ct_motangan').value = d.ct_motangan || '';
  document.getElementById('e_ct_motachitiet').value = d.ct_motachitiet || '';
  document.getElementById('e_ct_kichthuoc').value = d.ct_kichthuoc || '';
  document.getElementById('e_ct_xuatxu').value = d.ct_xuatxu || '';
  document.getElementById('e_ct_album1').value = d.ct_album1 || '';
  document.getElementById('e_ct_album2').value = d.ct_album2 || '';
  document.getElementById('e_ct_album3').value = d.ct_album3 || '';
  document.getElementById('editModal').style.display = 'block';
}

window.onclick = function(evt) {
  var addM = document.getElementById('addModal');
  var editM = document.getElementById('editModal');
  if (evt.target === addM) closeModal('addModal');
  if (evt.target === editM) closeModal('editModal');
};

var filterForm = document.getElementById('filterForm');
var searchInput = document.getElementById('searchInput');
var sortSelect = document.getElementById('sortSelect');
var searchTimer;

if (searchInput && filterForm) {
  searchInput.addEventListener('input', function() {
    clearTimeout(searchTimer);
    searchTimer = setTimeout(function() {
      filterForm.submit();
    }, 350);
  });
}

if (sortSelect && filterForm) {
  sortSelect.addEventListener('change', function() {
    filterForm.submit();
  });
}
</script>

<?php mysqli_close($conn); ?>
</body>
</html>

