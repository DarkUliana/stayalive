@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-7">
                <div class="card">
                    <div class="card-header"><h3>Recipes</h3></div>
                    <div class="card-body">
                        <a href="{{ url('/recipes/create') }}" class="btn btn-success btn-sm" title="Add New recipe">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/recipes') }}" accept-charset="UTF-8"
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
                                    <th>
                                        <div class="row">
                                        <div class="col-md-6">#</div>
                                        <div class="col-md-2">
                                            <div class="sort">
                                                <a href="{{ url('/recipes?sort=ID&type=asc') }}"><span
                                                            class="octicon octicon-chevron-up up"></span></a><a
                                                        href="{{ url('/recipes?sort=ID&type=desc') }}"><span
                                                            class="octicon octicon-chevron-down down"></span></a>
                                            </div>
                                        </div>
                                        <div class="col-md-4"></div>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="row">
                                        <div class="col-md-5">Name</div>
                                        <div class="col-md-5">
                                            <div class="sort">
                                                <a href="{{ url('/recipes?sort=Name&type=asc') }}"><span
                                                            class="octicon octicon-chevron-up up"></span></a><a
                                                        href="{{ url('/recipes?sort=Name&type=desc') }}"><span
                                                            class="octicon octicon-chevron-down down"></span></a>
                                            </div>
                                        </div>
                                        <div class="col-md-2"></div></div>
                                    </th>
                                    <th>
                                        <div class="row">
                                        <div class="col-md-8">RecipeType</div>
                                        <div class="col-md-2">
                                            <div class="sort">
                                                <a href="{{ url('/recipes?sort=recipeType&type=asc') }}"><span
                                                            class="octicon octicon-chevron-up up"></span></a><a
                                                        href="{{ url('/recipes?sort=recipeType&type=desc') }}"><span
                                                            class="octicon octicon-chevron-down down"></span></a>
                                            </div>
                                        </div>
                                        <div class="col-md-2"></div></div>
                                    </th>
                                    <th>
                                        <div class="row">
                                        <div class="col-md-8">CraftTime</div>
                                        <div class="col-md-2">
                                            <div class="sort">
                                                <a href="{{ url('/recipes?sort=CraftTime&type=asc') }}"><span
                                                            class="octicon octicon-chevron-up up"></span></a><a
                                                        href="{{ url('/recipes?sort=CraftTime&type=desc') }}"><span
                                                            class="octicon octicon-chevron-down down"></span></a>
                                            </div>
                                        </div>
                                        <div class="col-md-2"></div>
                                        </div>
                                    </th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($recipes as $item)
                                    <tr>
                                        <td>{{$item->ID }}</td>
                                        <td>{{ $item->Name }}</td>
                                        <td>{{ $item->recipeType }}</td>
                                        <td>{{ $item->CraftTime }}</td>
                                        <td>
                                            <a href="{{ url('/recipes/' . $item->ID) }}" title="View recipe">
                                                <button class="btn btn-info btn-sm"><i class="fa fa-eye"
                                                                                       aria-hidden="true"></i> View
                                                </button>
                                            </a>
                                            <a href="{{ url('/recipes/' . $item->ID . '/edit') }}" title="Edit recipe">
                                                <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"
                                                                                          aria-hidden="true"></i> Edit
                                                </button>
                                            </a>

                                            <form method="POST" action="{{ url('/recipes' . '/' . $item->ID) }}"
                                                  accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                        title="Delete recipe"
                                                        onclick="return confirm(&quot;Confirm delete?&quot;)"><i
                                                            class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $recipes->appends(['search' => Request::get('search'), 'filter' => Request::get('filter'), 'sort' => Request::get('sort')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
