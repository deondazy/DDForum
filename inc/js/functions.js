$(document).ready(function() {
  var url = document.URL.replace(/^.*\/|\.[^.]*$/g,'');

  $('.sort-item').each(function() {
    var item = $(this).find('a').prop('href').replace(/^.*\/|\.[^.]*$/g,'');

    if (url == item) {
      $(this).addClass('selected');
    }
  });
})
