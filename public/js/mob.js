$(document).ready(function () {

    console.log(1);
    enemySelect();
});

function enemySelect() {
    console.log(2);
    $('#enemyType').on('change', function () {
        console.log(3);
        var data = {};

        data.enemy = $(this).val();

        $.ajax({
            url : '/mob-fields',
            method: 'POST',
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (d) {

                $('table').remove();
                $('form').append(d);

            },
        });
        enemySelect();
    });
}