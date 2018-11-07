<td>
    <div class="box" data-id="{{ $item->ID }}" style="background: {{ $item->cell->color }}">
        <div class="box-inner">
            <div class="techLevel">{{ $item->techLevel }}</div>
            @if($item->technologyType == 1)
                <div class="img-border"></div>
            @else
                <img src="{{ asset('images/' . $item->technology->image->name) }}">
            @endif
        </div>
    </div>
</td>