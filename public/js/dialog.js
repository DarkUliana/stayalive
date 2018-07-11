$(document).ready(function () {

    $('.addDescription, #addDescription').on('click', function () {

        var type;
        if ($(this).closest('#dialogCard1').length) {

            type = 'beginDescriptions';
        } else {

            type = 'additionalDescriptions';
        }

        console.log(type);
        var optionTexts = [];

        var table = $(this).closest('table');

        table.find('tr .counter').each(function () {
            optionTexts.push(parseInt($(this).text()))
        });

        var index = Math.max.apply(null, optionTexts);

        if (table.find('.number').length == 0) {

            index = 0;
        }

        var data = {
            "index" : index,
            "type" : type
        };

        $.ajax({
            url: '/dialog-description',
            method: 'GET',
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {

                table.append(data);
                deleteDescription();
                sortDescriptions();
            },
        });
    });


    $('input[type=radio][name=daily]').change(function () {
        if (this.value === '1') {

            $('#dialogCard1, #dialogCard2').removeClass('d-block').addClass('d-none');
        }
        else if (this.value === '0') {

            $('#dialogCard1, #dialogCard2').removeClass('d-none').addClass('d-block');
        }
    });

    deleteDescription();


    $('tbody').sortable({update: sortDescriptions}).disableSelection();

    function sortDescriptions() {

        $('#dialogCard1').find('input.number').each(function (index) {

            $(this).attr('value', index);
        });
        $('#dialogCard2').find('input.number').each(function (index) {

            $(this).attr('value', index);
        });
    }

});

function deleteDescription() {
    $('.deleteDescription').on('click', function () {
        $(this).closest('tr').remove();
        sortDescriptions();
    });
}