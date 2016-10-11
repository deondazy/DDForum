tinymce.init({
    selector: '#form-box',
    plugins: [
        "advlist autosave autolink fullscreen table link emoticons charmap paste wordcount"
    ],

    toolbar1: 'bold italic underline strikethrough bullist numlist link advlist charmap emoticons fullscreen',

    skin: 'nmfskin',
    paste_as_text: true,
    menubar: false,
    gecko_spellcheck : true,
    resize: false,
    path: false,
});

$(document).ready(function() {
    $('.open-editor').on('click', function(e) {
        e.preventDefault();
        $('.editor').slideDown('slow');
        $('.editor-title').focus();
    });

    $('.close-editor').click(function(event) {
        event.preventDefault();
        $('.editor').slideUp('slow');
    });

    $('#topic-form').on('submit', function(ev) {
        ev.preventDefault();

        var topicSubject = $('#topic-subject').val(),
            topicForum   = $('#topic-forum').val(),
            topicMessage = tinyMCE.get('front-editor').getContent();

        var formData = 'topic-subject='+topicSubject+'&topic-forum='+topicForum+'&topic-message='+topicMessage;

        $.ajax({
            type: 'post',
            url:  root()+'post-topic.php',
            data: formData,
            success: function(data) {
                $('.editor').prepend('<div class="fixed">' + data + '</div>');
                setTimeout(function() {
                    $('.fixed').fadeOut(2000)
                }, 1000);
                $('.editor').slideUp('slow');
            }
        });
    });
})
