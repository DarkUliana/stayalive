<div class="form-group {{ $errors->has('locationName') ? 'has-error' : ''}}">
    <label for="locationName" class="col-md-4 control-label">{{ 'Locationname' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="locationName" type="text" id="locationName" value="{{ $eventIsland->locationName or ''}}" required>
        {!! $errors->first('locationName', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('frequencyOfOccurrence') ? 'has-error' : ''}}">
    <label for="frequencyOfOccurrence" class="col-md-4 control-label">{{ 'Frequencyofoccurrence' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="frequencyOfOccurrence" type="number" step="0.01" id="frequencyOfOccurrence" value="{{ $eventIsland->frequencyOfOccurrence or ''}}" required>
        {!! $errors->first('frequencyOfOccurrence', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('lifetime') ? 'has-error' : ''}}">
    <label for="lifetime" class="col-md-4 control-label">{{ 'Lifetime' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="lifetime" type="number" step="0.01" id="lifetime" value="{{ $eventIsland->lifetime or ''}}" required>
        {!! $errors->first('lifetime', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('probabilityOfAppearance') ? 'has-error' : ''}}">
    <label for="probabilityOfAppearance" class="col-md-4 control-label">{{ 'Probabilityofappearance' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="probabilityOfAppearance" type="number" step="0.01" id="probabilityOfAppearance" value="{{ $eventIsland->probabilityOfAppearance or ''}}" required>
        {!! $errors->first('probabilityOfAppearance', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
