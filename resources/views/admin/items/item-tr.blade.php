@foreach($items as $item)
    <tr>
        <td>{{$item->ID }}</td>
        <td>{{ $item->Name }}</td>
        <td>{{ $slotTypes[$item->InventorySlotType] }}</td>
        <td>{{ $itemTypes[$item->itemType] }}</td>
        <td>
            <a href="{{ url('/items/' . $item->ID . '/edit') }}" title="Edit item" class="editItem">
                <button class="btn btn-primary btn-sm"><i
                            class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                </button>
            </a>

            <form method="POST" action="{{ url('/items' . '/' . $item->ID) }}" accept-charset="UTF-8"
                  style="display:inline">
                <input type="hidden" name="_method" value="DELETE">
                {{ csrf_field() }}

                <button class="btn btn-danger btn-sm" title="Delete item"
                        onclick="return confirm('Confirm delete?')"><i
                            class="fa fa-trash-o" aria-hidden="true"></i> Delete
                </button>

            </form>
        </td>
    </tr>
@endforeach