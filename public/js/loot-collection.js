$(document).ready(function () {

   $('select').select2();

   $('#addItem').on('click', function () {

       var optionTexts = [];

       $('tbody>tr').each(function () {
           optionTexts.push(parseInt($(this).attr('data-index')));
       });

       var index ={"index": Math.max.apply(null, optionTexts)};
       console.log(optionTexts);

       if ($('tr').length == 1) {

           index = {"index": 0};
       }


       $.ajax({
           url: '/loot-collection.js-item',
           method: 'GET',
           data: index,
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
           success: function (data) {

               $('tbody').prepend(data);
               $('select').select2();
               deleteDescriptionEvent();
           },
       });
   });


    deleteDescriptionEvent();
});

function deleteDescriptionEvent() {
    $('.deleteItem').on('click', function () {
        $(this).closest('tr').remove();
    });
}