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

                $('table tr').first().after(data);
                $('select').select2({width: "100%", height: "100%"});
                deleteItem();
                onChangeItem();

            },
        });
    });

    $('select').select2({width: "100%", height: "100%"});

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

                select.closest('tr').find('.count').val(data.MaxInStack);
                // select.closest('tr').find('.imageName').val(data.Name);
                // select.closest('tr').find('.durability').attr('max', data.maxDurability).val(data.maxDurability);
            },

        });
    });
}