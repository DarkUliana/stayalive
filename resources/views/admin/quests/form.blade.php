<div class="form-group">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="string" id="name" value="{{ $quest->name or ''}}" >
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('typeID') ? 'has-error' : ''}}">
    <label for="typeID" class="col-md-4 control-label">{{ 'Type' }}</label>
    <div class="col-md-6">
        <select name="typeID" class="form-control" id="typeID" >
    @foreach ($types as $value)
        <option value="{{ $value->ID }}" {{ (isset($quest->typeID) && $quest->typeID == $value->ID) ? 'selected' : ''}}>{{ $value->name }}</option>
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
    <label for="starPoints" class="col-md-4 control-label">{{ 'StarPoints' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="starPoints" type="number" id="starPoints" value="{{ $quest->starPoints or ''}}" >
        {!! $errors->first('starPoints', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('countToDo') ? 'has-error' : ''}}">
    <label for="countToDo" class="col-md-4 control-label">{{ 'CountToDo' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="countToDo" type="number" id="countToDo" value="{{ $quest->countToDo or ''}}" >
        {!! $errors->first('countToDo', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('rewardID') ? 'has-error' : ''}}">
    <label for="rewardID" class="col-md-4 control-label">{{ 'Reward' }}</label>
    <div class="col-md-6">
        <select name="rewardID" class="form-control" id="rewardID" >
    @foreach ($rewards as $value)
        <option value="{{ $value->ID }}" {{ (isset($quest->rewardID) && $quest->rewardID == $value->ID) ? 'selected' : ''}}>{{ $value->name }}</option>
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
