$(document).ready(function () {

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