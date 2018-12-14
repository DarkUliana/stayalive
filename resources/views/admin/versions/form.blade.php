<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="description" class="col-md-4 control-label">{{ 'Description' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="description" type="text" id="description"
               value="{{ $version->description or ''}}">
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('serverVersion') ? 'has-error' : ''}}">
    <label for="serverVersion" class="col-md-4 control-label">{{ 'serverVersion' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="serverVersion" type="text" id="serverVersion"
               value="{{ $version->serverVersion or ''}}">
        {!! $errors->first('serverVersion', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <label for="serverAvailable" class="col-md-4 control-label">{{ 'serverAvailable' }}</label>
    <div class="col-md-6">
        <div class="radio">
            <label><input name="serverAvailable" type="radio"
                          value="1" @if (isset($version)) {{ (1 == $version->serverAvailable) ? 'checked' : '' }} @else {{ 'checked' }} @endif>
                true</label>
        </div>
        <div class="radio">
            <label><input name="serverAvailable" type="radio"
                          value="0" @if (isset($version)) {{ (0 == $version->serverAvailable) ? 'checked' : '' }} @endif>
                false</label>
        </div>
        {!! $errors->first('serverAvailable', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('serverTimer') ? 'has-error' : ''}}" id="serverTimer">
    <label for="serverTimer" class="col-md-4 control-label">{{ 'serverTimer' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="serverTimer" type="datetime-local" id="serverTimer"
               value="{{ isset($version) ? $version->serverTimer : date('Y-m-d\TH:i')}}">
        {!! $errors->first('serverTimer', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
