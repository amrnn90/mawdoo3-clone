export default {
    onEnter: function() {
        tinymce.init({
            selector: '.tinymce',
            branding: false,
            directionality : 'rtl',
            language_url: '/js/tinymce/langs/ar.js',
            plugins: 'paste anchor link code fullscreen', 
            toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | fullscreen link",
            paste_as_text: true,
            height: 200, 
        }); 
    },
    onLeave: function() {
        tinymce.remove();
    },
};