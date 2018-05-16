<table class="table table-bordered">
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