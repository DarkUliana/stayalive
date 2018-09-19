<tr data-index="{{ $index }}">
    <td>
        <select class="item form-control" name="items[{{$index}}][itemID]">
            @foreach ($items as $one):
            <option value="{{$one->ID}}"
                    {{(isset($item) && $item->itemID == $one->ID) ? "selected" : ''}}>
                {{$one->Name}}
            </option>
            @endforeach
        </select>
    </td>
    <td>
        <div class="form-group">
            <input class="form-control" name="items[{{$index}}][minValue]" type="number"
                   value="{{ $item->minValue or 0}}">
        </div>
    </td>
    <td>
        <div class="form-group">
            <input class="form-control" name="items[{{$index}}][maxValue]" type="number"
                   value="{{ $item->maxValue or 0}}">
        </div>
    </td>
    <td>
        <button type="button" class="btn btn-danger deleteItem">Delete</button>
    </td>
</tr>