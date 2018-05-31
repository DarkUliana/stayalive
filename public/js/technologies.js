$(document).ready(function () {

    $('#sidebar').addClass('col-md-2').addClass('offset-md-2').removeClass('col-md-3');
});


var dialogs = {
    "beginQuestDialogs":
        [{
            "id": -1,
            "questID": -1,
            "phrases": [{"speaker": 0, "phrase": "DialogLQ -1 Player 1"}, {
                "speaker": 0,
                "phrase": "DialogLQ -1 Player 2"
            }, {"speaker": 0, "phrase": "DialogLQ -1 Player 3"}, {
                "speaker": 1,
                "phrase": "DialogLQ -1 Parrot 1"
            }, {"speaker": 1, "phrase": "DialogLQ -1 Parrot 2"}, {
                "speaker": 1,
                "phrase": "DialogLQ -1 Parrot 3"
            }, {"speaker": 1, "phrase": "DialogLQ -1 Parrot 4"}, {
                "speaker": 1,
                "phrase": "DialogLQ -1 Parrot 5"
            }, {"speaker": 1, "phrase": "DialogLQ -1 Parrot 6"}, {
                "speaker": 1,
                "phrase": "DialogLQ -1 Parrot 7"
            }, {"speaker": 1, "phrase": "DialogLQ 0 Parrot 1"}]
        }, {
            "id": 0,
            "questID": 0,
            "phrases": [{"speaker": 1, "phrase": "DialogLQ 0 Parrot 2"}, {
                "speaker": 1,
                "phrase": "DialogLQ 1 Parrot 1"
            }]
        }, {
            "id": 1,
            "questID": 1,
            "phrases": [{
                "speaker": 1,
                "phrase": "DialogLQ 1 Parrot 2"
            },
                {
                    "speaker": 1,
                    "phrase": "DialogLQ 2 Parrot 1"
                }]
        }, {
            "id": 2,
            "questID": 2,
            "phrases": [{"speaker": 1, "phrase": "DialogLQ 2 Parrot 2"}, {
                "speaker": 1,
                "phrase": "DialogLQ 3 Parrot 1"
            }]
        }, {
            "id": 3,
            "questID": 3,
            "phrases": [{"speaker": 1, "phrase": "DialogLQ 3 Parrot 2"}, {
                "speaker": 1,
                "phrase": "DialogLQ 4 Parrot 1"
            }]
        }, {
            "id": 4,
            "questID": 4,
            "phrases": [{"speaker": 1, "phrase": "DialogLQ 4 Parrot 2"}, {
                "speaker": 1,
                "phrase": "DialogLQ 5 Parrot 1"
            }]
        }, {
            "id": 5,
            "questID": 5,
            "phrases": [{"speaker": 1, "phrase": "DialogLQ 5 Parrot 2"}, {
                "speaker": 1,
                "phrase": "DialogLQ 6 Parrot 1"
            }]
        }, {
            "id": 6,
            "questID": 6,
            "phrases": [{"speaker": 1, "phrase": "DialogLQ 6 Parrot 2"}, {
                "speaker": 1,
                "phrase": "DialogLQ 7 Parrot 1"
            }]
        }, {
            "id": 7,
            "questID": 7,
            "phrases": [{"speaker": 1, "phrase": "DialogLQ 7 Parrot 2"}, {
                "speaker": 1,
                "phrase": "DialogLQ 8 Parrot 1"
            }]
        }, {
            "id": 8,
            "questID": 8,
            "phrases": [{"speaker": 1, "phrase": "DialogLQ 8 Parrot 2"}, {
                "speaker": 1,
                "phrase": "DialogLQ 8 Parrot 3"
            }]
        }],
    "AdditionalDialogs":
        [
            {
                "id": 0,
                "questID": 8,
                "phrases": [
                    {
                        "speaker": 1,
                        "phrase": "Ebaty"
                    },
                    {
                        "speaker": 0,
                        "phrase": "Pizdec"
                    }
                ]
            }]
};

