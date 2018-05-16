$(document).ready(function () {

    online();
    $('#sidebar').addClass('col-md-2').addClass('offset-md-2').removeClass('col-md-3');


    setInterval(online, 5000);

    $('#deletePlayersButton').on('click', function () {

        $('#deleteForm').submit();

    });

    $('.delBtn').on('click', function (e) {

        e.preventDefault();
        var btn = $(this);
        var id = btn.closest('tr').find('td:nth-child(4)').text();

        $.ajaxSetup({cache: false});
        $.ajax({

            url: 'players/' + id,
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            success: function () {

                btn.closest('tr').remove();
            },
        });
    });
});

function online() {
    $.ajax({
        url: window.location.href,
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

        success: function (data) {

            data.forEach(function (item) {

                var element = $('tr>td:nth-child(4):contains(' + item.googleID + ')').next().first();

                element.empty();

                if (item.online === "true") {
                    element.append('<i class="fa fa-circle" style="color: #2ca02c"></i>');
                } else {
                    element.append('<i class="fa fa-circle" style="color: #98a2ac"></i>');
                }


            });

        },
    });


}