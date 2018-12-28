<tr data-index="{{ $index }}">
    <td>
        <input class="form-control" name="settings[{{$index}}][eventLocationName]" type="text"

               value="{{ isset($setting) ? $setting->eventLocationName : ''}}">
    </td>
    <td>
        <input class="form-control" name="settings[{{$index}}][lifeTime]" type="number" step="any"
               value="{{ isset($setting) ? $setting->lifeTime : ''}}">
    </td>
    <td>
        <input class="form-control" name="settings[{{$index}}][chanceToEvent]" type="number" step="any"

               value="{{ isset($setting) ? $setting->chanceToEvent : ''}}">
    </td>
    <td>
        <button type="button" class="btn btn-danger deleteSetting">Delete</button>
    </td>
</tr>
