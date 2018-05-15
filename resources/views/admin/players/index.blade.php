@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">Players</div>
                    <div class="card-body">
                        <a href="{{ url('/players/create') }}" class="btn btn-success btn-sm" title="Add New player">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                        <div class="btn btn-danger btn-sm" id="deletePlayersButton" title="Delete Selected">
                            <i class="fa fa-trash-o" aria-hidden="true"></i> Delete Selected
                        </div>

                        <form method="GET" action="{{ url('/players') }}" accept-charset="UTF-8"
                              class="form-inline my-2 my-lg-0 float-right" role="search">
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
                                    <th></th>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>GoogleID</th>
                                    <th>Online</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <form id="deleteForm" method="POST" action="{{ url('players') }}">
                                    <input type="hidden" name="_method" value="delete" />
                                    {!! csrf_field() !!}
                                    @foreach($players as $item)
                                        <tr>
                                            <td>
                                                <div class="checkbox">
                                                    <label>
                                                        <input class="forDelete" name="googleIDs[{{ $item->googleID }}]" type="checkbox">
                                                    </label>
                                                </div>
                                            </td>
                                            <td>{{ $item->ID }}</td>
                                            <td>{{ $item->Name }}</td>
                                            <td>{{ $item->googleID }}</td>
                                            <td>
                                            </td>
                                            <td>
                                                <a href="{{ url('/players/' . $item->ID) }}" title="View player">
                                                    <button class="btn btn-info btn-sm"><i class="fa fa-eye"
                                                                                           aria-hidden="true"></i> View
                                                    </button>
                                                </a>
                                                <a href="{{ url('/players/' . $item->ID . '/edit') }}"
                                                   title="Edit player">
                                                    <button class="btn btn-primary btn-sm"><i
                                                                class="fa fa-pencil-square-o"
                                                                aria-hidden="true"></i> Edit
                                                    </button>
                                                </a>

                                                    <button class="btn btn-danger btn-sm  delBtn"
                                                            title="Delete player"
                                                            onclick="return confirm(&quot;Confirm delete?&quot;)">
                                                        <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                                    </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </form>
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $players->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
