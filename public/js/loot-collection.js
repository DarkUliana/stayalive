$(document).ready(function () {

    $('select').select2();


    $('#addItem').on('click', function () {

        var optionTexts = [];

        $('tbody>tr').each(function () {
            optionTexts.push(parseInt($(this).attr('data-index')));
        });

        var index = {"index": Math.max.apply(null, optionTexts)};

        if ($('tr').length == 1) {

            index = {"index": 0};
        }


        $.ajax({
            url: '/loot-collections-item',
            method: 'GET',
            data: index,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {

                $('tbody').prepend(data);
                $('select').select2();
                deleteItemEvent();
                minMaxValuesFocusEvent();

                $('.minValue').first().trigger('keyup');
                $('.maxValue').first().trigger('keyup');

            },
        });
    });


    deleteItemEvent();
    minMaxValuesFocusEvent();
    $.each($('.minValue, .maxValue'), function () {

        $(this).trigger('keyup');
    });
});

function deleteItemEvent() {
    $('.deleteItem').on('click', function () {
        $(this).closest('tr').remove();
    });
}

function minMaxValuesFocusEvent() {

    console.log('minMaxValuesFocusEvent');
    $('.minValue, .maxValue').on('keyup', function () {

        // $.each($('table input'), function () {

        var type = $(this).closest('tr').find('select option:selected').attr('data-type');
        var cloth = ['Head', 'Chest', 'Pants', 'Boots'];
        console.log($.inArray(type, cloth));
        console.log(type);
        console.log($(this).val() < 10);
            if (($(this).hasClass('minValue') && $(this).val() == 0) ||
                ($(this).hasClass('maxValue') && $(this).val() == 0 && type == 'Food') ||
                ($(this).hasClass('maxValue') && $(this).val() < 10 && $.inArray(type, cloth) != -1)) {

                $(this).addClass('is-invalid');

            } else {

                $(this).removeClass('is-invalid');
            }

        // });

    });
}