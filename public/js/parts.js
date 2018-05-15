$(document).ready(function () {
    $(document).on('click', '#addProperty', function () {
        var quantity = $('tr:last .number').text();
        $.ajax({
            url: '/item-property',
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {"counter": quantity},

            success: function (data) {
                $('tbody').append(data);
            },

        });
    });

    $(document).on('click', '#addComponent', function () {

        var quantity = $('tr:last .number').text();
        $.ajax({
            url: '/recipe-component',
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {"counter": quantity},

            success: function (data) {
                $('tbody').append(data);
                $('.component:last').select2({width: '100%'});
            },

        });
    });

    $(document).on('click', '.deleteComponent, .deleteProperty, .deleteEmptyLanguage', function () {
        $(this).closest('tr').remove();
    });

    $(document).on('click', '.editLanguage', function () {
        $(this).closest('tr').find('.editForm').show();
        $(this).closest('tr').find('.languageName').hide();
    });

    $(document).on('click', '.addLanguage', function () {
        $.ajax({
            url: '/language-item',
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            success: function (data) {
                $('tbody').append(data);
            },

        });
    });

    $(document).on('click', '#addShopItem', function () {

        var quantity = $('tr:last .number').text();
        $.ajax({
            url: '/shop-item',
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {"counter": quantity},
            success: function (data) {
                $('tbody').append(data);
                if ($('tr').length === 7) {
                    $('#addShopItem').attr('disabled', 'disabled');
                }

            },

        });

    });

    $(document).on('click', '.deleteShopItem', function () {
        $(this).closest('tr').remove();

        if ($('tr').length < 7) {
            $('#addShopItem').removeAttr('disabled');
        }
    });

    if ($('tr').length === 7) {
        $('#addShopItem').attr('disabled', 'disabled');
    }

    $('#typeID').on('change', function () {


        var type = {"type": $(this).val()};

        $.ajax({
            url: '/quest-items',
            method: 'GET',
            data: type,
            success: function (data) {

                $('#questObject').remove();
                $('#questType').after(data);
            },
        });
    });

});