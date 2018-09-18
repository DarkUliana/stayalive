$(document).ready(function () {

    $('select').select2({"width" : "100%"});

    $('#collectionName').on('focus', function () {

        $(this).val($('#objectKey').val() + ' ' + $('#collectionItem').find(':selected').text());
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

                var option = new Option(data.value, data.id, false, true);
                $("#objectCollections").append(option).trigger('change');
            },
        });

    });
});