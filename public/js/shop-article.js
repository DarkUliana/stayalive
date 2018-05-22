$(document).ready(function () {

    if ($('#shopItemType').val() !== '8') {

        $('#dateTimeDiv').hide();

    }

    $('#shopItemType').on('change', function () {

        console.log($('#shopItemType').val());
        if ($(this).val() === '8') {

            $('#dateTimeDiv').show();
        } else {

            $('#dateTimeDiv').hide();
        }
    });
});
