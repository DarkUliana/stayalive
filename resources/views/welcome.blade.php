<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/admin/technologies') }}">Technologies</a>
                <a href="{{ url('/logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a>

                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </div>
    @endif

    <div class="content">
        <div class="title m-b-md">
            Laravel
        </div>

        <div class="links">

            <a href="#" id="create">Create Player</a>
            <a href="#" id="update">Update Player</a>
            <a href="#" id="get">Get Player</a>
            <a href="#" id="delete">Delete Player</a>

        </div>
        <div class="links" style="padding-top: 50px">

        <a href="#" id="createTimer">Create timer</a>
        <a href="#" id="getTimer">Get timer</a>

        </div>
        <div class="links" style="padding-top: 50px">

        <a href="#" id="createSlots">Create slots</a>
        <a href="#" id="getSlots">Get slots</a>

        </div>
        {{--<div class="links" style="padding-top: 50px">--}}

        {{--<a href="#" id="createItems">Create items</a>--}}
        {{--<a href="#" id="getItems">Get items</a>--}}
        {{--<a href="#" id="deleteItem">Get item</a>--}}

        {{--</div>--}}

        {{--<div class="links" style="padding-top: 50px">--}}

        {{--<a href="#" id="createTechnologies">Create Technologies</a>--}}
        {{--<a href="#" id="getTechnologies">Get Technologies</a>--}}

        {{--</div>--}}

        {{--<div class="links" style="padding-top: 50px">--}}

        {{--<a href="#" id="createRecipes">Create Recipes</a>--}}
        {{--<a href="#" id="getRecipes">Get Recipes</a>--}}

        {{--</div>--}}

        <div class="links" style="padding-top: 50px">

        <a href="#" id="createTechList">Create Tech List</a>
        <a href="#" id="getTechList">Get Tech List</a>

        </div>

        {{--<div class="links" style="padding-top: 50px">--}}

        {{--<a href="#" id="createItemsInCraft">Create Items In Craft</a>--}}
        {{--<a href="#" id="getItemsInCraft">Get Items In Craft</a>--}}

        {{--</div>--}}


        <div class="links">

            <a href="#" id="getDescriptions">Get descriptions</a>
            <a href="#" id="createDescriptions">Create descriptions</a>

        </div>

    </div>
