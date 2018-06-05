<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="{{ $reward->name or ''}}">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('chest') ? 'has-error' : ''}}">
    <label for="chest" class="col-md-4 control-label">{{ 'Chest' }}</label>
    <div class="col-md-6">
        <select name="chest" class="form-control" id="chest">
            @foreach ($chests as $chest)
                <option value="{{ $chest->ID }}" {{ (isset($reward->chest) && $reward->chest == $chest->ID) ? 'selected' : ''}}>{{ $chest->name }}</option>
            @endforeach
        </select>
        {!! $errors->first('chest', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<table class="table table-bordered">
    <tr>
        <th>Name</th>
        <th>Count</th>
        <th>Rarity</th>
        <th>
            <button id="addComponent" type="button" class="btn btn-success">Add</button>
        </th>
    </tr>
    @isset($components)
        @foreach($components as $component)
            @include('admin.rewards.item')
        @endforeach
    @endisset


</table>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
