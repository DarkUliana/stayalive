$(document).ready(function () {

    $('.addItem').on('click', function () {

        var button = $(this);
        var optionTexts = [];

        button.closest('table').find('tbody>tr').each(function () {
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

                button.closest('table').find('tbody').prepend(data);
                selectEvent();
                deleteItemEvent();
                minMaxValuesFocusEvent();

                $('.minValue').first().trigger('keyup');
                $('.maxValue').first().trigger('keyup');

            },
        });
    });

    selectEvent();
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

    $('.minValue, .maxValue').on('keyup mouseup', function () {

        // $.each($('table input'), function () {

        var type = $(this).closest('tr').find('select option:selected').attr('data-type');
        var cloth = ['Head', 'Chest', 'Pants', 'Boots'];
        console.log(type);

        check($(this), type, cloth);

        if ($(this).hasClass('maxValue')) {

            check($(this).closest('tr').find('.minValue'), type, cloth);
        } else {

            check($(this).closest('tr').find('.maxValue'), type, cloth);
        }

    });
}

function check(el, type, cloth) {

    if (el.val() == 0 ||
        (el.hasClass('minValue') &&
        parseInt(el.closest('tr').find('.maxValue').val()) < parseInt(el.val())) ||

        (el.hasClass('maxValue') &&

            ((parseInt(el.val()) < 10 && $.inArray(type, cloth) != -1) ||
            parseInt(el.closest('tr').find('.minValue').val()) > parseInt(el.val())))) {

        el.addClass('is-invalid');

    } else {

        el.removeClass('is-invalid');
    }
}

function selectEvent() {

    $('select').select2();

    $('select').on('change', function () {

        $(this).closest('tr').find('.minValue').trigger('keyup');
    });
}