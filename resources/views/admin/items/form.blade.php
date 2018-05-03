<div class="form-group {{ $errors->has('Name') ? 'has-error' : ''}}">
    <label for="Name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="Name" type="text" id="Name" value="{{ $item->Name or ''}}">
        {!! $errors->first('Name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('MaxInStack') ? 'has-error' : ''}}">
    <label for="MaxInStack" class="col-md-4 control-label">{{ 'Maxinstack' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="MaxInStack" type="number" id="MaxInStack"
               value="{{ $item->MaxInStack or ''}}">
        {!! $errors->first('MaxInStack', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('InventorySlotType') ? 'has-error' : ''}}">
    <label for="InventorySlotType" class="col-md-4 control-label">{{ 'InventorySlotType' }}</label>
    <div class="col-md-6">
        <select id="inventorySlotType" name="InventorySlotType">
            @foreach($types as $type)
                <option value="{{ $type->type }}" @if(isset($item->InventorySlotType) && $item->InventorySlotType == $type->type)
                             selected
                        @endif>{{ $type->typeName }}</option>
            @endforeach
        </select>
    </div>

</div>
<h4>Properties</h4>

@include('admin.items.property')

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
