$(document).ready(function () {
    $('.merge').on('click', function (e) {

        e.preventDefault();
        if (confirm('Are you sure?')) {
            document.location.href = $(this).attr('href');
        }
    });
});