@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">Mobs</div>
                    <div class="card-body">
                        <a href="{{ url('mobs/create') }}" class="btn btn-success btn-sm" title="Add New mob">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('mobs') }}" accept-charset="UTF-8"
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
                                    <th>
                                        <div class="row">
                                            <div class="col-md-8">EnemyType</div>
                                            <div class="col-md-2">
                                                <div class="sort">
                                                    <a href="{{ url('/mobs?sort=enemyType&type=asc') }}"><span
                                                                class="octicon octicon-chevron-up up"></span></a><a
                                                            href="{{ url('/mobs?sort=enemyType&type=desc') }}"><span
                                                                class="octicon octicon-chevron-down down"></span></a>
                                                </div>
                                            </div>
                                            <div class="col-md-2"></div>
                                        </div></th>
                                    <th>
                                        <div class="row">
                                            <div class="col-md-8">EnemyLevel</div>
                                            <div class="col-md-2">
                                                <div class="sort">
                                                    <a href="{{ url('/mobs?sort=enemyLevel&type=asc') }}"><span
                                                                class="octicon octicon-chevron-up up"></span></a><a
                                                            href="{{ url('/mobs?sort=enemyLevel&type=desc') }}"><span
                                                                class="octicon octicon-chevron-down down"></span></a>
                                                </div>
                                            </div>
                                            <div class="col-md-2"></div>
                                        </div></th>
                                    <th>
                                        <div class="row">
                                            <div class="col-md-8">MaximumHP</div>
                                            <div class="col-md-2">
                                                <div class="sort">
                                                    <a href="{{ url('/mobs?sort=maximumHP&type=asc') }}"><span
                                                                class="octicon octicon-chevron-up up"></span></a><a
                                                            href="{{ url('/mobs?sort=maximumHP&type=desc') }}"><span
                                                                class="octicon octicon-chevron-down down"></span></a>
                                                </div>
                                            </div>
                                            <div class="col-md-2"></div>
                                        </div></th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($mobs as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->ID }}</td>
                                        <td>{{ $item->enemy->name }}</td>
                                        <td>{{ $item->enemyLevel }}</td>
                                        <td>{{ $item->maximumHP }}</td>
                                        <td>
                                            <a href="{{ url('mobs/' . $item->ID) }}" title="View mob">
                                                <button class="btn btn-info btn-sm"><i class="fa fa-eye"
                                                                                       aria-hidden="true"></i> View
                                                </button>
                                            </a>
                                            <a href="{{ url('mobs/' . $item->ID . '/edit') }}" title="Edit mob">
                                                <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"
                                                                                          aria-hidden="true"></i> Edit
                                                </button>
                                            </a>

                                            <form method="POST" action="{{ url('mobs' . '/' . $item->ID) }}"
                                                  accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete mob"
                                                        onclick="return confirm(&quot;Confirm delete?&quot;)"><i
                                                            class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $mobs->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
