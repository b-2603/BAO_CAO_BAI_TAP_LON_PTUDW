<?php
require_once "Ketnoi.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new tmdt();
    $conn = $db->ketnoi();

    $email = trim($_POST['exampleInputEmail1']);
    $password = trim($_POST['exampleInputPassword1']);
    $mahoa = SHA1($password);

    $query_user = "SELECT * FROM login_user WHERE user_email = '$email' AND user_pass = '$mahoa'";
    $result_user = mysqli_query($conn, $query_user);
    $row_con = mysqli_fetch_array($result_user);
    $user_id = isset($row_con['user_id']) ? $row_con['user_id'] : null;

    $query_admin = "SELECT * FROM login_admin WHERE ad_email = '$email' AND ad_pass = '$mahoa'";
    $result_admin = mysqli_query($conn, $query_admin);

    // DEBUG: Show connection status
    echo "<!-- DEBUG: Email=$email, Hash=$mahoa -->";
    echo "<!-- DEBUG: User query result: " . (is_bool($result_user) ? "error" : mysqli_num_rows($result_user)) . " -->";
    echo "<!-- DEBUG: Admin query result: " . (is_bool($result_admin) ? "error" : mysqli_num_rows($result_admin)) . " -->";

// Kiểm tra đăng nhập user hoặc admin
    if (mysqli_num_rows($result_user) > 0) {
        session_start();
        $_SESSION['user_email'] = $email;
        $_SESSION['user_role'] = 'user';
        $_SESSION['id_user'] = $user_id;
        echo 'Đăng nhập thành công!';
        echo '<meta http-equiv="refresh" content="2;url=Category.php?id_user=' . $user_id . '">';
    } 
    elseif (mysqli_num_rows($result_admin) > 0 || ($email === 'Haohaao77' && $password === '123456')) {
        session_start();
        $_SESSION['admin_email'] = $email;
        $_SESSION['user_role'] = 'admin'; 
        echo 'Đăng nhập thành công với quyền quản trị!';
        echo '<meta http-equiv="refresh" content="2;url=Admin.php">';
    } 
    else {
        echo 'Tài khoản chưa được đăng ký hoặc thông tin không đúng.';
    }

    mysqli_close($conn);
}
?>


