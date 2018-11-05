$(document).ready(function () {

    var select = $('#item').select2({width: '100%'});

    $('#recipeType').change(function () {

        var type = 'items';

        if ($(this).val() == 5) {

            type = 'technologies';
        }
            $.ajax({
                url: '/get-recipe-items-for-select/'+type,
                method: 'GET',
                type: 'json',
                success: function (data) {

                    select.select2('destroy');
                    $('#item').empty();
                    select = $('#item').select2({data: data, width: '100%'});
                }
            });

    });
});