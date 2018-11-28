@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">restorable-object {{ $restorableObject->id }}</div>
                    <div class="card-body">

                        <a href="{{ url('restorable-objects' . getQueryParams(request())) }}" title="Back">
                            <button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                                Back
                            </button>
                        </a>
                        <a href="{{ url('restorable-objects/' . $restorableObject->id . '/edit') }}"
                           title="Edit restorable-object">
                            <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"
                                                                      aria-hidden="true"></i> Edit
                            </button>
                        </a>

                        <form method="POST" action="{{ url('admin/restorable-objects' . '/' . $restorableObject->id) }}"
                              accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete restorable-object"
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
                                    <td>{{ $restorableObject->id }}</td>
                                </tr>
                                <tr>
                                    <th> Name</th>
                                    <td> {{ $restorableObject->name }} </td>
                                </tr>
                                <tr>
                                    <th> TopListItems</th>
                                    <td>
                                        <table class="table-bordered">
                                            @foreach($topList as $item)
                                                <tr>
                                                    <td>
                                                        {{ $item->item->Name }}
                                                    </td>
                                                    <td>
                                                        {{ $item->RequiredCount }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <th> BottomListItems</th>
                                    <td>
                                        <table class="table-bordered">
                                            @foreach($bottomList as $item)
                                                <tr>
                                                    <td>
                                                        {{ $item->item->Name }}
                                                    </td>
                                                    <td>
                                                        {{ $item->RequiredCount }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </td>
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
