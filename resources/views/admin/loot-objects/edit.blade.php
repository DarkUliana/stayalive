@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Edit LootObject #{{ $lootobject->ID }}</div>
                    <div class="card-body">
                        <a href="{{ url('/loot-objects') }}" title="Back">
                            <button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                                Back
                            </button>
                        </a>
                        <br/>
                        <br/>

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form id="mainForm" method="POST" action="{{ url('/loot-objects/' . $lootobject->ID) }}"
                              accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('admin.loot-objects.form')
                            <button id="submit" class="btn btn-primary">Update</button>
                        </form>

                    </div>
                </div>
                @include ('admin.loot-objects.collection')

                <div class="card collections-card">
                    <div class="card-header">Collections</div>
                    <div class="card-body">
                        @foreach($lootobject->collections as $collection)
                            @include ('admin.loot-objects.edit-collection')
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
