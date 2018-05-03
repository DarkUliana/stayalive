<div class="form-group {{ $errors->has('language') ? 'has-error' : ''}}">
    <input class="form-control" name="language" type="text" id="language" value="{{ $item->language or ''}}">
    {!! $errors->first('language', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    <input class="btn btn-primary btn-sm" type="submit" value="{{ $submitButtonText or 'Create' }}">
</div>
