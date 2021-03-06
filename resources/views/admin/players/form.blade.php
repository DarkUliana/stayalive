<div class="form-group {{ $errors->has('Name') ? 'has-error' : ''}}">
    <label for="Name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="Name" type="text" id="Name" value="{{ $player->Name or ''}}">
        {!! $errors->first('Name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('googleID') ? 'has-error' : ''}}">
    <label for="googleID" class="col-md-4 control-label">{{ 'Googleid' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="googleID" type="text" id="googleID" value="{{ $player->googleID or ''}}">
        {!! $errors->first('googleID', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group ">
    <label for="isDeveloper" class="col-md-4 control-label">isDeveloper</label>
    <div class="col-md-6">
        <div class="radio">
            <label>
                <input name="isDeveloper" type="radio"
                          value="1" {{ (isset($player) && 1 == $player->isDeveloper) ? 'checked' : '' }}>
                Yes</label>
        </div>
        <div class="radio">
            <label>
                <input name="isDeveloper" type="radio"
                          value="0" @if (isset($player)) {{ (0 == $player->isDeveloper) ? 'checked' : '' }} @else {{ 'checked' }} @endif>
                No</label>
        </div>
        {!! $errors->first('isBuilding', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('CurrentLevel') ? 'has-error' : ''}}">
    <label for="googleID" class="col-md-4 control-label">{{ 'CurrentLevel' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="CurrentLevel" type="text" id="googleID"
               value="{{ $player->CurrentLevel or 0}}">
        {!! $errors->first('CurrentLevel', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('goldCoin') ? 'has-error' : ''}}">
    <label for="googleID" class="col-md-4 control-label">{{ 'GoldCoin' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="goldCoin" type="text" id="googleID" value="{{ $player->goldCoin or 0}}">
        {!! $errors->first('goldCoin', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('techCoin') ? 'has-error' : ''}}">
    <label for="googleID" class="col-md-4 control-label">{{ 'TechCoin' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="techCoin" type="text" id="googleID" value="{{ $player->techCoin or 0}}">
        {!! $errors->first('techCoin', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('keyCoin') ? 'has-error' : ''}}">
    <label for="googleID" class="col-md-4 control-label">{{ 'keyCoin' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="keyCoin" type="text" id="googleID" value="{{ $player->keyCoin or 0}}">
        {!! $errors->first('keyCoin', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
