$(document).ready(function () {

    console.log('load');
    enemySelect();
});

function enemySelect() {
    console.log('enemySelect');
    $('select[name="enemyType"]').on('change', function () {
        console.log('event');
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

                console.log('success');
                $('table').empty();
                $('table').append(d);
                enemySelect();
            },
        });

    });
}