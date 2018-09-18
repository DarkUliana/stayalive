$(document).ready(function () {

    $('select').select2({"width" : "100%"});

    $('#collectionName').on('focus', function () {

        $(this).val($('#objectKey').val() + ' ' + $('#collectionItem').find(':selected').text());
    });
});