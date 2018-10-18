var isSubmit = false;

$(document).ready(function () {

    collectionSubmit();

    $('#collectionName').val($('#objectKey').val() + ' ' + $('#collectionItem').find(':selected').text());
    $('select').select2({"width" : "100%"});

    $('#collectionName').on('focus', function () {

        $(this).val($('#objectKey').val() + ' ' + $('#collectionItem').find(':selected').text());
    });

    $('#collectionItem').change(function () {

        $('#collectionName').val($('#objectKey').val() + ' ' + $('#collectionItem').find(':selected').text());
    });

    $('#submit').on('click', function () {

        $('#mainForm').submit();
    });

    $('#addCollection').on('click', function (e) {

        e.preventDefault();

        if ($('#collectionName').val().length < 1) {

            $('#collectionName').focus();
        }

        $('.collectionValue').each(function () {

            if ($(this).val().length < 1) {

                $(this).val(0);
            }
        });

        var data = $('#collectionForm').serialize();

        $.ajax({
            url: '/loot-collections',
            method: 'POST',
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {

                location.reload();
            },
        });

    });

    $('#objectCollections').on("change", function(){


        var newCollections = $("#objectCollections").select2("val");
        var currentCollection = [];
        var del = [];

        $('.collections-card>.card-body>.card').each(function () {

            var id = $(this).attr('data-id');
            currentCollection.push(id);

            if ($.inArray(id, newCollections) === -1) {

                console.log(id);
                del.push(id);

                $('.collections-card [data-id="'+id+'"]').remove();
            }


        });

        console.log(newCollections);
        console.log(currentCollection);

        newCollections.forEach(function (item) {

            if ($.inArray(item, currentCollection) === -1) {

                $.ajax({

                    url: '/get-collection-for-loot-object/' + item,
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (data) {

                        $('.collections-card>.card-body').prepend(data);
                        addItem();
                        collectionSubmit();
                    }
                });
            }
        });


    });
});

function collectionSubmit() {

    $('form.lootCollectionForm').submit(function (e) {

        if (isSubmit) {

            return;
        }

        e.preventDefault();
        var collectionForm = $(this);


        $.ajax({
            url: $('#mainForm').attr('action'),
            method: 'PATCH',
            data: $('#mainForm').serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function () {

                isSubmit = true;
                collectionForm.submit();
            }
        });
    });
}