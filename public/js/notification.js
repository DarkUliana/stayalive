$(document).ready(function () {

    $('input[type=radio][name=isSimple]').change(function () {
        if (this.value === '1') {

            $('#date').removeClass('d-block').addClass('d-none');
        }
        else if (this.value === '0') {

            $('#date').removeClass('d-none').addClass('d-block');
        }
    });
});