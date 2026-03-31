$(document).ready(function() {
    $("#dangnhap").click(function() {
        $("#loginModal").modal("show");
    });
//Đảm bảo dữ liệu không rỗng
    function validateLoginForm() {
        var email = document.getElementById('exampleInputEmail1').value;
        var password = document.getElementById('exampleInputPassword1').value;
        var valid = true;
        document.getElementById('emailError').textContent = '';
        document.getElementById('passwordError').textContent = '';
        if (email === "") {
            document.getElementById('emailError').textContent = 'Email không được để trống';
            valid = false;
        }
        if (password === "") {
            document.getElementById('passwordError').textContent = 'Mật khẩu không được để trống';
            valid = false;
        }
        return valid;
    }
//Truyền thông tin bằng Ajax
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        event.preventDefault();
        if (!validateLoginForm()) {
            console.log("Form is invalid, không gửi dữ liệu");
            return;
        }
        var formData = new FormData(this);
        fetch('../CLASS/Login.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            document.getElementById('loginMessage').innerHTML = data;
            // Nếu đăng nhập thành công thì điều hướng theo meta refresh trả về
            const match = data.match(/url=([^"']+)/i);
            if (match && match[1]) {
                window.location.href = match[1];
                return;
            }
            if (data.toLowerCase().includes('đăng nhập thành công')) {
                window.location.reload();
            }
        })
        .catch(error => {
            console.error('Có lỗi xảy ra:', error);
        });
    });
//Xóa thông báo
    $("#loginForm input").on("input", function() {
        document.getElementById('emailError').textContent = '';
        document.getElementById('passwordError').textContent = '';
    });
});
