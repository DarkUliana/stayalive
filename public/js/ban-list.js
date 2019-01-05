$(document).ready(function () {

    $('td select').change(function () {

        $(this).closest('form').submit();
    });

    $('#ban').select2({
        width: '100%',
        placeholder: 'Player',
        minimumInputLength: 3,
        ajax: {
            url: 'players-to-ban',
            dataType: 'json',
            type: "GET",
            quietMillis: 50,
            data: function (term) {
                return {
                    term: term
                };
            }
        }
    });
});