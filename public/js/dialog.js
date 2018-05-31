$(document).ready(function () {

    $('#addDescription').on('click', function () {

        var optionTexts = [];

        $('tr .counter').each(function() {
            optionTexts.push(parseInt($(this).text()))
        });

        var max = Math.max.apply(null, optionTexts);
        console.log(max);
        var index = {"index" : $('tr:last-child>.number').val()};

        console.log(index);

        $.ajax({
            url: '/dialog-description',
            method: 'GET',
            data: index,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {

                $('table').append(data);
            },
        });
    });

    $('.deleteDescription').on('click', function () {

        sortDescriptions();
    });

    $('tbody').sortable({update: sortDescriptions}).disableSelection();

    function sortDescriptions() {

        $('input.number').each(function (index) {

            $(this).attr('value', index);
        });
    }

});



