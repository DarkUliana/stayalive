@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Quest-replacement-times</div>
                    <div class="card-body">

                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addTime">
                            Add
                        </button>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Time</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($questReplacementTimes as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->ID }}</td>
                                        <td>{{ $item->time }}</td>
                                        <td>
                                            <form method="POST" action="{{ url('/quest-replacement-times' . '/' . $item->ID) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete quest-replacement-time" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $questReplacementTimes->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.quest-replacement-times.create')
@endsection
