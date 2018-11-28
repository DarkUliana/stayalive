@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Log {{ $log->ID }}</div>
                    <div class="card-body">

                        <a href="{{ url('unity-logs' . getQueryParams(request())) }}" title="Back">
                            <button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                                Back
                            </button>
                        </a>

                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th>logTime</th>
                                    <td> {{ $log->logTime }} </td>
                                </tr>
                                <tr>
                                    <th>playerID</th>
                                    <td>{{ $log->playerID }}</td>
                                </tr>
                                <tr>
                                    <th>logType</th>
                                    <td> {{ $log->logType }} </td>
                                </tr>
                                <tr>
                                    <th>logCondition</th>
                                    <td> {{ $log->logCondition }} </td>
                                </tr>
                                <tr>
                                    <th>logTrace</th>
                                    <td> {{ $log->logTrace }} </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection