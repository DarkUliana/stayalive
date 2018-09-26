@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Lootcollections</div>
                    <div class="card-body">
                        <a href="{{ url('/loot-collections/create') }}" class="btn btn-success btn-sm"
                           title="Add New LootCollection">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/loot-collections') }}" accept-charset="UTF-8"
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
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Chance</th>
                                    <th>MinValue</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($lootcollections as $item)
                                    <tr>
                                        <td>{{$item->ID }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->chance }}</td>
                                        <td>{{ $item->minValue }}</td>
                                        <td>
                                            <a href="{{ url('/loot-collections/' . $item->ID) }}"
                                               title="View LootCollection">
                                                <button class="btn btn-info btn-sm"><i class="fa fa-eye"
                                                                                       aria-hidden="true"></i> View
                                                </button>
                                            </a>
                                            <a href="{{ url('/loot-collections/' . $item->ID . '/edit') }}"
                                               title="Edit LootCollection">
                                                <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"
                                                                                          aria-hidden="true"></i> Edit
                                                </button>
                                            </a>

                                            <button class="btn btn-sm btn-danger deleteCollection" data-id="{{ $item->ID }}">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                Delete
                                            </button>
                                            {{--<form method="POST"--}}
                                            {{--action="{{ url('/loot-collections' . '/' . $item->ID) }}"--}}
                                            {{--accept-charset="UTF-8" style="display:inline">--}}
                                            {{--{{ method_field('DELETE') }}--}}
                                            {{--{{ csrf_field() }}--}}
                                            {{--<button type="submit" class="btn btn-danger btn-sm"--}}
                                            {{--title="Delete LootCollection"--}}
                                            {{--onclick="return confirm(&quot;Confirm delete?&quot;)"><i--}}
                                            {{--class="fa fa-trash-o" aria-hidden="true"></i> Delete--}}
                                            {{--</button>--}}
                                            {{--</form>--}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $lootcollections->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">What do you want to delete?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><div id="collection" class="text-black-50"><div></div> is linked to <div id="object" class="text-black-50"><div></div>. Do you want to remove both?</p>
                </div>
                <div class="modal-footer">
                    <button id="delWithObj" type="button" class="btn btn-danger">Delete with object</button>
                    <button id="delCollection" type="button" class="btn btn-warning">Delete only collection</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
