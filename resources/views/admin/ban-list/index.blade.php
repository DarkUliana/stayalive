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

                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                data-target="#addPlayerModalCenter">
                            Add
                        </button>

                        <br/>
                        <br/>

                        <table class="table table-bordered table-light table-hover">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>GoogleID</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            @foreach($banlist as $item)
                                <tr class="{{ $item->status == 0 ? 'bg-warning' : '' }}">
                                    <td>
                                        {{ $item->ID }}
                                    </td>
                                    <td>{{ $item->player->Name }}</td>
                                    <td>{{ $item->player->googleID }}</td>
                                    <td>
                                        <form method="POST" action="{{ url('/ban-list/' . $item->ID) }}">
                                            {{ method_field('PATCH') }}
                                            {{ csrf_field() }}
                                            <select name="status" class="form-control-sm">
                                                @foreach([1 => 'distrust', 2 => 'ban'] as $key => $status)
                                                    <option value="{{ $key }}" {{ ($item->status == $key || ($item->status == 0 && $key == 1)) ? 'selected' : '' }} {{ (!$key) ? 'disabled' : '' }}>{{ $status }}</option>
                                                @endforeach
                                            </select>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ url('/ban-list' . '/' . $item->ID) }}"
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

                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.ban-list.create')
@endsection