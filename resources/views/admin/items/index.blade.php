@extends('layouts.app')

@section('content')
    <div class="container-fluid" id="itemsContainer">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-5 col-sm-6" id="itemsCol">
                <div class="card">
                    <div class="card-header"><h3>Items</h3></div>
                    <div class="card-body">
                        <a href="{{ url('/items/create') }}" class="btn btn-success btn-sm" title="Add New item" id="addItem">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form id="filterForm" method="GET" action="{{ url('/items') }}" accept-charset="UTF-8"
                              class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group" style="margin-right: 20px">
                                <select id="filter" name="filter">
                                    <option></option>
                                    @foreach($types as $key => $type)
                                        <option value="{{ $key }}">{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..."
                                       value="{{ request('search') }}">
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
                                    <th>InventorySlotType</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody id="itemsTbody">

                                @include('admin.items.item-tr')

                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $items->appends(['search' => Request::get('search'), 'filter' => Request::get('filter'), 'sort' => Request::get('sort')])->links() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-4" id="itemBlade">
            </div>
        </div>
    </div>
@endsection
