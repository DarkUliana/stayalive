<div class="form-group {{ $errors->has('Name') ? 'has-error' : ''}}">
    <label for="Name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="Name" type="text" id="Name" value="{{ $player->Name or ''}}" >
        {!! $errors->first('Name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('googleID') ? 'has-error' : ''}}">
    <label for="googleID" class="col-md-4 control-label">{{ 'Googleid' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="googleID" type="text" id="googleID" value="{{ $player->googleID or ''}}" >
        {!! $errors->first('googleID', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
