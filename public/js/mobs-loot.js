$(document).ready(function () {

    $(document).on('click', '#addItem', function () {

        var optionTexts = [];

        $('tr .counter').each(function () {
            optionTexts.push(parseInt($(this).text()))
        });

        var index ={"index": Math.max.apply(null, optionTexts)};

        if ($('.counter').length == 0) {

            index = {"index": 0};
        }


        $.ajax({
            url: '/mobs-loot-item',
            method: 'GET',
            data: index,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {

                $('table').append(data);
                deleteItemEvent();
            },
        });
    });


    deleteItemEvent();

});

function deleteItemEvent() {
    $('.deleteItem').on('click', function () {
        $(this).closest('tr').remove();
    });
}