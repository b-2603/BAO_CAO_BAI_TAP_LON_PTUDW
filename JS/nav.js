$(document).ready(function() {
    $('.nav-item').on('mouseenter', function() {
      $('.sub_menu').hide(); 
      $(this).find('.sub_menu').stop(true, true).fadeIn();
    });

    $('.nav-item').on('mouseleave', function() {
      $(this).find('.sub_menu').stop(true, true).fadeOut(); 
    });

    $('.sub_menu').on('mouseenter', function() {
      $(this).stop(true, true).fadeIn(); 
    });

    $('.sub_menu').on('mouseleave', function() {
      $(this).stop(true, true).fadeOut(); 
    });
    document.addEventListener('DOMContentLoaded', function () {
    var myModal = document.getElementById('navbarModal');
    myModal.addEventListener('shown.bs.modal', function () {
    });
    });
    });