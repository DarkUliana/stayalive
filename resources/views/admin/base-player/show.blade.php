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
                    <div class="card-header">Base player</div>
                    <div class="card-body">

                        <form method="POST" action="{{ url('/base-player/') }}" accept-charset="UTF-8"
                              class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <table class="table table-bordered table-light table-hover">
                                <tr>
                                    <th>Name</th>
                                    <th>Value</th>
                                </tr>
                                @foreach($properties as $property)
                                    <tr>
                                        <td style="font-weight: 600">{{ $property->property }}</td>
                                        <td>
                                            <input class="form-control" name="{{ $property->property }}"
                                                   type="{{ $property->type=='string'?'text':'number' }}"
                                                   id="{{ $property->property }}"
                                                   value="{{ $property->value or ''}}"
                                            {{ $property->type=='double'?'step=0.01':'' }}>
                                            {!! $errors->first($property->property, '<p class="help-block">:message</p>') !!}

                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            <button type="submit" class="btn btn-success">Update</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection