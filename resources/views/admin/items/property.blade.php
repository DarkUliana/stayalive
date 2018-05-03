<div id="properties">

    @if(isset($properties))
        <?php $counter = 0; ?>
        @foreach($properties as $property)
            <div class="form-group">
                <label for="InventorySlotType" class="col-md-4 control-label">{{ $property->name }}</label>
                <div class="col-md-6">
                    <input type="hidden" name="Properties[{{ $counter }}][propertyID]"
                           value="{{ $property->ID }}">
                    <input class="form-control" name="Properties[{{ $counter }}][propertyValue]"
                           type="number" id="Type" value="{{ $property->value or 0 }}" step="0.01">
                </div>

            </div>
            <?php ++$counter ?>
        @endforeach
    @endif

</div>

