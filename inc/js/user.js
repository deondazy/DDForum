$(document).ready(function() {
  $('.js-handle').on('click', function() {
    $(this).next('.js-field').slideToggle();
    if ($(this).find('i').hasClass('fa-chevron-down')) {
      $(this).find('i').removeClass('fa-chevron-down');
      $(this).find('i').addClass('fa-chevron-up');
    } else {
      $(this).find('i').removeClass('fa-chevron-up');
      $(this).find('i').addClass('fa-chevron-down');
    }
  })
})
