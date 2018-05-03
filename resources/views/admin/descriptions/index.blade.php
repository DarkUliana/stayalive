@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header"><h3>Descriptions</h3></div>
                    <div class="card-body">
                        <a href="{{ url('/descriptions/create') }}" class="btn btn-success btn-sm"
                           title="Add New description">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                        <a href="{{ url('/description-export') }}" class="btn btn-danger btn-sm" id="export">
                            <i class="fa fa-download" aria-hidden="true"></i> Download
                        </a>

                        <form method="GET" action="{{ url('/descriptions') }}" accept-charset="UTF-8"
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
                                    <th>
                                        <div class="row">
                                            <div class="col-md-6">ID</div>
                                            <div class="col-md-2">
                                                <div class="sort">
                                                    <a href="{{ url('/descriptions?sort=ID&type=asc') }}"><span
                                                                class="octicon octicon-chevron-up up"></span></a><a
                                                            href="{{ url('/descriptions?sort=ID&type=desc') }}"><span
                                                                class="octicon octicon-chevron-down down"></span></a>
                                                </div>
                                            </div>
                                            <div class="col-md-4"></div>
                                        </div>

                                    </th>
                                    <th>
                                        <div class="row">
                                            <div class="col-md-6">Key</div>
                                            <div class="col-md-2">
                                                <div class="sort">
                                                    <a href="{{ url('/descriptions?sort=key&type=asc') }}"><span
                                                                class="octicon octicon-chevron-up up"></span></a><a
                                                            href="{{ url('/descriptions?sort=key&type=desc') }}"><span
                                                                class="octicon octicon-chevron-down down"></span></a>
                                                </div>
                                            </div>
                                            <div class="col-md-4"></div>
                                        </div>

                                    </th>
                                    <th>
                                        <div class="row">
                                            <div class="col-md-6">Status</div>
                                            <div class="col-md-2">
                                                <div class="sort">
                                                    <a href="{{ url('/descriptions?sort=status&type=asc') }}"><span
                                                                class="octicon octicon-chevron-up up"></span></a><a
                                                            href="{{ url('/descriptions?sort=status&type=desc') }}"><span
                                                                class="octicon octicon-chevron-down down"></span></a>
                                                </div>
                                            </div>
                                            <div class="col-md-4"></div>
                                        </div>
                                    </th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($descriptions as $item)
                                    <tr>
                                        <td>{{$item['ID'] }}</td>
                                        <td>{{ $item['key']}}</td>

                                        @if($item['allLanguages'] == $languagesCount)
                                            <td>
                                                <div style="font-size:2em; color:#4CC552"><i
                                                            class="fa fa-check-circle"></i>
                                                </div>
                                            </td>
                                        @else
                                            <td>
                                                <div style="font-size:2em; color:#FFC100"><i
                                                            class="fa fa-exclamation-circle"></i>
                                                </div>
                                            </td>
                                        @endif
                                        <td>
                                            <a href="{{ url('/descriptions/' . $item['ID']) }}"
                                               title="View description">
                                                <button class="btn btn-info btn-sm"><i class="fa fa-eye"
                                                                                       aria-hidden="true"></i> View
                                                </button>
                                            </a>
                                            <a href="{{ url('/descriptions/' . $item['ID'] . '/edit') }}"
                                               title="Edit description">
                                                <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"
                                                                                          aria-hidden="true"></i> Edit
                                                </button>
                                            </a>

                                            <form method="POST"
                                                  action="{{ url('/descriptions' . '/' . $item['ID']) }}"
                                                  accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                        title="Delete description"
                                                        onclick="return confirm(&quot;Confirm delete?&quot;)"><i
                                                            class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $descriptions->appends(['search' => Request::get('search'), 'sort' => Request::get('sort'), 'type' => Request::get('type')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
