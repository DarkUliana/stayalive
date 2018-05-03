<tr>
    <td>
        <div class="number" style="display: none;">{{$counter}}</div>
        <div class="form-group">
            <input class="form-control" name="items[{{$counter}}][imageName]" type="text"
                   value="{{ $item->imageName or ''}}">
        </div>
    </td>
    <td>
        <div class="form-group">
            <input class="form-control" name="items[{{$counter}}][count]" type="number"
                   value="{{ $item->count or ''}}">
        </div>
    </td>
    <td>
        <div class="radio">
            <label><input name="items[{{$counter}}][inStuck]" type="radio"
                          value="1" {{ (isset($item) && 1 == $item->inStuck) ? 'checked' : '' }}> Yes</label>
        </div>
        <div class="radio">
            <label><input name="items[{{$counter}}][inStuck]" type="radio"
                          value="0" @if (isset($item)) {{ (0 == $item->inStuck) ? 'checked' : '' }} @else {{ 'checked' }} @endif>
                No</label>
        </div>
    </td>
    <td>
        <button type="button" class="btn btn-danger deleteShopItem">Delete</button>
    </td>
</tr>