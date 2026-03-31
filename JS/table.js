$(document).ready(function(){

    $('#nutdangnhap').on('click', function(event) {
      event.stopPropagation(); 
      $('#loginTable').toggleClass('d-none');
    });

    $(document).on('click', function(event) {
      if (!$(event.target).closest('#loginTable, #nutdangnhap').length) {
        $('#loginTable').addClass('d-none');
      }
    });

    });