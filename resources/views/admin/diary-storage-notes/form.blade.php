<div class="form-group {{ $errors->has('noteID') ? 'has-error' : ''}}">
    <label for="noteID" class="col-md-4 control-label">{{ 'Noteid' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="noteID" type="number" id="noteID"
               value="{{ $diaryStorageNote->noteID or ''}}" {{isset($diaryStorageNote) ? 'disabled' : ''}}>
        {!! $errors->first('noteID', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('noteSubject') ? 'has-error' : ''}}">
    <label for="noteSubject" class="col-md-4 control-label">{{ 'Notesubject' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="noteSubject" type="text" id="noteSubject"
               value="{{ $diaryStorageNote->noteSubject or ''}}">
        {!! $errors->first('noteSubject', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('noteImage') ? 'has-error' : ''}}">
    <label for="noteImage" class="col-md-4 control-label">{{ 'Noteimage' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="noteImage" type="text" id="noteImage"
               value="{{ $diaryStorageNote->noteImage or ''}}">
        {!! $errors->first('noteImage', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('quests') ? 'has-error' : ''}}">
    <label for="quests" class="col-md-4 control-label">{{ 'quests' }}</label>
    <div class="col-md-6">
        <select name="quests[]" id="quests" multiple>
            @foreach($quests as $quest)
                <option value="{{ $quest->ID }}" {{ isset($noteQuests) && in_array($quest->ID, $noteQuests) ? 'selected' : '' }}>{{ $quest->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
