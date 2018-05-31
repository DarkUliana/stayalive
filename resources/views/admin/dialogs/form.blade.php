<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="{{ $dialog->name or ''}}">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('questID') ? 'has-error' : ''}}">
    <label for="questID" class="col-md-4 control-label">{{ 'Quest' }}</label>
    <div class="col-md-6">
        <select name="questID" class="form-control" id="questID">
            @foreach ($quests as $quest)
                <option value="{{ $quest->ID }}" {{ (isset($dialog->questID) && $dialog->questID == $quest->ID) ? 'selected' : ''}}>{{ $quest->name }}</option>
            @endforeach
        </select>
        {!! $errors->first('questID', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
<table class="table table-bordered">
    <tr>
        <th>Description</th>
        <th>Speaker</th>

        <th>
            <button id="addDescription" type="button" class="btn btn-success">Add</button>
        </th>
    </tr>

    <tbody>
    @isset($dialog)
        @foreach($dialog->descriptions->sortBy('number') as $value)

            @include('admin.dialogs.description', ['index' => $loop->index])

        @endforeach
    @endisset
    </tbody>

</table>

