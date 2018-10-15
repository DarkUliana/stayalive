<div class="card one-item-collection-card" style="margin-bottom: 20px">
    <div class="card-header">Add one item collection</div>
    <div class="card-body">
        <form id="collectionForm">
            <table class="table-responsive table-bordered" style="margin-bottom: 20px">
                <tr>
                    <th>Name</th>
                    <th>Item</th>
                    <th>Chance</th>
                    <th>MinValue</th>
                    <th>MaxValue</th>
                </tr>
                <tr>
                    <td><input id="collectionName" class="form-control" name="name" type="text" value="" required></td>
                    <td>
                        <select id="collectionItem" name="items[0][itemID]">
                            @foreach($items as $item)
                                <option name value="{{ $item->ID }}">{{ $item->Name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input  class="form-control collectionValue" name="chance" type="number" value="0" step="0.01" required>
                    </td>
                    <td>
                        <input  class="form-control collectionValue" name="items[0][minValue]" type="number" value="0" step="0.01" required>
                    </td>
                    <td>
                        <input  class="form-control collectionValue" name="items[0][maxValue]" type="number" value="0" step="0.01" required>
                    </td>
                </tr>
            </table>
            <button id="addCollection" type="submit" class="btn btn-success">Add collection</button>
        </form>
    </div>
</div>
