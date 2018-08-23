<div id="properties">

    @if(isset($properties))
        <?php $counter = 0; ?>
        @foreach($properties as $property)
            <div class="form-group">
                <label for="InventorySlotType" class="col-md-12 control-label">{{ $property->name }}</label>
                <div class="col-md-12">
                    <input type="hidden" name="Properties[{{ $counter }}][propertyID]"
                           value="{{ $property->ID }}">

                    @if($property->name == 'noteID')
                        <select class="form-control" name="Properties[{{ $counter }}][propertyValue]"
                                id="noteID">
                            @foreach($notes as $note)
                                <option value="{{ $note->noteID }}" {{ isset($property->value) && $property->value == $note->noteID ? 'selected' : '' }}
                                data-image="{{ $note->noteImage }}">{{ $note->noteSubject }}</option>
                            @endforeach
                        </select>
                </div>
            </div>
            <div class="form-group">
                <label for="noteImage" class="col-md-12 control-label">noteImage</label>
                <div class="col-md-12">
                    <input class="form-control" name="noteImage" type="text" id="noteImage" value="{{ isset($property->value) ? $notes->where('noteID', $property->value)->first()->noteImage : '' }}">

            @else
                <input class="form-control" name="Properties[{{ $counter }}][propertyValue]"
                       type="number" id="Type" value="{{ $property->value or 0 }}" step="0.01">

@endif
                </div>
            </div>

<?php ++$counter ?>
@endforeach
@endif

</div>

