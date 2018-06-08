<tr>
    <td>
        <div class="d-none counter">{{ $counter or $loop->index }}</div>
        <select class="form-control itemSelect" name="items[{{ $counter or $loop->index }}][imageName]">
            @foreach($items as $item)
                <option value="{{ $item->Name }}"
                        @if(isset($slot) && $item->Name == $slot->imageName)
                        selected
                        @endif
                >{{ $item->Name }}</option>
            @endforeach
        </select>
    </td>
    <td>
        <input name="items[{{ $counter or $loop->index }}][count]" type="number" class="form-control count"
               value="{{ isset($slot) ? $slot->count : $firstItem->MaxInStack }}" min="-1" max="{{ isset($slot) ? $slot->item->MaxInStack : $firstItem->MaxInStack }}">
    </td>
    <td>
        <button type="button" class="btn btn-danger deleteItem">Delete</button>
    </td>
</tr>