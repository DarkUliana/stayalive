<div class="form-group {{ $errors->has('levelName') ? 'has-error' : ''}}">
    <label for="levelName" class="control-label">{{ 'Levelname' }}</label>
    <input class="form-control" name="levelName" type="text" id="levelName" value="{{ $scenechest->levelName or ''}}" >
    {!! $errors->first('levelName', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('chestsNumber') ? 'has-error' : ''}}">
    <label for="chestsNumber" class="control-label">{{ 'Chestsnumber' }}</label>
    <input class="form-control" name="chestsNumber" type="number" id="chestsNumber" value="{{ $scenechest->chestsNumber or ''}}" >
    {!! $errors->first('chestsNumber', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
