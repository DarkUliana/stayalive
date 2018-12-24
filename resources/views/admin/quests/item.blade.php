<div class="form-group" id="questObject">
    <label for="itemID" class="col-md-4 control-label">{{ $name }}</label>
    <div class="col-md-6">
        <input type="hidden" name="field[fieldID]" value="{{ $ID}}">
        @if($inputType == 'integer')
            <select name="field[value]" class="form-control" id="itemID">
                @foreach ($items as $value)
                    <option value="{{ isset($value->noteID) ? $value->noteID : $value->ID }}"
                            {{ (isset($quest->field) && (isset($value->noteID) && ($value->noteID == $quest->field->value))
                            || (!isset($value->noteID) && ($quest->field->value == $value->ID))) ? 'selected' : ''}}>
                        {{ isset($value->name) ? $value->name : (isset($value->Name) ? $value->Name : $value->noteSubject) }}
                    </option>
                @endforeach
            </select>
        @elseif($name == 'ObjectToRestore')
            <select name="field[value]" class="form-control" id="itemID">
                @foreach ($items as $value)
                    <option value="{{ $value->name }}" {{ (isset($quest->field) && $quest->field->value == $value->name) ? 'selected' : ''}}>{{ $value->name }}</option>
                @endforeach
            </select>
        @else
            <input type="text" name="field[value]" class="form-control" id="typeID"
                   value="@isset($quest->field->value){{ $quest->field->value }}@endisset">
        @endif
    </div>
</div>