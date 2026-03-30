<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = mysqli_connect('localhost', 'root', 'Shatou5114', 'baitaplon');
    if (!$conn) {
        die("Kết nối thất bại: " . mysqli_connect_error());
    }

 // Lấy thông tin
    $firstname = $_POST['exampleInputFirstName'];
    $lastname = $_POST['exampleInputLastName'];
    $email = $_POST['exampleInputEmail'];
    $password = $_POST['exampleInputPassword'];
    $mahoa = SHA1($password);

// Kiểm tra email hoặc lastname đã tồn tại
    $checkEmail = "SELECT * FROM login_user WHERE user_email = '$email' OR user_lastname = '$lastname'";
    $result = mysqli_query($conn, $checkEmail);

    if (mysqli_num_rows($result) > 0) {
        echo '<div class="alert alert-danger" role="alert">Email hoặc Last Name đã tồn tại.</div>';
    } else {
        $sql = "INSERT INTO login_user (user_firstname, user_lastname, user_pass, user_email, user_ngaytaotk) 
                VALUES ('$firstname', '$lastname', '$mahoa', '$email', NOW())";

        if (mysqli_query($conn, $sql)) {
            echo 'Tài khoản được tạo thành công!';
            echo '<button id="btnLogin" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#loginModal">Đăng nhập ngay</button>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Lỗi: ' . mysqli_error($conn) . '</div>';
        }
    }

    mysqli_close($conn);
}
?>
