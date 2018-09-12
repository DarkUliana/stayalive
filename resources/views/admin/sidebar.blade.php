<div class="{{$sidebarClass or "col-md-3"}} {{ isset($hideSidebar) && $hideSidebar ? 'd-none' : '' }}" id="sidebar">
    <div class="card">
        <div class="card-header">
            Sidebar
        </div>

        <ul class="list-group list-group-flush">
            <li class="list-group-item"><a class="card-link" href="{{ url('/players') }}">
                    Players
                </a></li>
            <li class="list-group-item"><a class="card-link" href="{{ url('/base-player') }}">
                    Base Player
                </a></li>
            <li class="list-group-item"><a class="card-link" href="{{ url('/technologies') }}">
                    Technologies
                </a></li>
            <li class="list-group-item"><a class="card-link" href="{{ url('/items') }}">
                    Items
                </a></li>
            <li class="list-group-item"><a class="card-link" href="{{ url('/recipes') }}">
                    Recipes
                </a></li>
            <li class="list-group-item"><a class="card-link" href="{{ url('/descriptions') }}">
                    Descriptions
                </a></li>
            <li class="list-group-item"><a class="card-link" href="{{ url('/languages') }}">
                    Languages
                </a></li>
            <li class="list-group-item"><a class="card-link" href="{{ url('/shop-articles') }}">
                    Shop Articles
                </a></li>
            <li class="list-group-item"><a class="card-link" href="{{ url('/quests') }}">
                    Quests
                </a></li>
            <li class="list-group-item"><a class="card-link" href="{{ url('/versions') }}">
                    Versions
                </a></li>
            <li class="list-group-item"><a class="card-link" href="{{ url('/dialogs') }}">
                    Dialogs
                </a></li>
            <li class="list-group-item"><a class="card-link" href="{{ url('/rewards') }}">
                    Rewards
                </a></li>
            <li class="list-group-item"><a class="card-link" href="{{ url('/restorable-objects') }}">
                    Restorable Objects
                </a></li>
            <li class="list-group-item"><a class="card-link" href="{{ url('/mobs') }}">
                    Mobs
                </a></li>
            <li class="list-group-item"><a class="card-link" href="{{ url('/loot') }}">
                    Loot
                </a></li>
            <li class="list-group-item"><a class="card-link" href="{{ url('/notifications') }}">
                    Notifications
                </a></li>
            <li class="list-group-item"><a class="card-link" href="{{ url('/banlist') }}">
                    BanList
                </a></li>
            <li class="list-group-item"><a class="card-link" href="{{ url('/event-islands') }}">
                    Event Islands
                </a></li>
            <li class="list-group-item"><a class="card-link" href="{{ url('/quest-replacement-times') }}">
                    Quest replacements times
                </a></li>
            <li class="list-group-item"><a class="card-link" href="{{ url('/diary-storage-notes') }}">
                    Diary storage notes
                </a></li>
            <li class="list-group-item"><a class="card-link" href="{{ url('/techcoin-settings') }}">
                    Techcoin Settings
                </a></li>
        </ul>

    </div>
</div>
