@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">event-island {{ $eventIsland->ID }}</div>
                    <div class="card-body">

                        <a href="{{ url('/event-islands' . getQueryParams(request())) }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/event-islands/' . $eventIsland->ID . '/edit') }}" title="Edit event-island"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('event-islands' . '/' . $eventIsland->ID) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete event-island" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $eventIsland->ID }}</td>
                                    </tr>
                                    <tr><th> LocationName </th><td> {{ $eventIsland->locationName }} </td></tr><tr><th> FrequencyOfOccurrence </th><td> {{ $eventIsland->frequencyOfOccurrence }} </td></tr><tr><th> Lifetime </th><td> {{ $eventIsland->lifetime }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
