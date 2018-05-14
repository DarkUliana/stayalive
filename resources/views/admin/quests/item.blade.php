<div class="form-group" id="questObject">
    <label for="typeID" class="col-md-4 control-label">{{ $name }}</label>
    <div class="col-md-6">
        <input type="hidden" name="field[fieldID]" value="{{ $ID}}">
        <select name="field[value]" class="form-control" id="typeID">
            @foreach ($items as $value)
                <option value="{{ $value->ID }}" {{ (isset($quest->field->value) && $quest->field->value == $value->ID) ? 'selected' : ''}}>{{ $value->name or $value->Name }}</option>
            @endforeach
        </select>
    </div>
</div>