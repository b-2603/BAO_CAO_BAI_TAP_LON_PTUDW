<?php
$conn = mysqli_connect("localhost", "root", "", "baitaplon");

if (!$conn) {
    die("❌ Kết nối thất bại: " . mysqli_connect_error());
}

echo "<h2>👥 Admin Accounts trong Database</h2>";

$query = "SELECT ad_id, ad_email, ad_pass FROM login_admin";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>ID</th><th>Email</th><th>Password Hash</th></tr>";
    
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['ad_id'] . "</td>";
        echo "<td>" . $row['ad_email'] . "</td>";
        echo "<td>" . $row['ad_pass'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    echo "<br><hr><br>";
    echo "<h3>🔐 Test Password Hash</h3>";
    
    // Test what SHA1 of your password produces
    $testPassword = "Bao@12345";
    $testHash = SHA1($testPassword);
    echo "Password: <strong>" . $testPassword . "</strong><br>";
    echo "SHA1 Hash: <strong>" . $testHash . "</strong><br>";
    
} else {
    echo "Không có admin account nào";
}

mysqli_close($conn);
?>
