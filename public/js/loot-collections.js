$(document).ready(function () {

    $('.deleteCollection').on('click', function () {

        var delBtn = $(this);

        $.ajax({
            url: '/loot-collection-object/'+ delBtn.attr('data-id'),
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {



                $('#object').text($('#object').text() + data.key + ' ');



                $('#collection').text($(delBtn.closest('tr').find('td')[1]).text() + ' ');

                onDeleteCollection(delBtn, data);

                $('#choiceModal').modal();
            },
            error: function (err) {

                console.log(err);
                if (err.status === 404) {

                    onDeleteCollection(delBtn, {});
                    $('#confirmModal').modal();
                }
            },

        });
    });
});

function onDeleteCollection(delBtn, data) {

    $('#delWithObj, .delCollection').on('click', function () {

        if ($(this).is('#delWithObj')) {

            $.ajax({

                url: '/loot-objects/' + data.ID,
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            });

        }

        $.ajax({

            url: '/loot-collections/' + delBtn.attr('data-id'),
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        });

        location.reload();
    });
}