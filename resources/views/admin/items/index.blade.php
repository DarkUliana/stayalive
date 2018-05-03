@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header"><h3>Items</h3></div>
                    <div class="card-body">
                        <a href="{{ url('/items/create') }}" class="btn btn-success btn-sm" title="Add New item">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form id="filterForm" method="GET" action="{{ url('/items') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group" style="margin-right: 20px">
                                <select id="filter" name="filter">
                                    <option></option>
                                    @foreach($types as $key => $type)
                                        <option value="{{ $key }}">{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>
                                            <div class="row">
                                                <div class="col-md-8">Name</div>
                                                <div class="col-md-2">
                                                    <div class="sort">
                                                        <a href="{{ url('/items?sort=Name&type=asc') }}"><span
                                                                    class="octicon octicon-chevron-up up"></span></a><a
                                                                href="{{ url('/items?sort=Name&type=desc') }}"><span
                                                                    class="octicon octicon-chevron-down down"></span></a>
                                                    </div>
                                                </div>
                                                <div class="col-md-2"></div>
                                            </div>
                                        </th>
                                        <th>InventorySlotType</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($items as $item)
                                    <tr>
                                        <td>{{$item->ID }}</td>
                                        <td>{{ $item->Name }}</td><td>{{ $types[$item->InventorySlotType] }}</td>
                                        <td>
                                            <a href="{{ url('/items/' . $item->ID) }}" title="View item"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/items/' . $item->ID . '/edit') }}" title="Edit item"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/items' . '/' . $item->ID) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete item" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $items->appends(['search' => Request::get('search'), 'filter' => Request::get('filter'), 'sort' => Request::get('sort')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
