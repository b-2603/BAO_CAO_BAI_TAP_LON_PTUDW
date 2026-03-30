function togglePassword(inputId, iconId) {
    var passwordInput = document.getElementById(inputId);
    var eyeIcon = document.getElementById(iconId);

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeIcon.src = "https://i.postimg.cc/vZvCXDq9/eyeClose.png";
    } else {
        passwordInput.type = "password";
        eyeIcon.src = "https://i.postimg.cc/vZvCXDq9/eyeClose.png";
    }
}
window.togglePassword = togglePassword;
