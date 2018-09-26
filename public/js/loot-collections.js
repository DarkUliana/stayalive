$(document).ready(function () {

    $('.deleteCollection').on('click', function () {

        $.ajax({
            url: '/loot-collection-object/'+$(this).attr('data-id'),
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {

            console.log(data);
            data.forEach(function (obj, i) {

                $('#object').text(obj.key + ' ')
            });

                $('#delWithObj, #delCollection').on('click', function () {

                    var data = {};

                    if ($(this).is('#delWithObj')) {

                        // data.objectID =
                    }
                });

                $('.modal').modal();
            },

        });
    });
});