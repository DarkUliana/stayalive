$(document).ready(function () {

    $('#sidebar').addClass('col-md-2').addClass('offset-md-1').removeClass('col-md-3');



    $('#filter').on('select2:select', function (e) {

        $('#filterForm').submit();
    });

    $('#filterForm').on('submit', function (e) {

        e.preventDefault();

        var url = $(this).attr('action');

        $.get(url, $(this).serialize(), function (data) {


            $('#itemsTbody').html(data.items);
            $('.pagination-wrapper').empty().html(data.pagination);

            linkOnClick();
            editOrAddOnClick();
            viewOnClick();
            deleteOnClick();

        });
    });

    linkOnClick();
    createOrUpdate();
    editOrAddOnClick();
    viewOnClick();
    deleteOnClick();

    $('#addItem').trigger('click');


});

function linkOnClick() {

    $('.page-link').on('click', function (e) {

        e.preventDefault();

        var url = $(this).attr('href');

        $.get(url, function (data) {

            $('tr').remove();
            $('tbody').html(data.items);
            $('.pagination-wrapper').empty().html(data.pagination);

            linkOnClick();

            // $('.page-item.active').removeClass('active');
            // $(e.target).closest('.page-item').addClass('active');

        });
    });

}

function createOrUpdate() {

    $('#createOrUpdate').on('click', function (e) {

        e.preventDefault();

        var form = $(this).closest('form');

        $.ajax({

            url: form.attr('action'),
            method: form.attr('method'),
            data: form.serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            // type: 'json',
            error: function (error) {

                $('#itemBody>.alert').remove();
                error = error.responseJSON;

                if (error !== '') {

                    var err = '<div class="alert alert-danger">';
                    $.each(error.errors, function (key, value) {

                        err += value + '<br>';
                    });
                    err += '</div>';

                    $('#itemBody').prepend(err);
                }


            },
            success: function (data) {
                $('#itemBody>.alert').remove();

                status = '<div class="alert alert-success">' + data.status + '</div>';
                $('#itemBody').prepend(status);
            }
        });
    });
}

function editOrAddOnClick() {

    $('.editItem, #addItem').on('click', function (e) {

        e.preventDefault();

        var url = $(this).attr('href');

        $.ajax({
            url: url,
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {

                $('#itemBlade').remove();
                $('#itemsContainer>.row').append(data);

                $('#inventorySlotType').select2({width: '100%', minimumResultsForSearch: Infinity});

                $('#inventorySlotType').on('select2:select', function () {

                    var type = {"type": $(this).val()};

                    $.ajax({
                        url: '/properties',
                        method: 'GET',
                        data: type,
                        success: function (d) {

                            $('#properties').empty();
                            $('#properties').append(d);

                            $('#Name').val($('#noteID>option').first().text());
                            $('#noteImage').val($('#noteID>option').first().attr('data-image'));


                            $('#noteID').select2({width: '100%', minimumResultsForSearch: Infinity});
                            $('#noteID').on('select2:select', function () {

                                $('#Name').val($(this).find(':selected').text());
                                $('#noteImage').val($(this).find(':selected').attr('data-image'));

                            });
                        },
                    });

                });

                createOrUpdate();
            },

        });
    });
}

function viewOnClick() {

    $('.viewItem').on('click', function (e) {

        e.preventDefault();

        var url = $(this).attr('href');

        $.ajax({
            url: url,
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {

                $('#itemBlade').remove();
                $('#itemsContainer>.row').append(data);

            },

        });

    });
}

function deleteOnClick() {

    $('.deleteItem').on('click', function (e) {

        e.preventDefault();

        var item = $(this);
        var url = item.attr('href');

        $.ajax({
            url: url,
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {

                item.closest('tr').remove();
                $('#itemsCol>.alert').remove();

                status = '<div class="alert alert-success">' + data.status + '</div>';
                $('#itemsCol').prepend(status);

            },

        });

    });
}