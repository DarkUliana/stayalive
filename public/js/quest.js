$(document).ready(function () {

    $('#addDescription').on('click', function () {

        var data = {};
        data.mode = $(this).closest('.row').find('option:selected').val()

        var optionTexts = [];

        $('tbody>tr').each(function () {
            optionTexts.push(parseInt($(this).attr('data-index')));
        });

        data.index = Math.max.apply(null, optionTexts);

        $.ajax({
            url: '/new-quest-description',
            method: 'GET',
            data: data,
            success: function (d) {

                $('tbody').append(d);
            }
        });
    });
});