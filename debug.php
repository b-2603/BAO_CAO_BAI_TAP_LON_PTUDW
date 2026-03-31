<?php
echo "<h2>🔍 Database Debug Check</h2>";

// Test connection
$conn = mysqli_connect("localhost", "root", "", "baitaplon");

if (!$conn) {
    echo "❌ <strong>Kết nối thất bại:</strong> " . mysqli_connect_error();
    exit();
}

echo "✅ Kết nối CSDL thành công<br><br>";

// Check if login_admin table exists
$checkTable = "SHOW TABLES LIKE 'login_admin'";
$tableResult = mysqli_query($conn, $checkTable);

if (mysqli_num_rows($tableResult) > 0) {
    echo "✅ Bảng <strong>login_admin</strong> tồn tại<br><br>";
    
    // Check admin accounts
    $checkAdmin = "SELECT ad_id, ad_email FROM login_admin";
    $adminResult = mysqli_query($conn, $checkAdmin);
    
    if (mysqli_num_rows($adminResult) > 0) {
        echo "📋 <strong>Admin accounts trong DB:</strong><br>";
        while ($row = mysqli_fetch_array($adminResult)) {
            echo "- ID: " . $row['ad_id'] . " | Email: " . $row['ad_email'] . "<br>";
        }
    } else {
        echo "⚠️ Bảng login_admin trống (chưa có admin)<br>";
    }
} else {
    echo "❌ Bảng <strong>login_admin</strong> không tồn tại<br>";
}

echo "<br>---<br>";
echo "📌 Các bảng trong database:<br>";
$allTables = "SHOW TABLES";
$tablesResult = mysqli_query($conn, $allTables);
while ($row = mysqli_fetch_array($tablesResult)) {
    echo "- " . $row[0] . "<br>";
}

mysqli_close($conn);
?>
