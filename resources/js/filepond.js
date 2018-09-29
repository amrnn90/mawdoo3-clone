import * as FilePond from 'filepond';

export default {
    onEnter: () => {
        const inputElement = document.querySelector('input[type="file"]');
        if (inputElement) {
            const pond = FilePond.create( inputElement );
        }
    }
}