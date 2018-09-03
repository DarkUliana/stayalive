$(document).ready(function () {

    if ($.cookie('table')) {

        $('#nav-table').addClass('show active');

    } else {

        $('#nav-list').addClass('show active');

    }

    $('#nav-table-tab').on('click', function () {
        // $('#sidebar').addClass('col-md-2').removeClass('offset-md-2');

        $('#sidebar').addClass('d-none');
        $('#main-block').addClass('col-md-12').removeClass('col-md-7');
        $.cookie('table', 1);
    });

    $('#nav-list-tab').on('click', function () {
        // $('#sidebar').addClass('offset-md-2');
        $('#sidebar').removeClass('d-none');
        $('#main-block').removeClass('col-md-12').addClass('col-md-7');

        $.cookie('table', 0);
    });

    $('.select2').select2({width: "100%",});

    $('#table-form').on('submit', function (e) {

        e.preventDefault();
        var data = $(this).serialize();
        $.ajax({
            url: '/recipes/0',
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: data,
            success: function () {

                $('#myModal').modal();
            },
        })
    });
});