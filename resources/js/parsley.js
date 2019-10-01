import $ from 'jquery';
import 'parsleyjs';
import * as Filepond from 'filepond';
import './parsleyjs/i18n/ar';


Parsley.addAsyncValidator('availableEmail', function (xhr) {
    return 200 === xhr.status;
}, '/available-email');

/*
    used for validating registration email
    we don't use built-in remote functionality
    because it doesn't handle localized messages 
    (We add data-parsley-debounce to have similar
    experience to builtin async validation,
    but we still miss caching).
*/
Parsley
    .addValidator('availableEmail', {
        requirementType: 'string',
        validateString: function (value) {
            return $.ajax('/available-email', { data: { email: value } }).then(function (data) {
                return data.ok;
            });
        },
        messages: {
            en: 'This email is not available',
            ar: 'هذا الإيميل غير متوفر'
        }
    });

Parsley
    .addValidator('filepond', {
        requirementType: 'string',
        validateString: function (value, requirement) {
            const filesCount = Filepond.find(document.querySelector(requirement)).getFiles().length;
            return filesCount > 0;
        },
        messages: {
            en: 'This file is required',
            ar: 'هذه الصورة مطلوبة'
        }
    });

/*
    Upon validation, remove errors shown previously on server-side.
*/
Parsley.on('form:validate', function () {
    this.$element.find('.server-errors').remove()
});


let forms;
let parsleyObj;

function initParsley() {
    window.parsleyObj = parsleyObj = $('.parsley').parsley({
        excluded: 'input[type=button], input[type=submit], input[type=reset]',
        inputs: 'input, textarea, select, input[type=hidden], :hidden'
    });
}

export default {
    onEnter: () => {
        initParsley();
    },
    reset: () => {
        if (parsleyObj) {
            parsleyObj.destroy();
        }
        initParsley();
    },
    validate: () => {
        if (parsleyObj) {
            parsleyObj.validate();

        }
    }
}