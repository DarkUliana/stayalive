$(document).ready(function () {

    $('#inputFile').on('change', function () {

        var file = new FormData($(this).closest('form')[0]);

        $.ajax({
            url: '/description-import',
            method: 'POST',
            data: file,
            cache: false,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            success: function (data) {

                $('.alert').text(data).removeClass('d-none').addClass('alert-success');
            },

            error: function (data) {

                $('.alert').text(data.statusText).removeClass('d-none').addClass('alert-danger');
            }
        });
    });
});