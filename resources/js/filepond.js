import * as FilePond from 'filepond';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import parsleyManager from './parsley';


FilePond.registerPlugin(FilePondPluginImagePreview, FilePondPluginFileValidateType);
FilePond.setOptions({
    server: {
        url: '/uploads',
        process: {
            headers: {
                'X-CSRF-TOKEN': window.csrf_token,
            },
        },
        revert: {
            headers: {
                'X-CSRF-TOKEN': window.csrf_token,
            },
        },
        // load: ''
    },
});

export default {
    onEnter: () => {
        const inputElement = document.querySelector('input[type="file"]');
        if (inputElement) {
            const files = [];
            let file;
    
            if (file = inputElement.getAttribute('data-source')) {
                files.push({source: file, options: {type: 'local'}});
            }
            
            const pond = FilePond.create(inputElement);
            pond.setOptions({
                files: files,
                acceptedFileTypes: ['image/*']
            });

            pond.element.addEventListener('FilePond:addfile', () => {
                parsleyManager.validate();
            }); 
            pond.element.addEventListener('FilePond:removefile', () => {
                parsleyManager.validate();
            }); 
        }

    }
}