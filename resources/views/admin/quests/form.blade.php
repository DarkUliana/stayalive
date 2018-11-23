<div class="form-group">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="string" id="name" value="{{ $quest->name or ''}}">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('daily') ? 'has-error' : ''}}">
    <div class="col-md-6">
        <div class="radio">
            <label><input name="daily" type="radio"
                          value="1" @if (isset($quest)) {{ (1 == $quest->daily) ? 'checked' : '' }} @else {{ 'checked' }} @endif>
                daily</label>
        </div>
        <div class="radio">
            <label><input name="daily" type="radio"
                          value="0" @if (isset($quest)) {{ (0 == $quest->daily) ? 'checked' : '' }} @endif>
                linear</label>
        </div>
        {!! $errors->first('daily', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('typeID') ? 'has-error' : ''}}" id="questType">
    <label for="typeID" class="col-md-4 control-label">{{ 'Type' }}</label>
    <div class="col-md-6">
        <select name="typeID" class="form-control" id="typeID">
            @foreach ($types as $value)
                <option value="{{ $value->ID }}" {{ (isset($quest->typeID) && $quest->typeID == $value->ID) ? 'selected' : ''}}>{{ $value->name }}</option>
            @endforeach
        </select>
        {!! $errors->first('typeID', '<p class="help-block">:message</p>') !!}
    </div>
</div>

@if(isset($quest))
    @isset($items)
        @include('admin.quests.item', ['name' => $quest->field->fieldname->name, 'ID' => $quest->field->fieldName->ID, 'inputType' => $quest->field->fieldName->type])
    @endisset
@else
    @include('admin.quests.item', ['name' => $field->name, 'ID' => $field->ID,  'inputType' => $field->type])
@endif

<div class="form-group {{ $errors->has('countToDo') ? 'has-error' : ''}}">
    <label for="countToDo" class="col-md-4 control-label">{{ 'CountToDo' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="countToDo" type="number" id="countToDo" value="{{ $quest->countToDo or 0}}">
        {!! $errors->first('countToDo', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('level') ? 'has-error' : ''}}">
    <label for="level" class="col-md-4 control-label">{{ 'Level' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="level" type="number" id="level" value="{{ $quest->level or 0}}">
        {!! $errors->first('level', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('starPoints') ? 'has-error' : ''}}">
    <label for="starPoints" class="col-md-4 control-label">{{ 'StarPoints' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="starPoints" type="number" id="starPoints"
               value="{{ $quest->starPoints or 0}}">
        {!! $errors->first('starPoints', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('rewardID') ? 'has-error' : ''}}">
    <label for="rewardID" class="col-md-4 control-label">{{ 'Reward' }}</label>
    <div class="col-md-6">
        <select name="rewardID" class="form-control" id="rewardID">
            @foreach ($rewards as $value)
                <option value="{{ $value->ID }}" {{ (isset($quest->rewardID) && $quest->rewardID == $value->ID) ? 'selected' : ''}}>{{ $value->name }}</option>
            @endforeach
        </select>
        {!! $errors->first('rewardID', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="card" style="margin: 15px 0 15px 0">
    <div class="card-header"><h5>Quest descriptions</h5></div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <select class="form-control form-control-sm" name="mode">
                    @foreach($modes as $mode)
                        <option value="{{ $mode->index }}">{{ $mode->name }}</option>
                        <option></option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <div class="btn btn-success btn-sm" id="addDescription"><i class="fa fa-plus" aria-hidden="true"></i>
                    Add
                </div>
            </div>
        </div>



        <div class="table-responsive">
            <table class="table table-bordered quest-description-table">
                @isset($questdescriptions)
                    @foreach($questdescriptions as $description)
                        @include("admin.quests.mode-$description->mode", ['mode' => $description->mode, 'index' => $loop->index])
                    @endforeach
                @endisset

            </table>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
