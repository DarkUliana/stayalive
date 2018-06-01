$(document).ready(function () {

    $('#addDescription').on('click', function () {

        var optionTexts = [];

        $('tr .counter').each(function () {
            optionTexts.push(parseInt($(this).text()))
        });

        var max = Math.max.apply(null, optionTexts);

        var index = {"index": $('tbody tr:last-child .number').val()};


        if ($('.number').length == 0) {

            index = {"index": 0};
        }


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


    $('input[type=radio][name=daily]').change(function () {
        if (this.value === '1') {

            $('#dialogCard').removeClass('d-block').addClass('d-none');
        }
        else if (this.value === '0') {

            $('#dialogCard').removeClass('d-none').addClass('d-block');
        }
    });


    $('.deleteDescription').on('click', function () {
        $(this).closest('tr').remove();
        sortDescriptions();
    });

    $('tbody').sortable({update: sortDescriptions}).disableSelection();

    function sortDescriptions() {

        $('input.number').each(function (index) {

            $(this).attr('value', index);
        });
    }

});



