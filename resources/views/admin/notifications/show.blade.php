@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">notification {{ $notification->ID }}</div>
                    <div class="card-body">

                        <a href="{{ url('notifications' . getQueryParams(request())) }}" title="Back">
                            <button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                                Back
                            </button>
                        </a>
                        <a href="{{ url('notifications/' . $notification->ID . '/edit') }}" title="Edit notification">
                            <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"
                                                                      aria-hidden="true"></i> Edit
                            </button>
                        </a>

                        <form method="POST" action="{{ url('admin/notifications' . '/' . $notification->ID) }}"
                              accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete notification"
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
                                    <th>ID</th>
                                    <td>{{ $notification->ID }}</td>
                                </tr>
                                <tr>
                                    <th> DescriptionID</th>
                                    <td> {{ $notification->descriptionID }} </td>
                                </tr>
                                <tr>
                                    <th> IsSimple</th>
                                    <td> {{ $notification->isSimple }} </td>
                                </tr>
                                <tr>
                                    <th> ExpirationDate</th>
                                    <td> {{ $notification->expirationDate }} </td>
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
