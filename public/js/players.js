$(document).ready(function () {
    online();
    $('#sidebar').addClass('col-md-2').addClass('offset-md-2').removeClass('col-md-3');


    setInterval(online, 5000);
});

function online() {
    $.ajax({
        url: window.location.href,
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

        success: function (data) {

            data.forEach(function (item) {

                var element = $('td:contains(' + item.googleID + ')').next().first();

                element.empty();

                if (item.online === "true") {
                    element.append('<i class="fa fa-circle" style="color: #2ca02c"></i>');
                } else {
                    element.append('<i class="fa fa-circle" style="color: #98a2ac"></i>');
                }


            });
            // $('tbody').append(data);
            // $('.component:last').select2({width: '100%'});
        },
    });
}