<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="{{ $lootcollection->name or ''}}">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('chance') ? 'has-error' : ''}}">
    <label for="chance" class="col-md-4 control-label">{{ 'Chance' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="chance" type="number" id="chance" value="{{ $lootcollection->chance or ''}}">
        {!! $errors->first('chance', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="card" style="margin-bottom: 10px">
    <div class="card-header">Items</div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Item</th>
                <th>minValue</th>
                <th>maxValue</th>
                <th>
                    <button type="button" class="btn btn-success addItem">Add</button>
                </th>
            </tr>
            </thead>
            <tbody>
            @isset($lootcollection)
                @foreach($lootcollection->items as $item)
                    @include('admin.loot-collections.item', ['index' => $loop->index, 'item' => $item])
                @endforeach
            @endisset
            </tbody>
        </table>
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
