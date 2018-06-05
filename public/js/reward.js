$(document).ready(function () {

    $(document).on('click', '#addComponent', function () {

        var optionTexts = [];

        $('tr .counter').each(function () {
            optionTexts.push(parseInt($(this).text()))
        });

        var counter ={"counter": Math.max.apply(null, optionTexts)};
        console.log(optionTexts);

        if ($('.counter').length == 0) {

            counter = {"counter": 0};
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
    $('.deleteComponent').on('click', function () {
        $(this).closest('tr').remove();
    });
}

