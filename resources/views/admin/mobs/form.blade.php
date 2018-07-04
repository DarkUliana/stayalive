<div class="form-group {{ $errors->has('enemyType') ? 'has-error' : ''}}">
    <label for="enemyType" class="col-md-4 control-label">{{ 'Enemytype' }}</label>
    <div class="col-md-6">
        <select name="enemyType" class="form-control" id="enemyType" >
    @foreach ($enemies as $enemy)
        <option value="{{ $enemy->ID }}" {{ (isset($mob->enemyType) && $mob->enemyType == $enemy->ID) ? 'selected' : ''}}>{{ $enemy->name }}</option>
    @endforeach
</select>
        {!! $errors->first('enemyType', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('enemyLevel') ? 'has-error' : ''}}">
    <label for="enemyLevel" class="col-md-4 control-label">{{ 'Enemylevel' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="enemyLevel" type="number" id="enemyLevel" value="{{ $mob->enemyLevel or ''}}" >
        {!! $errors->first('enemyLevel', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('maximumHP') ? 'has-error' : ''}}">
    <label for="maximumHP" class="col-md-4 control-label">{{ 'Maximumhp' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="maximumHP" type="number" id="maximumHP" value="{{ $mob->maximumHP or ''}}" >
        {!! $errors->first('maximumHP', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('playerDetectRadius') ? 'has-error' : ''}}">
    <label for="playerDetectRadius" class="col-md-4 control-label">{{ 'Playerdetectradius' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="playerDetectRadius" type="number" step="0.001" id="playerDetectRadius" value="{{ $mob->playerDetectRadius or ''}}" >
        {!! $errors->first('playerDetectRadius', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('callRadius') ? 'has-error' : ''}}">
    <label for="callRadius" class="col-md-4 control-label">{{ 'Callradius' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="callRadius" type="number" step="0.001" id="callRadius" value="{{ $mob->callRadius or ''}}" >
        {!! $errors->first('callRadius', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('addAgroRadius') ? 'has-error' : ''}}">
    <label for="addAgroRadius" class="col-md-4 control-label">{{ 'Addagroradius' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="addAgroRadius" type="number" step="0.001" id="addAgroRadius" value="{{ $mob->addAgroRadius or ''}}" >
        {!! $errors->first('addAgroRadius', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('attackCloseRange') ? 'has-error' : ''}}">
    <label for="attackCloseRange" class="col-md-4 control-label">{{ 'Attackcloserange' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="attackCloseRange" type="number" step="0.001" id="attackCloseRange" value="{{ $mob->attackCloseRange or ''}}" >
        {!! $errors->first('attackCloseRange', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('attackClosePower') ? 'has-error' : ''}}">
    <label for="attackClosePower" class="col-md-4 control-label">{{ 'Attackclosepower' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="attackClosePower" type="number" id="attackClosePower" value="{{ $mob->attackClosePower or ''}}" >
        {!! $errors->first('attackClosePower', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('attackCloseRate') ? 'has-error' : ''}}">
    <label for="attackCloseRate" class="col-md-4 control-label">{{ 'Attackcloserate' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="attackCloseRate" type="number" step="0.001" id="attackCloseRate" value="{{ $mob->attackCloseRate or ''}}" >
        {!! $errors->first('attackCloseRate', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('giveExpirience') ? 'has-error' : ''}}">
    <label for="giveExpirience" class="col-md-4 control-label">{{ 'Giveexpirience' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="giveExpirience" type="number" id="giveExpirience" value="{{ $mob->giveExpirience or ''}}" >
        {!! $errors->first('giveExpirience', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('movementSpeed') ? 'has-error' : ''}}">
    <label for="movementSpeed" class="col-md-4 control-label">{{ 'Movementspeed' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="movementSpeed" type="number" step="0.001" id="movementSpeed" value="{{ $mob->movementSpeed or ''}}" >
        {!! $errors->first('movementSpeed', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('timeToStay') ? 'has-error' : ''}}">
    <label for="timeToStay" class="col-md-4 control-label">{{ 'Timetostay' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="timeToStay" type="number" step="0.001" id="timeToStay" value="{{ $mob->timeToStay or ''}}" >
        {!! $errors->first('timeToStay', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('increaseSpeedRange') ? 'has-error' : ''}}">
    <label for="increaseSpeedRange" class="col-md-4 control-label">{{ 'Increasespeedrange' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="increaseSpeedRange" type="number" step="0.001" id="increaseSpeedRange" value="{{ $mob->increaseSpeedRange or ''}}" >
        {!! $errors->first('increaseSpeedRange', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('increaseSpeedValue') ? 'has-error' : ''}}">
    <label for="increaseSpeedValue" class="col-md-4 control-label">{{ 'Increasespeedvalue' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="increaseSpeedValue" type="number" step="0.001" id="increaseSpeedValue" value="{{ $mob->increaseSpeedValue or ''}}" >
        {!! $errors->first('increaseSpeedValue', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('increaseSpeedTime') ? 'has-error' : ''}}">
    <label for="increaseSpeedTime" class="col-md-4 control-label">{{ 'Increasespeedtime' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="increaseSpeedTime" type="number" step="0.001" id="increaseSpeedTime" value="{{ $mob->increaseSpeedTime or ''}}" >
        {!! $errors->first('increaseSpeedTime', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('attackDistanceRange') ? 'has-error' : ''}}">
    <label for="attackDistanceRange" class="col-md-4 control-label">{{ 'Attackdistancerange' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="attackDistanceRange" type="number" step="0.001" id="attackDistanceRange" value="{{ $mob->attackDistanceRange or ''}}" >
        {!! $errors->first('attackDistanceRange', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('attackDistancePower') ? 'has-error' : ''}}">
    <label for="attackDistancePower" class="col-md-4 control-label">{{ 'Attackdistancepower' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="attackDistancePower" type="number" id="attackDistancePower" value="{{ $mob->attackDistancePower or ''}}" >
        {!! $errors->first('attackDistancePower', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('attackDistanceRate') ? 'has-error' : ''}}">
    <label for="attackDistanceRate" class="col-md-4 control-label">{{ 'Attackdistancerate' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="attackDistanceRate" type="number" step="0.001" id="attackDistanceRate" value="{{ $mob->attackDistanceRate or ''}}" >
        {!! $errors->first('attackDistanceRate', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('attackSpeedDecrease') ? 'has-error' : ''}}">
    <label for="attackSpeedDecrease" class="col-md-4 control-label">{{ 'Attackspeeddecrease' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="attackSpeedDecrease" type="number" step="0.001" id="attackSpeedDecrease" value="{{ $mob->attackSpeedDecrease or ''}}" >
        {!! $errors->first('attackSpeedDecrease', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('movementSpeedDecrease') ? 'has-error' : ''}}">
    <label for="movementSpeedDecrease" class="col-md-4 control-label">{{ 'Movementspeeddecrease' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="movementSpeedDecrease" type="number" step="0.001" id="movementSpeedDecrease" value="{{ $mob->movementSpeedDecrease or ''}}" >
        {!! $errors->first('movementSpeedDecrease', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('timeDebuff') ? 'has-error' : ''}}">
    <label for="timeDebuff" class="col-md-4 control-label">{{ 'Timedebuff' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="timeDebuff" type="number" step="0.001" id="timeDebuff" value="{{ $mob->timeDebuff or ''}}" >
        {!! $errors->first('timeDebuff', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('chance') ? 'has-error' : ''}}">
    <label for="chance" class="col-md-4 control-label">{{ 'Chance' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="chance" type="number" step="0.001" id="chance" value="{{ $mob->chance or ''}}" >
        {!! $errors->first('chance', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('hillRange') ? 'has-error' : ''}}">
    <label for="hillRange" class="col-md-4 control-label">{{ 'Hillrange' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="hillRange" type="number" step="0.001" id="hillRange" value="{{ $mob->hillRange or ''}}" >
        {!! $errors->first('hillRange', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('hillPower') ? 'has-error' : ''}}">
    <label for="hillPower" class="col-md-4 control-label">{{ 'Hillpower' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="hillPower" type="number" id="hillPower" value="{{ $mob->hillPower or ''}}" >
        {!! $errors->first('hillPower', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('hillRate') ? 'has-error' : ''}}">
    <label for="hillRate" class="col-md-4 control-label">{{ 'Hillrate' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="hillRate" type="number" step="0.001" id="hillRate" value="{{ $mob->hillRate or ''}}" >
        {!! $errors->first('hillRate', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
