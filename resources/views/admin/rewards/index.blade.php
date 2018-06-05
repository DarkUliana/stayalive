@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Rewards</div>
                    <div class="card-body">
                        <a href="{{ url('/rewards/create') }}" class="btn btn-success btn-sm" title="Add New reward">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/rewards') }}" accept-charset="UTF-8"
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
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Chest</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($rewards as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->ID }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            @switch($item->chest)
                                                @case(0)
                                                <i class="fa fa-circle" style="color: #98a2ac"></i>
                                                @break
                                                @case(1)
                                                <i class="fa fa-circle" style="color: #0066ff"></i>
                                                @break
                                                @case(2)
                                                <i class="fa fa-circle" style="color: #b366ff"></i>
                                                @break
                                                @case(3)
                                                <i class="fa fa-circle" style="color: #ff8c1a"></i>
                                                @break
                                            @endswitch
                                        </td>
                                        <td>
                                            <a href="{{ url('/rewards/' . $item->ID) }}" title="View reward">
                                                <button class="btn btn-info btn-sm"><i class="fa fa-eye"
                                                                                       aria-hidden="true"></i> View
                                                </button>
                                            </a>
                                            <a href="{{ url('/rewards/' . $item->ID . '/edit') }}" title="Edit reward">
                                                <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"
                                                                                          aria-hidden="true"></i> Edit
                                                </button>
                                            </a>

                                            <form method="POST" action="{{ url('/rewards' . '/' . $item->ID) }}"
                                                  accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                        title="Delete reward"
                                                        onclick="return confirm(&quot;Confirm delete?&quot;)"><i
                                                            class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $rewards->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
