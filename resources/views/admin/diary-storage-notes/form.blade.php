<div class="form-group {{ $errors->has('noteID') ? 'has-error' : ''}}">
    <label for="noteID" class="col-md-4 control-label">{{ 'Noteid' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="noteID" type="number" id="noteID" value="{{ $diaryStorageNote->noteID or ''}}" {{isset($diaryStorageNote) ? 'disabled' : ''}}>
        {!! $errors->first('noteID', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('noteSubject') ? 'has-error' : ''}}">
    <label for="noteSubject" class="col-md-4 control-label">{{ 'Notesubject' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="noteSubject" type="text" id="noteSubject" value="{{ $diaryStorageNote->noteSubject or ''}}" >
        {!! $errors->first('noteSubject', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('noteText') ? 'has-error' : ''}}">
    <label for="noteText" class="col-md-4 control-label">{{ 'Notetext' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="noteText" type="text" id="noteText" value="{{ $diaryStorageNote->noteText or ''}}" >
        {!! $errors->first('noteText', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
