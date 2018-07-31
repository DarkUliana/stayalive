@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">Ban list</div>
                    <div class="card-body">

                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addPlayerModalCenter">
                            Add
                        </button>
                        <div class="btn btn-danger btn-sm" id="deletePlayersButton" title="Delete Selected">
                            <i class="fa fa-trash-o" aria-hidden="true"></i> Delete Selected
                        </div>
                        {{--<div class="btn btn-danger btn-sm" id="deleteAllPlayers" title="Delete All">--}}
                        {{--&#128128; Delete All--}}
                        {{--</div>--}}

                        <br/>
                        <br/>

                        <form method="POST" action="{{ url('/base-player/') }}" accept-charset="UTF-8"
                              class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <table class="table table-bordered table-light table-hover">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>GoogleID</th>
                                    <th>Actions</th>
                                </tr>
                                @foreach($banlist as $item)
                                    <tr>
                                        <td>
                                        <td>
                                            <div class="checkbox">
                                                <label>
                                                    <input class="forDelete" name="googleIDs[{{ $item->googleID }}]"
                                                           type="checkbox">
                                                </label>
                                            </div>
                                        </td>
                                        </td>
                                        <td>{{ $item->googleID }}</td>
                                        <td>{{ $item->player->Name }}</td>
                                        <td>
                                            <form method="POST" action="{{ url('/banlist' . '/' . $item->ID) }}"
                                                  accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                        title="Delete player"
                                                        onclick="return confirm('Confirm delete?')"><i
                                                            class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.banlist.create')
@endsection