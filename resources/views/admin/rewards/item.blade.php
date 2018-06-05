<tr>
    <td>
        <div class="number" style="display: none;">{{$loop->index or $counter}}</div>
        <div class="form-group">
            <select class="component form-control" name="components[{{$loop->index or $counter}}][itemID]">
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
            <input class="form-control" name="components[{{$loop->index or $counter}}][count]" type="number"
                   value="{{ $component->count or 0}}">
        </div>
    </td>
    <td>
        <div class="form-group">
            <input class="form-control" name="components[{{$loop->index or $counter}}][rarity]" type="number"
                   value="{{ $component->rarity or 0}}">
        </div>
    </td>
    <td>
        <button type="button" class="btn btn-danger deleteComponent">Delete</button>
    </td>
</tr>