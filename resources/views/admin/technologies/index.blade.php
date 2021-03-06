@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-7">
                <div class="card">
                    <div class="card-header"><h3>Technologies</h3></div>
                    <div class="card-body">
                        <a href="{{ url('/technologies/create') }}" class="btn btn-success btn-sm"
                           title="Add New technology">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/technologies') }}" accept-charset="UTF-8"
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
                                    <th>
                                        <div class="row">
                                        <div class="col-md-6">Level</div>
                                        <div class="col-md-2">
                                            <div class="sort">
                                                <a href="{{ url('/technologies?sort=level&type=asc') }}"><span
                                                            class="octicon octicon-chevron-up up"></span></a><a
                                                        href="{{ url('/technologies?sort=level&type=desc') }}"><span
                                                            class="octicon octicon-chevron-down down"></span></a>
                                            </div>
                                        </div>
                                        </div>
                                    </th>
                                    <th>PlayerLevel</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($technologies as $item)
                                    <tr>
                                        <td>{{$item->ID }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->level }}</td>
                                        <td>{{ $item->playerLevel }}</td>
                                        <td>
                                            {{--<a href="{{ url('/technologies/' . $item->ID) }}" title="View technology">--}}
                                                {{--<button class="btn btn-info btn-sm"><i class="fa fa-eye"--}}
                                                                                       {{--aria-hidden="true"></i> View--}}
                                                {{--</button>--}}
                                            {{--</a>--}}
                                            <a href="{{ url('/technologies/' . $item->ID . '/edit') }}"
                                               title="Edit technology">
                                                <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"
                                                                                          aria-hidden="true"></i> Edit
                                                </button>
                                            </a>

                                            <form method="POST" action="{{ url('/technologies' . '/' . $item->ID) }}"
                                                  accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                        title="Delete technology"
                                                        onclick="return confirm(&quot;Confirm delete?&quot;)"><i
                                                            class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $technologies->appends(['search' => Request::get('search'), 'sort' => Request::get('sort'), 'type' => Request::get('type')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
