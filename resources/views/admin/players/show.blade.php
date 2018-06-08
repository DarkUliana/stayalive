@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">player {{ $player->ID }}</div>
                    <div class="card-body">

                        <a href="{{ url('/players') }}" title="Back">
                            <button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                                Back
                            </button>
                        </a>
                        <a href="{{ url('/players/' . $player->ID . '/edit') }}" title="Edit player">
                            <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"
                                                                      aria-hidden="true"></i> Edit
                            </button>
                        </a>

                        <form method="POST" action="{{ url('players' . '/' . $player->ID) }}"
                              accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete player"
                                    onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o"
                                                                                             aria-hidden="true"></i>
                                Delete
                            </button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <th colspan="2" class="text-center">Player</th>
                                </tr>
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $player->ID }}</td>
                                </tr>
                                <tr>
                                    <th> Name</th>
                                    <td> {{ $player->Name }} </td>
                                </tr>
                                <tr>
                                    <th> GoogleID</th>
                                    <td> {{ $player->googleID }} </td>
                                </tr>
                                <tr>
                                    <th>GoldCoin</th>
                                    <td>{{ $player->goldCoin }}</td>
                                </tr>
                                <tr>
                                    <th>TechCoin</th>
                                    <td>{{ $player->techCoin }}</td>
                                </tr>
                                </tbody>
                            </table>

                            <table class="table table-bordered">
                                <tr>
                                    <th colspan="3" class="text-center">Cloud items</th>
                                </tr>

                                <tr>
                                    <th>Name</th>
                                    <th>Count</th>
                                </tr>
                                @foreach($cloud as $item)
                                    <tr>
                                        <th>{{ $item->imageName }}</th>
                                        <th>{{ $item->count }}</th>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
