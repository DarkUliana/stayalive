<div class="col-md-3" id="itemBlade">
    <div class="card">
        <div class="card-header"><strong>Item #{{ $item->ID }}</strong></div>
        <div class="card-body">
            </form>

            <div class="table-responsive">
                <table class="table">
                    <tbody>
                    <tr>
                        <th>ID</th>
                        <td>{{ $item->ID }}</td>
                    </tr>
                    <tr>
                        <th> Name</th>
                        <td> {{ $item->Name }} </td>
                    </tr>
                    <tr>
                        <th> MaxInStack</th>
                        <td> {{ $item->MaxInStack }} </td>
                    </tr>
                    <tr>
                        <th> InventorySlotType</th>
                        <td> {{ $item->InventorySlotType }} </td>
                    </tr>
                    @foreach($properties as $property)
                        <tr>
                            <th>{{ $property->name }}</th>
                            <td> {{ $property->value }} </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
