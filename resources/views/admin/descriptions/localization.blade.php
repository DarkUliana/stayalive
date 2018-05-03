<tr>
    <td>
        <strong>{{ $localization->language->language or $language->language}}</strong>
        <input name="localizations[{{$counter}}][languageID]" type="hidden" value="{{ $localization->languageID or $language->ID }}">
    </td>
    <td>
        <input class="form-control" name="localizations[{{$counter}}][name]" type="text" id="name" value="{{ $localization->name or ''}}">
    </td>
    <td>
        <div class="form-group">
            <textarea class="form-control" name="localizations[{{$counter}}][description]"
                      rows="3">{{ $localization->description or ''}}</textarea>
        </div>
    </td>
</tr>