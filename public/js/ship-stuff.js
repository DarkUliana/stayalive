$(document).ready(function () {

    $('.box').on('click', function (e) {

        e.preventDefault();
        $.ajax({
            url: '/get-ship-modal/' + $(this).attr('data-id'),
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {

                $('.modal').remove();
                $('body').append(data);
                $('.modal').modal('show');
            }

        });
    });

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
            }
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
            }
        });
    });

    $('.addNewCell').on('click', function () {

        e.preventDefault();
        $.ajax({
            url: '/get-ship-modal',
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {

                $('.modal').remove();
                $('body').append(data);
                $('.modal').modal('show');
            }

        });
    });
});