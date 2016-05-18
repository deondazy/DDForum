tinymce.init({
  selector: '#front-editor',
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
  $('.editor-title').focus();
})