</div>
<script>
    var descriptions = {
        "items": [
            {
                "name": "Fried Crab",
                "id": 301,
                "description": "Fried crab allays the hunger very well "
            },
            {
                "name": "Fried Crab",
                "id": 301,
                "description": "Fried crab allays the hunger very well "
            },
            {
                "name": "Dried Fish",
                "id": 302,
                "description": "Dried fish allays the hunger, can be kept for a long time"
            },
            {
                "name": "Fried Fish",
                "id": 303,
                "description": "Fried fish is delicious, allays hunger perfectly"
            },
            {
                "name": "Fried Meat",
                "id": 304,
                "description": "Fried meat is excellent to allay hunger"
            },
            {
                "name": "Fried Mushrooms",
                "id": 305,
                "description": "Fried mushrooms are palatable and nutritious"
            },
            {
                "name": "Dried Mushrooms",
                "id": 306,
                "description": "Dried mushrooms cure the sores well and allay the hunger"
            },
            {
                "name": "Water",
                "id": 307,
                "description": "Water is the best to allay thirst "
            },
            {
                "name": "Crabs Meat",
                "id": 308,
                "description": "Crab meat is a substantial nutrition, you won’t starve to dead"
            },
            {
                "name": "Fish Meat",
                "id": 309,
                "description": "Fish is a good food, you can cook it"
            },
            {
                "name": "Meat",
                "id": 310,
                "description": "Raw meat is better cooked"
            },
            {
                "name": "Mushrooms",
                "id": 311,
                "description": "Tree is the main firewood, it can be hew them into planks"
            }, {
                "name": "Coconut",
                "id": 312,
                "description": "Coconut – they can use it as some food and as a water source"
            }, {
                "name": "Banana",
                "id": 313,
                "description": "Banana is a sweet fruit and it appeases hunger"
            }, {
                "name": "Sugar Cane",
                "id": 314,
                "description": "Sugar cane appeases hunger"

            },
            {
                "name": "Wood",
                "id": 1,
                "description": "Tree is the main firewood, it can be hew them into planks"
            }, {
                "name": "Stone",
                "id": 2,
                "description": "Stone can be used as the initial tool or stone blocks"
            }, {
                "name": "Iron Ore",
                "id": 3,
                "description": "Iron ore is melted down into the metal"
            }, {
                "name": "Sulfur Ore",
                "id": 4,
                "description": "Sulfur ore – refine it to get sulfur for powder"
            }, {
                "name": "Cuprum Ore",
                "id": 5,
                "description": "Copper ore is melt able – precious metal"
            }, {
                "name": "Nitrum Ore",
                "id": 6,
                "description": "Saltpeter is used for powder manufacture"
            }, {
                "name": "Salt",
                "id": 7,
                "description": "Salt is a valuable mineral source"
            }, {
                "name": "Coal",
                "id": 8,
                "description": "Coal is a good fuel"
            }, {
                "name": "Clay",
                "id": 9,
                "description": "Clay is the initial building material"
            }, {
                "name": "Palm Leaves",
                "id": 10,
                "description": "Palm leaves are suitable for making a roof or some simple clothes"
            }, {
                "name": "Stem",
                "id": 11,
                "description": "Stems – use them to twist a rope"
            }, {
                "name": "Incisor",
                "id": 12,
                "description": "Tusks are used for the armament"
            }, {
                "name": "Bone",
                "id": 13,
                "description": "Bones are used in everyday life"
            }, {
                "name": "Skin",
                "id": 14,
                "description": "Skin can be dried on the tannery"
            }, {
                "name": "Resin",
                "id": 15,
                "description": "Pitch is rather good ductile material"
            }, {
                "name": "Spyglass",
                "id": 107,
                "description": "You need spyglass to travel by ship"
            }, {
                "name": "Stone Axe",
                "id": 1101,
                "description": "Stone axe is a tool for tree cutting"
            }, {
                "name": "Stone Hoe",
                "id": 1102,
                "description": "Stone hoe is a tool for ore and clay treatment"
            }, {
                "name": "Stone Pickaxe",
                "id": 1103,
                "description": "Stone navy pick is a tool for ore mining"
            }, {
                "name": "Iron Axe",
                "id": 1104,
                "description": "Metal ax is a tool for tree cutting "
            }, {
                "name": "Iron Pickaxe",
                "id": 1105,
                "description": "Metal navy pick is a tool for ore mining"
            }, {
                "name": "Iron Hoe",
                "id": 1106,
                "description": "Metal hoe is a tool for ore and clay treatment"
            }, {
                "name": "Stone Knife",
                "id": 1201,
                "description": "Stone knife is used to protection and cutting"
            }, {
                "name": "Stone Spear",
                "id": 1202,
                "description": "Stone spear is the thrusting weapon"
            }, {
                "name": "Club",
                "id": 1203,
                "description": "Wooden club is to crush aborigines skulls"
            }, {
                "name": "Bow",
                "id": 1204,
                "description": "Bow is the silent weapon of long-range combat"
            }, {
                "name": "Stone Sword",
                "id": 1205,
                "description": "Stone sward is the initial weapon for blowing the heads off"
            }, {
                "name": "Stone Sword And Shield",
                "id": 1206,
                "description": "Wooden shield with sword сan slightly protect you from the enemy attacks"
            }, {
                "name": "Wooden Arrow",
                "id": 1207,
                "description": "Arrows #1 are the wood and leaves  arrows"
            }, {
                "name": "Bone Arrow",
                "id": 1208,
                "description": "Arrows #2 are the arrows with the stone tips"
            }, {
                "name": "Iron Arrow",
                "id": 1209,
                "description": "Arrows #3 are the arrows with metal tips"
            }, {
                "name": "Iron Spear",
                "id": 1210,
                "description": "Metal spear is the thrusting weapon"
            }, {
                "name": "Iron Sword",
                "id": 1211,
                "description": "Metal sword is a good weapon for blowing up heads"
            }, {
                "name": "Iron Sword And Shield",
                "id": 1212,
                "description": "Metal sword and shield is a good protection from the enemies attacks"
            }, {
                "name": "Iron Knife",
                "id": 1213,
                "description": "Metal knife cuts everything near at hand well"
            }, {
                "name": "Pistol",
                "id": 1215,
                "description": "Pistole is the initial fire arm"
            }, {
                "name": "Pistol and Musket Ammo",
                "id": 1216,
                "description": "Cartridges #1 – for initial fire arm"
            }, {
                "name": "Rapier",
                "id": 1217,
                "description": "Rapier is a perfect pirate weapon"
            }, {
                "name": "Musket",
                "id": 1218,
                "description": "Musket is a powerful initial fire arm"
            }, {
                "name": "Revolver",
                "id": 1219,
                "description": "Colt is the advanced fire arm"
            }, {
                "name": "Revolver and Winchester Ammo",
                "id": 1220,
                "description": "Cartridges #2 – for advanced fire arm"
            }, {
                "name": "Winchester",
                "id": 1221,
                "description": "Winchester rifle is the advanced fire arm"
            }, {
                "name": "Palm Bag",
                "id": 1301,
                "description": "Small backpack - for collecting and portage of resources"
            }, {
                "name": "Palm Headband",
                "id": 1302,
                "description": "Palm leaves clothes is a weak protection from the animals and aborigines attacks"
            }, {
                "name": "Palm Chest",
                "id": 1303,
                "description": "Palm leaves clothes is a weak protection from the animals and aborigines attacks"
            }, {
                "name": "Palm Pants",
                "id": 1304,
                "description": "Palm leaves clothes is a weak protection from the animals and aborigines attacks"
            }, {
                "name": "Palm Shoes",
                "id": 1305,
                "description": "Palm leaves clothes is a weak protection from the animals and aborigines attacks"
            }, {
                "name": "Bone Bandage",
                "id": 1306,
                "description": "Bone clothes is a good protection from the attacks"
            }, {
                "name": "Bone Chest",
                "id": 1307,
                "description": "Bone clothes is a good protection from the attacks"
            }, {
                "name": "Bone Pants",
                "id": 1308,
                "description": "Bone clothes is a good protection from the attacks"
            }, {
                "name": "Bone Shoes",
                "id": 1309,
                "description": "Bone clothes is a good protection from the attacks"
            }, {
                "name": "Wooden Helmet",
                "id": 1310,
                "description": "Wooden armor protects from the attacks"
            }, {
                "name": "Wooden Chest",
                "id": 1311,
                "description": "Wooden armor protects from the attacks"
            }, {
                "name": "Wooden Pants",
                "id": 1312,
                "description": "Wooden armor protects from the attacks"
            }, {
                "name": "Wooden Shoes",
                "id": 1313,
                "description": "Wooden armor protects from the attacks"
            }, {
                "name": "Cloth Bag",
                "id": 1314,
                "description": "Middle size backpack - for collecting and portage of resources"
            }, {
                "name": "Cloth Headband",
                "id": 1332,
                "description": "Metal knife cuts everything near at hand well"
            }, {
                "name": "Cloth Chest",
                "id": 1333,
                "description": "Clothes made of cloth protects from cold and attacks"
            }, {
                "name": "Cloth Pants",
                "id": 1334,
                "description": "Clothes made of cloth protects from cold and attacks"
            }, {
                "name": "Cloth Shoes",
                "id": 1335,
                "description": "Clothes made of cloth protects from cold and attacks"
            }, {
                "name": "Heavy Bone Helmet",
                "id": 1315,
                "description": "Bone armor is a good protection from the attacks"
            }, {
                "name": "Heavy Bone Chest",
                "id": 1316,
                "description": "Bone armor is a good protection from the attacks"
            }, {
                "name": "Heavy Bone Pants",
                "id": 1317,
                "description": "Bone armor is a good protection from the attacks"
            }, {
                "name": "Heavy Bone Shoes",
                "id": 1318,
                "description": "Bone armor is a good protection from the attacks"
            }, {
                "name": "Skin Bag",
                "id": 1319,
                "description": "Big backpack - for collecting and portage of resources"
            }, {
                "name": "Pirate Hat",
                "id": 1320,
                "description": "Pirate outfit is what you need for the brave pirate protection"
            }, {
                "name": "Pirate Chest",
                "id": 1321,
                "description": "Pirate outfit is what you need for the brave pirate protection"
            }, {
                "name": "Pirate Pants",
                "id": 1322,
                "description": "Pirate outfit is what you need for the brave pirate protection"
            }, {
                "name": "Pirate Shoes",
                "id": 1323,
                "description": "Pirate outfit is what you need for the brave pirate protection"
            }, {
                "name": "Skin Chest",
                "id": 1325,
                "description": "Leather clothes is a perfect protection from cold and the attacks"
            }, {
                "name": "Skin Pants",
                "id": 1326,
                "description": "Leather clothes is a perfect protection from cold and the attacks"
            }, {
                "name": "Skin Shoes",
                "id": 1327,
                "description": "Leather clothes is a perfect protection from cold and the attacks"
            }, {
                "name": "Metal Helmet",
                "id": 1328,
                "description": "Metal armor is the most reliable protection from the assault"
            }, {
                "name": "Metal Chest",
                "id": 1329,
                "description": "Metal armor is the most reliable protection from the assault"
            }, {
                "name": "Metal Pants",
                "id": 1330,
                "description": "Metal armor is the most reliable protection from the assault"
            }, {
                "name": "Metal Shoes",
                "id": 1331,
                "description": "Metal armor is the most reliable protection from the assault"
            }, {
                "name": "Rope",
                "id": 201,
                "description": "Rope is unreliable but is able to tie everything invisible"
            }, {
                "name": "Strong Rope",
                "id": 202,
                "description": "Ruggedized rope is a reliable helper in craft or building"
            }, {
                "name": "Boards",
                "id": 203,
                "description": "Planks are the material for building and craft"
            }, {
                "name": "Net",
                "id": 204,
                "description": "Net catches some fish"
            }, {
                "name": "Stone Block",
                "id": 205,
                "description": "Stone blocks are reliable building material"
            }, {
                "name": "Clay Block",
                "id": 206,
                "description": "Clay blocks are the initial building material"
            }, {
                "name": "Cured Leather",
                "id": 207,
                "description": "Leather is a good material for clothes"
            }, {
                "name": "Cloth",
                "id": 208,
                "description": "Cloth can be used for sewing clothes"
            }, {
                "name": "Iron Bar",
                "id": 209,
                "description": "Metal is widely used in craft"
            }, {
                "name": "Sulfur",
                "id": 210,
                "description": "Sulfur is used for powder making"
            }, {
                "name": "Bullet",
                "id": 211,
                "description": "Bullet blows the aborigines heads off, is used in the fire arms"
            }, {
                "name": "Iron Plate",
                "id": 212,
                "description": "Metal plate is widely used in the armament and in the craft "
            }, {
                "name": "Gunpowder Level 1",
                "id": 213,
                "description": "Powder is for shooting from the initial fire arm"
            }, {
                "name": "Clay Forms For Weapons",
                "id": 214,
                "description": "Clay casting forms are used for weapons making"
            }, {
                "name": "Cuprum Bar",
                "id": 215,
                "description": "Copper is an indispensable material for craft"
            }, {
                "name": "Cuprum Plate",
                "id": 216,
                "description": "Copper plate is widely used in the armament"
            }, {
                "name": "Spare Parts",
                "id": 217,
                "description": "Small spares are for advanced fire arms"
            }, {
                "name": "Peeled Saltpeter",
                "id": 219,
                "description": "Refined sulfur - for making more qualitative powder"
            }, {
                "name": "Cuprum Muff",
                "id": 220,
                "description": "Copper sleeve – for shooting from the advanced fire arms"
            }, {
                "name": "Clay Tiling",
                "id": 222,
                "description": "Clay shine – for house roof of high quality"
            }, {
                "name": "Gunpowder Level 2",
                "id": 221,
                "description": "Refined powder – for shooting from the advanced fire arm"
            }, {
                "name": "Home Level 1",
                "id": 2001,
                "description": "Hut is your initial level house. It's weak and unreliable. Don't stay here for a long time!"
            }, {
                "name": "Home Level 2",
                "id": 2002,
                "description": "The initial level house is a better security from cold and danger, it provides an opportunity to work wood"
            }, {
                "name": "Home Level 3",
                "id": 2003,
                "description": "Wooden house is a cozy dwelling, it provides an opportunity to work stone"
            }, {
                "name": "Home Level 4",
                "id": 2004,
                "description": "Stone blocks house is the secure accomodation, it provides an opportunity to smelt metal and to make fire arm   "
            }, {
                "name": "Home Level 5",
                "id": 2005,
                "description": "Bastel house is the most reliable refuge from all dangers, it provides an opportunity to make fire arms and to craft up to the highest level  "
            }, {
                "name": "Hearth Level 1",
                "id": 2011,
                "description": "Bonfire allows you to cook food and to allay your hunger"
            }, {
                "name": "Hearth Level 2",
                "id": 2012,
                "description": "Big bonfire accelerates food cooking, you can cook mushrooms either"
            }, {
                "name": "Hearth Level 3",
                "id": 2013,
                "description": "Stove is a comfortable civilized device for the dwelling heating and for the rapid food cooking  "
            }, {
                "name": "Hearth Level 4",
                "id": 2014,
                "description": "Big stove allows to cook food as quickly as it's possible"
            }, {
                "name": "Chest Level 1",
                "id": 2021,
                "description": "Small case is for keeping your few possessions for a spell"
            }, {
                "name": "Chest Level 2",
                "id": 2022,
                "description": "Big case increases your capacity for keeping resources"
            }, {
                "name": "Chest Level 3",
                "id": 2023,
                "description": "Small chest is a safe place with a great roominess. It's good enough for keeping the supplies and your weapon"
            }, {
                "name": "Chest Level 4",
                "id": 2024,
                "description": "Big chest provides superior limit of room for keeping all your wealth on the island"
            }, {
                "name": "Raft",
                "id": 2031,
                "description": "Most simple sttuff to cross on water. Allows you to travel to other island"
            }, {
                "name": "Spring Level 1",
                "id": 2041,
                "description": "Spring produces the water reserve and doesn't let you die of thirst."
            }, {
                "name": "Spring Level 2",
                "id": 2042,
                "description": "Advanced spring augments the water producing as compared to the simple spring "
            }, {
                "name": "Spring Level 3",
                "id": 2043,
                "description": "Well is more civilized water source next to your house. It increases water producing"
            }, {
                "name": "Spring Level 4",
                "id": 2044,
                "description": "Big well is a better water source, it produces maximal ammount during less time"
            }, {
                "name": "Fishing Net Level 1",
                "id": 2051,
                "description": "Simple net provides you with the permanent fish supply, it won't let you to die from hunger"
            }, {
                "name": "Fishing Net Level 2",
                "id": 2052,
                "description": "Fisher's net enhance a chance for good catch"
            }, {
                "name": "Fishing Net Level 3",
                "id": 2053,
                "description": "Seine - having such device you'll never be hungry. You can also do a trade"
            }, {
                "name": "Drier Level 1",
                "id": 2061,
                "description": "Small draning-rack provides an opportunity to cook fish instead of eating raw fish. You don't need any firewood"
            }, {
                "name": "Drier Level 2",
                "id": 2062,
                "description": "Middle sized draning-rack allows to cook more food. You can cook fish and mushrooms"
            }, {
                "name": "Drier Level 3",
                "id": 2063,
                "description": "Big dranking-rack provides you with unlimited food supply. It has got a peak production"
            }, {
                "name": "Woodworking Machine Level 1",
                "id": 2071,
                "description": "Small woodworking machine provides an opportunity to work the wood and to make planks that you need in your household"
            }, {
                "name": "Woodworking Machine Level 2",
                "id": 2072,
                "description": "Big woodworking machine increases the quantity of integrated products. It's an excellent tool for working the wood"
            }, {
                "name": "Stoneworking Machine Level 1",
                "id": 2081,
                "description": "Small stoneworking machine makes blocks from stones needed for building and other requirements"
            }, {
                "name": "Stoneworking Machine Level 2",
                "id": 2082,
                "description": "Big stoneworking machine provides an opportunity to speed up the stone blocks manufacturing"
            }, {
                "name": "Pottery Wheel Level 1",
                "id": 2091,
                "description": "Small potter's lathe - for making clay blocks and other things"
            }, {
                "name": "Pottery Wheel Level 2",
                "id": 2092,
                "description": "Big potter's lathe has an extended productivity, more product for the shorter period of time"
            }, {
                "name": "Tanning Tool Level 1",
                "id": 2093,
                "description": "Tannery allows to turn the flayed animals' skins into the leather"
            }, {
                "name": "Tanning Tool Level 2",
                "id": 2094,
                "description": "Big tannery for skins speeds up the time and the productivity of making leather"
            }, {
                "name": "Loom",
                "id": 2095,
                "description": "Weaving loom enables the island plants transformation into the valuable cloth"
            }, {
                "name": "Smelter Level 1",
                "id": 2096,
                "description": "Small smeltery is the initial tool for ore processing into the resources"
            }, {
                "name": "Smelter Level 2",
                "id": 2097,
                "description": "Middle sized smeltery - for copper minning. It's a good tool for ore processing."
            }, {
                "name": "Smelter Level 3",
                "id": 2098,
                "description": "Big smeltery is already a small factory for all ores processing. It has got a peak production"
            }, {
                "name": "Metal Workbench Level 1",
                "id": 2083,
                "description": "Metal working #1 - initial tool for the metal bullions treatment"
            }, {
                "name": "Metal Workbench Level 2",
                "id": 2084,
                "description": "Metal working #2 - provides an opportunity to process copper. The performance data is improved"
            }, {
                "name": "Gunpowder Machine Level 1",
                "id": 2085,
                "description": "Gun powder craft #1 let you craft the gun powder for the initial level weapons"
            }, {
                "name": "Gunpowder Machine Level 2",
                "id": 2086,
                "description": "Gun powder craft #2 provides an opportunity to craft the refined gun powder for the better fire arms"
            }, {
                "name": "Ammo Machine",
                "id": 2087,
                "description": "Cartridge craft tool permits to join the cartridge elements into the lethal reserve"
            }, {
                "name": "Nitrum Cleaner",
                "id": 2088,
                "description": "Saltpeter purification device allows to prepare saltpeter for the gun powder craft"
            }
        ]
    };

    $(document).on('click', '#getDescriptions', function () {
        $.ajax({
            url: '/api/descriptions/English',
            method: 'GET',
            dataType: 'json',
        });
    });

    $(document).on('click', '#createDescriptions', function () {
        $.ajax({
            url: '/api/descriptions',
            method: 'POST',
            dataType: 'json',
            data : descriptions,
        });
    });

    var a = {
        "allItemsData": [{
            "Type": "FoodItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Fried Crab\",\"Id\":1,\"MaxInStack\":10,\"InventorySlotType\":8,\"hpRestore\":10,\"hungerRestore\":3,\"thirstRestore\":1}"
        }, {
            "Type": "FoodItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Dried Fish\",\"Id\":2,\"MaxInStack\":10,\"InventorySlotType\":8,\"hpRestore\":15,\"hungerRestore\":8,\"thirstRestore\":2}"
        }, {
            "Type": "FoodItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Fried Fish\",\"Id\":3,\"MaxInStack\":10,\"InventorySlotType\":8,\"hpRestore\":12,\"hungerRestore\":10,\"thirstRestore\":0}"
        }, {
            "Type": "FoodItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Fried Meat\",\"Id\":4,\"MaxInStack\":10,\"InventorySlotType\":8,\"hpRestore\":10,\"hungerRestore\":10,\"thirstRestore\":0}"
        }, {
            "Type": "FoodItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Fried Mushrooms\",\"Id\":5,\"MaxInStack\":10,\"InventorySlotType\":8,\"hpRestore\":5,\"hungerRestore\":10,\"thirstRestore\":0}"
        }, {
            "Type": "FoodItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Dried Mushrooms\",\"Id\":6,\"MaxInStack\":10,\"InventorySlotType\":8,\"hpRestore\":10,\"hungerRestore\":10,\"thirstRestore\":0}"
        }, {
            "Type": "FoodItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Mushroom Soup\",\"Id\":116,\"MaxInStack\":10,\"InventorySlotType\":8,\"hpRestore\":40,\"hungerRestore\":35,\"thirstRestore\":20}"
        }, {
            "Type": "FoodItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Fried Potatoes\",\"Id\":117,\"MaxInStack\":10,\"InventorySlotType\":8,\"hpRestore\":15,\"hungerRestore\":20,\"thirstRestore\":5}"
        }, {
            "Type": "FoodItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Meat Soup\",\"Id\":118,\"MaxInStack\":10,\"InventorySlotType\":8,\"hpRestore\":35,\"hungerRestore\":25,\"thirstRestore\":25}"
        }, {
            "Type": "FoodItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Roast\",\"Id\":119,\"MaxInStack\":10,\"InventorySlotType\":8,\"hpRestore\":60,\"hungerRestore\":30,\"thirstRestore\":10}"
        }, {
            "Type": "FoodItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Dried Meat\",\"Id\":120,\"MaxInStack\":10,\"InventorySlotType\":8,\"hpRestore\":14,\"hungerRestore\":20,\"thirstRestore\":5}"
        }, {
            "Type": "FoodItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Water\",\"Id\":7,\"MaxInStack\":10,\"InventorySlotType\":8,\"hpRestore\":0,\"hungerRestore\":0,\"thirstRestore\":10}"
        }, {
            "Type": "FoodItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Crabs Meat\",\"Id\":8,\"MaxInStack\":10,\"InventorySlotType\":8,\"hpRestore\":10,\"hungerRestore\":10,\"thirstRestore\":3}"
        }, {
            "Type": "FoodItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Fish Meat\",\"Id\":9,\"MaxInStack\":10,\"InventorySlotType\":8,\"hpRestore\":10,\"hungerRestore\":5,\"thirstRestore\":2}"
        }, {
            "Type": "FoodItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Meat\",\"Id\":10,\"MaxInStack\":10,\"InventorySlotType\":8,\"hpRestore\":15,\"hungerRestore\":5,\"thirstRestore\":3}"
        }, {
            "Type": "FoodItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Mushrooms\",\"Id\":11,\"MaxInStack\":10,\"InventorySlotType\":8,\"hpRestore\":5,\"hungerRestore\":5,\"thirstRestore\":0}"
        }, {
            "Type": "FoodItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Coconut\",\"Id\":12,\"MaxInStack\":10,\"InventorySlotType\":8,\"hpRestore\":5,\"hungerRestore\":2,\"thirstRestore\":5}"
        }, {
            "Type": "FoodItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Banana\",\"Id\":13,\"MaxInStack\":10,\"InventorySlotType\":8,\"hpRestore\":5,\"hungerRestore\":5,\"thirstRestore\":0}"
        }, {
            "Type": "FoodItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Sugar Cane\",\"Id\":14,\"MaxInStack\":10,\"InventorySlotType\":8,\"hpRestore\":8,\"hungerRestore\":5,\"thirstRestore\":4}"
        }, {
            "Type": "FoodItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Potatoes\",\"Id\":115,\"MaxInStack\":10,\"InventorySlotType\":8,\"hpRestore\":5,\"hungerRestore\":7,\"thirstRestore\":1}"
        }, {
            "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Wood\",\"Id\":15,\"MaxInStack\":10,\"InventorySlotType\":1}"
        }, {
            "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Oak Wood\",\"Id\":111,\"MaxInStack\":10,\"InventorySlotType\":1}"
        }, {
            "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Oak Boards\",\"Id\":112,\"MaxInStack\":10,\"InventorySlotType\":1}"
        }, {
            "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Stained Stone\",\"Id\":113,\"MaxInStack\":10,\"InventorySlotType\":1}"
        }, {
            "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Coated Skin\",\"Id\":114,\"MaxInStack\":10,\"InventorySlotType\":1}"
        }, {
            "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Stone\",\"Id\":16,\"MaxInStack\":10,\"InventorySlotType\":1}"
        }, {
            "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Iron Ore\",\"Id\":17,\"MaxInStack\":10,\"InventorySlotType\":1}"
        }, {
            "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Sulfur Ore\",\"Id\":18,\"MaxInStack\":10,\"InventorySlotType\":1}"
        }, {
            "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Cuprum Ore\",\"Id\":19,\"MaxInStack\":10,\"InventorySlotType\":1}"
        }, {
            "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Nitrum Ore\",\"Id\":20,\"MaxInStack\":10,\"InventorySlotType\":1}"
        }, {
            "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Salt\",\"Id\":21,\"MaxInStack\":10,\"InventorySlotType\":1}"
        }, {
            "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Coal\",\"Id\":22,\"MaxInStack\":10,\"InventorySlotType\":1}"
        }, {
            "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Clay\",\"Id\":23,\"MaxInStack\":10,\"InventorySlotType\":1}"
        }, {
            "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Palm Leaves\",\"Id\":24,\"MaxInStack\":10,\"InventorySlotType\":1}"
        }, {
            "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Stem\",\"Id\":25,\"MaxInStack\":10,\"InventorySlotType\":1}"
        }, {
            "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Incisor\",\"Id\":26,\"MaxInStack\":10,\"InventorySlotType\":1}"
        }, {
            "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Bone\",\"Id\":27,\"MaxInStack\":10,\"InventorySlotType\":1}"
        }, {
            "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Skin\",\"Id\":28,\"MaxInStack\":10,\"InventorySlotType\":1}"
        }, {
            "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Resin\",\"Id\":29,\"MaxInStack\":10,\"InventorySlotType\":1}"
        }, {
            "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Rope\",\"Id\":90,\"MaxInStack\":10,\"InventorySlotType\":1}"
        }, {
            "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Strong Rope\",\"Id\":91,\"MaxInStack\":10,\"InventorySlotType\":1}"
        }, {
            "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Boards\",\"Id\":92,\"MaxInStack\":10,\"InventorySlotType\":1}"
        }, {
            "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Net\",\"Id\":93,\"MaxInStack\":10,\"InventorySlotType\":1}"
        }, {
            "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Stone Block\",\"Id\":94,\"MaxInStack\":10,\"InventorySlotType\":1}"
        }, {
            "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Clay Block\",\"Id\":95,\"MaxInStack\":10,\"InventorySlotType\":1}"
        }, {
            "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Cured Leather\",\"Id\":96,\"MaxInStack\":10,\"InventorySlotType\":1}"
        }, {
            "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Cloth\",\"Id\":97,\"MaxInStack\":10,\"InventorySlotType\":1}"
        }, {
            "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Iron Bar\",\"Id\":98,\"MaxInStack\":10,\"InventorySlotType\":1}"
        }, {
            "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Sulfur\",\"Id\":99,\"MaxInStack\":10,\"InventorySlotType\":1}"
        }, {
            "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Bullet\",\"Id\":100,\"MaxInStack\":10,\"InventorySlotType\":1}"
        }, {
            "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Iron Plate\",\"Id\":101,\"MaxInStack\":10,\"InventorySlotType\":1}"
        }, {
            "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Gunpowder Level 1\",\"Id\":102,\"MaxInStack\":10,\"InventorySlotType\":1}"
        }, {
            "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Clay Forms For Weapons\",\"Id\":103,\"MaxInStack\":10,\"InventorySlotType\":1}"
        }, {
            "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Cuprum Bar\",\"Id\":104,\"MaxInStack\":10,\"InventorySlotType\":1}"
        }, {
            "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Cuprum Plate\",\"Id\":105,\"MaxInStack\":10,\"InventorySlotType\":1}"
        }, {
            "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Spare Parts\",\"Id\":106,\"MaxInStack\":10,\"InventorySlotType\":1}"
        }, {
            "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Peeled Saltpeter\",\"Id\":107,\"MaxInStack\":10,\"InventorySlotType\":1}"
        }, {
            "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Cuprum Muff\",\"Id\":108,\"MaxInStack\":10,\"InventorySlotType\":1}"
        }, {
            "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Clay Tiling\",\"Id\":109,\"MaxInStack\":10,\"InventorySlotType\":1}"
        }, {
            "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Gunpowder Level 2\",\"Id\":110,\"MaxInStack\":10,\"InventorySlotType\":1}"
        }, {
            "Type": "WeaponItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Stone Axe\",\"Id\":30,\"MaxInStack\":1,\"InventorySlotType\":2,\"maxDurability\":100.0,\"durabilityDecrement\":2.0,\"instrumentType\":2,\"requireAmmoType\":0,\"attackAnimation\":5,\"attackDistance\":1.0,\"damage\":7,\"attackSpeed\":1.0,\"armor\":0}"
        }, {
            "Type": "WeaponItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Stone Hoe\",\"Id\":31,\"MaxInStack\":1,\"InventorySlotType\":2,\"maxDurability\":100.0,\"durabilityDecrement\":2.0,\"instrumentType\":32,\"requireAmmoType\":0,\"attackAnimation\":5,\"attackDistance\":1.0,\"damage\":8,\"attackSpeed\":0.800000011920929,\"armor\":0}"
        }, {
            "Type": "WeaponItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Stone Pickaxe\",\"Id\":32,\"MaxInStack\":1,\"InventorySlotType\":2,\"maxDurability\":100.0,\"durabilityDecrement\":2.0,\"instrumentType\":8,\"requireAmmoType\":0,\"attackAnimation\":5,\"attackDistance\":1.0,\"damage\":9,\"attackSpeed\":0.699999988079071,\"armor\":0}"
        }, {
            "Type": "WeaponItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Iron Axe\",\"Id\":33,\"MaxInStack\":1,\"InventorySlotType\":2,\"maxDurability\":100.0,\"durabilityDecrement\":1.0,\"instrumentType\":68,\"requireAmmoType\":0,\"attackAnimation\":5,\"attackDistance\":1.0,\"damage\":10,\"attackSpeed\":1.0,\"armor\":0}"
        }, {
            "Type": "WeaponItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Iron Hoe\",\"Id\":34,\"MaxInStack\":1,\"InventorySlotType\":2,\"maxDurability\":100.0,\"durabilityDecrement\":1.0,\"instrumentType\":64,\"requireAmmoType\":0,\"attackAnimation\":5,\"attackDistance\":1.0,\"damage\":12,\"attackSpeed\":0.800000011920929,\"armor\":0}"
        }, {
            "Type": "WeaponItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Iron Pickaxe\",\"Id\":35,\"MaxInStack\":1,\"InventorySlotType\":2,\"maxDurability\":100.0,\"durabilityDecrement\":1.0,\"instrumentType\":16,\"requireAmmoType\":0,\"attackAnimation\":5,\"attackDistance\":1.0,\"damage\":14,\"attackSpeed\":0.699999988079071,\"armor\":0}"
        }, {
            "Type": "WeaponItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Stone Knife\",\"Id\":36,\"MaxInStack\":1,\"InventorySlotType\":2,\"maxDurability\":100.0,\"durabilityDecrement\":2.0,\"instrumentType\":0,\"requireAmmoType\":0,\"attackAnimation\":5,\"attackDistance\":1.0,\"damage\":5,\"attackSpeed\":2.5,\"armor\":0}"
        }, {
            "Type": "WeaponItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Stone Spear\",\"Id\":37,\"MaxInStack\":1,\"InventorySlotType\":2,\"maxDurability\":50.0,\"durabilityDecrement\":1.0,\"instrumentType\":0,\"requireAmmoType\":0,\"attackAnimation\":4,\"attackDistance\":2.0,\"damage\":20,\"attackSpeed\":0.800000011920929,\"armor\":0}"
        }, {
            "Type": "WeaponItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Club\",\"Id\":38,\"MaxInStack\":1,\"InventorySlotType\":2,\"maxDurability\":100.0,\"durabilityDecrement\":2.0,\"instrumentType\":0,\"requireAmmoType\":0,\"attackAnimation\":5,\"attackDistance\":1.0,\"damage\":8,\"attackSpeed\":1.2000000476837159,\"armor\":0}"
        }, {
            "Type": "WeaponItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Bow\",\"Id\":39,\"MaxInStack\":1,\"InventorySlotType\":2,\"maxDurability\":100.0,\"durabilityDecrement\":1.0,\"instrumentType\":0,\"requireAmmoType\":1,\"attackAnimation\":1,\"attackDistance\":8.0,\"damage\":25,\"attackSpeed\":0.6000000238418579,\"armor\":0}"
        }, {
            "Type": "WeaponItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Stone Sword\",\"Id\":40,\"MaxInStack\":1,\"InventorySlotType\":2,\"maxDurability\":100.0,\"durabilityDecrement\":1.0,\"instrumentType\":0,\"requireAmmoType\":0,\"attackAnimation\":5,\"attackDistance\":1.0,\"damage\":25,\"attackSpeed\":1.100000023841858,\"armor\":0}"
        }, {
            "Type": "WeaponItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Stone Sword And Shield\",\"Id\":41,\"MaxInStack\":1,\"InventorySlotType\":2,\"maxDurability\":200.0,\"durabilityDecrement\":1.0,\"instrumentType\":0,\"requireAmmoType\":0,\"attackAnimation\":5,\"attackDistance\":1.0,\"damage\":25,\"attackSpeed\":0.800000011920929,\"armor\":18}"
        }, {
            "Type": "AmmoItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Wooden Arrow\",\"Id\":42,\"MaxInStack\":25,\"InventorySlotType\":4,\"damage\":5,\"ammoType\":1}"
        }, {
            "Type": "AmmoItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Bone Arrow\",\"Id\":43,\"MaxInStack\":30,\"InventorySlotType\":4,\"damage\":10,\"ammoType\":1}"
        }, {
            "Type": "AmmoItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Iron Arrow\",\"Id\":44,\"MaxInStack\":35,\"InventorySlotType\":4,\"damage\":15,\"ammoType\":1}"
        }, {
            "Type": "AmmoItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Wooden Arrow\",\"Id\":42,\"MaxInStack\":30,\"InventorySlotType\":4,\"damage\":0,\"ammoType\":1}"
        }, {
            "Type": "WeaponItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Iron Spear\",\"Id\":45,\"MaxInStack\":1,\"InventorySlotType\":2,\"maxDurability\":100.0,\"durabilityDecrement\":1.0,\"instrumentType\":0,\"requireAmmoType\":0,\"attackAnimation\":4,\"attackDistance\":2.0,\"damage\":30,\"attackSpeed\":0.800000011920929,\"armor\":0}"
        }, {
            "Type": "WeaponItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Iron Sword\",\"Id\":46,\"MaxInStack\":1,\"InventorySlotType\":2,\"maxDurability\":150.0,\"durabilityDecrement\":1.0,\"instrumentType\":0,\"requireAmmoType\":0,\"attackAnimation\":5,\"attackDistance\":1.0,\"damage\":35,\"attackSpeed\":1.2000000476837159,\"armor\":0}"
        }, {
            "Type": "WeaponItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Iron Sword And Shield\",\"Id\":47,\"MaxInStack\":1,\"InventorySlotType\":2,\"maxDurability\":250.0,\"durabilityDecrement\":1.0,\"instrumentType\":0,\"requireAmmoType\":0,\"attackAnimation\":5,\"attackDistance\":1.0,\"damage\":35,\"attackSpeed\":0.8999999761581421,\"armor\":0}"
        }, {
            "Type": "WeaponItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Iron Knife\",\"Id\":48,\"MaxInStack\":1,\"InventorySlotType\":2,\"maxDurability\":100.0,\"durabilityDecrement\":1.0,\"instrumentType\":0,\"requireAmmoType\":0,\"attackAnimation\":5,\"attackDistance\":1.0,\"damage\":10,\"attackSpeed\":3.0,\"armor\":0}"
        }, {
            "Type": "WeaponItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Pistol\",\"Id\":49,\"MaxInStack\":1,\"InventorySlotType\":2,\"maxDurability\":100.0,\"durabilityDecrement\":1.0,\"instrumentType\":0,\"requireAmmoType\":2,\"attackAnimation\":2,\"attackDistance\":8.0,\"damage\":25,\"attackSpeed\":1.2000000476837159,\"armor\":0}"
        }, {
            "Type": "WeaponItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Rapier\",\"Id\":50,\"MaxInStack\":1,\"InventorySlotType\":2,\"maxDurability\":100.0,\"durabilityDecrement\":1.0,\"instrumentType\":0,\"requireAmmoType\":0,\"attackAnimation\":5,\"attackDistance\":1.0,\"damage\":35,\"attackSpeed\":1.2999999523162842,\"armor\":0}"
        }, {
            "Type": "WeaponItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Musket\",\"Id\":51,\"MaxInStack\":1,\"InventorySlotType\":2,\"maxDurability\":100.0,\"durabilityDecrement\":1.0,\"instrumentType\":0,\"requireAmmoType\":2,\"attackAnimation\":3,\"attackDistance\":10.0,\"damage\":40,\"attackSpeed\":0.5,\"armor\":0}"
        }, {
            "Type": "WeaponItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Revolver\",\"Id\":52,\"MaxInStack\":1,\"InventorySlotType\":2,\"maxDurability\":150.0,\"durabilityDecrement\":1.0,\"instrumentType\":0,\"requireAmmoType\":4,\"attackAnimation\":2,\"attackDistance\":8.0,\"damage\":30,\"attackSpeed\":1.5,\"armor\":0}"
        }, {
            "Type": "WeaponItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Winchester\",\"Id\":53,\"MaxInStack\":1,\"InventorySlotType\":2,\"maxDurability\":150.0,\"durabilityDecrement\":1.0,\"instrumentType\":0,\"requireAmmoType\":4,\"attackAnimation\":3,\"attackDistance\":10.0,\"damage\":50,\"attackSpeed\":1.100000023841858,\"armor\":0}"
        }, {
            "Type": "AmmoItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Revolver and Winchester Ammo\",\"Id\":54,\"MaxInStack\":50,\"InventorySlotType\":4,\"damage\":15,\"ammoType\":4}"
        }, {
            "Type": "AmmoItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Pistol and Musket Ammo\",\"Id\":55,\"MaxInStack\":1,\"InventorySlotType\":4,\"damage\":10,\"ammoType\":2}"
        }, {
            "Type": "AmmoItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Pistol and Musket Ammo\",\"Id\":55,\"MaxInStack\":50,\"InventorySlotType\":4,\"damage\":0,\"ammoType\":2}"
        }, {
            "Type": "BagItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Palm Bag\",\"Id\":56,\"MaxInStack\":1,\"InventorySlotType\":256,\"additionalSlots\":5}"
        }, {
            "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Palm Headband\",\"Id\":57,\"MaxInStack\":1,\"InventorySlotType\":16,\"maxDurability\":50.0,\"durabilityDecrement\":1.0,\"armor\":3,\"movementSpeed\":0.0,\"foodDecrement\":1,\"waterDecrement\":1}"
        }, {
            "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Palm Chest\",\"Id\":58,\"MaxInStack\":1,\"InventorySlotType\":32,\"maxDurability\":50.0,\"durabilityDecrement\":1.0,\"armor\":2,\"movementSpeed\":0.0,\"foodDecrement\":1,\"waterDecrement\":1}"
        }, {
            "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Palm Pants\",\"Id\":59,\"MaxInStack\":1,\"InventorySlotType\":64,\"maxDurability\":50.0,\"durabilityDecrement\":1.0,\"armor\":3,\"movementSpeed\":0.0,\"foodDecrement\":1,\"waterDecrement\":1}"
        }, {
            "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Palm Shoes\",\"Id\":60,\"MaxInStack\":1,\"InventorySlotType\":128,\"maxDurability\":50.0,\"durabilityDecrement\":1.0,\"armor\":2,\"movementSpeed\":1.0,\"foodDecrement\":1,\"waterDecrement\":1}"
        }, {
            "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Bone Bandage\",\"Id\":61,\"MaxInStack\":1,\"InventorySlotType\":16,\"maxDurability\":75.0,\"durabilityDecrement\":1.0,\"armor\":4,\"movementSpeed\":0.0,\"foodDecrement\":1,\"waterDecrement\":1}"
        }, {
            "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Bone Chest\",\"Id\":62,\"MaxInStack\":1,\"InventorySlotType\":64,\"maxDurability\":80.0,\"durabilityDecrement\":1.0,\"armor\":6,\"movementSpeed\":0.0,\"foodDecrement\":1,\"waterDecrement\":1}"
        }, {
            "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Bone Pants\",\"Id\":63,\"MaxInStack\":1,\"InventorySlotType\":64,\"maxDurability\":80.0,\"durabilityDecrement\":1.0,\"armor\":4,\"movementSpeed\":0.0,\"foodDecrement\":1,\"waterDecrement\":1}"
        }, {
            "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Bone Shoes\",\"Id\":64,\"MaxInStack\":1,\"InventorySlotType\":128,\"maxDurability\":75.0,\"durabilityDecrement\":1.0,\"armor\":3,\"movementSpeed\":1.5,\"foodDecrement\":1,\"waterDecrement\":1}"
        }, {
            "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Wooden Helmet\",\"Id\":65,\"MaxInStack\":1,\"InventorySlotType\":16,\"maxDurability\":100.0,\"durabilityDecrement\":1.0,\"armor\":7,\"movementSpeed\":-1.0,\"foodDecrement\":2,\"waterDecrement\":2}"
        }, {
            "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Wooden Chest\",\"Id\":66,\"MaxInStack\":1,\"InventorySlotType\":32,\"maxDurability\":100.0,\"durabilityDecrement\":1.0,\"armor\":8,\"movementSpeed\":-1.0,\"foodDecrement\":3,\"waterDecrement\":3}"
        }, {
            "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Wooden Pants\",\"Id\":67,\"MaxInStack\":1,\"InventorySlotType\":64,\"maxDurability\":100.0,\"durabilityDecrement\":1.0,\"armor\":8,\"movementSpeed\":-1.0,\"foodDecrement\":3,\"waterDecrement\":3}"
        }, {
            "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Wooden Shoes\",\"Id\":68,\"MaxInStack\":1,\"InventorySlotType\":128,\"maxDurability\":100.0,\"durabilityDecrement\":1.0,\"armor\":7,\"movementSpeed\":-1.0,\"foodDecrement\":2,\"waterDecrement\":2}"
        }, {
            "Type": "BagItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Cloth Bag\",\"Id\":69,\"MaxInStack\":1,\"InventorySlotType\":256,\"additionalSlots\":10}"
        }, {
            "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Cloth Headband\",\"Id\":70,\"MaxInStack\":1,\"InventorySlotType\":16,\"maxDurability\":85.0,\"durabilityDecrement\":1.0,\"armor\":3,\"movementSpeed\":0.0,\"foodDecrement\":1,\"waterDecrement\":1}"
        }, {
            "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Cloth Chest\",\"Id\":71,\"MaxInStack\":1,\"InventorySlotType\":32,\"maxDurability\":85.0,\"durabilityDecrement\":1.0,\"armor\":4,\"movementSpeed\":0.0,\"foodDecrement\":1,\"waterDecrement\":1}"
        }, {
            "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Cloth Pants\",\"Id\":72,\"MaxInStack\":1,\"InventorySlotType\":64,\"maxDurability\":85.0,\"durabilityDecrement\":1.0,\"armor\":4,\"movementSpeed\":0.0,\"foodDecrement\":1,\"waterDecrement\":1}"
        }, {
            "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Cloth Shoes\",\"Id\":73,\"MaxInStack\":1,\"InventorySlotType\":128,\"maxDurability\":85.0,\"durabilityDecrement\":1.0,\"armor\":3,\"movementSpeed\":2.0,\"foodDecrement\":1,\"waterDecrement\":1}"
        }, {
            "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Heavy Bone Helmet\",\"Id\":74,\"MaxInStack\":1,\"InventorySlotType\":16,\"maxDurability\":130.0,\"durabilityDecrement\":1.0,\"armor\":13,\"movementSpeed\":-2.0,\"foodDecrement\":3,\"waterDecrement\":3}"
        }, {
            "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Heavy Bone Chest\",\"Id\":75,\"MaxInStack\":1,\"InventorySlotType\":32,\"maxDurability\":140.0,\"durabilityDecrement\":1.0,\"armor\":14,\"movementSpeed\":-2.0,\"foodDecrement\":4,\"waterDecrement\":4}"
        }, {
            "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Heavy Bone Pants\",\"Id\":76,\"MaxInStack\":1,\"InventorySlotType\":64,\"maxDurability\":140.0,\"durabilityDecrement\":1.0,\"armor\":14,\"movementSpeed\":-2.0,\"foodDecrement\":4,\"waterDecrement\":4}"
        }, {
            "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Heavy Bone Shoes\",\"Id\":77,\"MaxInStack\":1,\"InventorySlotType\":128,\"maxDurability\":130.0,\"durabilityDecrement\":1.0,\"armor\":13,\"movementSpeed\":-2.0,\"foodDecrement\":3,\"waterDecrement\":3}"
        }, {
            "Type": "BagItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Skin Bag\",\"Id\":78,\"MaxInStack\":1,\"InventorySlotType\":256,\"additionalSlots\":15}"
        }, {
            "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Pirate Hat\",\"Id\":79,\"MaxInStack\":1,\"InventorySlotType\":16,\"maxDurability\":95.0,\"durabilityDecrement\":1.0,\"armor\":7,\"movementSpeed\":0.0,\"foodDecrement\":1,\"waterDecrement\":1}"
        }, {
            "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Pirate Chest\",\"Id\":80,\"MaxInStack\":1,\"InventorySlotType\":32,\"maxDurability\":95.0,\"durabilityDecrement\":1.0,\"armor\":8,\"movementSpeed\":0.0,\"foodDecrement\":1,\"waterDecrement\":1}"
        }, {
            "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Pirate Pants\",\"Id\":81,\"MaxInStack\":1,\"InventorySlotType\":64,\"maxDurability\":95.0,\"durabilityDecrement\":1.0,\"armor\":8,\"movementSpeed\":0.0,\"foodDecrement\":1,\"waterDecrement\":1}"
        }, {
            "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Pirate Shoes\",\"Id\":82,\"MaxInStack\":1,\"InventorySlotType\":128,\"maxDurability\":95.0,\"durabilityDecrement\":1.0,\"armor\":7,\"movementSpeed\":2.0,\"foodDecrement\":1,\"waterDecrement\":1}"
        }, {
            "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Skin Chest\",\"Id\":83,\"MaxInStack\":1,\"InventorySlotType\":32,\"maxDurability\":80.0,\"durabilityDecrement\":1.0,\"armor\":8,\"movementSpeed\":0.0,\"foodDecrement\":1,\"waterDecrement\":1}"
        }, {
            "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Skin Pants\",\"Id\":84,\"MaxInStack\":1,\"InventorySlotType\":64,\"maxDurability\":80.0,\"durabilityDecrement\":1.0,\"armor\":8,\"movementSpeed\":0.0,\"foodDecrement\":1,\"waterDecrement\":1}"
        }, {
            "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Skin Shoes\",\"Id\":85,\"MaxInStack\":1,\"InventorySlotType\":128,\"maxDurability\":80.0,\"durabilityDecrement\":1.0,\"armor\":8,\"movementSpeed\":2.0,\"foodDecrement\":1,\"waterDecrement\":1}"
        }, {
            "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Metal Helmet\",\"Id\":86,\"MaxInStack\":1,\"InventorySlotType\":16,\"maxDurability\":150.0,\"durabilityDecrement\":1.0,\"armor\":15,\"movementSpeed\":-2.0,\"foodDecrement\":3,\"waterDecrement\":3}"
        }, {
            "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Metal Chest\",\"Id\":87,\"MaxInStack\":1,\"InventorySlotType\":32,\"maxDurability\":160.0,\"durabilityDecrement\":1.0,\"armor\":16,\"movementSpeed\":-2.0,\"foodDecrement\":3,\"waterDecrement\":3}"
        }, {
            "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Metal Pants\",\"Id\":88,\"MaxInStack\":1,\"InventorySlotType\":64,\"maxDurability\":160.0,\"durabilityDecrement\":1.0,\"armor\":16,\"movementSpeed\":-2.0,\"foodDecrement\":3,\"waterDecrement\":3}"
        }, {
            "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Json": "{\"Name\":\"Metal Shoes\",\"Id\":89,\"MaxInStack\":1,\"InventorySlotType\":128,\"maxDurability\":150.0,\"durabilityDecrement\":1.0,\"armor\":15,\"movementSpeed\":0.0,\"foodDecrement\":2,\"waterDecrement\":2}"
        }]
    };

    var itemsInCraft = {
        "googleID": 0,
        "itemsInCraft": [{
            "countToCraft": 5,
            "timeToCraft": 10,
            "itemID": 1,
            "type": 2,
            "coinCost": 0
        }, {"countToCraft": 3, "timeToCraft": 15, "itemID": 2, "type": 2, "coinCost": 0}, {
            "countToCraft": 3,
            "timeToCraft": 15,
            "itemID": 3,
            "type": 2,
            "coinCost": 0
        }, {"countToCraft": 0, "timeToCraft": 0, "itemID": -1, "type": 0, "coinCost": 100}, {
            "countToCraft": 0,
            "timeToCraft": 0,
            "itemID": -1,
            "type": 0,
            "coinCost": 100
        }]
    };

    $(document).on('click', '#createItemsInCraft', function () {
        $.ajax({
            url: '/api/items-in-craft',
            method: 'POST',
            dataType: 'json',
            data: itemsInCraft,
        });
    });

    $(document).on('click', '#getItemsInCraft', function () {
        $.ajax({
            url: '/api/items-in-craft',
            method: 'GET',
            dataType: 'json',
            data: {"googleID": "asdasdasdasxcgtjhrrds"},
        });
    });

    var techlist = {
        "googleID": 1,
        "playerTechList": [{
            "id": 1,
            "technologyState": 0
        }, {
            "id": 2,
            "technologyState": 0
        }, {
            "id": 3,
            "technologyState": 0
        }, {
            "id": 4,
            "technologyState": 0
        }, {
            "id": 5,
            "technologyState": 0
        }, {
            "id": 6,
            "technologyState": 0
        }, {
            "id": 7,
            "technologyState": 0
        }, {
            "id": 8,
            "technologyState": 0
        }, {
            "id": 9,
            "technologyState": 0
        }, {
            "id": 10,
            "technologyState": 0
        }, {
            "id": 11,
            "technologyState": 0
        }, {
            "id": 12,
            "technologyState": 0
        }, {
            "id": 13,
            "technologyState": 0
        }, {
            "id": 14,
            "technologyState": 0
        }, {
            "id": 15,
            "technologyState": 0
        }, {
            "id": 16,
            "technologyState": 0
        }, {
            "id": 17,
            "technologyState": 0
        }, {
            "id": 18,
            "technologyState": 0
        }, {
            "id": 19,
            "technologyState": 0
        }, {
            "id": 20,
            "technologyState": 0
        }, {
            "id": 21,
            "technologyState": 0
        }, {
            "id": 22,
            "technologyState": 0
        }, {
            "id": 23,
            "technologyState": 0
        }, {
            "id": 24,
            "technologyState": 0
        }, {
            "id": 25,
            "technologyState": 0
        }, {
            "id": 26,
            "technologyState": 0
        }, {
            "id": 27,
            "technologyState": 0
        }, {
            "id": 28,
            "technologyState": 0
        }, {
            "id": 29,
            "technologyState": 0
        }, {
            "id": 30,
            "technologyState": 0
        }, {
            "id": 31,
            "technologyState": 0
        }, {
            "id": 32,
            "technologyState": 0
        }, {
            "id": 33,
            "technologyState": 0
        }, {
            "id": 34,
            "technologyState": 0
        }, {
            "id": 35,
            "technologyState": 0
        }, {
            "id": 36,
            "technologyState": 0
        }, {
            "id": 37,
            "technologyState": 0
        }, {
            "id": 38,
            "technologyState": 0
        }, {
            "id": 39,
            "technologyState": 0
        }, {
            "id": 40,
            "technologyState": 0
        }, {
            "id": 41,
            "technologyState": 0
        }, {
            "id": 42,
            "technologyState": 0
        }
        ],
        "inBuilding": false,
        "idCurrentBuildingTech": 0
    };

    $(document).on('click', '#createTechList', function () {
        $.ajax({
            url: '/api/tech-list',
            method: 'POST',
            dataType: 'json',
            data: techlist,
        });
    });

    $(document).on('click', '#getTechList', function () {
        $.ajax({
            url: '/api/tech-list',
            method: 'GET',
            dataType: 'json',
            data: {"googleID": "asdasdasdasxcgtjhrrds"},
        });
    });


    var recipes = {
        "AllRecepies": [{
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":5,\"ItemID\":1,\"Name\":\"Home Level 1\",\"CraftTime\":60.0,\"Level\":1,\"Components\":[{\"id\":15,\"neededCount\":10},{\"id\":90,\"neededCount\":5},{\"id\":24,\"neededCount\":8}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":5,\"ItemID\":2,\"Name\":\"Home Level 2\",\"CraftTime\":120.0,\"Level\":5,\"Components\":[{\"id\":15,\"neededCount\":10},{\"id\":91,\"neededCount\":6},{\"id\":24,\"neededCount\":12},{\"id\":16,\"neededCount\":8}],\"TechnologiesIDs\":[1],\"tmpComponentsSize\":4,\"componentsSize\":4,\"tmpBuildingsSize\":1,\"BuildingsSize\":1}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":5,\"ItemID\":3,\"Name\":\"Home Level 3\",\"CraftTime\":240.0,\"Level\":15,\"Components\":[{\"id\":91,\"neededCount\":12},{\"id\":24,\"neededCount\":18},{\"id\":92,\"neededCount\":8},{\"id\":16,\"neededCount\":6}],\"TechnologiesIDs\":[2],\"tmpComponentsSize\":4,\"componentsSize\":4,\"tmpBuildingsSize\":1,\"BuildingsSize\":1}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":5,\"ItemID\":4,\"Name\":\"Home Level 4\",\"CraftTime\":480.0,\"Level\":25,\"Components\":[{\"id\":7,\"neededCount\":20},{\"id\":96,\"neededCount\":5},{\"id\":23,\"neededCount\":6},{\"id\":94,\"neededCount\":10},{\"id\":92,\"neededCount\":10}],\"TechnologiesIDs\":[3],\"tmpComponentsSize\":5,\"componentsSize\":5,\"tmpBuildingsSize\":1,\"BuildingsSize\":1}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":5,\"ItemID\":5,\"Name\":\"Home Level 5\",\"CraftTime\":960.0,\"Level\":40,\"Components\":[{\"id\":109,\"neededCount\":8},{\"id\":98,\"neededCount\":4},{\"id\":94,\"neededCount\":6},{\"id\":92,\"neededCount\":14}],\"TechnologiesIDs\":[4],\"tmpComponentsSize\":4,\"componentsSize\":4,\"tmpBuildingsSize\":1,\"BuildingsSize\":1}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":5,\"ItemID\":6,\"Name\":\"Hearth Level 1\",\"CraftTime\":60.0,\"Level\":3,\"Components\":[{\"id\":15,\"neededCount\":4},{\"id\":16,\"neededCount\":6}],\"TechnologiesIDs\":[1],\"tmpComponentsSize\":2,\"componentsSize\":2,\"tmpBuildingsSize\":1,\"BuildingsSize\":1}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":5,\"ItemID\":7,\"Name\":\"Hearth Level 2\",\"CraftTime\":120.0,\"Level\":17,\"Components\":[{\"id\":95,\"neededCount\":4},{\"id\":92,\"neededCount\":6}],\"TechnologiesIDs\":[1,6],\"tmpComponentsSize\":2,\"componentsSize\":2,\"tmpBuildingsSize\":2,\"BuildingsSize\":2}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":5,\"ItemID\":8,\"Name\":\"Hearth Level 3\",\"CraftTime\":240.0,\"Level\":27,\"Components\":[{\"id\":95,\"neededCount\":10},{\"id\":98,\"neededCount\":2},{\"id\":94,\"neededCount\":6}],\"TechnologiesIDs\":[4,7],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":2,\"BuildingsSize\":2}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":5,\"ItemID\":9,\"Name\":\"Hearth Level 4\",\"CraftTime\":480.0,\"Level\":42,\"Components\":[{\"id\":95,\"neededCount\":16},{\"id\":101,\"neededCount\":2},{\"id\":94,\"neededCount\":10}],\"TechnologiesIDs\":[5,8],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":2,\"BuildingsSize\":2}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":5,\"ItemID\":10,\"Name\":\"Chest Level 1\",\"CraftTime\":60.0,\"Level\":2,\"Components\":[{\"id\":15,\"neededCount\":4},{\"id\":90,\"neededCount\":2},{\"id\":30,\"neededCount\":1}],\"TechnologiesIDs\":[1],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":1,\"BuildingsSize\":1}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":5,\"ItemID\":11,\"Name\":\"Chest Level 2\",\"CraftTime\":120.0,\"Level\":16,\"Components\":[{\"id\":92,\"neededCount\":6},{\"id\":29,\"neededCount\":4}],\"TechnologiesIDs\":[10,3],\"tmpComponentsSize\":2,\"componentsSize\":2,\"tmpBuildingsSize\":2,\"BuildingsSize\":2}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":5,\"ItemID\":12,\"Name\":\"Chest Level 3\",\"CraftTime\":240.0,\"Level\":26,\"Components\":[{\"id\":98,\"neededCount\":6},{\"id\":94,\"neededCount\":4},{\"id\":92,\"neededCount\":6}],\"TechnologiesIDs\":[11,4],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":2,\"BuildingsSize\":2}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":5,\"ItemID\":13,\"Name\":\"Chest Level 4\",\"CraftTime\":480.0,\"Level\":41,\"Components\":[{\"id\":101,\"neededCount\":4},{\"id\":105,\"neededCount\":2},{\"id\":106,\"neededCount\":4}],\"TechnologiesIDs\":[12,5],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":2,\"BuildingsSize\":2}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":5,\"ItemID\":14,\"Name\":\"Raft\",\"CraftTime\":60.0,\"Level\":1,\"Components\":[{\"id\":15,\"neededCount\":20},{\"id\":90,\"neededCount\":16}],\"TechnologiesIDs\":[1],\"tmpComponentsSize\":2,\"componentsSize\":2,\"tmpBuildingsSize\":1,\"BuildingsSize\":1}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":5,\"ItemID\":15,\"Name\":\"Spring Level 1\",\"CraftTime\":60.0,\"Level\":4,\"Components\":[{\"id\":16,\"neededCount\":4}],\"TechnologiesIDs\":[1],\"tmpComponentsSize\":1,\"componentsSize\":1,\"tmpBuildingsSize\":1,\"BuildingsSize\":1}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":5,\"ItemID\":16,\"Name\":\"Spring Level 2\",\"CraftTime\":120.0,\"Level\":18,\"Components\":[{\"id\":23,\"neededCount\":4},{\"id\":16,\"neededCount\":6}],\"TechnologiesIDs\":[15,3],\"tmpComponentsSize\":2,\"componentsSize\":2,\"tmpBuildingsSize\":2,\"BuildingsSize\":2}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":5,\"ItemID\":17,\"Name\":\"Spring Level 3\",\"CraftTime\":240.0,\"Level\":28,\"Components\":[{\"id\":23,\"neededCount\":4},{\"id\":16,\"neededCount\":4},{\"id\":95,\"neededCount\":6}],\"TechnologiesIDs\":[16,4],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":2,\"BuildingsSize\":2}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":5,\"ItemID\":18,\"Name\":\"Spring Level 4\",\"CraftTime\":480.0,\"Level\":43,\"Components\":[{\"id\":94,\"neededCount\":6},{\"id\":92,\"neededCount\":4},{\"id\":101,\"neededCount\":2},{\"id\":91,\"neededCount\":14}],\"TechnologiesIDs\":[17,5],\"tmpComponentsSize\":4,\"componentsSize\":4,\"tmpBuildingsSize\":2,\"BuildingsSize\":2}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":5,\"ItemID\":19,\"Name\":\"Fishing Net Level 1\",\"CraftTime\":60.0,\"Level\":8,\"Components\":[{\"id\":15,\"neededCount\":4},{\"id\":93,\"neededCount\":5}],\"TechnologiesIDs\":[2],\"tmpComponentsSize\":2,\"componentsSize\":2,\"tmpBuildingsSize\":1,\"BuildingsSize\":1}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":5,\"ItemID\":20,\"Name\":\"Fishing Net Level 2\",\"CraftTime\":120.0,\"Level\":29,\"Components\":[{\"id\":92,\"neededCount\":4},{\"id\":93,\"neededCount\":4}],\"TechnologiesIDs\":[19,4],\"tmpComponentsSize\":2,\"componentsSize\":2,\"tmpBuildingsSize\":2,\"BuildingsSize\":2}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":5,\"ItemID\":21,\"Name\":\"Fishing Net Level 3\",\"CraftTime\":240.0,\"Level\":44,\"Components\":[{\"id\":92,\"neededCount\":10},{\"id\":93,\"neededCount\":8},{\"id\":91,\"neededCount\":12},{\"id\":101,\"neededCount\":2}],\"TechnologiesIDs\":[20,5],\"tmpComponentsSize\":4,\"componentsSize\":4,\"tmpBuildingsSize\":2,\"BuildingsSize\":2}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":5,\"ItemID\":22,\"Name\":\"Drier Level 1\",\"CraftTime\":60.0,\"Level\":10,\"Components\":[{\"id\":15,\"neededCount\":6},{\"id\":90,\"neededCount\":4}],\"TechnologiesIDs\":[2],\"tmpComponentsSize\":2,\"componentsSize\":2,\"tmpBuildingsSize\":1,\"BuildingsSize\":1}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":5,\"ItemID\":23,\"Name\":\"Drier Level 2\",\"CraftTime\":120.0,\"Level\":19,\"Components\":[{\"id\":15,\"neededCount\":8},{\"id\":93,\"neededCount\":4}],\"TechnologiesIDs\":[22,3],\"tmpComponentsSize\":2,\"componentsSize\":2,\"tmpBuildingsSize\":2,\"BuildingsSize\":2}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":5,\"ItemID\":24,\"Name\":\"Drier Level 3\",\"CraftTime\":240.0,\"Level\":30,\"Components\":[{\"id\":92,\"neededCount\":6},{\"id\":93,\"neededCount\":4},{\"id\":91,\"neededCount\":2}],\"TechnologiesIDs\":[23,4],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":2,\"BuildingsSize\":2}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":5,\"ItemID\":25,\"Name\":\"Woodworking Machine Level 1\",\"CraftTime\":60.0,\"Level\":12,\"Components\":[{\"id\":15,\"neededCount\":4},{\"id\":30,\"neededCount\":1},{\"id\":36,\"neededCount\":1}],\"TechnologiesIDs\":[2],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":1,\"BuildingsSize\":1}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":5,\"ItemID\":26,\"Name\":\"Woodworking Machine Level 2\",\"CraftTime\":120.0,\"Level\":31,\"Components\":[{\"id\":92,\"neededCount\":4},{\"id\":33,\"neededCount\":1},{\"id\":48,\"neededCount\":1}],\"TechnologiesIDs\":[25,4],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":2,\"BuildingsSize\":2}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":5,\"ItemID\":27,\"Name\":\"Stoneworking Machine Level 1\",\"CraftTime\":60.0,\"Level\":20,\"Components\":[{\"id\":92,\"neededCount\":4},{\"id\":32,\"neededCount\":1},{\"id\":16,\"neededCount\":4}],\"TechnologiesIDs\":[3],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":1,\"BuildingsSize\":1}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":5,\"ItemID\":28,\"Name\":\"Stoneworking Machine Level 2\",\"CraftTime\":120.0,\"Level\":32,\"Components\":[{\"id\":94,\"neededCount\":4},{\"id\":92,\"neededCount\":6},{\"id\":35,\"neededCount\":1}],\"TechnologiesIDs\":[27,4],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":2,\"BuildingsSize\":2}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":5,\"ItemID\":29,\"Name\":\"Pottery Wheel Level 1\",\"CraftTime\":60.0,\"Level\":21,\"Components\":[{\"id\":94,\"neededCount\":6},{\"id\":7,\"neededCount\":10},{\"id\":92,\"neededCount\":6}],\"TechnologiesIDs\":[3],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":1,\"BuildingsSize\":1}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":5,\"ItemID\":30,\"Name\":\"Pottery Wheel Level 2\",\"CraftTime\":120.0,\"Level\":33,\"Components\":[{\"id\":94,\"neededCount\":10},{\"id\":7,\"neededCount\":20},{\"id\":92,\"neededCount\":10},{\"id\":101,\"neededCount\":6}],\"TechnologiesIDs\":[29,4],\"tmpComponentsSize\":4,\"componentsSize\":4,\"tmpBuildingsSize\":2,\"BuildingsSize\":2}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":5,\"ItemID\":31,\"Name\":\"Tanning Tool Level 1\",\"CraftTime\":60.0,\"Level\":22,\"Components\":[{\"id\":92,\"neededCount\":6},{\"id\":91,\"neededCount\":4}],\"TechnologiesIDs\":[3],\"tmpComponentsSize\":2,\"componentsSize\":2,\"tmpBuildingsSize\":1,\"BuildingsSize\":1}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":5,\"ItemID\":32,\"Name\":\"Tanning Tool Level 2\",\"CraftTime\":120.0,\"Level\":34,\"Components\":[{\"id\":92,\"neededCount\":10},{\"id\":91,\"neededCount\":6},{\"id\":95,\"neededCount\":10},{\"id\":7,\"neededCount\":10}],\"TechnologiesIDs\":[31,4],\"tmpComponentsSize\":4,\"componentsSize\":4,\"tmpBuildingsSize\":2,\"BuildingsSize\":2}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":5,\"ItemID\":33,\"Name\":\"Loom\",\"CraftTime\":60.0,\"Level\":24,\"Components\":[{\"id\":92,\"neededCount\":10},{\"id\":91,\"neededCount\":6},{\"id\":94,\"neededCount\":4},{\"id\":27,\"neededCount\":10}],\"TechnologiesIDs\":[3],\"tmpComponentsSize\":4,\"componentsSize\":4,\"tmpBuildingsSize\":1,\"BuildingsSize\":1}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":5,\"ItemID\":34,\"Name\":\"Smelter Level 1\",\"CraftTime\":60.0,\"Level\":23,\"Components\":[{\"id\":95,\"neededCount\":6},{\"id\":94,\"neededCount\":6},{\"id\":17,\"neededCount\":10}],\"TechnologiesIDs\":[3],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":1,\"BuildingsSize\":1}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":5,\"ItemID\":35,\"Name\":\"Smelter Level 2\",\"CraftTime\":120.0,\"Level\":35,\"Components\":[{\"id\":95,\"neededCount\":10},{\"id\":94,\"neededCount\":10},{\"id\":98,\"neededCount\":6}],\"TechnologiesIDs\":[34,4],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":2,\"BuildingsSize\":2}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":5,\"ItemID\":36,\"Name\":\"Smelter Level 3\",\"CraftTime\":240.0,\"Level\":45,\"Components\":[{\"id\":95,\"neededCount\":20},{\"id\":94,\"neededCount\":20},{\"id\":101,\"neededCount\":10}],\"TechnologiesIDs\":[35,5],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":2,\"BuildingsSize\":2}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":5,\"ItemID\":37,\"Name\":\"Metal Workbench Level 1\",\"CraftTime\":60.0,\"Level\":36,\"Components\":[{\"id\":15,\"neededCount\":4},{\"id\":92,\"neededCount\":6},{\"id\":98,\"neededCount\":6}],\"TechnologiesIDs\":[4],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":1,\"BuildingsSize\":1}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":5,\"ItemID\":38,\"Name\":\"Metal Workbench Level 2\",\"CraftTime\":120.0,\"Level\":46,\"Components\":[{\"id\":92,\"neededCount\":10},{\"id\":98,\"neededCount\":8},{\"id\":101,\"neededCount\":6},{\"id\":94,\"neededCount\":6}],\"TechnologiesIDs\":[37,5],\"tmpComponentsSize\":4,\"componentsSize\":4,\"tmpBuildingsSize\":2,\"BuildingsSize\":2}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":5,\"ItemID\":39,\"Name\":\"Gunpowder Machine Level 1\",\"CraftTime\":60.0,\"Level\":37,\"Components\":[{\"id\":23,\"neededCount\":4},{\"id\":7,\"neededCount\":4}],\"TechnologiesIDs\":[4],\"tmpComponentsSize\":2,\"componentsSize\":2,\"tmpBuildingsSize\":1,\"BuildingsSize\":1}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":5,\"ItemID\":40,\"Name\":\"Gunpowder Machine Level 2\",\"CraftTime\":120.0,\"Level\":48,\"Components\":[{\"id\":23,\"neededCount\":10},{\"id\":7,\"neededCount\":8},{\"id\":92,\"neededCount\":6}],\"TechnologiesIDs\":[39,5],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":2,\"BuildingsSize\":2}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":5,\"ItemID\":41,\"Name\":\"Ammo Machine\",\"CraftTime\":60.0,\"Level\":38,\"Components\":[{\"id\":92,\"neededCount\":10},{\"id\":98,\"neededCount\":6},{\"id\":101,\"neededCount\":6}],\"TechnologiesIDs\":[4],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":1,\"BuildingsSize\":1}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":5,\"ItemID\":42,\"Name\":\"Nitrum Cleaner\",\"CraftTime\":60.0,\"Level\":47,\"Components\":[{\"id\":94,\"neededCount\":10},{\"id\":92,\"neededCount\":10},{\"id\":98,\"neededCount\":6}],\"TechnologiesIDs\":[5],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":1,\"BuildingsSize\":1}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":0,\"ItemID\":30,\"Name\":\"Stone Axe\",\"CraftTime\":60.0,\"Level\":1,\"Components\":[{\"id\":15,\"neededCount\":6},{\"id\":16,\"neededCount\":4},{\"id\":90,\"neededCount\":4}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":0,\"ItemID\":32,\"Name\":\"Stone Pickaxe\",\"CraftTime\":60.0,\"Level\":2,\"Components\":[{\"id\":15,\"neededCount\":8},{\"id\":16,\"neededCount\":6},{\"id\":90,\"neededCount\":4}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":0,\"ItemID\":31,\"Name\":\"Stone Hoe\",\"CraftTime\":60.0,\"Level\":3,\"Components\":[{\"id\":15,\"neededCount\":8},{\"id\":16,\"neededCount\":4},{\"id\":90,\"neededCount\":4}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":0,\"ItemID\":33,\"Name\":\"Iron Axe\",\"CraftTime\":120.0,\"Level\":23,\"Components\":[{\"id\":98,\"neededCount\":2},{\"id\":92,\"neededCount\":4}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":2,\"componentsSize\":2,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":0,\"ItemID\":35,\"Name\":\"Iron Pickaxe\",\"CraftTime\":120.0,\"Level\":24,\"Components\":[{\"id\":98,\"neededCount\":4},{\"id\":92,\"neededCount\":4}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":2,\"componentsSize\":2,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":0,\"ItemID\":34,\"Name\":\"Iron Hoe\",\"CraftTime\":120.0,\"Level\":25,\"Components\":[{\"id\":98,\"neededCount\":4},{\"id\":92,\"neededCount\":4}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":2,\"componentsSize\":2,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":1,\"ItemID\":36,\"Name\":\"Stone Knife\",\"CraftTime\":60.0,\"Level\":1,\"Components\":[{\"id\":16,\"neededCount\":4},{\"id\":90,\"neededCount\":2}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":2,\"componentsSize\":2,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":1,\"ItemID\":37,\"Name\":\"Stone Spear\",\"CraftTime\":60.0,\"Level\":3,\"Components\":[{\"id\":15,\"neededCount\":4},{\"id\":16,\"neededCount\":6},{\"id\":90,\"neededCount\":2}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":1,\"ItemID\":38,\"Name\":\"Club\",\"CraftTime\":60.0,\"Level\":5,\"Components\":[{\"id\":28,\"neededCount\":2},{\"id\":90,\"neededCount\":2},{\"id\":15,\"neededCount\":8}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":1,\"ItemID\":39,\"Name\":\"Bow\",\"CraftTime\":100.0,\"Level\":7,\"Components\":[{\"id\":15,\"neededCount\":8},{\"id\":90,\"neededCount\":4},{\"id\":28,\"neededCount\":6}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":1,\"ItemID\":40,\"Name\":\"Stone Sword\",\"CraftTime\":80.0,\"Level\":9,\"Components\":[{\"id\":16,\"neededCount\":8},{\"id\":15,\"neededCount\":6},{\"id\":28,\"neededCount\":4},{\"id\":28,\"neededCount\":4}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":4,\"componentsSize\":4,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":1,\"ItemID\":41,\"Name\":\"Stone Sword And Shield\",\"CraftTime\":160.0,\"Level\":13,\"Components\":[{\"id\":40,\"neededCount\":1},{\"id\":90,\"neededCount\":6},{\"id\":15,\"neededCount\":16}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "StackableRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":1,\"ItemID\":42,\"Name\":\"Wooden Arrow\",\"CraftTime\":40.0,\"Level\":7,\"Components\":[{\"id\":24,\"neededCount\":4},{\"id\":15,\"neededCount\":6}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":2,\"componentsSize\":2,\"tmpBuildingsSize\":0,\"BuildingsSize\":0,\"InStack\":15}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":1,\"ItemID\":45,\"Name\":\"Iron Spear\",\"CraftTime\":160.0,\"Level\":24,\"Components\":[{\"id\":15,\"neededCount\":10},{\"id\":98,\"neededCount\":2},{\"id\":91,\"neededCount\":2}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":1,\"ItemID\":46,\"Name\":\"Iron Sword\",\"CraftTime\":160.0,\"Level\":28,\"Components\":[{\"id\":15,\"neededCount\":6},{\"id\":98,\"neededCount\":6},{\"id\":91,\"neededCount\":2}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":1,\"ItemID\":47,\"Name\":\"Iron Sword And Shield\",\"CraftTime\":300.0,\"Level\":30,\"Components\":[{\"id\":46,\"neededCount\":1},{\"id\":98,\"neededCount\":4},{\"id\":92,\"neededCount\":6},{\"id\":91,\"neededCount\":2}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":4,\"componentsSize\":4,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":1,\"ItemID\":48,\"Name\":\"Iron Knife\",\"CraftTime\":180.0,\"Level\":26,\"Components\":[{\"id\":15,\"neededCount\":6},{\"id\":98,\"neededCount\":2},{\"id\":91,\"neededCount\":2},{\"id\":96,\"neededCount\":2}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":4,\"componentsSize\":4,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":1,\"ItemID\":49,\"Name\":\"Pistol\",\"CraftTime\":320.0,\"Level\":38,\"Components\":[{\"id\":15,\"neededCount\":10},{\"id\":101,\"neededCount\":6},{\"id\":103,\"neededCount\":2}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":1,\"ItemID\":50,\"Name\":\"Rapier\",\"CraftTime\":360.0,\"Level\":32,\"Components\":[{\"id\":15,\"neededCount\":8},{\"id\":98,\"neededCount\":6},{\"id\":96,\"neededCount\":4},{\"id\":91,\"neededCount\":2}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":4,\"componentsSize\":4,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":1,\"ItemID\":51,\"Name\":\"Musket\",\"CraftTime\":400.0,\"Level\":46,\"Components\":[{\"id\":15,\"neededCount\":12},{\"id\":101,\"neededCount\":6},{\"id\":106,\"neededCount\":4},{\"id\":103,\"neededCount\":4},{\"id\":91,\"neededCount\":4}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":5,\"componentsSize\":5,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":1,\"ItemID\":52,\"Name\":\"Revolver\",\"CraftTime\":420.0,\"Level\":47,\"Components\":[{\"id\":15,\"neededCount\":8},{\"id\":101,\"neededCount\":4},{\"id\":105,\"neededCount\":4},{\"id\":106,\"neededCount\":4},{\"id\":103,\"neededCount\":4}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":5,\"componentsSize\":5,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":1,\"ItemID\":53,\"Name\":\"Winchester\",\"CraftTime\":480.0,\"Level\":50,\"Components\":[{\"id\":15,\"neededCount\":16},{\"id\":101,\"neededCount\":6},{\"id\":105,\"neededCount\":8},{\"id\":106,\"neededCount\":6},{\"id\":103,\"neededCount\":6}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":5,\"componentsSize\":5,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "StackableRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":1,\"ItemID\":54,\"Name\":\"Revolver and Winchester Ammo\",\"CraftTime\":160.0,\"Level\":47,\"Components\":[{\"id\":100,\"neededCount\":4},{\"id\":110,\"neededCount\":10},{\"id\":108,\"neededCount\":4}],\"TechnologiesIDs\":[41],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":1,\"BuildingsSize\":1,\"InStack\":25}"
        }, {
            "Type": "StackableRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":1,\"ItemID\":55,\"Name\":\"Pistol and Musket Ammo\",\"CraftTime\":120.0,\"Level\":38,\"Components\":[{\"id\":102,\"neededCount\":6},{\"id\":100,\"neededCount\":4}],\"TechnologiesIDs\":[41],\"tmpComponentsSize\":2,\"componentsSize\":2,\"tmpBuildingsSize\":1,\"BuildingsSize\":1,\"InStack\":25}"
        }, {
            "Type": "StackableRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":2,\"ItemID\":90,\"Name\":\"Rope\",\"CraftTime\":60.0,\"Level\":1,\"Components\":[{\"id\":25,\"neededCount\":2}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":1,\"componentsSize\":1,\"tmpBuildingsSize\":0,\"BuildingsSize\":0,\"InStack\":1}"
        }, {
            "Type": "StackableRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":2,\"ItemID\":91,\"Name\":\"Strong Rope\",\"CraftTime\":60.0,\"Level\":3,\"Components\":[{\"id\":25,\"neededCount\":2},{\"id\":29,\"neededCount\":4}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":2,\"componentsSize\":2,\"tmpBuildingsSize\":0,\"BuildingsSize\":0,\"InStack\":1}"
        }, {
            "Type": "StackableRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":2,\"ItemID\":92,\"Name\":\"Boards\",\"CraftTime\":60.0,\"Level\":12,\"Components\":[{\"id\":15,\"neededCount\":2}],\"TechnologiesIDs\":[25],\"tmpComponentsSize\":1,\"componentsSize\":1,\"tmpBuildingsSize\":1,\"BuildingsSize\":1,\"InStack\":1}"
        }, {
            "Type": "StackableRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":2,\"ItemID\":112,\"Name\":\"Oak Boards\",\"CraftTime\":80.0,\"Level\":31,\"Components\":[{\"id\":111,\"neededCount\":2}],\"TechnologiesIDs\":[26],\"tmpComponentsSize\":1,\"componentsSize\":1,\"tmpBuildingsSize\":1,\"BuildingsSize\":1,\"InStack\":1}"
        }, {
            "Type": "StackableRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":2,\"ItemID\":93,\"Name\":\"Net\",\"CraftTime\":160.0,\"Level\":7,\"Components\":[{\"id\":91,\"neededCount\":2}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":1,\"componentsSize\":1,\"tmpBuildingsSize\":0,\"BuildingsSize\":0,\"InStack\":1}"
        }, {
            "Type": "StackableRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":2,\"ItemID\":113,\"Name\":\"Stained Stone\",\"CraftTime\":160.0,\"Level\":20,\"Components\":[{\"id\":16,\"neededCount\":2}],\"TechnologiesIDs\":[27],\"tmpComponentsSize\":1,\"componentsSize\":1,\"tmpBuildingsSize\":1,\"BuildingsSize\":1,\"InStack\":1}"
        }, {
            "Type": "StackableRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":2,\"ItemID\":94,\"Name\":\"Stone Block\",\"CraftTime\":180.0,\"Level\":32,\"Components\":[{\"id\":113,\"neededCount\":2}],\"TechnologiesIDs\":[28],\"tmpComponentsSize\":1,\"componentsSize\":1,\"tmpBuildingsSize\":1,\"BuildingsSize\":1,\"InStack\":1}"
        }, {
            "Type": "StackableRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":2,\"ItemID\":95,\"Name\":\"Clay Block\",\"CraftTime\":80.0,\"Level\":21,\"Components\":[{\"id\":23,\"neededCount\":1}],\"TechnologiesIDs\":[29],\"tmpComponentsSize\":1,\"componentsSize\":1,\"tmpBuildingsSize\":1,\"BuildingsSize\":1,\"InStack\":1}"
        }, {
            "Type": "StackableRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":2,\"ItemID\":96,\"Name\":\"Cured Leather\",\"CraftTime\":120.0,\"Level\":22,\"Components\":[{\"id\":28,\"neededCount\":2}],\"TechnologiesIDs\":[31],\"tmpComponentsSize\":1,\"componentsSize\":1,\"tmpBuildingsSize\":1,\"BuildingsSize\":1,\"InStack\":1}"
        }, {
            "Type": "StackableRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":2,\"ItemID\":97,\"Name\":\"Cloth\",\"CraftTime\":80.0,\"Level\":24,\"Components\":[{\"id\":24,\"neededCount\":4}],\"TechnologiesIDs\":[33],\"tmpComponentsSize\":1,\"componentsSize\":1,\"tmpBuildingsSize\":1,\"BuildingsSize\":1,\"InStack\":1}"
        }, {
            "Type": "StackableRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":2,\"ItemID\":99,\"Name\":\"Sulfur\",\"CraftTime\":160.0,\"Level\":33,\"Components\":[{\"id\":18,\"neededCount\":4},{\"id\":15,\"neededCount\":2}],\"TechnologiesIDs\":[34],\"tmpComponentsSize\":2,\"componentsSize\":2,\"tmpBuildingsSize\":1,\"BuildingsSize\":1,\"InStack\":1}"
        }, {
            "Type": "StackableRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":2,\"ItemID\":98,\"Name\":\"Iron Bar\",\"CraftTime\":320.0,\"Level\":23,\"Components\":[{\"id\":17,\"neededCount\":4},{\"id\":15,\"neededCount\":2}],\"TechnologiesIDs\":[34],\"tmpComponentsSize\":2,\"componentsSize\":2,\"tmpBuildingsSize\":1,\"BuildingsSize\":1,\"InStack\":1}"
        }, {
            "Type": "StackableRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":2,\"ItemID\":100,\"Name\":\"Bullet\",\"CraftTime\":120.0,\"Level\":38,\"Components\":[{\"id\":101,\"neededCount\":2}],\"TechnologiesIDs\":[37],\"tmpComponentsSize\":1,\"componentsSize\":1,\"tmpBuildingsSize\":1,\"BuildingsSize\":1,\"InStack\":1}"
        }, {
            "Type": "StackableRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":2,\"ItemID\":101,\"Name\":\"Iron Plate\",\"CraftTime\":160.0,\"Level\":36,\"Components\":[{\"id\":98,\"neededCount\":2}],\"TechnologiesIDs\":[37],\"tmpComponentsSize\":1,\"componentsSize\":1,\"tmpBuildingsSize\":1,\"BuildingsSize\":1,\"InStack\":1}"
        }, {
            "Type": "StackableRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":2,\"ItemID\":102,\"Name\":\"Gunpowder Level 1\",\"CraftTime\":60.0,\"Level\":37,\"Components\":[{\"id\":22,\"neededCount\":2},{\"id\":99,\"neededCount\":4},{\"id\":20,\"neededCount\":4}],\"TechnologiesIDs\":[39],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":1,\"BuildingsSize\":1,\"InStack\":1}"
        }, {
            "Type": "StackableRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":2,\"ItemID\":103,\"Name\":\"Clay Forms For Weapons\",\"CraftTime\":360.0,\"Level\":32,\"Components\":[{\"id\":23,\"neededCount\":4},{\"id\":98,\"neededCount\":1},{\"id\":7,\"neededCount\":10}],\"TechnologiesIDs\":[30],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":1,\"BuildingsSize\":1,\"InStack\":1}"
        }, {
            "Type": "StackableRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":2,\"ItemID\":104,\"Name\":\"Cuprum Bar\",\"CraftTime\":160.0,\"Level\":35,\"Components\":[{\"id\":19,\"neededCount\":4},{\"id\":15,\"neededCount\":4}],\"TechnologiesIDs\":[35],\"tmpComponentsSize\":2,\"componentsSize\":2,\"tmpBuildingsSize\":1,\"BuildingsSize\":1,\"InStack\":1}"
        }, {
            "Type": "StackableRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":2,\"ItemID\":105,\"Name\":\"Cuprum Plate\",\"CraftTime\":200.0,\"Level\":46,\"Components\":[{\"id\":104,\"neededCount\":1}],\"TechnologiesIDs\":[38],\"tmpComponentsSize\":1,\"componentsSize\":1,\"tmpBuildingsSize\":1,\"BuildingsSize\":1,\"InStack\":1}"
        }, {
            "Type": "StackableRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":2,\"ItemID\":106,\"Name\":\"Spare Parts\",\"CraftTime\":240.0,\"Level\":46,\"Components\":[{\"id\":98,\"neededCount\":2},{\"id\":104,\"neededCount\":2}],\"TechnologiesIDs\":[38],\"tmpComponentsSize\":2,\"componentsSize\":2,\"tmpBuildingsSize\":1,\"BuildingsSize\":1,\"InStack\":1}"
        }, {
            "Type": "StackableRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":2,\"ItemID\":107,\"Name\":\"Peeled Saltpeter\",\"CraftTime\":240.0,\"Level\":47,\"Components\":[{\"id\":20,\"neededCount\":2},{\"id\":7,\"neededCount\":4}],\"TechnologiesIDs\":[42],\"tmpComponentsSize\":2,\"componentsSize\":2,\"tmpBuildingsSize\":1,\"BuildingsSize\":1,\"InStack\":1}"
        }, {
            "Type": "StackableRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":2,\"ItemID\":108,\"Name\":\"Cuprum Muff\",\"CraftTime\":240.0,\"Level\":47,\"Components\":[{\"id\":105,\"neededCount\":2}],\"TechnologiesIDs\":[38],\"tmpComponentsSize\":1,\"componentsSize\":1,\"tmpBuildingsSize\":1,\"BuildingsSize\":1,\"InStack\":1}"
        }, {
            "Type": "StackableRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":2,\"ItemID\":109,\"Name\":\"Clay Tiling\",\"CraftTime\":320.0,\"Level\":38,\"Components\":[{\"id\":7,\"neededCount\":8},{\"id\":92,\"neededCount\":4},{\"id\":23,\"neededCount\":10}],\"TechnologiesIDs\":[30],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":1,\"BuildingsSize\":1,\"InStack\":1}"
        }, {
            "Type": "StackableRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":2,\"ItemID\":110,\"Name\":\"Gunpowder Level 2\",\"CraftTime\":260.0,\"Level\":48,\"Components\":[{\"id\":21,\"neededCount\":4},{\"id\":22,\"neededCount\":4},{\"id\":99,\"neededCount\":6},{\"id\":107,\"neededCount\":2}],\"TechnologiesIDs\":[40],\"tmpComponentsSize\":4,\"componentsSize\":4,\"tmpBuildingsSize\":1,\"BuildingsSize\":1,\"InStack\":1}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":3,\"ItemID\":56,\"Name\":\"Palm Bag\",\"CraftTime\":60.0,\"Level\":3,\"Components\":[{\"id\":24,\"neededCount\":8},{\"id\":90,\"neededCount\":4}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":2,\"componentsSize\":2,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":3,\"ItemID\":57,\"Name\":\"Palm Headband\",\"CraftTime\":60.0,\"Level\":3,\"Components\":[{\"id\":24,\"neededCount\":4},{\"id\":90,\"neededCount\":2}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":2,\"componentsSize\":2,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":3,\"ItemID\":58,\"Name\":\"Palm Chest\",\"CraftTime\":60.0,\"Level\":3,\"Components\":[{\"id\":24,\"neededCount\":6},{\"id\":90,\"neededCount\":4}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":2,\"componentsSize\":2,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":3,\"ItemID\":59,\"Name\":\"Palm Pants\",\"CraftTime\":60.0,\"Level\":3,\"Components\":[{\"id\":24,\"neededCount\":6},{\"id\":90,\"neededCount\":4}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":2,\"componentsSize\":2,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":3,\"ItemID\":60,\"Name\":\"Palm Shoes\",\"CraftTime\":60.0,\"Level\":3,\"Components\":[{\"id\":24,\"neededCount\":4},{\"id\":90,\"neededCount\":4},{\"id\":15,\"neededCount\":2}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":3,\"ItemID\":61,\"Name\":\"Bone Bandage\",\"CraftTime\":120.0,\"Level\":8,\"Components\":[{\"id\":24,\"neededCount\":4},{\"id\":27,\"neededCount\":2},{\"id\":90,\"neededCount\":2}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":3,\"ItemID\":62,\"Name\":\"Bone Chest\",\"CraftTime\":120.0,\"Level\":8,\"Components\":[{\"id\":24,\"neededCount\":8},{\"id\":27,\"neededCount\":8},{\"id\":90,\"neededCount\":4}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":3,\"ItemID\":63,\"Name\":\"Bone Pants\",\"CraftTime\":120.0,\"Level\":8,\"Components\":[{\"id\":24,\"neededCount\":6},{\"id\":27,\"neededCount\":6},{\"id\":90,\"neededCount\":2}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":3,\"ItemID\":64,\"Name\":\"Bone Shoes\",\"CraftTime\":120.0,\"Level\":8,\"Components\":[{\"id\":24,\"neededCount\":4},{\"id\":27,\"neededCount\":4},{\"id\":90,\"neededCount\":4},{\"id\":15,\"neededCount\":4}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":4,\"componentsSize\":4,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":3,\"ItemID\":65,\"Name\":\"Wooden Helmet\",\"CraftTime\":240.0,\"Level\":15,\"Components\":[{\"id\":91,\"neededCount\":2},{\"id\":92,\"neededCount\":2}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":2,\"componentsSize\":2,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":3,\"ItemID\":66,\"Name\":\"Wooden Chest\",\"CraftTime\":240.0,\"Level\":15,\"Components\":[{\"id\":91,\"neededCount\":8},{\"id\":92,\"neededCount\":8}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":2,\"componentsSize\":2,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":3,\"ItemID\":67,\"Name\":\"Wooden Pants\",\"CraftTime\":240.0,\"Level\":15,\"Components\":[{\"id\":91,\"neededCount\":6},{\"id\":92,\"neededCount\":6}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":2,\"componentsSize\":2,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":3,\"ItemID\":68,\"Name\":\"Wooden Shoes\",\"CraftTime\":240.0,\"Level\":15,\"Components\":[{\"id\":91,\"neededCount\":4},{\"id\":92,\"neededCount\":4}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":2,\"componentsSize\":2,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":3,\"ItemID\":69,\"Name\":\"Cloth Bag\",\"CraftTime\":320.0,\"Level\":24,\"Components\":[{\"id\":91,\"neededCount\":4},{\"id\":97,\"neededCount\":8}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":2,\"componentsSize\":2,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":3,\"ItemID\":70,\"Name\":\"Cloth Headband\",\"CraftTime\":320.0,\"Level\":25,\"Components\":[{\"id\":91,\"neededCount\":2},{\"id\":97,\"neededCount\":4}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":2,\"componentsSize\":2,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":3,\"ItemID\":71,\"Name\":\"Cloth Chest\",\"CraftTime\":320.0,\"Level\":25,\"Components\":[{\"id\":91,\"neededCount\":4},{\"id\":97,\"neededCount\":10}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":2,\"componentsSize\":2,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":3,\"ItemID\":72,\"Name\":\"Cloth Pants\",\"CraftTime\":320.0,\"Level\":25,\"Components\":[{\"id\":91,\"neededCount\":4},{\"id\":97,\"neededCount\":10}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":2,\"componentsSize\":2,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":3,\"ItemID\":73,\"Name\":\"Cloth Shoes\",\"CraftTime\":320.0,\"Level\":25,\"Components\":[{\"id\":91,\"neededCount\":2},{\"id\":97,\"neededCount\":6},{\"id\":92,\"neededCount\":2}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":3,\"ItemID\":74,\"Name\":\"Heavy Bone Helmet\",\"CraftTime\":400.0,\"Level\":20,\"Components\":[{\"id\":91,\"neededCount\":2},{\"id\":28,\"neededCount\":2},{\"id\":27,\"neededCount\":4},{\"id\":26,\"neededCount\":2}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":4,\"componentsSize\":4,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":3,\"ItemID\":75,\"Name\":\"Heavy Bone Chest\",\"CraftTime\":400.0,\"Level\":20,\"Components\":[{\"id\":91,\"neededCount\":4},{\"id\":28,\"neededCount\":6},{\"id\":27,\"neededCount\":8},{\"id\":26,\"neededCount\":4}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":4,\"componentsSize\":4,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":3,\"ItemID\":76,\"Name\":\"Heavy Bone Pants\",\"CraftTime\":400.0,\"Level\":20,\"Components\":[{\"id\":91,\"neededCount\":4},{\"id\":28,\"neededCount\":4},{\"id\":27,\"neededCount\":6},{\"id\":26,\"neededCount\":4}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":4,\"componentsSize\":4,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":3,\"ItemID\":77,\"Name\":\"Heavy Bone Shoes\",\"CraftTime\":400.0,\"Level\":20,\"Components\":[{\"id\":91,\"neededCount\":2},{\"id\":28,\"neededCount\":4},{\"id\":27,\"neededCount\":6},{\"id\":92,\"neededCount\":2}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":4,\"componentsSize\":4,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "StackableRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":2,\"ItemID\":114,\"Name\":\"Coated Skin\",\"CraftTime\":160.0,\"Level\":34,\"Components\":[{\"id\":96,\"neededCount\":2},{\"id\":21,\"neededCount\":4}],\"TechnologiesIDs\":[32],\"tmpComponentsSize\":2,\"componentsSize\":2,\"tmpBuildingsSize\":1,\"BuildingsSize\":1,\"InStack\":1}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":3,\"ItemID\":78,\"Name\":\"Skin Bag\",\"CraftTime\":480.0,\"Level\":34,\"Components\":[{\"id\":114,\"neededCount\":4},{\"id\":97,\"neededCount\":2},{\"id\":91,\"neededCount\":4}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":3,\"ItemID\":79,\"Name\":\"Pirate Hat\",\"CraftTime\":420.0,\"Level\":28,\"Components\":[{\"id\":96,\"neededCount\":2},{\"id\":97,\"neededCount\":2},{\"id\":91,\"neededCount\":2}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":3,\"ItemID\":80,\"Name\":\"Pirate Chest\",\"CraftTime\":420.0,\"Level\":28,\"Components\":[{\"id\":96,\"neededCount\":4},{\"id\":97,\"neededCount\":6},{\"id\":91,\"neededCount\":4}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":3,\"ItemID\":81,\"Name\":\"Pirate Pants\",\"CraftTime\":420.0,\"Level\":28,\"Components\":[{\"id\":96,\"neededCount\":6},{\"id\":97,\"neededCount\":4},{\"id\":91,\"neededCount\":2}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":3,\"ItemID\":82,\"Name\":\"Pirate Shoes\",\"CraftTime\":420.0,\"Level\":28,\"Components\":[{\"id\":96,\"neededCount\":4},{\"id\":92,\"neededCount\":2},{\"id\":91,\"neededCount\":4}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":3,\"ItemID\":83,\"Name\":\"Skin Chest\",\"CraftTime\":480.0,\"Level\":36,\"Components\":[{\"id\":114,\"neededCount\":6},{\"id\":101,\"neededCount\":2},{\"id\":91,\"neededCount\":4}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":3,\"ItemID\":84,\"Name\":\"Skin Pants\",\"CraftTime\":480.0,\"Level\":36,\"Components\":[{\"id\":114,\"neededCount\":6},{\"id\":101,\"neededCount\":2},{\"id\":91,\"neededCount\":4}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":3,\"ItemID\":85,\"Name\":\"Skin Shoes\",\"CraftTime\":480.0,\"Level\":36,\"Components\":[{\"id\":114,\"neededCount\":4},{\"id\":101,\"neededCount\":2},{\"id\":91,\"neededCount\":2},{\"id\":112,\"neededCount\":2}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":4,\"componentsSize\":4,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":3,\"ItemID\":86,\"Name\":\"Metal Helmet\",\"CraftTime\":500.0,\"Level\":46,\"Components\":[{\"id\":114,\"neededCount\":4},{\"id\":101,\"neededCount\":4},{\"id\":105,\"neededCount\":2}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":3,\"ItemID\":87,\"Name\":\"Metal Chest\",\"CraftTime\":500.0,\"Level\":46,\"Components\":[{\"id\":114,\"neededCount\":8},{\"id\":101,\"neededCount\":6},{\"id\":105,\"neededCount\":4}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":3,\"ItemID\":88,\"Name\":\"Metal Pants\",\"CraftTime\":500.0,\"Level\":46,\"Components\":[{\"id\":114,\"neededCount\":6},{\"id\":101,\"neededCount\":4},{\"id\":105,\"neededCount\":2}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":3,\"ItemID\":89,\"Name\":\"Metal Shoes\",\"CraftTime\":500.0,\"Level\":46,\"Components\":[{\"id\":114,\"neededCount\":4},{\"id\":101,\"neededCount\":2},{\"id\":105,\"neededCount\":2},{\"id\":112,\"neededCount\":2}],\"TechnologiesIDs\":[],\"tmpComponentsSize\":4,\"componentsSize\":4,\"tmpBuildingsSize\":0,\"BuildingsSize\":0}"
        }, {
            "Type": "StackableRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":4,\"ItemID\":1,\"Name\":\"Fried Crab\",\"CraftTime\":60.0,\"Level\":3,\"Components\":[{\"id\":8,\"neededCount\":2},{\"id\":15,\"neededCount\":4}],\"TechnologiesIDs\":[6],\"tmpComponentsSize\":2,\"componentsSize\":2,\"tmpBuildingsSize\":1,\"BuildingsSize\":1,\"InStack\":1}"
        }, {
            "Type": "StackableRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":4,\"ItemID\":4,\"Name\":\"Fried Meat\",\"CraftTime\":60.0,\"Level\":3,\"Components\":[{\"id\":10,\"neededCount\":2},{\"id\":15,\"neededCount\":4}],\"TechnologiesIDs\":[6],\"tmpComponentsSize\":2,\"componentsSize\":2,\"tmpBuildingsSize\":1,\"BuildingsSize\":1,\"InStack\":1}"
        }, {
            "Type": "StackableRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":4,\"ItemID\":3,\"Name\":\"Fried Fish\",\"CraftTime\":120.0,\"Level\":17,\"Components\":[{\"id\":9,\"neededCount\":2},{\"id\":21,\"neededCount\":1},{\"id\":15,\"neededCount\":4}],\"TechnologiesIDs\":[7],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":1,\"BuildingsSize\":1,\"InStack\":1}"
        }, {
            "Type": "StackableRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":4,\"ItemID\":5,\"Name\":\"Fried Mushrooms\",\"CraftTime\":120.0,\"Level\":17,\"Components\":[{\"id\":11,\"neededCount\":4},{\"id\":21,\"neededCount\":2},{\"id\":15,\"neededCount\":4}],\"TechnologiesIDs\":[7],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":1,\"BuildingsSize\":1,\"InStack\":1}"
        }, {
            "Type": "StackableRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":4,\"ItemID\":2,\"Name\":\"Dried Fish\",\"CraftTime\":80.0,\"Level\":10,\"Components\":[{\"id\":9,\"neededCount\":2},{\"id\":21,\"neededCount\":1}],\"TechnologiesIDs\":[22],\"tmpComponentsSize\":2,\"componentsSize\":2,\"tmpBuildingsSize\":1,\"BuildingsSize\":1,\"InStack\":1}"
        }, {
            "Type": "StackableRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":4,\"ItemID\":6,\"Name\":\"Dried Mushrooms\",\"CraftTime\":160.0,\"Level\":19,\"Components\":[{\"id\":11,\"neededCount\":2},{\"id\":1,\"neededCount\":1}],\"TechnologiesIDs\":[23],\"tmpComponentsSize\":2,\"componentsSize\":2,\"tmpBuildingsSize\":1,\"BuildingsSize\":1,\"InStack\":1}"
        }, {
            "Type": "StackableRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":4,\"ItemID\":116,\"Name\":\"Mushroom Soup\",\"CraftTime\":240.0,\"Level\":27,\"Components\":[{\"id\":11,\"neededCount\":6},{\"id\":115,\"neededCount\":4},{\"id\":7,\"neededCount\":8},{\"id\":21,\"neededCount\":2},{\"id\":15,\"neededCount\":10}],\"TechnologiesIDs\":[8],\"tmpComponentsSize\":5,\"componentsSize\":5,\"tmpBuildingsSize\":1,\"BuildingsSize\":1,\"InStack\":1}"
        }, {
            "Type": "StackableRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":4,\"ItemID\":117,\"Name\":\"Fried Potatoes\",\"CraftTime\":240.0,\"Level\":27,\"Components\":[{\"id\":115,\"neededCount\":4},{\"id\":21,\"neededCount\":2},{\"id\":15,\"neededCount\":6}],\"TechnologiesIDs\":[8],\"tmpComponentsSize\":3,\"componentsSize\":3,\"tmpBuildingsSize\":1,\"BuildingsSize\":1,\"InStack\":1}"
        }, {
            "Type": "StackableRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":4,\"ItemID\":118,\"Name\":\"Meat Soup\",\"CraftTime\":380.0,\"Level\":42,\"Components\":[{\"id\":10,\"neededCount\":8},{\"id\":115,\"neededCount\":6},{\"id\":7,\"neededCount\":10},{\"id\":21,\"neededCount\":4},{\"id\":15,\"neededCount\":14}],\"TechnologiesIDs\":[9],\"tmpComponentsSize\":5,\"componentsSize\":5,\"tmpBuildingsSize\":1,\"BuildingsSize\":1,\"InStack\":1}"
        }, {
            "Type": "StackableRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":4,\"ItemID\":119,\"Name\":\"Roast\",\"CraftTime\":420.0,\"Level\":42,\"Components\":[{\"id\":10,\"neededCount\":8},{\"id\":11,\"neededCount\":6},{\"id\":115,\"neededCount\":6},{\"id\":21,\"neededCount\":4},{\"id\":15,\"neededCount\":16}],\"TechnologiesIDs\":[9],\"tmpComponentsSize\":5,\"componentsSize\":5,\"tmpBuildingsSize\":1,\"BuildingsSize\":1,\"InStack\":1}"
        }, {
            "Type": "StackableRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
            "Data": "{\"recipeType\":4,\"ItemID\":120,\"Name\":\"Dried Meat\",\"CraftTime\":220.0,\"Level\":30,\"Components\":[{\"id\":10,\"neededCount\":2},{\"id\":21,\"neededCount\":4}],\"TechnologiesIDs\":[24],\"tmpComponentsSize\":2,\"componentsSize\":2,\"tmpBuildingsSize\":1,\"BuildingsSize\":1,\"InStack\":1}"
        }]
    };


    $(document).on('click', '#createRecipes', function () {
        $.ajax({
            url: '/api/recipe',
            method: 'POST',
            dataType: 'json',
            data: recipes,
        });
    });

    $(document).on('click', '#getRecipes', function () {
        $.ajax({
            url: '/api/recipe',
            method: 'GET',

        });
    });

    var technologies = {
        "technologies": [{
            "name": "Home Level 1",
            "id": 1,
            "level": 1,
            "playerLevel": 1,
            "coinCost": 1,
            "timeToBuild": 60.0,
            "isBuilding": false,
            "technologyType": 1,
            "oppenedItems": []
        }, {
            "name": "Home Level 2",
            "id": 2,
            "level": 2,
            "playerLevel": 5,
            "coinCost": 2,
            "timeToBuild": 120.0,
            "isBuilding": false,
            "technologyType": 1,
            "oppenedItems": []
        }, {
            "name": "Home Level 3",
            "id": 3,
            "level": 3,
            "playerLevel": 15,
            "coinCost": 4,
            "timeToBuild": 240.0,
            "isBuilding": false,
            "technologyType": 1,
            "oppenedItems": []
        }, {
            "name": "Home Level 4",
            "id": 4,
            "level": 4,
            "playerLevel": 25,
            "coinCost": 8,
            "timeToBuild": 480.0,
            "isBuilding": false,
            "technologyType": 1,
            "oppenedItems": []
        }, {
            "name": "Home Level 5",
            "id": 5,
            "level": 5,
            "playerLevel": 40,
            "coinCost": 16,
            "timeToBuild": 960.0,
            "isBuilding": false,
            "technologyType": 1,
            "oppenedItems": []
        }, {
            "name": "Hearth Level 1",
            "id": 6,
            "level": 1,
            "playerLevel": 3,
            "coinCost": 1,
            "timeToBuild": 60.0,
            "isBuilding": false,
            "technologyType": 2,
            "oppenedItems": [1, 4]
        }, {
            "name": "Hearth Level 2",
            "id": 7,
            "level": 2,
            "playerLevel": 17,
            "coinCost": 2,
            "timeToBuild": 120.0,
            "isBuilding": false,
            "technologyType": 2,
            "oppenedItems": [3, 4]
        }, {
            "name": "Hearth Level 3",
            "id": 8,
            "level": 3,
            "playerLevel": 27,
            "coinCost": 4,
            "timeToBuild": 240.0,
            "isBuilding": false,
            "technologyType": 2,
            "oppenedItems": []
        }, {
            "name": "Hearth Level 4",
            "id": 9,
            "level": 4,
            "playerLevel": 42,
            "coinCost": 8,
            "timeToBuild": 480.0,
            "isBuilding": false,
            "technologyType": 2,
            "oppenedItems": []
        }, {
            "name": "Chest Level 1",
            "id": 10,
            "level": 1,
            "playerLevel": 2,
            "coinCost": 1,
            "timeToBuild": 60.0,
            "isBuilding": false,
            "technologyType": 4,
            "oppenedItems": []
        }, {
            "name": "Chest Level 2",
            "id": 11,
            "level": 2,
            "playerLevel": 16,
            "coinCost": 2,
            "timeToBuild": 120.0,
            "isBuilding": false,
            "technologyType": 4,
            "oppenedItems": []
        }, {
            "name": "Chest Level 3",
            "id": 12,
            "level": 3,
            "playerLevel": 26,
            "coinCost": 4,
            "timeToBuild": 240.0,
            "isBuilding": false,
            "technologyType": 4,
            "oppenedItems": []
        }, {
            "name": "Chest Level 4",
            "id": 13,
            "level": 4,
            "playerLevel": 41,
            "coinCost": 8,
            "timeToBuild": 480.0,
            "isBuilding": false,
            "technologyType": 4,
            "oppenedItems": []
        }, {
            "name": "Raft",
            "id": 14,
            "level": 1,
            "playerLevel": 1,
            "coinCost": 1,
            "timeToBuild": 60.0,
            "isBuilding": false,
            "technologyType": 8,
            "oppenedItems": []
        }, {
            "name": "Spring Level 1",
            "id": 15,
            "level": 1,
            "playerLevel": 4,
            "coinCost": 1,
            "timeToBuild": 60.0,
            "isBuilding": true,
            "technologyType": 16,
            "oppenedItems": [7]
        }, {
            "name": "Spring Level 2",
            "id": 16,
            "level": 2,
            "playerLevel": 18,
            "coinCost": 2,
            "timeToBuild": 120.0,
            "isBuilding": false,
            "technologyType": 16,
            "oppenedItems": []
        }, {
            "name": "Spring Level 3",
            "id": 17,
            "level": 3,
            "playerLevel": 28,
            "coinCost": 4,
            "timeToBuild": 240.0,
            "isBuilding": false,
            "technologyType": 16,
            "oppenedItems": []
        }, {
            "name": "Spring Level 4",
            "id": 18,
            "level": 4,
            "playerLevel": 43,
            "coinCost": 8,
            "timeToBuild": 480.0,
            "isBuilding": false,
            "technologyType": 16,
            "oppenedItems": []
        }, {
            "name": "Fishing Net Level 1",
            "id": 19,
            "level": 1,
            "playerLevel": 8,
            "coinCost": 1,
            "timeToBuild": 60.0,
            "isBuilding": false,
            "technologyType": 32,
            "oppenedItems": [9]
        }, {
            "name": "Fishing Net Level 2",
            "id": 20,
            "level": 2,
            "playerLevel": 29,
            "coinCost": 2,
            "timeToBuild": 120.0,
            "isBuilding": false,
            "technologyType": 32,
            "oppenedItems": []
        }, {
            "name": "Fishing Net Level 3",
            "id": 21,
            "level": 3,
            "playerLevel": 44,
            "coinCost": 4,
            "timeToBuild": 240.0,
            "isBuilding": false,
            "technologyType": 32,
            "oppenedItems": []
        }, {
            "name": "Drier Level 1",
            "id": 22,
            "level": 1,
            "playerLevel": 10,
            "coinCost": 1,
            "timeToBuild": 60.0,
            "isBuilding": false,
            "technologyType": 64,
            "oppenedItems": [2]
        }, {
            "name": "Drier Level 2",
            "id": 23,
            "level": 2,
            "playerLevel": 19,
            "coinCost": 2,
            "timeToBuild": 120.0,
            "isBuilding": false,
            "technologyType": 64,
            "oppenedItems": [6]
        }, {
            "name": "Drier Level 3",
            "id": 24,
            "level": 3,
            "playerLevel": 30,
            "coinCost": 4,
            "timeToBuild": 240.0,
            "isBuilding": false,
            "technologyType": 64,
            "oppenedItems": []
        }, {
            "name": "Woodworking Machine Level 1",
            "id": 25,
            "level": 1,
            "playerLevel": 12,
            "coinCost": 1,
            "timeToBuild": 60.0,
            "isBuilding": false,
            "technologyType": 128,
            "oppenedItems": [92]
        }, {
            "name": "Woodworking Machine Level 2",
            "id": 26,
            "level": 2,
            "playerLevel": 31,
            "coinCost": 2,
            "timeToBuild": 120.0,
            "isBuilding": false,
            "technologyType": 128,
            "oppenedItems": []
        }, {
            "name": "Stoneworking Machine Level 1",
            "id": 27,
            "level": 1,
            "playerLevel": 20,
            "coinCost": 1,
            "timeToBuild": 60.0,
            "isBuilding": false,
            "technologyType": 256,
            "oppenedItems": [94]
        }, {
            "name": "Stoneworking Machine Level 2",
            "id": 28,
            "level": 2,
            "playerLevel": 32,
            "coinCost": 2,
            "timeToBuild": 120.0,
            "isBuilding": false,
            "technologyType": 256,
            "oppenedItems": []
        }, {
            "name": "Pottery Wheel Level 1",
            "id": 29,
            "level": 1,
            "playerLevel": 21,
            "coinCost": 1,
            "timeToBuild": 60.0,
            "isBuilding": false,
            "technologyType": 512,
            "oppenedItems": [95]
        }, {
            "name": "Pottery Wheel Level 2",
            "id": 30,
            "level": 2,
            "playerLevel": 33,
            "coinCost": 2,
            "timeToBuild": 120.0,
            "isBuilding": false,
            "technologyType": 512,
            "oppenedItems": [103, 109]
        }, {
            "name": "Tanning Tool Level 1",
            "id": 31,
            "level": 1,
            "playerLevel": 22,
            "coinCost": 1,
            "timeToBuild": 60.0,
            "isBuilding": false,
            "technologyType": 1024,
            "oppenedItems": [96]
        }, {
            "name": "Tanning Tool Level 2",
            "id": 32,
            "level": 2,
            "playerLevel": 34,
            "coinCost": 2,
            "timeToBuild": 120.0,
            "isBuilding": false,
            "technologyType": 1024,
            "oppenedItems": []
        }, {
            "name": "Loom",
            "id": 33,
            "level": 1,
            "playerLevel": 24,
            "coinCost": 1,
            "timeToBuild": 60.0,
            "isBuilding": false,
            "technologyType": 2048,
            "oppenedItems": [97]
        }, {
            "name": "Smelter Level 1",
            "id": 34,
            "level": 1,
            "playerLevel": 23,
            "coinCost": 1,
            "timeToBuild": 60.0,
            "isBuilding": false,
            "technologyType": 4096,
            "oppenedItems": [98, 99]
        }, {
            "name": "Smelter Level 2",
            "id": 35,
            "level": 2,
            "playerLevel": 35,
            "coinCost": 2,
            "timeToBuild": 120.0,
            "isBuilding": false,
            "technologyType": 4096,
            "oppenedItems": [104]
        }, {
            "name": "Smelter Level 3",
            "id": 36,
            "level": 3,
            "playerLevel": 45,
            "coinCost": 4,
            "timeToBuild": 240.0,
            "isBuilding": false,
            "technologyType": 4096,
            "oppenedItems": []
        }, {
            "name": "Metal Workbench Level 1",
            "id": 37,
            "level": 1,
            "playerLevel": 36,
            "coinCost": 1,
            "timeToBuild": 60.0,
            "isBuilding": false,
            "technologyType": 8192,
            "oppenedItems": [101]
        }, {
            "name": "Metal Workbench Level 2",
            "id": 38,
            "level": 2,
            "playerLevel": 46,
            "coinCost": 2,
            "timeToBuild": 120.0,
            "isBuilding": false,
            "technologyType": 8192,
            "oppenedItems": [106, 105, 108]
        }, {
            "name": "Gunpowder Machine Level 1",
            "id": 39,
            "level": 1,
            "playerLevel": 37,
            "coinCost": 1,
            "timeToBuild": 60.0,
            "isBuilding": false,
            "technologyType": 16384,
            "oppenedItems": [102]
        }, {
            "name": "Gunpowder Machine Level 2",
            "id": 40,
            "level": 2,
            "playerLevel": 47,
            "coinCost": 2,
            "timeToBuild": 120.0,
            "isBuilding": false,
            "technologyType": 16384,
            "oppenedItems": [110]
        }, {
            "name": "Ammo Machine",
            "id": 41,
            "level": 1,
            "playerLevel": 38,
            "coinCost": 1,
            "timeToBuild": 60.0,
            "isBuilding": false,
            "technologyType": 32768,
            "oppenedItems": [100]
        }, {
            "name": "Nitrum Cleaner",
            "id": 42,
            "level": 1,
            "playerLevel": 48,
            "coinCost": 1,
            "timeToBuild": 60.0,
            "isBuilding": false,
            "technologyType": 65536,
            "oppenedItems": [107]
        }
        ]
    };

    $(document).on('click', '#createTechnologies', function () {
        $.ajax({
            url: '/api/technology',
            method: 'POST',
            dataType: 'json',
            data: technologies,
        });
    });

    $(document).on('click', '#getTechnologies', function () {
        $.ajax({
            url: '/api/technology',
            method: 'GET',

        });
    });

    $(document).on('click', '#create', function () {
        $.ajax({
            url: '/api/player',
            method: 'POST',
            dataType: 'json',
            data: {
                "googleID": "asdasdasdasxcgtjhrrds",
                "playerMaximumHP": 10000,
                "playerCurrentHP": 10000,
                "playerMaximumPower": 100,
                "playerCurrentPower": 100,
                "playerMaximumSatiety": 100,
                "playerCurrentSatiety": 94,
                "playerFoodDecrement": 0,
                "playerCurrentFoodDecrement": 0,
                "playerMaximumThirst": 100,
                "playerCurrentThirst": 94,
                "playerWaterDecrement": 0,
                "playerCurrentWaterDecrement": 0,
                "playerCurrentLevel": 1,
                "playerCurrentExperience": 0,
                "playerNextLevelExperience": 100,
                "playerAttackPower": 5,
                "playerCurrentAttackPower": 5,
                "playerAttackSpeed": 1.0,
                "playerCurrentAttackSpeed": 1.0,
                "playerMovementSpeed": 1.0,
                "playerCurrentMovementSpeed": 1.0,
                "playerGender": true,
                "playerName": "plName",
                "playerArmor": 0,
                "playerCurrentArmor": 0,
                "playerAttackDistance": 1.75,
                "playerCollectDistance": 0.550000011920929,
                "playerCurrentAttackDistance": 1.75,
                "playerDetectEnemyRadius": 10.0,
                "playerDetectResourceRadius": 8.0,
                "isDie": false,
                "isSpawnInLocation": false,
                "goldCoin": 100,
                "playerClass": 0,
                "playerAttackBonus": 0.0,
                "playerGatheringBonus": 1.409999966621399,
                "playerCraftTimeImprovementBonus": 1.0499999523162842
            },
        });
    });

    $(document).on('click', '#update', function () {
        $.ajax({
            url: '/api/player',
            method: 'POST',
            dataType: 'json',
            data: {
                "googleID": 1,
                "playerMaximumHP": 40000,
                "playerCurrentHP": 50000,

            },
        });
    });
    $(document).on('click', '#delete', function () {
        $.ajax({
            url: '/api/player',
            method: 'DELETE',
            dataType: 'json',
            data: {"googleID": 1},
        });
    });
    $(document).on('click', '#get', function () {
        $.ajax({
            url: '/api/player',
            method: 'GET',
            dataType: 'json',
            data: {"googleID": 1},
        });
    });

    $(document).on('click', '#getTimer', function () {
        $.ajax({
            url: '/api/timer/walking',
            method: 'GET',
            data: {"googleID": "asdasdasdasxcgtjhrrds"},
        });
    });

    $(document).on('click', '#createTimer', function () {
        $.ajax({
            url: '/api/timer/walking',
            method: 'POST',
            data: {"googleID": "asdasdasdasxcgtjhrrds"},
        });
    });

    var slots = {
        "googleID":
            "1",
        "slotsData":
            [{
                "slotInfo": "{\"Index\":0,\"CurrentCount\":0,\"currentDurability\":0.0,\"available\":true,\"SlotType\":511}",
                "itemID": "-1"
            }, {
                "slotInfo": "{\"Index\":1,\"CurrentCount\":0,\"currentDurability\":0.0,\"available\":true,\"SlotType\":511}",
                "itemID": "-1"
            }, {
                "slotInfo": "{\"Index\":2,\"CurrentCount\":0,\"currentDurability\":0.0,\"available\":true,\"SlotType\":511}",
                "itemID": "-1"
            }, {
                "slotInfo": "{\"Index\":3,\"CurrentCount\":0,\"currentDurability\":0.0,\"available\":true,\"SlotType\":511}",
                "itemID": "-1"
            }, {
                "slotInfo": "{\"Index\":4,\"CurrentCount\":10,\"currentDurability\":1.0,\"available\":true,\"SlotType\":511}",
                "itemID": "-1"
            }, {
                "slotInfo": "{\"Index\":5,\"CurrentCount\":0,\"currentDurability\":0.0,\"available\":true,\"SlotType\":511}",
                "itemID": "-1"
            }, {
                "slotInfo": "{\"Index\":6,\"CurrentCount\":0,\"currentDurability\":0.0,\"available\":true,\"SlotType\":511}",
                "itemID": "-1"
            }, {
                "slotInfo": "{\"Index\":7,\"CurrentCount\":0,\"currentDurability\":0.0,\"available\":true,\"SlotType\":511}",
                "itemID": "-1"
            }, {
                "slotInfo": "{\"Index\":8,\"CurrentCount\":0,\"currentDurability\":0.0,\"available\":true,\"SlotType\":511}",
                "itemID": "-1"
            }, {
                "slotInfo": "{\"Index\":9,\"CurrentCount\":10,\"currentDurability\":1.0,\"available\":true,\"SlotType\":511}",
                "itemID": "-1"
            }, {
                "slotInfo": "{\"Index\":10,\"CurrentCount\":0,\"currentDurability\":0.0,\"available\":false,\"SlotType\":511}",
                "itemID": "-1"
            }, {
                "slotInfo": "{\"Index\":11,\"CurrentCount\":0,\"currentDurability\":0.0,\"available\":false,\"SlotType\":511}",
                "itemID": "-1"
            }, {
                "slotInfo": "{\"Index\":12,\"CurrentCount\":0,\"currentDurability\":0.0,\"available\":false,\"SlotType\":511}",
                "itemID": "-1"
            }, {
                "slotInfo": "{\"Index\":13,\"CurrentCount\":0,\"currentDurability\":0.0,\"available\":false,\"SlotType\":511}",
                "itemID": "-1"
            }, {
                "slotInfo": "{\"Index\":14,\"CurrentCount\":0,\"currentDurability\":0.0,\"available\":false,\"SlotType\":511}",
                "itemID": "-1"
            }, {
                "slotInfo": "{\"Index\":15,\"CurrentCount\":0,\"currentDurability\":0.0,\"available\":false,\"SlotType\":511}",
                "itemID": "-1"
            }, {
                "slotInfo": "{\"Index\":16,\"CurrentCount\":0,\"currentDurability\":0.0,\"available\":false,\"SlotType\":511}",
                "itemID": "-1"
            }, {
                "slotInfo": "{\"Index\":17,\"CurrentCount\":0,\"currentDurability\":0.0,\"available\":false,\"SlotType\":511}",
                "itemID": "-1"
            }, {
                "slotInfo": "{\"Index\":18,\"CurrentCount\":0,\"currentDurability\":0.0,\"available\":false,\"SlotType\":511}",
                "itemID": "-1"
            }, {
                "slotInfo": "{\"Index\":19,\"CurrentCount\":0,\"currentDurability\":0.0,\"available\":false,\"SlotType\":511}",
                "itemID": "-1"
            }, {
                "slotInfo": "{\"Index\":20,\"CurrentCount\":0,\"currentDurability\":0.0,\"available\":false,\"SlotType\":511}",
                "itemID": "-1"
            }, {
                "slotInfo": "{\"Index\":21,\"CurrentCount\":0,\"currentDurability\":0.0,\"available\":false,\"SlotType\":511}",
                "itemID": "-1"
            }, {
                "slotInfo": "{\"Index\":22,\"CurrentCount\":0,\"currentDurability\":0.0,\"available\":false,\"SlotType\":511}",
                "itemID": "-1"
            }, {
                "slotInfo": "{\"Index\":23,\"CurrentCount\":0,\"currentDurability\":0.0,\"available\":false,\"SlotType\":511}",
                "itemID": "-1"
            }, {
                "slotInfo": "{\"Index\":24,\"CurrentCount\":0,\"currentDurability\":0.0,\"available\":false,\"SlotType\":511}",
                "itemID": "-1"
            }]
    };

    $(document).on('click', '#getSlots', function () {
        $.ajax({
            url: '/api/player-chest-items',
            method: 'GET',
            data: {"googleID": 1},
        });
    });

    $(document).on('click', '#createSlots', function () {
        $.ajax({
            url: '/api/player-chest-items',
            method: 'POST',
            dataType: 'json',
            data: slots,
        });
    });

    var items =
        {
            "allItemsData": [{
                "Type": "FoodItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Fried Crab\",\"Id\":1,\"MaxInStack\":10,\"InventorySlotType\":8,\"hpRestore\":10,\"hungerRestore\":3,\"thirstRestore\":1}"
            }, {
                "Type": "FoodItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Dried Fish\",\"Id\":2,\"MaxInStack\":10,\"InventorySlotType\":8,\"hpRestore\":15,\"hungerRestore\":8,\"thirstRestore\":2}"
            }, {
                "Type": "FoodItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Fried Fish\",\"Id\":3,\"MaxInStack\":10,\"InventorySlotType\":8,\"hpRestore\":12,\"hungerRestore\":10,\"thirstRestore\":0}"
            }, {
                "Type": "FoodItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Fried Meat\",\"Id\":4,\"MaxInStack\":10,\"InventorySlotType\":8,\"hpRestore\":10,\"hungerRestore\":10,\"thirstRestore\":0}"
            }, {
                "Type": "FoodItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Fried Mushrooms\",\"Id\":5,\"MaxInStack\":10,\"InventorySlotType\":8,\"hpRestore\":5,\"hungerRestore\":10,\"thirstRestore\":0}"
            }, {
                "Type": "FoodItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Dried Mushrooms\",\"Id\":6,\"MaxInStack\":10,\"InventorySlotType\":8,\"hpRestore\":10,\"hungerRestore\":10,\"thirstRestore\":0}"
            }, {
                "Type": "FoodItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Mushroom Soup\",\"Id\":116,\"MaxInStack\":10,\"InventorySlotType\":8,\"hpRestore\":40,\"hungerRestore\":35,\"thirstRestore\":20}"
            }, {
                "Type": "FoodItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Fried Potatoes\",\"Id\":117,\"MaxInStack\":10,\"InventorySlotType\":8,\"hpRestore\":15,\"hungerRestore\":20,\"thirstRestore\":5}"
            }, {
                "Type": "FoodItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Meat Soup\",\"Id\":118,\"MaxInStack\":10,\"InventorySlotType\":8,\"hpRestore\":35,\"hungerRestore\":25,\"thirstRestore\":25}"
            }, {
                "Type": "FoodItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Roast\",\"Id\":119,\"MaxInStack\":10,\"InventorySlotType\":8,\"hpRestore\":60,\"hungerRestore\":30,\"thirstRestore\":10}"
            }, {
                "Type": "FoodItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Dried Meat\",\"Id\":120,\"MaxInStack\":10,\"InventorySlotType\":8,\"hpRestore\":14,\"hungerRestore\":20,\"thirstRestore\":5}"
            }, {
                "Type": "FoodItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Water\",\"Id\":7,\"MaxInStack\":10,\"InventorySlotType\":8,\"hpRestore\":0,\"hungerRestore\":0,\"thirstRestore\":10}"
            }, {
                "Type": "FoodItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Crabs Meat\",\"Id\":8,\"MaxInStack\":10,\"InventorySlotType\":8,\"hpRestore\":10,\"hungerRestore\":10,\"thirstRestore\":3}"
            }, {
                "Type": "FoodItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Fish Meat\",\"Id\":9,\"MaxInStack\":10,\"InventorySlotType\":8,\"hpRestore\":10,\"hungerRestore\":5,\"thirstRestore\":2}"
            }, {
                "Type": "FoodItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Meat\",\"Id\":10,\"MaxInStack\":10,\"InventorySlotType\":8,\"hpRestore\":15,\"hungerRestore\":5,\"thirstRestore\":3}"
            }, {
                "Type": "FoodItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Mushrooms\",\"Id\":11,\"MaxInStack\":10,\"InventorySlotType\":8,\"hpRestore\":5,\"hungerRestore\":5,\"thirstRestore\":0}"
            }, {
                "Type": "FoodItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Coconut\",\"Id\":12,\"MaxInStack\":10,\"InventorySlotType\":8,\"hpRestore\":5,\"hungerRestore\":2,\"thirstRestore\":5}"
            }, {
                "Type": "FoodItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Banana\",\"Id\":13,\"MaxInStack\":10,\"InventorySlotType\":8,\"hpRestore\":5,\"hungerRestore\":5,\"thirstRestore\":0}"
            }, {
                "Type": "FoodItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Sugar Cane\",\"Id\":14,\"MaxInStack\":10,\"InventorySlotType\":8,\"hpRestore\":8,\"hungerRestore\":5,\"thirstRestore\":4}"
            }, {
                "Type": "FoodItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Potatoes\",\"Id\":115,\"MaxInStack\":10,\"InventorySlotType\":8,\"hpRestore\":5,\"hungerRestore\":7,\"thirstRestore\":1}"
            }, {
                "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Wood\",\"Id\":15,\"MaxInStack\":10,\"InventorySlotType\":1}"
            }, {
                "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Oak Wood\",\"Id\":111,\"MaxInStack\":10,\"InventorySlotType\":1}"
            }, {
                "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Oak Boards\",\"Id\":112,\"MaxInStack\":10,\"InventorySlotType\":1}"
            }, {
                "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Stained Stone\",\"Id\":113,\"MaxInStack\":10,\"InventorySlotType\":1}"
            }, {
                "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Coated Skin\",\"Id\":114,\"MaxInStack\":10,\"InventorySlotType\":1}"
            }, {
                "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Stone\",\"Id\":16,\"MaxInStack\":10,\"InventorySlotType\":1}"
            }, {
                "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Iron Ore\",\"Id\":17,\"MaxInStack\":10,\"InventorySlotType\":1}"
            }, {
                "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Sulfur Ore\",\"Id\":18,\"MaxInStack\":10,\"InventorySlotType\":1}"
            }, {
                "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Cuprum Ore\",\"Id\":19,\"MaxInStack\":10,\"InventorySlotType\":1}"
            }, {
                "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Nitrum Ore\",\"Id\":20,\"MaxInStack\":10,\"InventorySlotType\":1}"
            }, {
                "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Salt\",\"Id\":21,\"MaxInStack\":10,\"InventorySlotType\":1}"
            }, {
                "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Coal\",\"Id\":22,\"MaxInStack\":10,\"InventorySlotType\":1}"
            }, {
                "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Clay\",\"Id\":23,\"MaxInStack\":10,\"InventorySlotType\":1}"
            }, {
                "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Palm Leaves\",\"Id\":24,\"MaxInStack\":10,\"InventorySlotType\":1}"
            }, {
                "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Stem\",\"Id\":25,\"MaxInStack\":10,\"InventorySlotType\":1}"
            }, {
                "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Incisor\",\"Id\":26,\"MaxInStack\":10,\"InventorySlotType\":1}"
            }, {
                "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Bone\",\"Id\":27,\"MaxInStack\":10,\"InventorySlotType\":1}"
            }, {
                "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Skin\",\"Id\":28,\"MaxInStack\":10,\"InventorySlotType\":1}"
            }, {
                "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Resin\",\"Id\":29,\"MaxInStack\":10,\"InventorySlotType\":1}"
            }, {
                "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Rope\",\"Id\":90,\"MaxInStack\":10,\"InventorySlotType\":1}"
            }, {
                "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Strong Rope\",\"Id\":91,\"MaxInStack\":10,\"InventorySlotType\":1}"
            }, {
                "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Boards\",\"Id\":92,\"MaxInStack\":10,\"InventorySlotType\":1}"
            }, {
                "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Net\",\"Id\":93,\"MaxInStack\":10,\"InventorySlotType\":1}"
            }, {
                "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Stone Block\",\"Id\":94,\"MaxInStack\":10,\"InventorySlotType\":1}"
            }, {
                "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Clay Block\",\"Id\":95,\"MaxInStack\":10,\"InventorySlotType\":1}"
            }, {
                "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Cured Leather\",\"Id\":96,\"MaxInStack\":10,\"InventorySlotType\":1}"
            }, {
                "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Cloth\",\"Id\":97,\"MaxInStack\":10,\"InventorySlotType\":1}"
            }, {
                "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Iron Bar\",\"Id\":98,\"MaxInStack\":10,\"InventorySlotType\":1}"
            }, {
                "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Sulfur\",\"Id\":99,\"MaxInStack\":10,\"InventorySlotType\":1}"
            }, {
                "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Bullet\",\"Id\":100,\"MaxInStack\":10,\"InventorySlotType\":1}"
            }, {
                "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Iron Plate\",\"Id\":101,\"MaxInStack\":10,\"InventorySlotType\":1}"
            }, {
                "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Gunpowder Level 1\",\"Id\":102,\"MaxInStack\":10,\"InventorySlotType\":1}"
            }, {
                "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Clay Forms For Weapons\",\"Id\":103,\"MaxInStack\":10,\"InventorySlotType\":1}"
            }, {
                "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Cuprum Bar\",\"Id\":104,\"MaxInStack\":10,\"InventorySlotType\":1}"
            }, {
                "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Cuprum Plate\",\"Id\":105,\"MaxInStack\":10,\"InventorySlotType\":1}"
            }, {
                "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Spare Parts\",\"Id\":106,\"MaxInStack\":10,\"InventorySlotType\":1}"
            }, {
                "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Peeled Saltpeter\",\"Id\":107,\"MaxInStack\":10,\"InventorySlotType\":1}"
            }, {
                "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Cuprum Muff\",\"Id\":108,\"MaxInStack\":10,\"InventorySlotType\":1}"
            }, {
                "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Clay Tiling\",\"Id\":109,\"MaxInStack\":10,\"InventorySlotType\":1}"
            }, {
                "Type": "ResourceItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Gunpowder Level 2\",\"Id\":110,\"MaxInStack\":10,\"InventorySlotType\":1}"
            }, {
                "Type": "WeaponItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Stone Axe\",\"Id\":30,\"MaxInStack\":1,\"InventorySlotType\":2,\"maxDurability\":100.0,\"durabilityDecrement\":2.0,\"instrumentType\":2,\"requireAmmoType\":0,\"attackAnimation\":5,\"attackDistance\":1.0,\"damage\":7,\"attackSpeed\":1.0,\"armor\":0}"
            }, {
                "Type": "WeaponItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Stone Hoe\",\"Id\":31,\"MaxInStack\":1,\"InventorySlotType\":2,\"maxDurability\":100.0,\"durabilityDecrement\":2.0,\"instrumentType\":32,\"requireAmmoType\":0,\"attackAnimation\":5,\"attackDistance\":1.0,\"damage\":8,\"attackSpeed\":0.800000011920929,\"armor\":0}"
            }, {
                "Type": "WeaponItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Stone Pickaxe\",\"Id\":32,\"MaxInStack\":1,\"InventorySlotType\":2,\"maxDurability\":100.0,\"durabilityDecrement\":2.0,\"instrumentType\":8,\"requireAmmoType\":0,\"attackAnimation\":5,\"attackDistance\":1.0,\"damage\":9,\"attackSpeed\":0.699999988079071,\"armor\":0}"
            }, {
                "Type": "WeaponItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Iron Axe\",\"Id\":33,\"MaxInStack\":1,\"InventorySlotType\":2,\"maxDurability\":100.0,\"durabilityDecrement\":1.0,\"instrumentType\":68,\"requireAmmoType\":0,\"attackAnimation\":5,\"attackDistance\":1.0,\"damage\":10,\"attackSpeed\":1.0,\"armor\":0}"
            }, {
                "Type": "WeaponItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Iron Hoe\",\"Id\":34,\"MaxInStack\":1,\"InventorySlotType\":2,\"maxDurability\":100.0,\"durabilityDecrement\":1.0,\"instrumentType\":64,\"requireAmmoType\":0,\"attackAnimation\":5,\"attackDistance\":1.0,\"damage\":12,\"attackSpeed\":0.800000011920929,\"armor\":0}"
            }, {
                "Type": "WeaponItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Iron Pickaxe\",\"Id\":35,\"MaxInStack\":1,\"InventorySlotType\":2,\"maxDurability\":100.0,\"durabilityDecrement\":1.0,\"instrumentType\":16,\"requireAmmoType\":0,\"attackAnimation\":5,\"attackDistance\":1.0,\"damage\":14,\"attackSpeed\":0.699999988079071,\"armor\":0}"
            }, {
                "Type": "WeaponItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Stone Knife\",\"Id\":36,\"MaxInStack\":1,\"InventorySlotType\":2,\"maxDurability\":100.0,\"durabilityDecrement\":2.0,\"instrumentType\":0,\"requireAmmoType\":0,\"attackAnimation\":5,\"attackDistance\":1.0,\"damage\":5,\"attackSpeed\":2.5,\"armor\":0}"
            }, {
                "Type": "WeaponItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Stone Spear\",\"Id\":37,\"MaxInStack\":1,\"InventorySlotType\":2,\"maxDurability\":50.0,\"durabilityDecrement\":1.0,\"instrumentType\":0,\"requireAmmoType\":0,\"attackAnimation\":4,\"attackDistance\":2.0,\"damage\":20,\"attackSpeed\":0.800000011920929,\"armor\":0}"
            }, {
                "Type": "WeaponItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Club\",\"Id\":38,\"MaxInStack\":1,\"InventorySlotType\":2,\"maxDurability\":100.0,\"durabilityDecrement\":2.0,\"instrumentType\":0,\"requireAmmoType\":0,\"attackAnimation\":5,\"attackDistance\":1.0,\"damage\":8,\"attackSpeed\":1.2000000476837159,\"armor\":0}"
            }, {
                "Type": "WeaponItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Bow\",\"Id\":39,\"MaxInStack\":1,\"InventorySlotType\":2,\"maxDurability\":100.0,\"durabilityDecrement\":1.0,\"instrumentType\":0,\"requireAmmoType\":1,\"attackAnimation\":1,\"attackDistance\":8.0,\"damage\":25,\"attackSpeed\":0.6000000238418579,\"armor\":0}"
            }, {
                "Type": "WeaponItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Stone Sword\",\"Id\":40,\"MaxInStack\":1,\"InventorySlotType\":2,\"maxDurability\":100.0,\"durabilityDecrement\":1.0,\"instrumentType\":0,\"requireAmmoType\":0,\"attackAnimation\":5,\"attackDistance\":1.0,\"damage\":25,\"attackSpeed\":1.100000023841858,\"armor\":0}"
            }, {
                "Type": "WeaponItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Stone Sword And Shield\",\"Id\":41,\"MaxInStack\":1,\"InventorySlotType\":2,\"maxDurability\":200.0,\"durabilityDecrement\":1.0,\"instrumentType\":0,\"requireAmmoType\":0,\"attackAnimation\":5,\"attackDistance\":1.0,\"damage\":25,\"attackSpeed\":0.800000011920929,\"armor\":18}"
            }, {
                "Type": "AmmoItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Wooden Arrow\",\"Id\":42,\"MaxInStack\":25,\"InventorySlotType\":4,\"damage\":5,\"ammoType\":1}"
            }, {
                "Type": "AmmoItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Bone Arrow\",\"Id\":43,\"MaxInStack\":30,\"InventorySlotType\":4,\"damage\":10,\"ammoType\":1}"
            }, {
                "Type": "AmmoItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Iron Arrow\",\"Id\":44,\"MaxInStack\":35,\"InventorySlotType\":4,\"damage\":15,\"ammoType\":1}"
            }, {
                "Type": "AmmoItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Wooden Arrow\",\"Id\":42,\"MaxInStack\":30,\"InventorySlotType\":4,\"damage\":0,\"ammoType\":1}"
            }, {
                "Type": "WeaponItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Iron Spear\",\"Id\":45,\"MaxInStack\":1,\"InventorySlotType\":2,\"maxDurability\":100.0,\"durabilityDecrement\":1.0,\"instrumentType\":0,\"requireAmmoType\":0,\"attackAnimation\":4,\"attackDistance\":2.0,\"damage\":30,\"attackSpeed\":0.800000011920929,\"armor\":0}"
            }, {
                "Type": "WeaponItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Iron Sword\",\"Id\":46,\"MaxInStack\":1,\"InventorySlotType\":2,\"maxDurability\":150.0,\"durabilityDecrement\":1.0,\"instrumentType\":0,\"requireAmmoType\":0,\"attackAnimation\":5,\"attackDistance\":1.0,\"damage\":35,\"attackSpeed\":1.2000000476837159,\"armor\":0}"
            }, {
                "Type": "WeaponItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Iron Sword And Shield\",\"Id\":47,\"MaxInStack\":1,\"InventorySlotType\":2,\"maxDurability\":250.0,\"durabilityDecrement\":1.0,\"instrumentType\":0,\"requireAmmoType\":0,\"attackAnimation\":5,\"attackDistance\":1.0,\"damage\":35,\"attackSpeed\":0.8999999761581421,\"armor\":0}"
            }, {
                "Type": "WeaponItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Iron Knife\",\"Id\":48,\"MaxInStack\":1,\"InventorySlotType\":2,\"maxDurability\":100.0,\"durabilityDecrement\":1.0,\"instrumentType\":0,\"requireAmmoType\":0,\"attackAnimation\":5,\"attackDistance\":1.0,\"damage\":10,\"attackSpeed\":3.0,\"armor\":0}"
            }, {
                "Type": "WeaponItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Pistol\",\"Id\":49,\"MaxInStack\":1,\"InventorySlotType\":2,\"maxDurability\":100.0,\"durabilityDecrement\":1.0,\"instrumentType\":0,\"requireAmmoType\":2,\"attackAnimation\":2,\"attackDistance\":8.0,\"damage\":25,\"attackSpeed\":1.2000000476837159,\"armor\":0}"
            }, {
                "Type": "WeaponItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Rapier\",\"Id\":50,\"MaxInStack\":1,\"InventorySlotType\":2,\"maxDurability\":100.0,\"durabilityDecrement\":1.0,\"instrumentType\":0,\"requireAmmoType\":0,\"attackAnimation\":5,\"attackDistance\":1.0,\"damage\":35,\"attackSpeed\":1.2999999523162842,\"armor\":0}"
            }, {
                "Type": "WeaponItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Musket\",\"Id\":51,\"MaxInStack\":1,\"InventorySlotType\":2,\"maxDurability\":100.0,\"durabilityDecrement\":1.0,\"instrumentType\":0,\"requireAmmoType\":2,\"attackAnimation\":3,\"attackDistance\":10.0,\"damage\":40,\"attackSpeed\":0.5,\"armor\":0}"
            }, {
                "Type": "WeaponItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Revolver\",\"Id\":52,\"MaxInStack\":1,\"InventorySlotType\":2,\"maxDurability\":150.0,\"durabilityDecrement\":1.0,\"instrumentType\":0,\"requireAmmoType\":4,\"attackAnimation\":2,\"attackDistance\":8.0,\"damage\":30,\"attackSpeed\":1.5,\"armor\":0}"
            }, {
                "Type": "WeaponItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Winchester\",\"Id\":53,\"MaxInStack\":1,\"InventorySlotType\":2,\"maxDurability\":150.0,\"durabilityDecrement\":1.0,\"instrumentType\":0,\"requireAmmoType\":4,\"attackAnimation\":3,\"attackDistance\":10.0,\"damage\":50,\"attackSpeed\":1.100000023841858,\"armor\":0}"
            }, {
                "Type": "AmmoItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Revolver and Winchester Ammo\",\"Id\":54,\"MaxInStack\":50,\"InventorySlotType\":4,\"damage\":15,\"ammoType\":4}"
            }, {
                "Type": "AmmoItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Pistol and Musket Ammo\",\"Id\":55,\"MaxInStack\":1,\"InventorySlotType\":4,\"damage\":10,\"ammoType\":2}"
            }, {
                "Type": "AmmoItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Pistol and Musket Ammo\",\"Id\":55,\"MaxInStack\":50,\"InventorySlotType\":4,\"damage\":0,\"ammoType\":2}"
            }, {
                "Type": "BagItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Palm Bag\",\"Id\":56,\"MaxInStack\":1,\"InventorySlotType\":256,\"additionalSlots\":5}"
            }, {
                "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Palm Headband\",\"Id\":57,\"MaxInStack\":1,\"InventorySlotType\":16,\"maxDurability\":50.0,\"durabilityDecrement\":1.0,\"armor\":3,\"movementSpeed\":0.0,\"foodDecrement\":1,\"waterDecrement\":1}"
            }, {
                "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Palm Chest\",\"Id\":58,\"MaxInStack\":1,\"InventorySlotType\":32,\"maxDurability\":50.0,\"durabilityDecrement\":1.0,\"armor\":2,\"movementSpeed\":0.0,\"foodDecrement\":1,\"waterDecrement\":1}"
            }, {
                "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Palm Pants\",\"Id\":59,\"MaxInStack\":1,\"InventorySlotType\":64,\"maxDurability\":50.0,\"durabilityDecrement\":1.0,\"armor\":3,\"movementSpeed\":0.0,\"foodDecrement\":1,\"waterDecrement\":1}"
            }, {
                "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Palm Shoes\",\"Id\":60,\"MaxInStack\":1,\"InventorySlotType\":128,\"maxDurability\":50.0,\"durabilityDecrement\":1.0,\"armor\":2,\"movementSpeed\":1.0,\"foodDecrement\":1,\"waterDecrement\":1}"
            }, {
                "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Bone Bandage\",\"Id\":61,\"MaxInStack\":1,\"InventorySlotType\":16,\"maxDurability\":75.0,\"durabilityDecrement\":1.0,\"armor\":4,\"movementSpeed\":0.0,\"foodDecrement\":1,\"waterDecrement\":1}"
            }, {
                "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Bone Chest\",\"Id\":62,\"MaxInStack\":1,\"InventorySlotType\":64,\"maxDurability\":80.0,\"durabilityDecrement\":1.0,\"armor\":6,\"movementSpeed\":0.0,\"foodDecrement\":1,\"waterDecrement\":1}"
            }, {
                "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Bone Pants\",\"Id\":63,\"MaxInStack\":1,\"InventorySlotType\":64,\"maxDurability\":80.0,\"durabilityDecrement\":1.0,\"armor\":4,\"movementSpeed\":0.0,\"foodDecrement\":1,\"waterDecrement\":1}"
            }, {
                "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Bone Shoes\",\"Id\":64,\"MaxInStack\":1,\"InventorySlotType\":128,\"maxDurability\":75.0,\"durabilityDecrement\":1.0,\"armor\":3,\"movementSpeed\":1.5,\"foodDecrement\":1,\"waterDecrement\":1}"
            }, {
                "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Wooden Helmet\",\"Id\":65,\"MaxInStack\":1,\"InventorySlotType\":16,\"maxDurability\":100.0,\"durabilityDecrement\":1.0,\"armor\":7,\"movementSpeed\":-1.0,\"foodDecrement\":2,\"waterDecrement\":2}"
            }, {
                "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Wooden Chest\",\"Id\":66,\"MaxInStack\":1,\"InventorySlotType\":32,\"maxDurability\":100.0,\"durabilityDecrement\":1.0,\"armor\":8,\"movementSpeed\":-1.0,\"foodDecrement\":3,\"waterDecrement\":3}"
            }, {
                "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Wooden Pants\",\"Id\":67,\"MaxInStack\":1,\"InventorySlotType\":64,\"maxDurability\":100.0,\"durabilityDecrement\":1.0,\"armor\":8,\"movementSpeed\":-1.0,\"foodDecrement\":3,\"waterDecrement\":3}"
            }, {
                "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Wooden Shoes\",\"Id\":68,\"MaxInStack\":1,\"InventorySlotType\":128,\"maxDurability\":100.0,\"durabilityDecrement\":1.0,\"armor\":7,\"movementSpeed\":-1.0,\"foodDecrement\":2,\"waterDecrement\":2}"
            }, {
                "Type": "BagItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Cloth Bag\",\"Id\":69,\"MaxInStack\":1,\"InventorySlotType\":256,\"additionalSlots\":10}"
            }, {
                "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Cloth Headband\",\"Id\":70,\"MaxInStack\":1,\"InventorySlotType\":16,\"maxDurability\":85.0,\"durabilityDecrement\":1.0,\"armor\":3,\"movementSpeed\":0.0,\"foodDecrement\":1,\"waterDecrement\":1}"
            }, {
                "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Cloth Chest\",\"Id\":71,\"MaxInStack\":1,\"InventorySlotType\":32,\"maxDurability\":85.0,\"durabilityDecrement\":1.0,\"armor\":4,\"movementSpeed\":0.0,\"foodDecrement\":1,\"waterDecrement\":1}"
            }, {
                "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Cloth Pants\",\"Id\":72,\"MaxInStack\":1,\"InventorySlotType\":64,\"maxDurability\":85.0,\"durabilityDecrement\":1.0,\"armor\":4,\"movementSpeed\":0.0,\"foodDecrement\":1,\"waterDecrement\":1}"
            }, {
                "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Cloth Shoes\",\"Id\":73,\"MaxInStack\":1,\"InventorySlotType\":128,\"maxDurability\":85.0,\"durabilityDecrement\":1.0,\"armor\":3,\"movementSpeed\":2.0,\"foodDecrement\":1,\"waterDecrement\":1}"
            }, {
                "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Heavy Bone Helmet\",\"Id\":74,\"MaxInStack\":1,\"InventorySlotType\":16,\"maxDurability\":130.0,\"durabilityDecrement\":1.0,\"armor\":13,\"movementSpeed\":-2.0,\"foodDecrement\":3,\"waterDecrement\":3}"
            }, {
                "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Heavy Bone Chest\",\"Id\":75,\"MaxInStack\":1,\"InventorySlotType\":32,\"maxDurability\":140.0,\"durabilityDecrement\":1.0,\"armor\":14,\"movementSpeed\":-2.0,\"foodDecrement\":4,\"waterDecrement\":4}"
            }, {
                "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Heavy Bone Pants\",\"Id\":76,\"MaxInStack\":1,\"InventorySlotType\":64,\"maxDurability\":140.0,\"durabilityDecrement\":1.0,\"armor\":14,\"movementSpeed\":-2.0,\"foodDecrement\":4,\"waterDecrement\":4}"
            }, {
                "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Heavy Bone Shoes\",\"Id\":77,\"MaxInStack\":1,\"InventorySlotType\":128,\"maxDurability\":130.0,\"durabilityDecrement\":1.0,\"armor\":13,\"movementSpeed\":-2.0,\"foodDecrement\":3,\"waterDecrement\":3}"
            }, {
                "Type": "BagItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Skin Bag\",\"Id\":78,\"MaxInStack\":1,\"InventorySlotType\":256,\"additionalSlots\":15}"
            }, {
                "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Pirate Hat\",\"Id\":79,\"MaxInStack\":1,\"InventorySlotType\":16,\"maxDurability\":95.0,\"durabilityDecrement\":1.0,\"armor\":7,\"movementSpeed\":0.0,\"foodDecrement\":1,\"waterDecrement\":1}"
            }, {
                "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Pirate Chest\",\"Id\":80,\"MaxInStack\":1,\"InventorySlotType\":32,\"maxDurability\":95.0,\"durabilityDecrement\":1.0,\"armor\":8,\"movementSpeed\":0.0,\"foodDecrement\":1,\"waterDecrement\":1}"
            }, {
                "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Pirate Pants\",\"Id\":81,\"MaxInStack\":1,\"InventorySlotType\":64,\"maxDurability\":95.0,\"durabilityDecrement\":1.0,\"armor\":8,\"movementSpeed\":0.0,\"foodDecrement\":1,\"waterDecrement\":1}"
            }, {
                "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Pirate Shoes\",\"Id\":82,\"MaxInStack\":1,\"InventorySlotType\":128,\"maxDurability\":95.0,\"durabilityDecrement\":1.0,\"armor\":7,\"movementSpeed\":2.0,\"foodDecrement\":1,\"waterDecrement\":1}"
            }, {
                "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Skin Chest\",\"Id\":83,\"MaxInStack\":1,\"InventorySlotType\":32,\"maxDurability\":80.0,\"durabilityDecrement\":1.0,\"armor\":8,\"movementSpeed\":0.0,\"foodDecrement\":1,\"waterDecrement\":1}"
            }, {
                "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Skin Pants\",\"Id\":84,\"MaxInStack\":1,\"InventorySlotType\":64,\"maxDurability\":80.0,\"durabilityDecrement\":1.0,\"armor\":8,\"movementSpeed\":0.0,\"foodDecrement\":1,\"waterDecrement\":1}"
            }, {
                "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Skin Shoes\",\"Id\":85,\"MaxInStack\":1,\"InventorySlotType\":128,\"maxDurability\":80.0,\"durabilityDecrement\":1.0,\"armor\":8,\"movementSpeed\":2.0,\"foodDecrement\":1,\"waterDecrement\":1}"
            }, {
                "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Metal Helmet\",\"Id\":86,\"MaxInStack\":1,\"InventorySlotType\":16,\"maxDurability\":150.0,\"durabilityDecrement\":1.0,\"armor\":15,\"movementSpeed\":-2.0,\"foodDecrement\":3,\"waterDecrement\":3}"
            }, {
                "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Metal Chest\",\"Id\":87,\"MaxInStack\":1,\"InventorySlotType\":32,\"maxDurability\":160.0,\"durabilityDecrement\":1.0,\"armor\":16,\"movementSpeed\":-2.0,\"foodDecrement\":3,\"waterDecrement\":3}"
            }, {
                "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Metal Pants\",\"Id\":88,\"MaxInStack\":1,\"InventorySlotType\":64,\"maxDurability\":160.0,\"durabilityDecrement\":1.0,\"armor\":16,\"movementSpeed\":-2.0,\"foodDecrement\":3,\"waterDecrement\":3}"
            }, {
                "Type": "ArmorItemInfo, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null",
                "Json": "{\"Name\":\"Metal Shoes\",\"Id\":89,\"MaxInStack\":1,\"InventorySlotType\":128,\"maxDurability\":150.0,\"durabilityDecrement\":1.0,\"armor\":15,\"movementSpeed\":0.0,\"foodDecrement\":2,\"waterDecrement\":2}"
            }]
        };

    $(document).on('click', '#createItems', function () {
        $.ajax({
            url: '/api/item',
            method: 'POST',
            data: a,
        });
    });

    $(document).on('click', '#getItems', function () {
        $.ajax({
            url: '/api/item',
            method: 'GET',

        });
    });


</script>
</body>
</html>
