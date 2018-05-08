$(document).ready(function () {
    $('#items').select2({width: '100%'});

    $('#item').select2({width: '100%'});

    $('#technologies').select2({width: '100%'});

    $('.component').select2({width: '100%'});

    $('.language').select2({width: '100%'});

    $('#filter').select2({width: '150px', placeholder: 'Type'});

});

var i = {
    "googleID": "10",
    "starQuest":
        {
            "questControllerData": "{\"progress\":50}",
            "questID": 19
        }
    ,
    "questsData":
        [
            {"questControllerData": "{\"progress\":0}", "questID": 11},

            {"questControllerData": "{\"progress\":0}", "questID": 1},

            {"questControllerData": "{\"progress\":2}", "questID": 2}
        ]
};

