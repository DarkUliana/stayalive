@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">reward {{ $reward->ID }}</div>
                    <div class="card-body">

                        <a href="{{ url('/rewards') }}" title="Back">
                            <button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                                Back
                            </button>
                        </a>
                        <a href="{{ url('/rewards/' . $reward->ID . '/edit') }}" title="Edit reward">
                            <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"
                                                                      aria-hidden="true"></i> Edit
                            </button>
                        </a>

                        <form method="POST" action="{{ url('admin/rewards' . '/' . $reward->ID) }}"
                              accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete reward"
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
                                    <td>{{ $reward->ID }}</td>
                                </tr>
                                <tr>
                                    <th> Name</th>
                                    <td> {{ $reward->name }} </td>
                                </tr>
                                <tr>
                                    <th> Chest</th>
                                    <td> {{ $reward->chest }} </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <h4>Items</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <th>Name</th>
                                    <th>Count</th>
                                    <th>Rarity</th>
                                </tr>

                                @foreach($components as $component)
                                    <tr>
                                        <td>{{ $component->item->Name }}</td>
                                        <td>{{ $component->count }}</td>
                                        <td>{{ $component->rarity }}</td>
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
