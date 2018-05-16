<tr>
    <td>
        <input type="hidden" name="items[{{ $loop->index }}][Index]" value="{{ $slot['Index'] }}">
        {{ $slot['Index'] }}
    </td>
    <td>
        <select class="form-control itemSelect" name="items[{{ $loop->index }}][itemID]">
            <option value="-1"></option>
            @foreach($items as $item)
                <option value="{{ $item->ID }}"
                        @if($item->ID == $slot['itemID'])
                        selected
                        @endif
                >{{ $item->Name }}</option>
            @endforeach
        </select>
    </td>
    <td>
        <input name="items[{{ $loop->index }}][CurrentCount]" type="number" class="form-control count"
               value="{{ $slot['CurrentCount']}}" min="-1" max="{{ $slot['maxInStack'] }}">
    </td>
    <td>
        <input name="items[{{ $loop->index }}][currentDurability]" type="number" class="form-control durability"
               value="{{ $slot['currentDurability']}}" min="0" max="{{ $slot['maxDurability'] }}">
    </td>
</tr>