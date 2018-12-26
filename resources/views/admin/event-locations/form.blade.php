<div class="form-group {{ $errors->has('triggerType') ? 'has-error' : ''}}">
    <label for="triggerType" class="control-label">{{ 'Triggertype' }}</label>
    <input class="form-control" name="triggerType" type="number" id="triggerType"
           value="{{ isset($eventLocation->triggerType) ? $eventLocation->triggerType : 0}}">
    {!! $errors->first('triggerType', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('conditionName') ? 'has-error' : ''}}">
    <label for="conditionName" class="control-label">{{ 'Conditionname' }}</label>
    <input class="form-control" name="conditionName" type="text" id="conditionName"
           value="{{ isset($eventLocation->conditionName) ? $eventLocation->conditionName : ''}}">
    {!! $errors->first('conditionName', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('respownCount') ? 'has-error' : ''}}">
    <label for="respownCount" class="control-label">{{ 'Respowncount' }}</label>
    <input class="form-control" name="respownCount" type="number" id="respownCount"
           value="{{ isset($eventLocation->respownCount) ? $eventLocation->respownCount : 0}}">
    {!! $errors->first('respownCount', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('timeToActivate') ? 'has-error' : ''}}">
    <label for="timeToActivate" class="control-label">{{ 'Timetoactivate' }}</label>
    <input class="form-control" name="timeToActivate" type="number" id="timeToActivate"
           value="{{ isset($eventLocation->timeToActivate) ? $eventLocation->timeToActivate : 0}}">
    {!! $errors->first('timeToActivate', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('timePeriod') ? 'has-error' : ''}}">
    <label for="timePeriod" class="control-label">{{ 'Timeperiod' }}</label>
    <input class="form-control" name="timePeriod" type="number" id="timePeriod"
           value="{{ isset($eventLocation->timePeriod) ? $eventLocation->timePeriod : 0}}">
    {!! $errors->first('timePeriod', '<p class="help-block">:message</p>') !!}
</div>

<div class="table-responsive">
    <table class="table table-bordered">
        <tr data-index="-1">
            <th>eventLocationName</th>
            <th>lifeTime</th>
            <th>chanceToEvent</th>
            <th>
                <button id="addSetting" type="button" class="btn btn-success">Add</button>
            </th>
        </tr>
        @isset($eventLocation->settings)
            @foreach($eventLocation->settings as $setting)
                @include('admin.event-locations.setting', ['index' => $loop->index])
            @endforeach
        @endisset
    </table>
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
