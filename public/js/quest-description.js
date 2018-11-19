$(document).ready(function () {

    $('#questID').on('change', function () {

        $('#textKey').val($(this).find(':selected').text());
    });
});