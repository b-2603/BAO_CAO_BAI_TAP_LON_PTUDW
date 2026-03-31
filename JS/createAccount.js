$(document).ready(function() {
    $("#dangky").click(function() {
        $("#createAccountModal").modal("show");
    });
//Kiểm tra tính hợp lệ của dữ liệu
    function validateForm() {
        let firstName = document.getElementById("exampleInputFirstName").value;
        let lastName = document.getElementById("exampleInputLastName").value;
        let email = document.getElementById("exampleInputEmail").value;
        let password = document.getElementById("exampleInputPassword").value;
        let isValid = true;
        clearErrors();
        let nameRegex = /^[A-Z][a-zA-Z]*$/;
        if (!nameRegex.test(firstName)) {
            document.getElementById("firstNameError").innerText = "First name phải bắt đầu bằng chữ in hoa và không chứa số hoặc ký tự đặc biệt.";
            isValid = false;
        }
        if (!nameRegex.test(lastName)) {
            document.getElementById("lastNameError").innerText = "Last name phải bắt đầu bằng chữ in hoa và không chứa số hoặc ký tự đặc biệt.";
            isValid = false;
        }
        let emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(com|net|edu|org|gov|vn|uk)$/;
        if (!emailRegex.test(email)) {
            document.getElementById("emailError").innerText = "Email không hợp lệ. Vui lòng nhập địa chỉ email có định dạng đúng.";
            isValid = false;
        }
        let passwordRegex = /^(?=.*[A-Z])(?=.*[!@#$%^&*])(?=.*[a-zA-Z0-9]).{8,}$/;
        if (!passwordRegex.test(password)) {
            document.getElementById("passwordError").innerText = "Password phải chứa ít nhất 8 ký tự, bao gồm một chữ in hoa và một ký tự đặc biệt.";
            isValid = false;
        }
        console.log("Form is valid?", isValid);
        return isValid;
    }
    function clearErrors() {
        document.getElementById("firstNameError").innerText = "";
        document.getElementById("lastNameError").innerText = "";
        document.getElementById("emailError").innerText = "";
        document.getElementById("passwordError").innerText = "";
    }
//Mở, tắt nút Create Account 
    $("#registerForm input").on("input", function() {
        if (validateForm()) {
            console.log("Form is valid");
            $("#createAccountBtn").removeClass("disabled"); 
        } else {
            console.log("Form is invalid");
            $("#createAccountBtn").addClass("disabled");
        }
    });
//Gửi thông tin bằng Ajax
    document.getElementById('registerForm').addEventListener('submit', function(event) {
        event.preventDefault();
        if (!validateForm()) {
            console.log("Form is invalid, không gửi dữ liệu");
            return;
        }

        var formData = new FormData(this);

        fetch('../CLASS/CreateAccount.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            document.getElementById('statusMessage').innerHTML = data;
        })
        .catch(error => {
            console.error('Có lỗi xảy ra:', error);
        });
    });
});
