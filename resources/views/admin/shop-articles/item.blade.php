<tr>
    <td>
        <div class="number" style="display: none;">{{$counter}}</div>
        <div class="form-group">
            <select name="items[{{$counter}}][imageName]" class="form-control">
                @foreach($items as $name)
                    <option value="{{ $name }}" {{ isset($item) && $item->imageName == $name ? 'selected' : '' }}>
                        {{ $name }}</option>
                @endforeach
            </select>
        </div>
    </td>
    <td>
        <div class="form-group">
            <input class="form-control" name="items[{{$counter}}][count]" type="number"
                   value="{{ $item->count or 0}}">
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