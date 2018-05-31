@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">description {{ $description->ID }}</div>
                    <div class="card-body">

                        <a href="{{ url()->previous() }}" title="Back">
                            <button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                                Back
                            </button>
                        </a>
                        <a href="{{ url('/descriptions/' . $description->ID . '/edit') }}"
                           title="Edit description">
                            <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"
                                                                      aria-hidden="true"></i> Edit
                            </button>
                        </a>

                        <form method="POST" action="{{ url('admin/descriptions' . '/' . $description->ID) }}"
                              accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete description"
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
                                    <td>{{ $description->ID }}</td>
                                </tr>
                                <tr>
                                    <th> Key</th>
                                    <td> {{ $description->key }} </td>
                                </tr>

                                @foreach($description->localizations as $localization)
                                    <tr>
                                        <th>{{$localization->language->language}}</th>
                                        <td>{{$localization->name}}</td>
                                        <td>{{$localization->description}}</td>
                                    </tr>
                                </tbody>
                                @endforeach

                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
