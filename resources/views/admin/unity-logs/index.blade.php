@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('admin.sidebar', ['sidebarClass' => 'col-md-2 offset-md-1'])

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Unity logs</div>
                    <div class="card-body">

                        <form method="GET" action="{{ url('/unity-logs') }}" accept-charset="UTF-8"
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

                        <div class="table-responsive table-bordered">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th style="min-width: 110px;">logTime</th>
                                    <th>playerID</th>
                                    <th>logType</th>
                                    <th style="word-break: break-all;">logCondition</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($logs as $log)
                                    <tr>
                                        <td>{{ $log->created_at }}</td>
                                        <td>{{ $log->playerID }}</td>
                                        <td>{{ $log->logType }}</td>
                                        <td>{{ $log->logCondition }}</td>
                                        <td>
                                            <a href="{{ url('unity-logs/' . $log->ID) }}"
                                               title="View Log">
                                                <button class="btn btn-info btn-sm"><i class="fa fa-eye"
                                                                                       aria-hidden="true"></i> View
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $logs->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection