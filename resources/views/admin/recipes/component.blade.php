<tr>
    <td>
        <div class="number" style="display: none;">{{$counter}}</div>
        <div class="form-group">
            <select class="component" name="components[{{$counter}}][itemID]">
                @foreach ($items as $item):
                <option value="{{$item->ID}}"
                        @if(isset($component) && $item->ID == $component->itemID)selected="selected"@endif>
                    {{$item->Name}}
                </option>
                @endforeach
            </select>
        </div>
    </td>
    <td>
        <div class="form-group">
            <input class="form-control" name="components[{{$counter}}][neededCount]" type="number"
                   value="{{ $component->neededCount or ''}}">
        </div>
    </td>
    <td>
        <button type="button" class="btn btn-danger deleteComponent">Delete</button>
    </td>
</tr>