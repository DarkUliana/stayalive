<input type="hidden" name="playerID" value="{{ $player->ID }}">
<h4 style="margin-top: 50px">Items</h4>
<table class="table table-bordered" >
    <tr>
        <th>Item</th>
        <th>CurrentCount</th>
        <th>
            <button id="addItem" type="button" class="btn btn-success">Add</button>
        </th>
    </tr>
    @foreach($cloud as $slot)
        @include('admin.players.slot', $slot)
    @endforeach
</table>
<button type="submit" class="btn btn-info">Update</button>