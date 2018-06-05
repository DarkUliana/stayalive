$(document).ready(function () {

    $(document).on('click', '#addComponent', function () {

        var optionTexts = [];

        $('tr .counter').each(function () {
            optionTexts.push(parseInt($(this).text()))
        });

        var counter ={"index": Math.max.apply(null, optionTexts)};


        if ($('.counter').length == 0) {

            counter = {"index": 0};
        }


        $.ajax({
            url: '/reward-item',
            method: 'GET',
            data: counter,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {

                $('table').append(data);
                deleteDescriptionEvent();
            },
        });
    });


    deleteDescriptionEvent();

});

function deleteDescriptionEvent() {
    $('.deleteDescription').on('click', function () {
        $(this).closest('tr').remove();
    });
}

