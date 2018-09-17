$(document).ready(function () {

    $('td select').select2({
        tags: true
    });

    if ($('#shopItemType').val() !== '8') {

        $('#dateTimeDiv').hide();

    }

    $('#shopItemType').on('change', function () {

        console.log($('#shopItemType').val());
        if ($(this).val() === '8') {

            $('#dateTimeDiv').show();
        } else {

            $('#dateTimeDiv').hide();
        }
    });

    $(document).on('click', '#addShopItem', function () {

        var quantity = $('tr:last .number').text();
        $.ajax({
            url: '/shop-item',
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {"counter": quantity},
            success: function (data) {
                $('tbody').append(data);
                if ($('tr').length === 7) {
                    $('#addShopItem').attr('disabled', 'disabled');
                }

                $('td select').select2({
                    tags: true
                });

            },

        });

    });

    $(document).on('click', '.deleteShopItem', function () {
        $(this).closest('tr').remove();

        if ($('tr').length < 7) {
            $('#addShopItem').removeAttr('disabled');
        }
    });

    if ($('tr').length === 7) {
        $('#addShopItem').attr('disabled', 'disabled');
    }
});
