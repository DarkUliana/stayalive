$(document).ready(function () {

    $(document).on('click', '#addTopListItem, #addBottomListItem', function () {

        var isTop = $(this).closest('#topTable').length;
        console.log(isTop);
        var tableId = isTop ? '#topTable' : '#bottomTable';

        var optionTexts = [];

        $(tableId+' tr .counter').each(function () {
            optionTexts.push(parseInt($(this).text()))
        });

        var data = {"counter": Math.max.apply(null, optionTexts)};
        console.log(optionTexts);

        if ($(tableId+' .counter').length === 0) {

            data = {"counter": 0};
        }

        data.isTop = isTop ? 1 : 0;

        $.ajax({
            url: '/restorable-item',
            method: 'GET',
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {

                $(tableId).append(data);
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

