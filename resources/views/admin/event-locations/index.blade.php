@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Eventlocations</div>
                    <div class="card-body">
                        <a href="{{ url('/event-locations/create') }}" class="btn btn-success btn-sm"
                           title="Add New EventLocation">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/event-locations') }}" accept-charset="UTF-8"
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
                                    <th>TriggerType</th>
                                    <th>ConditionName</th>
                                    <th>RespownCount</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($eventLocations as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->triggerType }}</td>
                                        <td>{{ $item->conditionName }}</td>
                                        <td>{{ $item->respownCount }}</td>
                                        <td>
                                            <a href="{{ url('/event-locations/' . $item->ID) }}"
                                               title="View EventLocation">
                                                <button class="btn btn-info btn-sm"><i class="fa fa-eye"
                                                                                       aria-hidden="true"></i> View
                                                </button>
                                            </a>
                                            <a href="{{ url('/event-locations/' . $item->ID . '/edit') }}"
                                               title="Edit EventLocation">
                                                <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"
                                                                                          aria-hidden="true"></i> Edit
                                                </button>
                                            </a>

                                            <form method="POST" action="{{ url('/event-locations' . '/' . $item->ID) }}"
                                                  accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                        title="Delete EventLocation"
                                                        onclick="return confirm(&quot;Confirm delete?&quot;)"><i
                                                            class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $eventLocations->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                        <hr/>
                        <form method="POST" action="{{ url('/timer-to-new-attempt') }}"
                              accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="col-md-6 form-group {{ $errors->has('timerToNewAttempt') ? 'has-error' : ''}}">
                                <label for="timerToNewAttempt" class="control-label">{{ 'timerToNewAttempt' }}</label>
                                <input class="form-control" name="timerToNewAttempt" type="number"
                                       id="timerToNewAttempt" step="0.01"
                                       value="{{ isset($timerToNewAttempt) ? $timerToNewAttempt->timerToNewAttempt : 0}}">
                                {!! $errors->first('timerToNewAttempt', '<p class="help-block">:message</p>') !!}
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
