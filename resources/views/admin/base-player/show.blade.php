@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Base player</div>
                    <div class="card-body">

                        <form method="POST" action="{{ url('/players/' . $player->ID) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                        @foreach($properties as $property)

                                <div class="form-group {{ $errors->has($property->property) ? 'has-error' : ''}}">
                                    <label for="{{ $property->property }}" class="col-md-4 control-label">{{ $property->property }}</label>
                                    <div class="col-md-6">
                                        <input class="form-control" name="{{ $property->property }}" type="{{ $property->type=='string'?'text':'number' }}" id="{{ $property->property }}" value="{{ $property->value or ''}}" >
                                        {!! $errors->first($property->property, '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                        @endforeach
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection