$(document).ready(function () {

    deleteItem();

    onChangeItem();

    $('#addItem').on('click', function () {

        var optionTexts = [];

        $('tr .counter').each(function () {
            optionTexts.push(parseInt($(this).text()))
        });

        var counter = {"counter": Math.max.apply(null, optionTexts)};


        if ($('.counter').length == 0) {

            counter = {"counter": 0};
        }


        $.ajax({
            url: '/player-cloud-item',
            method: 'GET',
            data: counter,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {

                $('table').append(data);
                deleteItem();
                onChangeItem();
            },
        });
    });



});

function deleteItem() {

    $('.deleteItem').on('click', function () {

        $(this).closest('tr').remove();
    });
}

function onChangeItem() {

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
                // select.closest('tr').find('.imageName').val(data.Name);
                // select.closest('tr').find('.durability').attr('max', data.maxDurability).val(data.maxDurability);
            },

        });
    });
}