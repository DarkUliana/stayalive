<td>
    @php
        $count = isset($restorableObject) ? $restorableObject->cells->where('floor', $floor->floorIndex)->where('index', $item->cellIndex)->count() : 0;
    @endphp
    <div class="box {{ $count ? 'dark-border' : '' }}"
         data-id="{{ $item->ID }}" style="background: {{ $item->cell->color }}">
        <input type="hidden" name="deckCells[{{ $floor->floorIndex . $loop->index }}][floor]"
               value="{{ $floor->floorIndex }}" {{ $count ? '' : 'disabled' }}>

        <input type="hidden" name="deckCells[{{ $floor->floorIndex . $loop->index }}][index]"
               value="{{ $item->cellIndex }}" {{ $count ? '' : 'disabled' }}>

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