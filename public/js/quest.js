$(document).ready(function () {

    deleteDescription();

    $('#addDescription').on('click', function () {

        var data = {};
        data.mode = $(this).closest('.row').find('option:selected').val()

        var optionTexts = [];

        $('tbody>tr').each(function () {
            optionTexts.push(parseInt($(this).attr('data-index')));
        });

        if (optionTexts.length === 0) {

            data.index = -1;
        } else {

            data.index = Math.max.apply(null, optionTexts);
        }

        $.ajax({
            url: '/new-quest-description',
            method: 'GET',
            data: data,
            success: function (d) {

                if ($('tbody').length > 0) {

                    $('tbody').append(d);
                } else {

                    $('table').append(d);
                }
                deleteDescription();
            }
        });
    });


});

function deleteDescription() {

    $('.deleteDescription').on('click', function () {

        $(this).closest('tr').remove();
    });
}