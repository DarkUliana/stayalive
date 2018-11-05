$(document).ready(function () {

    online();
    $('#sidebar').addClass('col-md-2').addClass('offset-md-1').removeClass('col-md-3');


    setInterval(online, 5000);

    $('#deletePlayersButton').on('click', function () {

        result = confirm('Do you want to delete players?');

        if (result) {

            var ids = [];

            $('input:checked.forDelete').each(function () {

                ids.push($(this).attr('data-id'))
            });

            $.ajax({
                url: '/players',
                method: 'DELETE',
                data: {'localIDs' : ids},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function () {

                    location.reload();
                }
            });
        }

    });

    $('.deleteOnePlayer').on('click', function (e) {

        e.preventDefault();

        result = confirm('Do you want to delete the player?');

        if (result) {

            var btn = $(this);
            var id = btn.closest('tr').find('td:nth-child(2)').text();

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
        }

    });

    $('#deleteAllPlayers').on('click', function () {

        var result = confirm('Are you sure?');

        if (result) {

            result = confirm('Are you completely sure?');

            if(result) {

                $.ajax({
                    url: '/delete-all-players',
                    method: 'GET',
                    success: function () {
                        location.reload();
                    }
                });
            }
        }

    });

    $('.isDeveloper').on('change', function () {

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

function online() {
    $.ajax({
        url: 'players-online' + '?' + window.location.search.substr(1),
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

        success: function (data) {

            $('#online').text('Online: ' + data.online);
            data.players.forEach(function (item) {

                var element = $('tr>td:nth-child(2):contains(' + item.playerID + ')').closest('tr').find('td:nth-child(5)');

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