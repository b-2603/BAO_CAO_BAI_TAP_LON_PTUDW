$(document).ready(function () {
    function validateForm() {
        let email = $("#email").val().trim();
        let name = $("#ho_va_ten").val().trim();
        let address = $("#dia_chi").val().trim();
        let phone = $("#so_dien_thoai").val().trim();
        let city = $("#thanh_pho").val().trim();
        let isValid = true;
        $(".error-text").remove();

        let emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(com|net|edu|org|gov|vn|uk)$/;
        let nameRegex = /^[A-Za-zÀ-ỹ\s']+$/;
        let phoneRegex = /^(0|\+84)\d{9}$/;

        if (!emailRegex.test(email)) {
            $("#email").after("<div class='error-text' style='color:red;'>Email không hợp lệ.</div>");
            isValid = false;
        } else if (!nameRegex.test(name)) {
            $("#ho_va_ten").after("<div class='error-text' style='color:red;'>Tên không được có ký tự đặc biệt.</div>");
            isValid = false;
        } else if (address.length < 5) {
            $("#dia_chi").after("<div class='error-text' style='color:red;'>Địa chỉ không được quá ngắn.</div>");
            isValid = false;
        } else if (!phoneRegex.test(phone)) {
            $("#so_dien_thoai").after("<div class='error-text' style='color:red;'>SĐT phải có 10 chữ số và bắt đầu bằng 0 hoặc (+84).</div>");
            isValid = false;
        } else if (city.length < 2) {
            $("#thanh_pho").after("<div class='error-text' style='color:red;'>Hãy nhập thành phố hợp lệ.</div>");
            isValid = false;
        }

        return isValid;
    }

    // Bật/tắt nút khi nhập input
    $("#form_thanhtoan input").on("input", function () {
        if (validateForm()) {
            $("#xacnhan_donhang").removeClass("disabled").prop("disabled", false);
        } else {
            $("#xacnhan_donhang").addClass("disabled").prop("disabled", true);
        }
    });

    // Gửi form bằng fetch
    $("#form_thanhtoan").on("submit", function (e) {
        e.preventDefault();

        if (!validateForm()) {
            alert("Vui lòng điền đầy đủ thông tin hợp lệ.");
            return;
        }

        let formData = new FormData(this);
        fetch('../CLASS/chitietdonhang.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                window.location.href = "Donhangchitiet.php?dh_id=" + data.dh_id;
            } else {
                if (data.status === "not_logged_in") {
                    alert("Bạn cần đăng nhập để đặt hàng.");
                } else if (data.status === "empty_cart") {
                    alert("Giỏ hàng trống hoặc chưa chọn sản phẩm.");
                } else if (data.message) {
                    alert(data.message);
                } else {
                    alert("Đặt hàng thất bại!");
                }
            }
        });

    });
});
