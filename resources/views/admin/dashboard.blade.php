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
                @if(Auth::user()->role)
                    <div class="card">
                        <div class="card-header">Merging</div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-10 offset-md-1">
                                    <div class="row">
                                        <a href="{{ url('test-to-production') }}" class="merge col-md-4 btn btn-danger"
                                           style="color: #fff">Merge test to production</a>
                                        <a href="{{ url('production-to-test') }}"
                                           class="merge col-md-4 offset-md-3 btn btn-success" style="color: #fff">Merge
                                            production to test</a>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                @else
                        <div class="card">
                            <div class="card-header">Dashboard</div>

                            <div class="card-body">
                                <div class="row">

                                </div>
                            </div>
                        </div>
                @endif
            </div>
        </div>
    </div>
@endsection
