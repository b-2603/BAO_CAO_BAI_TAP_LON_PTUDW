<?php
// Setup script to create admin account
$conn = mysqli_connect('localhost', 'root', '', 'baitaplon');

if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Create login_admin table if it doesn't exist
$createTable = "CREATE TABLE IF NOT EXISTS login_admin (
    ad_id INT AUTO_INCREMENT PRIMARY KEY,
    ad_email VARCHAR(100) UNIQUE NOT NULL,
    ad_pass VARCHAR(100) NOT NULL,
    ad_name VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (mysqli_query($conn, $createTable)) {
    echo "✓ Bảng login_admin đã sẵn sàng<br>";
} else {
    echo "✗ Lỗi tạo bảng: " . mysqli_error($conn) . "<br>";
    exit();
}

// Insert admin account
$email = 'Bao11@gmail.com';
$password = 'Bao@12345';
$mahoa = SHA1($password);

// Check if admin already exists
$checkQuery = "SELECT * FROM login_admin WHERE ad_email = '$email'";
$checkResult = mysqli_query($conn, $checkQuery);

if (mysqli_num_rows($checkResult) > 0) {
    echo "⚠️ Tài khoản admin này đã tồn tại<br>";
    // Update password if needed
    $updateQuery = "UPDATE login_admin SET ad_pass = '$mahoa' WHERE ad_email = '$email'";
    if (mysqli_query($conn, $updateQuery)) {
        echo "✓ Cập nhật mật khẩu thành công<br>";
    }
} else {
    $insertQuery = "INSERT INTO login_admin (ad_email, ad_pass, ad_name) VALUES ('$email', '$mahoa', 'Admin Bao')";
    if (mysqli_query($conn, $insertQuery)) {
        echo "✓ Tạo tài khoản admin thành công!<br>";
    } else {
        echo "✗ Lỗi tạo tài khoản: " . mysqli_error($conn) . "<br>";
        exit();
    }
}

echo "<br>📋 Thông tin đăng nhập:<br>";
echo "Email: " . $email . "<br>";
echo "Mật khẩu: " . $password . "<br>";
echo "<br><a href='index.php'>← Quay lại trang chủ</a>";

mysqli_close($conn);
?>
