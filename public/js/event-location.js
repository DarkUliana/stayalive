$(document).ready(function () {

    $('#addSetting').on('click', function () {

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
            url: '/event-location-setting',
            method: 'GET',
            data: index,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {

                button.closest('table').find('tbody').append(data);

                deleteSettingEvent();

            }
        });
    });
});

function deleteSettingEvent() {
    $('.deleteSetting').on('click', function () {
        $(this).closest('tr').remove();
    });
}