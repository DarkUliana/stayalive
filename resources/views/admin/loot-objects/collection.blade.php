<div class="card">
    <div class="card-header">Add one item collection</div>
    <div class="card-body">
        <form>
            <table class="table-responsive table-bordered">
                <tr>
                    <th>Name</th>
                    <th>Item</th>
                    <th>Chance</th>
                    <th>MinValue</th>
                    <th>MaxValue</th>
                </tr>
                <tr>
                    <td><input id="collectionName" name="name" type="text" value=""></td>
                    <td>
                        <select id="collectionItem" name="items[0][itemID]">
                            @foreach($items as $item)
                                <option name value="{{ $item->ID }}">{{ $item->Name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input name="chance" type="number" value="0" step="0.01">
                    </td>
                    <td>
                        <input name="items[0][minValue]" type="number" value="0" step="0.01">
                    </td>
                    <td>
                        <input name="items[0][maxValue]" type="number" value="0" step="0.01">
                    </td>
                </tr>
            </table>
            <button type="submit" class="btn btn-success">Add collection</button>
        </form>
    </div>
</div>
