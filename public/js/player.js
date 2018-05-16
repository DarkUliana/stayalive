$(document).ready(function () {

    $('.itemSelect').on('change', function () {

        var select = $(this);

        $.ajax({

            url: '/player/get-item/' + select.val(),
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {

                select.closest('tr').find('.count').attr('max', data.MaxInStack).val(data.MaxInStack);
                select.closest('tr').find('.durability').attr('max', data.maxDurability).val(data.maxDurability);

                console.log( data.maxDurability);
            },

        });
    });
});