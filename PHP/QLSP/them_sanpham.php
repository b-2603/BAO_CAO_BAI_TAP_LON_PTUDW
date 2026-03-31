<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
<<<<<<< HEAD
    $conn = mysqli_connect("localhost", "root", "", "baitaplon");
=======
    $conn = mysqli_connect("localhost", "usertmdt", "passtmdt", "baitaplon");
>>>>>>> 1e04d946ee1b11827e820da189420f51ca0a5a0e
    if (!$conn) {
        die("Kết nối thất bại: " . mysqli_connect_error());
    }
// Lấy dữ liệu từ form
    $sp_ten = $_POST['sp_ten'];
    $sp_gia = $_POST['sp_gia'];
    $sp_anh1 = $_POST['sp_anh1'];
    $sp_anh2 = $_POST['sp_anh2'];
    $sp_thuoctinh = $_POST['sp_thuoctinh'];
    $dm_iddanhmuc = $_POST['dm_iddanhmuc'];
    $dmc_idcon = $_POST['dmc_idcon'];

    $ct_motangan = $_POST['ct_motangan'];
    $ct_motachitiet = $_POST['ct_motachitiet'];
    $ct_kichthuoc = $_POST['ct_kichthuoc'];
    $ct_xuatxu = $_POST['ct_xuatxu'];
    $ct_album1 = $_POST['ct_album1'];
    $ct_album2 = $_POST['ct_album2'];
    $ct_album3 = $_POST['ct_album3'];

// Thêm vào bảng sanpham
    $sql_sp = "INSERT INTO sanpham (dmc_idcon, sp_ten, sp_gia, sp_anh1, sp_anh2, sp_thuoctinh, dm_iddanhmuc) 
               VALUES ('$dmc_idcon', '$sp_ten', '$sp_gia', '$sp_anh1', '$sp_anh2', '$sp_thuoctinh', '$dm_iddanhmuc')";
    
    if (mysqli_query($conn, $sql_sp)) {
        $sp_id = mysqli_insert_id($conn); 

// Thêm vào bảng chitietsp
        $sql_ct = "INSERT INTO sanpham_chitiet (sp_id, ct_motachitiet, ct_danhgia, ct_motangan, ct_luotdanhgia, ct_kichthuoc, ct_album1, ct_album2, ct_album3, ct_xuatxu)
                   VALUES ('$sp_id', '$ct_motachitiet', '', '$ct_motangan', 0, '$ct_kichthuoc',  '$ct_album1', '$ct_album2', '$ct_album3', '$ct_xuatxu')";

        if (mysqli_query($conn, $sql_ct)) {
            echo '
            <div style="max-width: 600px; margin: 50px auto; padding: 30px; border: 1px solid #8d6e63; border-radius: 10px; background-color: #efebe9; text-align: center;">
                <h3 style="color: #4e342e;">✅ Sản phẩm đã được thêm thành công!</h3>
                <a href="../Chucnang_Admin/ManageProducts.php" style="display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #6d4c41; color: white; text-decoration: none; border-radius: 5px;">➕ Thêm sản phẩm mới</a>
            </div>';
            exit;
        } else {
            echo '
                <div style="max-width: 600px; margin: 50px auto; padding: 30px; border: 1px solid #a1887f; border-radius: 10px; background-color: #fbe9e7; text-align: center;">
                    <h3 style="color: #bf360c;">❌ Lỗi khi thêm chi tiết sản phẩm!</h3>
                    <p style="color: #5d4037;">' . mysqli_error($conn) . '</p>
                    <a href="../Chucnang_Admin/ManageProducts.php" style="display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #6d4c41; color: white; text-decoration: none; border-radius: 5px;">🔄 Thêm lại</a>
                </div>';

        }
    } else {
        echo '
            <div style="max-width: 600px; margin: 50px auto; padding: 30px; border: 1px solid #a1887f; border-radius: 10px; background-color: #fbe9e7; text-align: center;">
                <h3 style="color: #bf360c;">❌ Sản phẩm đã tồn tại!</h3>
                <p style="color: #5d4037;">' . mysqli_error($conn) . '</p>
                <a href="../Chucnang_Admin/ManageProducts.php" style="display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #6d4c41; color: white; text-decoration: none; border-radius: 5px;">🔄 Thêm lại</a>
            </div>';

    }

    mysqli_close($conn);
} else {
    echo "Phương thức không hợp lệ.";
}
?>
