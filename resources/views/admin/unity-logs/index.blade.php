@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('admin.sidebar', ['sidebarClass' => 'col-md-2 offset-md-1'])

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Unity logs</div>
                    <div class="card-body">
                        <div class="table-responsive table-bordered">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>logTime</th>
                                    <th>googleID</th>
                                    <th>logType</th>
                                    <th style="word-break: break-all;">logCondition</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($logs as $log)
                                    <tr>
                                        <td>{{ $log->logTime }}</td>
                                        <td>{{ $log->googleID }}</td>
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