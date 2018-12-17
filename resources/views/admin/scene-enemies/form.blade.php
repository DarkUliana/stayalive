<div class="form-group {{ $errors->has('sceneName') ? 'has-error' : ''}}">
    <label for="sceneName" class="control-label">{{ 'Scenename' }}</label>
    <select name="sceneName" id="sceneName">
        @foreach($sceneNames as $name)
            <option value="{{ $name }}"
                    {{ (isset($sceneenemy) && ($sceneenemy->sceneName == $name)) ? 'selected' : '' }}>
                {{ $name }}</option>
        @endforeach
    </select>
    {!! $errors->first('sceneName', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('areaKey') ? 'has-error' : ''}}">
    <label for="areaKey" class="control-label">{{ 'Areakey' }}</label>
    <select name="areaKey" id="areaKey">
        @foreach($lootKeys as $key)
            <option value="{{ $key }}"
                    {{ (isset($sceneenemy) && ($sceneenemy->lootKey == $key)) ? 'selected' : '' }}>{{ $key }}</option>
        @endforeach
    </select>
    {!! $errors->first('areaKey', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('enemyType') ? 'has-error' : ''}}">
    <label for="enemyType" class="control-label">{{ 'Enemytype' }}</label>
    <select class="form-control" name="enemyType" id="enemyType">
        @foreach($enemies as $enemy)
            <option value="{{ $enemy->ID }}"
                    {{ (isset($sceneenemy) && ($sceneenemy->enemyType == $enemy->ID)) ? 'selected' : '' }}>
                {{ $enemy->name }}</option>
        @endforeach
    </select>
    {!! $errors->first('enemyType', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('enemyLevel') ? 'has-error' : ''}}">
    <label for="enemyLevel" class="control-label">{{ 'Enemylevel' }}</label>
    <input class="form-control" name="enemyLevel" type="number" id="enemyLevel"
           value="{{ $sceneenemy->enemyLevel or ''}}">
    {!! $errors->first('enemyLevel', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('countInScene') ? 'has-error' : ''}}">
    <label for="countInScene" class="control-label">{{ 'Countinscene' }}</label>
    <input class="form-control" name="countInScene" type="number" id="countInScene"
           value="{{ $sceneenemy->countInScene or ''}}">
    {!! $errors->first('countInScene', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('lootKey') ? 'has-error' : ''}}">
    <label for="lootKey" class="control-label">{{ 'Lootkey' }}</label>
    <input class="form-control" name="lootKey" type="text" id="lootKey" value="{{ $sceneenemy->lootKey or ''}}">
    {!! $errors->first('lootKey', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('chanceToSelect') ? 'has-error' : ''}}">
    <label for="chanceToSelect" class="control-label">{{ 'Chancetoselect' }}</label>
    <input class="form-control" name="chanceToSelect" type="number" id="chanceToSelect" step="0.01"
           value="{{ $sceneenemy->chanceToSelect or ''}}">
    {!! $errors->first('chanceToSelect', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('chanceToInstatiate') ? 'has-error' : ''}}">
    <label for="chanceToInstatiate" class="control-label">{{ 'Chancetoinstatiate' }}</label>
    <input class="form-control" name="chanceToInstatiate" type="number" id="chanceToInstatiate" step="0.01"
           value="{{ $sceneenemy->chanceToInstatiate or ''}}">
    {!! $errors->first('chanceToInstatiate', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
