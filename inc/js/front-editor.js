tinymce.init({
    selector: '#front-editor',
    plugins: [
        "advlist autosave autolink image anchor lists hr fullscreen table link emoticons charmap paste wordcount"
    ],
    toolbar1: 'bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist hr | link advlist charmap emoticons fullscreen textcolor',

    skin: 'lightgray',
    paste_as_text: true,
    menubar: false,
    height: 300,
    gecko_spellcheck : true,
    path: false,
});

$(document).ready(function() {
    $('.editor-title').focus();
})
