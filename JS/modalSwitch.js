$(document).ready(function() {
    $(".modal_link_createAccount").click(function(e) {
        e.preventDefault();

        $("#loginModal").fadeOut(300, function() {
            $("#createAccountModal").fadeIn(300).modal("show");
        });
    });

    
    $(".modal_link_login").click(function(e) {
        e.preventDefault();

        $("#createAccountModal").fadeOut(300, function() {
            $("#loginModal").fadeIn(300).modal("show");
        });
    });
    $('#createAccountModal, #loginModal').on('hidden.bs.modal', function () {
        $('.modal-backdrop').remove(); 
    });
    
});
