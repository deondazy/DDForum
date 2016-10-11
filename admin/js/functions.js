function basename(path) {
  return path.replace(/\\/g,'/').replace( /.*\//, '' );
}

function dirname(path) {
  return path.replace(/\\/g,'/').replace(/\/[^\/]*$/, '');;
}

if (history.pushState && location.href.match(/\?message.*/) || location.href.match(/&message.*/) && document.referrer) {
  var theurl = window.location.protocol + "//" + window.location.host + window.location.pathname
  var removemsg = window.location.search;
  if ( removemsg.match(/\?message.*/) )
  	removemsg = removemsg.replace(/\?message.*/, '');
  else
  	removemsg = removemsg.replace(/&message.*/, '');

  var newurl = theurl + removemsg;
  window.history.pushState({path:newurl},'',newurl);
}

// Make Strings URL-safe
function slug(text)
{
  return text.toString().toLowerCase()
    .replace(/\s+/g, '-')           // Replace spaces with -
    .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
    .replace(/\-\-+/g, '-')         // Replace multiple - with single -
    .replace(/^-+/, '')             // Trim - from start of text
    .replace(/-+$/, '');            // Trim - from end of text
}

$(document).ready(function() {

  // Confirm item deletion
  $('.action-delete').on('click', function( event ) {
		var confirm = confirm('Are you sure you want to delete?');
    if (!confirm) {
			event.preventDefault()
		}
	});


  /*$("#select-all-1, #select-all-2").change(function(){
    $(":checkbox").prop('checked', $(this).prop("checked"));
  });*/

  // Active menu
 /* var active_menu_item = basename(window.location.href);

  $('.admin-menu-item a').each(function() {

    var menu_item = $(this).attr('href');

    if (active_menu_item == menu_item) {
      $(this).parent('li').addClass('active-submenu').parent('ul').parent('li').addClass('active-menu-parent');
    }
  });*/

  // Form validation
  var submitBtn =  $('#new-user-submit'),
    // Required fields
    userName  =  $('#uname'),
    email     =  $('#email'),
    password  =  $('#pass'),
    cpass     =  $('#cpass');

    required = [userName, email, password, cpass];

  submitBtn.click(function(e) {

    for (var i = 0; i < required.length; i++) {
      if (required[i].val() == '') {
        e.preventDefault();
        required[i].css('borderColor', 'red');
        required[i].parent().parent().css('background', '#ffebe8');
      }
    }
  });

  for (var i = 0; i < required.length; i++) {
    required[i].change(function() {
      if ($(this).val() != '') {
        $(this).css('borderColor', '#ddd');
        $(this).parent().parent().css('background', 'transparent');
      }
    });
  }

  // Slug
  $('.js-title-box').on('keyup', function() {
    var title = $(this).val()
    $('.js-slug-box').val(slug(title));
  });

  // Private message recipient username
  var name = $('.js-pm-recipient');

  //name.keyup(function() {

  })

});
