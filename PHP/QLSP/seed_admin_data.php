<?php
session_start();
if (!isset($_SESSION['admin_email']) || $_SESSION['user_role'] !== 'admin') {
    echo "Ban khong co quyen truy cap.";
    exit;
}

$conn = mysqli_connect("localhost", "root", "", "baitaplon");
if (!$conn) {
    die("Ket noi that bai: " . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8");

function q($conn, $sql)
{
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        throw new Exception(mysqli_error($conn));
    }
    return $result;
}

function scalar($conn, $sql, $field)
{
    $res = q($conn, $sql);
    $row = mysqli_fetch_assoc($res);
    return $row ? $row[$field] : null;
}

$report = array();

try {
    q($conn, "START TRANSACTION");

    $userId = scalar($conn, "SELECT user_id FROM login_user ORDER BY user_id ASC LIMIT 1", "user_id");
    if (!$userId) {
        $demoEmail = "demo.user@shop.local";
        $demoPass = sha1("123456");
        q(
            $conn,
            "INSERT INTO login_user (user_firstname, user_lastname, user_pass, user_email, user_ngaytaotk)
             VALUES ('Demo', 'User', '$demoPass', '$demoEmail', NOW())"
        );
        $userId = mysqli_insert_id($conn);
        $report[] = "Da tao 1 user mau: $demoEmail";
    } else {
        $report[] = "login_user da co du lieu, giu nguyen.";
    }

    $dmCount = (int) scalar($conn, "SELECT COUNT(*) AS c FROM danhmuc", "c");
    if ($dmCount === 0) {
        q($conn, "INSERT INTO danhmuc (dm_ten, dm_mota, dm_motachitiet, dm_anh1, dm_anh2, dm_anh3, dm_anhsub1, dm_anhsub2) VALUES
            ('Ao The Thao', 'Ao tap luyen', 'Danh muc ao tap luyen cho nam va nu.',
             'https://images.pexels.com/photos/6550851/pexels-photo-6550851.jpeg',
             'https://images.pexels.com/photos/6551098/pexels-photo-6551098.jpeg',
             'https://images.pexels.com/photos/7679720/pexels-photo-7679720.jpeg',
             'https://images.pexels.com/photos/5384620/pexels-photo-5384620.jpeg',
             'https://images.pexels.com/photos/2780762/pexels-photo-2780762.jpeg'),
            ('Giay Chay Bo', 'Giay bo va sneaker', 'Danh muc giay phuc vu tap luyen va di bo.',
             'https://images.pexels.com/photos/2529148/pexels-photo-2529148.jpeg',
             'https://images.pexels.com/photos/1456706/pexels-photo-1456706.jpeg',
             'https://images.pexels.com/photos/19090/pexels-photo.jpg',
             'https://images.pexels.com/photos/267202/pexels-photo-267202.jpeg',
             'https://images.pexels.com/photos/2529147/pexels-photo-2529147.jpeg'),
            ('Phu Kien', 'Phu kien tap luyen', 'Binh nuoc, tui gym va phu kien khac.',
             'https://images.pexels.com/photos/4397840/pexels-photo-4397840.jpeg',
             'https://images.pexels.com/photos/3759657/pexels-photo-3759657.jpeg',
             'https://images.pexels.com/photos/4498605/pexels-photo-4498605.jpeg',
             'https://images.pexels.com/photos/2385477/pexels-photo-2385477.jpeg',
             'https://images.pexels.com/photos/8436738/pexels-photo-8436738.jpeg')
        ");
        $report[] = "Da tao 3 danh muc mau.";
    } else {
        $report[] = "danhmuc da co du lieu, giu nguyen.";
    }

    $dmcCount = (int) scalar($conn, "SELECT COUNT(*) AS c FROM danhmuccon", "c");
    if ($dmcCount === 0) {
        $dmRows = q($conn, "SELECT dm_iddanhmuc, dm_ten FROM danhmuc ORDER BY dm_iddanhmuc ASC");
        while ($dm = mysqli_fetch_assoc($dmRows)) {
            $dmId = (int) $dm["dm_iddanhmuc"];
            $dmTen = mysqli_real_escape_string($conn, $dm["dm_ten"]);
            q($conn, "INSERT INTO danhmuccon (dm_iddanhmuc, dmc_tencon, dmc_mota, dmc_motachitiet) VALUES
                ($dmId, '$dmTen Co Ban', 'Dong co ban', 'San pham co ban thuoc danh muc $dmTen'),
                ($dmId, '$dmTen Cao Cap', 'Dong cao cap', 'San pham cao cap thuoc danh muc $dmTen')
            ");
        }
        $report[] = "Da tao danh muc con cho tung danh muc.";
    } else {
        $report[] = "danhmuccon da co du lieu, giu nguyen.";
    }

    $spCount = (int) scalar($conn, "SELECT COUNT(*) AS c FROM sanpham", "c");
    if ($spCount === 0) {
        $catMap = q($conn, "SELECT dm_iddanhmuc, dmc_idcon FROM danhmuccon ORDER BY dmc_idcon ASC");
        $first = mysqli_fetch_assoc($catMap);
        if (!$first) {
            throw new Exception("Khong tim thay danhmuccon de tao san pham.");
        }
        $dmId = (int) $first["dm_iddanhmuc"];
        $dmcId = (int) $first["dmc_idcon"];

        $products = array(
            array("Ao Running Pro", 490000, "https://images.pexels.com/photos/3076509/pexels-photo-3076509.jpeg", "https://images.pexels.com/photos/6456159/pexels-photo-6456159.jpeg", "banchay"),
            array("Quan Tap DryFit", 390000, "https://images.pexels.com/photos/2294361/pexels-photo-2294361.jpeg", "https://images.pexels.com/photos/8473714/pexels-photo-8473714.jpeg", "moi"),
            array("Giay Sprint X", 1290000, "https://images.pexels.com/photos/2529148/pexels-photo-2529148.jpeg", "https://images.pexels.com/photos/1598505/pexels-photo-1598505.jpeg", "banchay"),
            array("Binh Nuoc Sport 1L", 190000, "https://images.pexels.com/photos/416717/pexels-photo-416717.jpeg", "https://images.pexels.com/photos/1111304/pexels-photo-1111304.jpeg", "hot")
        );

        foreach ($products as $p) {
            $name = mysqli_real_escape_string($conn, $p[0]);
            $price = (int) $p[1];
            $img1 = mysqli_real_escape_string($conn, $p[2]);
            $img2 = mysqli_real_escape_string($conn, $p[3]);
            $attr = mysqli_real_escape_string($conn, $p[4]);

            q($conn, "INSERT INTO sanpham (dmc_idcon, sp_ten, sp_gia, sp_anh1, sp_anh2, sp_thuoctinh, dm_iddanhmuc)
                VALUES ($dmcId, '$name', $price, '$img1', '$img2', '$attr', $dmId)");
            $spId = mysqli_insert_id($conn);
            q($conn, "INSERT INTO sanpham_chitiet (sp_id, ct_motachitiet, ct_danhgia, ct_motangan, ct_luotdanhgia, ct_kichthuoc, ct_album1, ct_album2, ct_album3, ct_xuatxu)
                VALUES ($spId, 'San pham mau de test trang admin', '4.8', 'Mo ta ngan cho san pham mau', 120, 'S,M,L', '$img1', '$img2', '$img1', 'Viet Nam')");
        }
        $report[] = "Da tao 4 san pham + chi tiet san pham.";
    } else {
        $report[] = "sanpham da co du lieu, giu nguyen.";
    }

    $orderCount = (int) scalar($conn, "SELECT COUNT(*) AS c FROM donhang", "c");
    if ($orderCount === 0) {
        $spRes = q($conn, "SELECT sp_id, sp_ten, sp_gia, sp_anh1 FROM sanpham ORDER BY sp_id ASC LIMIT 3");
        $seedProducts = array();
        while ($r = mysqli_fetch_assoc($spRes)) {
            $seedProducts[] = $r;
        }
        if (count($seedProducts) === 0) {
            throw new Exception("Khong tim thay san pham de tao don hang mau.");
        }

        $statuses = array("Cho_xac_nhan", "Dang_giao", "Da_giao");
        foreach ($statuses as $idx => $status) {
            $picked = $seedProducts[$idx % count($seedProducts)];
            $spId = (int) $picked["sp_id"];
            $spName = mysqli_real_escape_string($conn, $picked["sp_ten"]);
            $spImg = mysqli_real_escape_string($conn, $picked["sp_anh1"]);
            $qty = $idx + 1;
            $price = (int) $picked["sp_gia"];
            $total = $qty * $price;
            $statusEsc = mysqli_real_escape_string($conn, $status);

            q($conn, "INSERT INTO donhang (user_id, dh_tongtien, dh_trangthai) VALUES ($userId, $total, '$statusEsc')");
            $dhId = mysqli_insert_id($conn);

            q($conn, "INSERT INTO donhang_chitiet (dh_id, id_sanpham, dhct_soluong, dhct_giabansp, dhct_thanhtien, dhct_tensp, dhct_anhsp)
                VALUES ($dhId, $spId, $qty, $price, $total, '$spName', '$spImg')");

            q($conn, "INSERT INTO vanchuyen (user_id, dh_id, vc_tenKH, vc_email, vc_sdt, vc_diachi, vc_thanhpho)
                VALUES ($userId, $dhId, 'Khach Demo', 'demo.user@shop.local', '090000000$idx', '123 Duong Demo', 'Ho Chi Minh')");
        }
        $report[] = "Da tao 3 don hang mau + van chuyen.";
    } else {
        $report[] = "donhang da co du lieu, giu nguyen.";
    }

    q($conn, "COMMIT");
} catch (Exception $e) {
    mysqli_query($conn, "ROLLBACK");
    $report[] = "Loi: " . $e->getMessage();
}

$summary = array(
    "tong_user" => scalar($conn, "SELECT COUNT(*) AS c FROM login_user", "c"),
    "tong_danhmuc" => scalar($conn, "SELECT COUNT(*) AS c FROM danhmuc", "c"),
    "tong_danhmuccon" => scalar($conn, "SELECT COUNT(*) AS c FROM danhmuccon", "c"),
    "tong_sanpham" => scalar($conn, "SELECT COUNT(*) AS c FROM sanpham", "c"),
    "tong_donhang" => scalar($conn, "SELECT COUNT(*) AS c FROM donhang", "c")
);
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Seed Du Lieu Admin</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f5f7fb; margin: 0; padding: 24px; }
    .box { max-width: 900px; margin: 0 auto; background: #fff; border: 1px solid #dbe1ef; border-radius: 10px; padding: 20px; }
    h2 { margin-top: 0; }
    ul { margin: 0 0 16px 18px; }
    table { width: 100%; border-collapse: collapse; margin-top: 8px; }
    th, td { border: 1px solid #e3e8f4; padding: 10px; text-align: left; }
    th { background: #eef3ff; }
    .back { margin-top: 16px; display: inline-block; text-decoration: none; padding: 10px 14px; border: 1px solid #3b82f6; border-radius: 8px; color: #1d4ed8; font-weight: 600; }
  </style>
</head>
<body>
  <div class="box">
    <h2>Seed du lieu admin da thuc thi</h2>
    <ul>
      <?php foreach ($report as $line) { ?>
        <li><?php echo htmlspecialchars($line); ?></li>
      <?php } ?>
    </ul>

    <table>
      <tr><th>Bang</th><th>So ban ghi</th></tr>
      <tr><td>login_user</td><td><?php echo (int) $summary["tong_user"]; ?></td></tr>
      <tr><td>danhmuc</td><td><?php echo (int) $summary["tong_danhmuc"]; ?></td></tr>
      <tr><td>danhmuccon</td><td><?php echo (int) $summary["tong_danhmuccon"]; ?></td></tr>
      <tr><td>sanpham</td><td><?php echo (int) $summary["tong_sanpham"]; ?></td></tr>
      <tr><td>donhang</td><td><?php echo (int) $summary["tong_donhang"]; ?></td></tr>
    </table>

    <a class="back" href="../Admin.php">Tro ve trang admin</a>
  </div>
</body>
</html>
