@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header"><h3>Languages</h3></div>
                    <div class="card-body">
                        <button class="btn btn-success btn-sm addLanguage" title="Add New language">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </button>

                        <form method="GET" action="{{ url('/languages') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Language</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($languages as $item)
                                    <tr>
                                        <td>{{$item->ID }}</td>
                                        <td>
                                            <div class="languageName">{{ $item->language }}</div>
                                            <form method="POST" action="{{ url('/languages/' . $item->ID) }}" accept-charset="UTF-8" class="form-horizontal editForm" enctype="multipart/form-data"  style="display: none;">
                                                {{ method_field('PATCH') }}
                                                {{ csrf_field() }}

                                                @include ('admin.languages.form', ['submitButtonText' => 'Update'])

                                            </form>
                                        </td>
                                        <td>
                                            <button class="btn btn-primary btn-sm editLanguage" title="Edit language"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>

                                            <form method="POST" action="{{ url('/languages' . '/' . $item->ID) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete language" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $languages->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
