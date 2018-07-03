<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="{{ $restorableObject->name or ''}}">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<h4>Top List Items</h4>
<div class="table-responsive">
    <table class="table table-bordered" id="topTable">
        <tr>
            <th>Item</th>
            <th>Count</th>
            <th>
                <button id="addTopListItem" type="button" class="btn btn-success">Add</button>
            </th>
        </tr>
        @isset($restorableObject)
            @foreach($topListItems as $objectItem)
                @include('admin.restorable-objects.item', ['arrayName' => 'topListItems'])
            @endforeach
        @endisset
    </table>
</div>

<h4>Bottom List Items</h4>
<div class="table-responsive">
    <table class="table table-bordered" id="bottomTable">
        <tr>
            <th>Item</th>
            <th>Count</th>
            <th>
                <button id="addBottomListItem" type="button" class="btn btn-success">Add</button>
            </th>
        </tr>
        @isset($restorableObject)
            @foreach($bottomListItems as $objectItem)
                @include('admin.restorable-objects.item', ['arrayName' => 'bottomListItems'])
            @endforeach
        @endisset
    </table>
</div>


<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
