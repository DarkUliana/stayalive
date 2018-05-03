<div class="form-group {{ $errors->has('key') ? 'has-error' : ''}}">
    <label for="key" class="col-md-4 control-label"><h5>{{ 'Key' }}</h5></label>
    <div class="col-md-6">
        <input class="form-control" name="key" type="text" id="key" value="{{ $description->key or ''}}">
        {!! $errors->first('key', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<h4>Localizations</h4>

<table class="table table-bordered">
    <tr>
        <th>Language</th>
        <th>Name</th>
        <th>Description</th>
    </tr>
    <?php $counter = 0; ?>
    @isset($description)
        @foreach($description->localizations as $localization)
            @include('admin.descriptions.localization')
            <?php ++$counter ?>
        @endforeach
        @unset($localization)
    @endisset

    @foreach($languages as $language)
        @if(!in_array($language->ID, $availableLanguages))
            @include('admin.descriptions.localization')
            <?php ++$counter ?>
        @endif
    @endforeach

</table>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
