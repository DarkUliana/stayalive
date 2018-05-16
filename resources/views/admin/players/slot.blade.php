<tr>
    <td>{{ $slot->Index }}</td>
    <td>
        <select>
            @foreach($items as $item)
                <option value="{{ $item->ID }}"
                        @if($item->ID == $slot->itemID)
                        selected
                        @endif
                >{{ $item->Name }}</option>
            @endforeach
        </select>{{ $slot->item->Name }}</td>
    <td>
        <input type="number" value="{{ $slot->CurrentCount }}" min="-1" max="{{ $item->item->MaxInStack }}">
    </td>
    <td><input type="number" value="{{ $slot->CurrentDurability }}" min="0"
               max="{{ App\ItemProperty::where('itemID', $slot->itemID)->where('propertyID', 1)->first()->value }}">
    </td>
</tr>