@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Techcoinsetting</div>
                    <div class="card-body">
                        <a href="{{ url('techcoin-settings') }}" class="btn btn-success btn-sm"
                           title="Add New techcoinSetting">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/techcoin-setting') }}" accept-charset="UTF-8"
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
                        <form action="{{ url("techcoin-settings") }}" method="POST">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Property</th>
                                        <th>Value</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    {{ csrf_field() }}
                                    @foreach($techcoinsetting as $item)
                                        <tr>
                                            <td>{{ $item->property }}</td>
                                            <td><input class="form-control" name="settings[{{ $item->ID }}]"
                                                       type="number" step="0.01"
                                                       value="{{ $item->value }}"></td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <button type="submit" class="btn btn-success">Save</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
