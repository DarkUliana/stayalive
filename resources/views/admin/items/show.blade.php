@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">item {{ $item->ID }}</div>
                    <div class="card-body">

                        <a href="{{ url('/items') }}" title="Back">
                            <button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                                Back
                            </button>
                        </a>
                        <a href="{{ url('/items/' . $item->ID . '/edit') }}" title="Edit item">
                            <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"
                                                                      aria-hidden="true"></i> Edit
                            </button>
                        </a>

                        <form method="POST" action="{{ url('admin/items' . '/' . $item->ID) }}" accept-charset="UTF-8"
                              style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete item"
                                    onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o"
                                                                                             aria-hidden="true"></i>
                                Delete
                            </button>
                        </form>
                        <br/>
                        <br/>

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
                                @foreach($item->properties as $property)
                                    <tr>
                                        <th>{{ $property->propertyName }}</th>
                                        <td> {{ $property->propertyValue }} </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