var quests = {
    "allQuestsData": [{
        "Type": "CollectQuest, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
        "Json": "{\"questID\":0,\"name\":\"Quest 1\",\"level\":1,\"starPoints\":25,\"countToDo\":30,\"rewardID\":1,\"itemID\":12}"
    }, {
        "Type": "CollectQuest, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
        "Json": "{\"questID\":1,\"name\":\"Quest 2\",\"level\":2,\"starPoints\":25,\"countToDo\":40,\"rewardID\":1,\"itemID\":13}"
    }, {
        "Type": "CollectQuest, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
        "Json": "{\"questID\":2,\"name\":\"Quest 3\",\"level\":3,\"starPoints\":25,\"countToDo\":30,\"rewardID\":1,\"itemID\":16}"
    }, {
        "Type": "CollectQuest, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
        "Json": "{\"questID\":3,\"name\":\"Quest 4\",\"level\":4,\"starPoints\":30,\"countToDo\":60,\"rewardID\":2,\"itemID\":15}"
    }, {
        "Type": "CollectQuest, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
        "Json": "{\"questID\":4,\"name\":\"Quest 5\",\"level\":5,\"starPoints\":30,\"countToDo\":50,\"rewardID\":2,\"itemID\":23}"
    }, {
        "Type": "CollectQuest, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
        "Json": "{\"questID\":5,\"name\":\"Quest 6\",\"level\":6,\"starPoints\":15,\"countToDo\":25,\"rewardID\":1,\"itemID\":24}"
    }, {
        "Type": "CollectQuest, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
        "Json": "{\"questID\":6,\"name\":\"Quest 7\",\"level\":7,\"starPoints\":25,\"countToDo\":30,\"rewardID\":1,\"itemID\":25}"
    }, {
        "Type": "CollectQuest, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
        "Json": "{\"questID\":7,\"name\":\"Quest 8\",\"level\":8,\"starPoints\":15,\"countToDo\":20,\"rewardID\":1,\"itemID\":8}"
    }, {
        "Type": "CollectQuest, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
        "Json": "{\"questID\":8,\"name\":\"Quest 9\",\"level\":9,\"starPoints\":25,\"countToDo\":30,\"rewardID\":1,\"itemID\":14}"
    }, {
        "Type": "CollectQuest, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
        "Json": "{\"questID\":9,\"name\":\"Quest 10\",\"level\":10,\"starPoints\":30,\"countToDo\":25,\"rewardID\":2,\"itemID\":29}"
    }, {
        "Type": "CollectQuest, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
        "Json": "{\"questID\":10,\"name\":\"Quest 11\",\"level\":11,\"starPoints\":25,\"countToDo\":30,\"rewardID\":1,\"itemID\":17}"
    }, {
        "Type": "CollectQuest, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
        "Json": "{\"questID\":11,\"name\":\"Quest 12\",\"level\":12,\"starPoints\":30,\"countToDo\":40,\"rewardID\":2,\"itemID\":11}"
    }, {
        "Type": "KillQuest, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
        "Json": "{\"questID\":12,\"name\":\"Quest 13\",\"level\":13,\"starPoints\":50,\"countToDo\":10,\"rewardID\":2,\"enemy\":4}"
    }, {
        "Type": "KillQuest, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
        "Json": "{\"questID\":13,\"name\":\"Quest 14\",\"level\":14,\"starPoints\":30,\"countToDo\":5,\"rewardID\":2,\"enemy\":3}"
    }, {
        "Type": "KillQuest, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
        "Json": "{\"questID\":14,\"name\":\"Quest 15\",\"level\":15,\"starPoints\":30,\"countToDo\":2,\"rewardID\":2,\"enemy\":0}"
    }, {
        "Type": "KillQuest, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
        "Json": "{\"questID\":15,\"name\":\"Quest 16\",\"level\":16,\"starPoints\":30,\"countToDo\":2,\"rewardID\":2,\"enemy\":1}"
    }, {
        "Type": "KillQuest, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
        "Json": "{\"questID\":16,\"name\":\"Quest 17\",\"level\":17,\"starPoints\":50,\"countToDo\":2,\"rewardID\":2,\"enemy\":8}"
    }, {
        "Type": "KillQuest, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
        "Json": "{\"questID\":17,\"name\":\"Quest 18\",\"level\":18,\"starPoints\":50,\"countToDo\":2,\"rewardID\":2,\"enemy\":7}"
    }, {
        "Type": "KillQuest, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
        "Json": "{\"questID\":18,\"name\":\"Quest 19\",\"level\":19,\"starPoints\":50,\"countToDo\":2,\"rewardID\":2,\"enemy\":11}"
    }, {
        "Type": "StarPointsQuest, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
        "Json": "{\"questID\":19,\"name\":\"Epic Quest\",\"level\":0,\"starPoints\":0,\"countToDo\":400,\"rewardID\":3}"
    }, {
        "Type": "StarPointsQuest, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
        "Json": "{\"questID\":20,\"name\":\"Legendary Quest\",\"level\":0,\"starPoints\":0,\"countToDo\":600,\"rewardID\":4}"
    }]
};