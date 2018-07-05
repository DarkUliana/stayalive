<div class="form-group {{ $errors->has('descriptionID') ? 'has-error' : ''}}">
    <label for="descriptionID" class="col-md-4 control-label">{{ 'Description' }}</label>
    <div class="col-md-6">
        <select name="descriptionID" class="form-control" id="descriptionID">
            @foreach ($descriptions as $description)
                <option value="{{ $description->ID }}" {{ (isset($notification->descriptionID) && $notification->descriptionID == $description->ID) ? 'selected' : ''}}>{{ $description->key }}</option>
            @endforeach
        </select>
        {!! $errors->first('descriptionID', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('isSimple') ? 'has-error' : ''}}">
    <label for="isSimple" class="col-md-4 control-label">{{ 'Is simple' }}</label>
    <div class="col-md-6">
        <div class="radio">
            <label><input name="isSimple" type="radio"
                          value="1" {{ (isset($notification) && 1 == $notification->isSimple) ? 'checked' : '' }}>
                Yes</label>
        </div>
        <div class="radio">
            <label><input name="isSimple" type="radio"
                          value="0" @if (isset($notification)) {{ (0 == $notification->isSimple) ? 'checked' : '' }} @else {{ 'checked' }} @endif>
                No</label>
        </div>
        {!! $errors->first('isSimple', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div id="date" class="form-group {{ $errors->has('expirationDate') ? 'has-error' : ''}} {{(isset($notification) && $notification->isSimple == 1) ? 'd-none' : '' }}">
    <label for="expirationDate" class="col-md-4 control-label">{{ 'Expiration date' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="expirationDate" type="date" id="expirationDate"
               value="{{ $notification->expirationDate or ''}}">
        {!! $errors->first('expirationDate', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
