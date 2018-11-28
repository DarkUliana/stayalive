@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('admin.sidebar', ['sidebarClass' => 'col-md-2 offset-md-1'])

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">LaravelLog {{ $laravellog->ID }}</div>
                    <div class="card-body">

                        <a href="{{ url('/laravel-logs' . getQueryParams(request())) }}" title="Back">
                            <button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                                Back
                            </button>
                        </a>

                        <form method="POST" action="{{ url('laravellogs' . '/' . $laravellog->ID) }}"
                              accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete LaravelLog"
                                    onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o"
                                                                                             aria-hidden="true"></i>
                                Delete
                            </button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th> Created At</th>
                                    <td> {{ $laravellog->created_at }} </td>
                                </tr>
                                <tr>
                                    <th> Message</th>
                                    <td> {{ $laravellog->message }} </td>
                                </tr>
                                <tr>
                                    <th> File</th>
                                    <td> {{ $laravellog->file }} </td>
                                </tr>
                                <tr>
                                    <th> Line</th>
                                    <td> {{ $laravellog->line }} </td>
                                </tr>
                                <tr>
                                    <th> URL</th>
                                    <td> {{ $laravellog->url }} </td>
                                </tr>
                                <tr>
                                    <th> Input</th>
                                    <td> {{ $laravellog->input }} </td>
                                </tr>
                                <tr>
                                    <th> Detail</th>
                                    <td> {{ $laravellog->detail }} </td>
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
