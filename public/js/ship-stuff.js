$(document).ready(function () {

    boxOnClick();

    $('#addNewFloor').on('click', function () {

        $.ajax({
            url: '/ship-stuff/create',
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {

                $('.modal').remove();
                $('body').append(data);
                $('.modal').modal('show');
            },

        });
    });

    $('.editFloor').on('click', function () {

        $.ajax({
            url: '/ship-stuff/' + $(this).attr('data-id') + '/edit',
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {

                $('.modal').remove();
                $('body').append(data);
                $('.modal').modal('show');
            },

        });
    });

    $('.addNewCell').on('click', function () {

        var button = $(this);
        var firstTr = button.closest('.tab-pane').find('table tr').first();

        $.ajax({
            url: '/get-ship-floor-cell/' + button.attr('data-floor-id'),
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {

                if (firstTr.find('td').length == button.attr('data-width')) {

                    button.closest('.tab-pane').find('tbody').prepend('<tr>' + data + '</tr>');
                } else {

                    firstTr.append(data);
                }

                $('.box').off('click')
                boxOnClick();

            },


        });
    });



    $(document).ajaxSend(function () {

        $('.ajax-background').show();
    });
    $(document).ajaxStop(function () {

        $('.ajax-background').hide();
    });
});

function boxOnClick() {

    $('.box').on('click', function () {

        $.ajax({
            url: '/get-ship-cell-modal/' + $(this).attr('data-id'),
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            success: function (data) {

                $('.modal').remove();
                $('body').append(data);
                onDeleteCell();
                onUpdateCell();
                $('.modal').modal('show');
            },


        });
    });
}

function onDeleteCell() {

    $('.deleteCell').on('click', function () {

        var id = $(this).closest('.modal').attr('data-id');
        var button = $(this);

        $.ajax({
            url: '/delete-ship-floor-cell/' + id,
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {

                $('.tab-pane.active').find('tr:first > td:last').remove();
                button.closest('.modal').modal('hide');

            },
        });
    });
}

function onUpdateCell() {

    $('form.cell-form').on('submit', function (e) {

        e.preventDefault();
        console.log(1);
        var form = $(this);
        var data = form.serialize();

        $.ajax({
            url: '/update-ship-floor-cell',
            data: data,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {

                form.closest('.modal').modal('hide');
                var id = form.closest('.modal').attr('data-id');
                var td = $('.box[data-id="' + id + '"]').closest('td');
                td.replaceWith(data);
            },
        });
    });
}