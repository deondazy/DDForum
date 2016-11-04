/*tinymce.init({
  selector: '#front-editor',
  plugins: [
    "advlist autosave autolink fullscreen table link emoticons charmap paste wordcount responsivefilemanager"
  ],

  toolbar1: 'bold italic underline strikethrough bullist numlist link advlist charmap emoticons fullscreen responsivefilemanager',

  skin: 'nmfskin',
  paste_as_text: true,
  menubar: false,
  gecko_spellcheck : true,
  resize: false,
  path: false,
});*/

tinymce.init({
    selector: "#front-editor",
    skin: "lightgray",
    height: 300,
    menubar: false,
    plugins: [
        "advlist autosave autolink image anchor lists hr fullscreen table link emoticons charmap paste wordcount responsivefilemanager"

        /*"advlist autolink link image lists charmap preview hr anchor pagebreak",
        "wordcount visualblocks visualchars insertdatetime media nonbreaking",
        "table contextmenu directionality emoticons paste textcolor responsivefilemanager code bbcode codesample"*/
   ],
   toolbar1: 'bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist hr | link advlist charmap emoticons fullscreen textcolor',
   /*toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
   toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
   toolbar3: 'bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | hr codesample',*/
   image_advtab: true,
 });

$(document).ready(function() {
  $('.editor-title').focus();
})
