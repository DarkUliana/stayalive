<tr>
    <td>
        <div class="counter" style="display: none;">{{ $loop->index or $counter }}</div>
        <div class="form-group">
            <input type="hidden" name="{{ $arrayName }}[{{ $loop->index or $counter }}][isTopList]" value="{{ $arrayName=='topListItems'?1:0 }}">
            <select class="form-control" name="{{ $arrayName }}[{{ $loop->index or $counter }}][ItemID]">
                @foreach ($items as $item):
                <option value="{{ $item->ID }}"
                        {{ isset($objectItem) && $item->ID == $objectItem->ItemID ? 'selected="selected"' : '' }}>
                    {{ $item->Name }}
                </option>
                @endforeach
            </select>
        </div>
    </td>
    <td>
        <div class="form-group">
            <input class="form-control" name="{{ $arrayName }}[{{ $loop->index or $counter }}][RequiredCount]"
                   type="number"
                   value="{{ $objectItem->RequiredCount or 0}}">
        </div>
    </td>
    <td>
        <button type="button" class="btn btn-danger deleteItem">Delete</button>
    </td>
</tr>