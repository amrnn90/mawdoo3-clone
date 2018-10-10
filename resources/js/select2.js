import $ from 'jquery';
import 'select2';
import axios from 'axios';


function initSubcategory($subcatEl, data = null) {
    $subcatEl.off('select2:selecting');
    $subcatEl.select2({
        width: '100%',
        data: data,
        tags: true,
        createTag: function (params) {
            var term = $.trim(params.term);

            if (term === '') {
                return null;
            }

            return {
                id: term,
                text: term,
                newTag: true
            }
        }
    }).on('select2:selecting', function (e) {
        const $el = $(this);
        const route = '/subcategories';
        // const label = $el.data('label');
        // const errorMessage = $el.data('error-message');
        const newTag = e.params.args.data.newTag;

        if (!newTag) return;

        $el.select2('close');

        axios.post('/subcategories', {
            name: e.params.args.data.text,
            parent_id: $('#category_id').val(),
        }).then(({ data }) => {
            // console.log(data);
            const newOption = new Option(e.params.args.data.text, data.id, false, true);
            $el.append(newOption).trigger('change');
        });
        return false;
    });
}

export default {
    onEnter: () => {
        $('#category_id').select2({width: '100%'});
        $('#category_id').on('change', function (e) {
            axios.get(`/subcategories/${this.value}`)
                .then(({ data }) => {
                    const subcategoriesEl = document.querySelector('#subcategory_id');
                    initSubcategory(
                        $('#subcategory_id').select2('destroy').empty(),
                        data.map(cat => ({ id: cat.id, text: cat.name }))
                    );
                });
        });

        initSubcategory($('#subcategory_id'));


        // $.post(route, {
        //     name: e.params.args.data.text,
        //     parent_id: $('#category_id').val(),
        // }).done(function(data) {
        //     console.log(data.data);
        //     const newOption = new Option(e.params.args.data.text, data.data.id, false, true);
        //     $el.append(newOption).trigger('change');
        // }).fail(function(error) {
        //     // toastr.error(errorMessage);
        // });

        return false;
    },
}
