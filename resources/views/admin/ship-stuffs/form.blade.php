<div class="form-group {{ $errors->has('floorIndex') ? 'has-error' : ''}}">
    <label for="floorIndex" class="col-md-4 control-label">{{ 'Floor index' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="floorIndex" type="number" id="floorIndex"
               value="{{ $shipstuff->floorIndex or ''}}">
        {!! $errors->first('floorIndex', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('deckWidth') ? 'has-error' : ''}}">
    <label for="deckWidth" class="col-md-4 control-label">{{ 'Deck width' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="deckWidth" type="number" id="deckWidth"
               value="{{ $shipstuff->deckWidth or ''}}">
        {!! $errors->first('deckWidth', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
