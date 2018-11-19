<div class="form-group {{ $errors->has('questID') ? 'has-error' : ''}}">
    <label for="questID" class="control-label">{{ 'questID' }}</label>
    <select name="questID" id="questID" class="form-control">
        @foreach($quests as $quest)
            <option value="{{ $quest->ID }}" {{ (isset($questdescription) && ($questdescription->questID == $quest->ID)) ? 'selected' : '' }}>{{ $quest->name }}</option>
        @endforeach
    </select>
    {!! $errors->first('questID', '<p class="help-block">:message</p>') !!}
</div>

<div style="border:solid 2px #6c757d">
<div class="row">
    <div class="col-md-12">
        <input class="form-control" name="texts[1][text]">
        <input type="hidden" name="texts[1][text]" value="">
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <input class="form-control" name="texts[1][text]">/div>
    <div class="col-md-6">
        <input class="form-control" name="texts[1][image]">
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <input class="form-control" name="texts[0][text]">
    </div>
    <div class="col-md-6">
        <input class="form-control" name="texts[0][text]">
    </div>
</div>
<div class="row">
    <div class="col-md-12"></div>
</div>
</div>


<div class="form-group {{ $errors->has('mode') ? 'has-error' : ''}}">
    <label for="mode" class="control-label">{{ 'mode' }}</label>
    <select name="mode" id="mode" class="form-control">
        @foreach($modes as $mode)
            <option value="{{ $mode->name }}" {{ (isset($questdescription) && ($questdescription->mode == $mode->name)) ? 'selected' : '' }}>{{ $mode->name }}</option>
        @endforeach
    </select>
    {!! $errors->first('mode', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {{ $errors->has('imageName') ? 'has-error' : ''}}">
    <label for="imageName" class="control-label">{{ 'Imagename' }}</label>
    <input class="form-control" name="imageName" type="text" id="imageName"
           value="{{ $questdescription->imageName or ''}}">
    {!! $errors->first('imageName', '<p class="help-block">:message</p>') !!}
</div>

<input type="text" name="textKey" id="textKey" value="{{ $questdescription->textKey or '' }}">

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
