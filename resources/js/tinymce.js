import parsleyManager from './parsley';

const tinymceElClass = '.tinymce-el';

const loadTinymce = (callback) => {
    var script = document.createElement('script');
    script.addEventListener('load', () => {
        callback();
    });
    script.src = "https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=xkrstfxd975kjdemdcwwy4fh7du1qpoz51lk20i6p3h0lcmo";

    document.head.appendChild(script);
};

const initTinymce = () => {
    window.tinymce.init({
        selector: tinymceElClass,
        branding: false,
        directionality : 'rtl',
        language_url: '/js/tinymce/langs/ar.js',
        plugins: 'paste anchor link code fullscreen media', 
        toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | fullscreen link",
        paste_as_text: true,
        height: 200, 
        init_instance_callback: function (editor) {
            editor.on('Change', function (e) {
              editor.save();
              parsleyManager.validate();
            });
        }
    }); 

    // needed because when parsley attaches before tinymce validation doesn't work well
    parsleyManager.reset();
};

const shouldLoadTinymce = () => {
    if (!window.tinymce && document.querySelector(tinymceElClass)) return true;

    return false;
}

export default {
    onEnter: function() {
        if (!window.tinymce) {
            loadTinymce(initTinymce);
        } else {
            initTinymce();
        }
    },
    onLeave: function() {
        if (window.tinymce) {
            tinymce.remove();
        }
    },
};