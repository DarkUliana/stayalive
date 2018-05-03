<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="{{ $technology->name or ''}}">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('level') ? 'has-error' : ''}}">
    <label for="level" class="col-md-4 control-label">{{ 'Level' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="level" type="number" id="level" value="{{ $technology->level or ''}}">
        {!! $errors->first('level', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('playerLevel') ? 'has-error' : ''}}">
    <label for="playerLevel" class="col-md-4 control-label">{{ 'Playerlevel' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="playerLevel" type="number" id="playerLevel"
               value="{{ $technology->playerLevel or ''}}">
        {!! $errors->first('playerLevel', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('coinCost') ? 'has-error' : ''}}">
    <label for="coinCost" class="col-md-4 control-label">{{ 'Coincost' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="coinCost" type="number" id="coinCost"
               value="{{ $technology->coinCost or ''}}">
        {!! $errors->first('coinCost', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('timeToBuild') ? 'has-error' : ''}}">
    <label for="timeToBuild" class="col-md-4 control-label">{{ 'Timetobuild' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="timeToBuild" type="number" id="timeToBuild"
               value="{{ $technology->timeToBuild or ''}}">
        {!! $errors->first('timeToBuild', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('isBuilding') ? 'has-error' : ''}}">
    <label for="isBuilding" class="col-md-4 control-label">{{ 'Isbuilding' }}</label>
    <div class="col-md-6">
        <div class="radio">
            <label><input name="isBuilding" type="radio"
                          value="1" {{ (isset($technology) && 1 == $technology->isBuilding) ? 'checked' : '' }}>
                Yes</label>
        </div>
        <div class="radio">
            <label><input name="isBuilding" type="radio"
                          value="0" @if (isset($technology)) {{ (0 == $technology->isBuilding) ? 'checked' : '' }} @else {{ 'checked' }} @endif>
                No</label>
        </div>
        {!! $errors->first('isBuilding', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('technologyType') ? 'has-error' : ''}}">
    <label for="technologyType" class="col-md-4 control-label">{{ 'TechnologyType' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="technologyType" type="number" id="technologyType"
               value="{{ $technology->technologyType or ''}}">
        {!! $errors->first('technologyType', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <label for="items" class="col-md-4 control-label">OpenedItems</label>
    <div class="col-md-6">
        <select id="items" name="items[]" multiple="multiple">
            @foreach ($items as $item):
            <option value="{{$item->ID}}" @if(isset($selectedItems) && in_array($item->ID, $selectedItems))selected="selected"@endif>
                {{$item->Name}}
            </option>
            @endforeach
        </select>
    </div>
</div>


<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
