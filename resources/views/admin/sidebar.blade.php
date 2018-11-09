<div class="{{$sidebarClass or "col-md-3"}} {{ isset($hideSidebar) && $hideSidebar ? 'd-none' : '' }}" id="sidebar">
    <div class="card">
        <div class="card-header">
            Sidebar
        </div>

        <ul class="list-group list-group-flush">

            @foreach($sidebar['list'] as $item)
                @if($item->name != 'Laravel logs' || Auth::user()->role)

                    <li class="list-group-item">
                        <a class="card-link" href="{{ url($item->url) }}">{{ $item->name }}</a>
                        @if($item->name == 'Ban List' && $sidebar['newPlayersInBan'])
                            <span class="ban-notification">{{ $sidebar['newPlayersInBan'] }}</span>
                        @endif
                    </li>
                @endif
            @endforeach
        </ul>

    </div>
</div>
