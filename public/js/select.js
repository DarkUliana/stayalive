$(document).ready(function () {
    $('#items').select2({width: '100%'});

    $('#item').select2({width: '100%'});

    $('#technologies').select2({width: '100%'});

    $('.component').select2({width: '100%'});

    $('.language').select2({width: '100%'});

    $('#filter').select2({width: '150px', minimumResultsForSearch: Infinity, placeholder: 'Type'});

    $('#filter').on('select2:select', function () {

        $('#filterForm').submit();
    });

    $('#inventorySlotType').select2({width: '100%', minimumResultsForSearch: Infinity});

    $('#inventorySlotType').on('select2:select', function () {

        var type = {"type" : $(this).val()};

        $.ajax({
            url: '/properties',
            method: 'GET',
            data: type,
            success: function (data) {

                console.log(data);
                $('#properties').empty();
                $('#properties').append(data);
            },
        });
    });
});

