<tr>
    <td>
        <div class="counter" style="display: none;">{{$index}}</div>
        <div class="form-group">
            <select class="form-control"  name="loot[{{ $index }}][itemID]">
                @foreach($items as $item)
                    <option value="{{ $item->ID }}" {{ (isset($value) && $value->itemID == $item->ID) ? 'selected' : ''}}>{{ $item->Name }}</option>
                @endforeach
            </select>
        </div>
    </td>
    <td>
        <div class="form-group">
            <input class="form-control" type="number" name="loot[{{ $index }}][minAmount]" value="{{ (isset($value)) ? $value->minAmount : 0}}">
        </div>
    </td>
    <td>
        <div class="form-group">
            <input class="form-control" type="number" name="loot[{{ $index }}][maxAmount]" value="{{ (isset($value)) ? $value->maxAmount : 0}}">
        </div>
    </td>
    <td>
        <div class="form-group">
            <input class="form-control" type="number" step="0.01" name="loot[{{ $index }}][chance]" value="{{ (isset($value)) ? $value->chance : 0}}">
        </div>
    </td>
    <td>
        <button type="button" class="btn btn-danger deleteItem">Delete</button>
    </td>
</tr>