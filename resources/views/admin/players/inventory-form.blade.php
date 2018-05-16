<input type="hidden" name="googleID" value="{{ $player->googleID }}">
<h4 style="margin-top: 50px">Items</h4>
<table class="table table-bordered" >
    <tr>
        <th>Index</th>
        <th>Item</th>
        <th>CurrentCount</th>
        <th>CurrentDurability</th>
    </tr>
    @foreach($inventory as $slot)
        @include('admin.players.slot', $slot)
    @endforeach
</table>
<button type="submit" class="btn btn-info">Update</button>