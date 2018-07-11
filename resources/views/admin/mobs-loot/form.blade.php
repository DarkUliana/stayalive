<div class="form-group {{ $errors->has('key') ? 'has-error' : ''}}">
    <label for="key" class="col-md-4 control-label">{{ 'Key' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="key" type="text" id="key" value="{{ $loot->key or ''}}">
        {!! $errors->first('key', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('minRandomSize') ? 'has-error' : ''}}">
    <label for="minRandomSize" class="col-md-4 control-label">{{ 'Minrandomsize' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="minRandomSize" type="number" id="minRandomSize"
               value="{{ $loot->minRandomSize or ''}}">
        {!! $errors->first('minRandomSize', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('maxRandomSize') ? 'has-error' : ''}}">
    <label for="maxRandomSize" class="col-md-4 control-label">{{ 'Maxrandomsize' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="maxRandomSize" type="number" id="maxRandomSize"
               value="{{ $loot->maxRandomSize or ''}}">
        {!! $errors->first('maxRandomSize', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="table">
    <table class="table table-bordered">
        <tr>
            <th>Item</th>
            <th>minAmount</th>
            <th>maxAmount</th>
            <th>chance</th>
            <th>
                <button id="addItem" type="button" class="btn btn-success">Add</button>
            </th>
        </tr>
        @isset($loot)
            @foreach($loot->loot as $value)

                @include('admin.mobs-loot.item', ['index' => $loop->index])

            @endforeach
        @endisset
    </table>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
