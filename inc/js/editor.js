tinymce.init({
    selector: '#form-box',
    plugins: [
    "advlist autosave autolink fullscreen table hr link textcolor emoticons searchreplace charmap paste wordcount pagebreak code hello"
    ],

    pagebreak_separator: "<!--u page break-->",

    toolbar1: 'bold italic underline strikethrough | formatselect fontselect fontsizeselect | bullist numlist | alignleft aligncenter alignright alignjustify | link | advlist fullscreen',
    toolbar2: 'forecolor backcolor | charmap emoticons | outdent indent | pastetext | searchreplace hello image',

    skin: 'nmfskin',
    paste_as_text: true,
    menubar: false,
    gecko_spellcheck : true,
    resize: false,
    path: false,
});