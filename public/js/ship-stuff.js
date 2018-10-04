$(document).ready(function () {

    $('.box').on('click', function () {

        $.ajax({
            url: '/get-ship-modal/' + $(this).attr('data-id'),
            mathod: 'GET',
            success: function (data) {

                $('body').append(data);
                $('.modal').modal('show');
            }

        });
    });
});