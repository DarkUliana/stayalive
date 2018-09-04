<tr>
    <td>
        <div class="d-none counter">{{ $counter or $loop->index }}</div>
        <select class="itemSelect" name="items[{{ $counter or $loop->index }}][imageName]">
            @foreach($items as $item)
                <option value="{{ $item->Name }}"
                        @if(isset($slot) && $item->Name == $slot->imageName)
                        selected
                        @endif
                >{{ $item->Name }}</option>
            @endforeach
            @foreach($rewards as $reward)
                <option value="{{ $reward->name }}"
                        @if(isset($slot) && $reward->vame == $slot->imageName)
                        selected
                        @endif
                >{{ $reward->name }}</option>
            @endforeach
        </select>
    </td>
    <td>
        <input name="items[{{ $counter or $loop->index }}][count]" type="number" class="form-control count"
               value="{{ isset($slot) ? $slot->count : 0 }}" min="-1"
               max="{{ (isset($slot) && isset($slot->item->MaxInStack)) ?
               ($slot->item->MaxInStack==1 ? 1 : '') :
               ($firstItem->MaxInStack==1 ? 1 : '') }}">
    </td>
    <td>
        <button type="button" class="btn btn-danger deleteItem">Delete</button>
    </td>
</tr>