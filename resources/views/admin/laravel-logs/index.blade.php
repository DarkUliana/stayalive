@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('admin.sidebar', ['sidebarClass' => 'col-md-2 offset-md-1'])

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Laravellogs</div>
                    <div class="card-body">
                        <a href="{{ url('/laravel-logs/create') }}" class="btn btn-success btn-sm"
                           title="Add New LaravelLog">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/laravel-logs') }}" accept-charset="UTF-8"
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
                                <tr class="d-flex">
                                    <th class="col-1">Created At</th>
                                    <th class="col-3">Message</th>
                                    <th class="col-4">File</th>
                                    <th class="col-2">Url</th>
                                    <th class="col-1">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($laravellogs as $item)
                                    <tr class="d-flex">
                                        <td class="col-1">{{ $item->created_at }}</td>
                                        <td class="col-3">{{ $item->message }}</td>
                                        <td class="col-4">{{ substr($item->file,strrpos($item->file,"\\")+1) }} {!! "<br>line: " !!} {{ $item->line }}</td>
                                        <td class="col-2">{{ str_replace(env('APP_URL'), '', $item->url) }}</td>
                                        <td class="col-1">
                                            <a href="{{ url('/laravel-logs/' . $item->ID) }}" title="View LaravelLog">
                                                <button class="btn btn-info btn-sm"><i class="fa fa-eye"
                                                                                       aria-hidden="true"></i> View
                                                </button>
                                            </a>

                                            <form method="POST" action="{{ url('/laravel-logs' . '/' . $item->ID) }}"
                                                  accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                        title="Delete LaravelLog"
                                                        onclick="return confirm(&quot;Confirm delete?&quot;)"><i
                                                            class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $laravellogs->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
