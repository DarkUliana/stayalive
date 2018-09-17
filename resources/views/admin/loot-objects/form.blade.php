<div class="form-group {{ $errors->has('key') ? 'has-error' : ''}}">
    <label for="key" class="col-md-4 control-label">{{ 'Key' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="key" type="text" id="key" value="{{ $lootobject->key or ''}}">
        {!! $errors->first('key', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <label for="collections" class="col-md-4 control-label">{{ 'Key' }}</label>
    <div class="col-md-6">
        <select name="">
            @foreach($collections as $collection)
                <option name="collections[]" value="{{ $collection->ID }}"
                        {{ isset($lootobject) && in_array($collection->ID, $lootobject->collections->toArray()) ? 'selected' : '' }}>
                    {{ $collection->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="card">
    <div class="card-header">Add one item collection</div>
    <div class="card-body">
        <form>
            <table class="table-responsive table-bordered">
                <tr>
                    <th>Item</th>
                    <th>Chance</th>
                    <th>MinValue</th>
                    <th>MaxValue</th>
                </tr>
                <tr>
                    <td>
                        <select>
                            @foreach($items as $item)
                                <option name value="{{ $item->ID }}">{{ $item->Name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input name="chance" type="number" value="0" step="0.01">
                    </td>
                    <td>
                        <input name="minValue" type="number" value="0" step="0.01">
                    </td>
                    <td>
                        <input name="maxValue" type="number" value="0" step="0.01">
                    </td>
                </tr>
            </table>
            <button type="submit" class="btn btn-success">Add collection</button>
        </form>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
