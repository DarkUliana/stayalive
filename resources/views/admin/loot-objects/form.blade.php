<div class="form-group {{ $errors->has('key') ? 'has-error' : ''}}">
    <label for="key" class="col-md-4 control-label">{{ 'Key' }}</label>
    <div class="col-md-6">
        <input id="objectKey" class="form-control" name="key" type="text" id="key" value="{{ $lootobject->key or ''}}">
        {!! $errors->first('key', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <label for="collections" class="col-md-4 control-label">{{ 'Key' }}</label>
    <div class="col-md-6">
        <select name="collections" multiple>
            @foreach($collections as $collection)
                <option name="collections[]" value="{{ $collection->ID }}"
                        {{ isset($lootobject) && in_array($collection->ID, $lootobject->collections->pluck('ID')->toArray()) ? 'selected' : '' }}>
                    {{ $collection->name }}</option>
            @endforeach
        </select>
    </div>
</div>

