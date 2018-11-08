$(document).ready(function () {

    $('td select').change(function () {

        $(this).closest('form').submit();
    });
});