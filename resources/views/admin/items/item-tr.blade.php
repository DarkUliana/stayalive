@foreach($items as $item)
    <tr>
        <td>{{$item->ID }}</td>
        <td>{{ $item->Name }}</td>
        <td>{{ $types[$item->InventorySlotType] }}</td>
        <td>
            <a href="{{ url('/items/' . $item->ID) }}" title="View item" class="viewItem">
                <button class="btn btn-info btn-sm"><i class="fa fa-eye"
                                                       aria-hidden="true"></i> View
                </button>
            </a>

            <a href="{{ url('/items/' . $item->ID . '/edit') }}" title="Edit item" class="editItem">
                <button class="btn btn-primary btn-sm"><i
                            class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                </button>
            </a>

            <a href="{{ url('/items' . '/' . $item->ID) }}" title="Delete item" class="deleteItem">
                <button class="btn btn-danger btn-sm" title="Delete item"
                        onclick="return confirm('Confirm delete?')"><i
                            class="fa fa-trash-o" aria-hidden="true"></i> Delete
                </button>
            </a>
        </td>
    </tr>
@endforeach