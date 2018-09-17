<tr>
    <td>
        <select class="item form-control" name="items[{{$index}}][itemID]">
            @foreach ($items as $item):
            <option value="{{$item->ID}}"
                    {{(isset($item) && $item->ID == $component->itemID) ? "selected" : ''}}>
                {{$item->Name}}
            </option>
            @endforeach
        </select>
    </td>
    <td>
        <div class="form-group">
            <input class="form-control" name="items[{{$counter}}][minValue]" type="number"
                   value="{{ $component->minValue or 0}}">
        </div>
    </td>
    <td>
        <div class="form-group">
            <input class="form-control" name="items[{{$counter}}][maxValue]" type="number"
                   value="{{ $component->maxValue or 0}}">
        </div>
    </td>
    <td>
        <button type="button" class="btn btn-danger deleteItem">Delete</button>
    </td>
</tr>