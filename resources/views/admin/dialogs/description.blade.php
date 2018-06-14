<tr>
    <td>
        <div class="counter" style="display: none;">{{$index}}</div>
        <input type="hidden" name="{{ $name or 'descriptions' }}[{{ $index }}][number]"
               value="{{ $value->number or $index }}" class="number">
        <div class="form-group">
            <select class="form-control"  name="{{ $name or 'descriptions' }}[{{ $index }}][descriptionID]">
                @foreach($descriptions as $description)
                    <option value="{{ $description->ID }}" {{ (isset($value) && $value->descriptionID == $description->ID) ? 'selected' : ''}}>{{ $description->key }}</option>
                @endforeach
            </select>
        </div>
    </td>
    <td>
        <input class="form-control"  type="number" name="{{ $name or 'descriptions' }}[{{ $index }}][speaker]" value="{{ $value->speaker or 0 }}">
    </td>
    <td>
        <button type="button" class="btn btn-danger deleteDescription">Delete</button>
    </td>
</tr>