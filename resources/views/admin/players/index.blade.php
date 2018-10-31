@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Players</div>
                    <div class="card-body">
                        <a href="{{ url('/players/create') }}" class="btn btn-success btn-sm" title="Add New player">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                        <div class="btn btn-danger btn-sm" id="deletePlayersButton" title="Delete Selected">
                            <i class="fa fa-trash-o" aria-hidden="true"></i> Delete Selected
                        </div>
                        <div class="btn btn-danger btn-sm" id="deleteAllPlayers" title="Delete All">
                            &#128128; Delete All
                        </div>

                        <form method="GET" action="{{ url('/players') }}" accept-charset="UTF-8"
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
                        <h5>Number of players: {{ $count }}</h5>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>GoogleID</th>
                                    <th>Online</th>
                                    <th>Developer</th>
                                    <th><i class="fa fa-database" style="color: #e08e0b"></i></th>
                                    <th><i class="fa fa-cog" style="color:#1b4f72; font-size: 20px"></i></th>
                                    <th>Level</th>
                                    <th>Actions</th>

                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($players as $item)
                                        <tr>
                                            <td>
                                                <div class="checkbox">
                                                    <label>
                                                        <input class="forDelete" data-id="{{ $item->ID }}"
                                                               type="checkbox">
                                                    </label>
                                                </div>
                                            </td>
                                            <td>{{ $item->ID }}</td>
                                            <td>{{ $item->Name }}</td>
                                            <td>{{ $item->googleID }}</td>
                                            <td>
                                            </td>
                                            <td>
                                                <form action="{{ url('/players/' . $item->ID) }}"
                                                      accept-charset="UTF-8" class="form-horizontal"
                                                      enctype="multipart/form-data">

                                                    {{ Form::checkbox('isDeveloper',true,null,
                                                    ['class'=>'isDeveloper', 'checked' => ($item->isDeveloper ? true : false), 'value' => ($item->isDeveloper ? 1 : 0)]) }}

                                                </form>
                                            </td>
                                            <td>{{ $item->goldCoin }}</td>
                                            <td>{{ $item->techCoin }}</td>
                                            <td>{{ $item->CurrentLevel }}</td>
                                            <td>
                                                {{--<a href="{{ url('/players/' . $item->ID) }}" title="View player">--}}
                                                    {{--<div class="btn btn-info btn-sm"><i class="fa fa-eye"--}}
                                                                                        {{--aria-hidden="true"></i> View--}}
                                                    {{--</div>--}}
                                                {{--</a>--}}
                                                <a href="{{ url('/players/' . $item->ID . '/edit') }}"
                                                   title="Edit player">
                                                    <div class="btn btn-primary btn-sm"><i
                                                                class="fa fa-pencil-square-o"
                                                                aria-hidden="true"></i> Edit
                                                    </div>
                                                </a>

                                                <div class="btn btn-danger btn-sm  deleteOnePlayer"
                                                     title="Delete player">
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $players->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
