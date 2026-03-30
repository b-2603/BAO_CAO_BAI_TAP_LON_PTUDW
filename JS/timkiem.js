$('#searchIcon').on('click', function() {
    $('#searchTable').stop(true, true).fadeIn();
  });
  $('.btn-close').on('click', function() {
    hideSearchTable();
  });
  $('.nav-link, .nav-item').on('mouseenter', function() {
    hideSearchTable();
  });
  $('#searchTable').on('mouseenter', function() {
    $(this).stop(true, true).fadeIn();
  });
  function hideSearchTable() {
    $('#searchTable').stop(true, true).fadeOut();
  }