<tr>
    <td>
        <div class="number" style="display: none;">{{$counter}}</div>
        <div class="form-group">
            <input class="form-control" name="Properties[{{$counter}}][propertyName]" type="text" id="Type"
                   value="{{ $property->propertyName or ''}}">
        </div>
    </td>
    <td>
        <div class="form-group">
            <input class="form-control" name="Properties[{{$counter}}][propertyValue]" type="text" id="Type"
                   value="{{ $property->propertyValue or ''}}">
        </div>
    </td>
    <td>
        <div class="form-group">
            <select class="form-control" name="Properties[{{$counter}}][propertyType]" id="Type"
                    value="{{ $property->propertyType or ''}}">
                <option value="integer">integer</option>
                <option value="double">double</option>
                <option value="string">string</option>
            </select>
        </div>
    </td>
    <td>
        <button type="button" class="btn btn-danger deleteProperty">Delete</button>
    </td>
</tr>




