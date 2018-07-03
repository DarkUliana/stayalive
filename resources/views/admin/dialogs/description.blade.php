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
        <div class="form-group">
            <select class="form-control"  name="{{ $name or 'descriptions' }}[{{ $index }}][speaker]">
                @foreach($speakers as $key => $speaker)
                    <option value="{{ $key }}" {{ (isset($value) && $value->speaker == $key) ? 'selected' : ''}}>{{ $speaker }}</option>
                @endforeach
            </select>
        </div>
    </td>
    <td>
        <button type="button" class="btn btn-danger deleteDescription">Delete</button>
    </td>
</tr>