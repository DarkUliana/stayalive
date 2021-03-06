@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">quest {{ $quest->ID }}</div>
                    <div class="card-body">

                        <a href="{{ url('/quests' . getQueryParams(request())) }}" title="Back">
                            <button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                                Back
                            </button>
                        </a>
                        <a href="{{ url('/quests/' . $quest->ID . '/edit') }}" title="Edit quest">
                            <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"
                                                                      aria-hidden="true"></i> Edit
                            </button>
                        </a>

                        <form method="POST" action="{{ url('admin/quests' . '/' . $quest->ID) }}" accept-charset="UTF-8"
                              style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete quest"
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
                                    <td>{{ $quest->ID }}</td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $quest->name }}</td>
                                </tr>
                                <tr>
                                    <th> Type</th>
                                    <td> {{ $quest->type->name }} </td>
                                </tr>

                                @if(!empty($field))
                                    <tr>
                                        <th> {{ $field['name'] }}</th>
                                        <td> {{ $field['count'] }} </td>
                                    </tr>
                                @endif


                                <tr>
                                    <th> Level</th>
                                    <td> {{ $quest->level or 0 }} </td>
                                </tr>
                                <tr>
                                    <th> StarPoints</th>
                                    <td> {{ $quest->starPoints }} </td>
                                </tr>
                                <tr>
                                    <th>Reward</th>
                                    <td>{{ $quest->reward->name }}</td>
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
