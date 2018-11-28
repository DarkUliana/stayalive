@extends('layouts.app')
<?php //var_dump($technology->itemNames); ?>
@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">technology {{ $technology->ID }}</div>
                    <div class="card-body">

                        <a href="{{ url('technologies' . getQueryParams(request())) }}" title="Back">
                            <button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                                Back
                            </button>
                        </a>
                        <a href="{{ url('/technologies/' . $technology->ID . '/edit') }}" title="Edit technology">
                            <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"
                                                                      aria-hidden="true"></i> Edit
                            </button>
                        </a>

                        <form method="POST" action="{{ url('admin/technologies' . '/' . $technology->ID) }}"
                              accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete technology"
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
                                    <td>{{ $technology->ID }}</td>
                                </tr>
                                <tr>
                                    <th> Name</th>
                                    <td> {{ $technology->name }} </td>
                                </tr>
                                <tr>
                                    <th> Level</th>
                                    <td> {{ $technology->level }} </td>
                                </tr>
                                <tr>
                                    <th> PlayerLevel</th>
                                    <td> {{ $technology->playerLevel }} </td>
                                </tr>
                                <tr>
                                    <th> coinCost</th>
                                    <td> {{ $technology->coinCost }} </td>
                                </tr>
                                <tr>
                                    <th> timeToBuild</th>
                                    <td> {{ $technology->timeToBuild }} </td>
                                </tr>
                                <tr>
                                    <th> isBuilding</th>
                                    <td> {{ (int)$technology->isBuilding }} </td>
                                </tr>
                                <tr>
                                    <th> technologyType</th>
                                    <td> {{ $technology->technologyType }} </td>
                                </tr>
                                <tr>
                                    <th> oppenedItems</th>
                                    <td>
                                        @foreach ($technology->items as $item)
                                            {{$item->item->Name}}
                                            <br>
                                        @endforeach
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
