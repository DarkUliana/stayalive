$(document).ready(function () {

    $('#sidebar').addClass('col-md-2').addClass('offset-md-2').removeClass('col-md-3');

    $('.onSale').on('change', function () {

        var data = $(this).closest('form').serialize();
        var url = $(this).closest('form').attr('action');

        $.ajax({
            url : url,
            method : "PATCH",
            data : data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        });
    });

});