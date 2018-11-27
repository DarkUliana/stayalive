<div class="form-group" id="questObject">
    <label for="itemID" class="col-md-4 control-label">{{ $name }}</label>
    <div class="col-md-6">
        <input type="hidden" name="field[fieldID]" value="{{ $ID}}">
        @if($inputType == 'integer')
            <select name="field[value]" class="form-control" id="itemID">
                @foreach ($items as $value)
                    <option value="{{ $value->ID }}" {{ (isset($quest->field->value) && $quest->field->value == (string)$value->ID) ? 'selected' : ''}}>{{ $value->name or $value->Name }}</option>
                @endforeach
            </select>
        @elseif($name == 'ObjectToRestore')
            <select name="field[value]" class="form-control" id="itemID">
                @foreach ($items as $value)
                    <option value="{{ $value->name }}" {{ (isset($quest->field->value) && $quest->field->value == $value->name) ? 'selected' : ''}}>{{ $value->name }}</option>
                @endforeach
            </select>
        @else
            <input type="text" name="field[value]" class="form-control" id="typeID"
                   value="@isset($quest->field->value){{ $quest->field->value }}@endisset">
        @endif
    </div>
</div>