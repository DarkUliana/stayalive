<div class="form-group {{ $errors->has('typeID') ? 'has-error' : ''}}">
    <label for="typeID" class="col-md-4 control-label">{{ 'Typeid' }}</label>
    <div class="col-md-6">
        <select name="typeID" class="form-control" id="typeID" >
    @foreach (json_decode('{}', true) as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($quest->typeID) && $quest->typeID == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
</select>
        {!! $errors->first('typeID', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('level') ? 'has-error' : ''}}">
    <label for="level" class="col-md-4 control-label">{{ 'Level' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="level" type="number" id="level" value="{{ $quest->level or ''}}" >
        {!! $errors->first('level', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('starPoints') ? 'has-error' : ''}}">
    <label for="starPoints" class="col-md-4 control-label">{{ 'Starpoints' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="starPoints" type="number" id="starPoints" value="{{ $quest->starPoints or ''}}" >
        {!! $errors->first('starPoints', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('countToDo') ? 'has-error' : ''}}">
    <label for="countToDo" class="col-md-4 control-label">{{ 'Counttodo' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="countToDo" type="number" id="countToDo" value="{{ $quest->countToDo or ''}}" >
        {!! $errors->first('countToDo', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('rewardID') ? 'has-error' : ''}}">
    <label for="rewardID" class="col-md-4 control-label">{{ 'Rewardid' }}</label>
    <div class="col-md-6">
        <select name="rewardID" class="form-control" id="rewardID" >
    @foreach (json_decode('{}', true) as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($quest->rewardID) && $quest->rewardID == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
</select>
        {!! $errors->first('rewardID', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
