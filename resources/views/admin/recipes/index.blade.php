@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('admin.sidebar', ['sidebarClass' => 'col-md-2 offset-md-2 ', 'hideSidebar' => $hideSidebar])

            <div class="{{ (isset($hideSidebar) && $hideSidebar) ? "col-md-12" : "col-md-7" }}" id="main-block">

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
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link  {{ isset($hideSidebar) && $hideSidebar ? "" : "active" }}"
                                   id="nav-list-tab" data-toggle="tab" href="#nav-list"
                                   role="tab" aria-controls="nav-list" aria-selected="true">List</a>
                                <a class="nav-item nav-link  {{ isset($hideSidebar) && $hideSidebar ? "active" : "" }}"
                                   id="nav-table-tab" data-toggle="tab" href="#nav-table"
                                   role="tab" aria-controls="nav-table" aria-selected="false">Table</a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade {{ isset($hideSidebar) && $hideSidebar ? "" : "show active" }}"
                                 id="nav-list" role="tabpanel"
                                 aria-labelledby="nav-list-tab">
                                <br>
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
                                                    <div class="col-md-2"></div>
                                                </div>
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
                                                    <div class="col-md-2"></div>
                                                </div>
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
                                        @foreach($recipes as $recipe)
                                            <tr>
                                                <td>{{$recipe->ID }}</td>
                                                <td>{{ $recipe->Name }}</td>
                                                <td>{{ $recipe->recipeType }}</td>
                                                <td>{{ $recipe->CraftTime }}</td>
                                                <td>
                                                    <a href="{{ url('/recipes/' . $recipe->ID) }}" title="View recipe">
                                                        <button class="btn btn-info btn-sm"><i class="fa fa-eye"
                                                                                               aria-hidden="true"></i>
                                                            View
                                                        </button>
                                                    </a>
                                                    <a href="{{ url('/recipes/' . $recipe->ID . '/edit') }}"
                                                       title="Edit recipe">
                                                        <button class="btn btn-primary btn-sm"><i
                                                                    class="fa fa-pencil-square-o"
                                                                    aria-hidden="true"></i> Edit
                                                        </button>
                                                    </a>

                                                    <form method="POST"
                                                          action="{{ url('/recipes' . '/' . $recipe->ID) }}"
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
                                </div>
                            </div>
                            <div class="tab-pane fade  {{ isset($hideSidebar) && $hideSidebar ? "show active" : "" }}"
                                 id="nav-table" role="tabpanel"
                                 aria-labelledby="nav-table-tab">
                                <br>
                                <form id="table-form">
                                    <div class="table-responsive">
                                        <button class="btn btn-success" type="submit" style="margin: 10px 0px 10px 0px">
                                            Submit
                                        </button>
                                        <table class="table table-sm table-bordered table" style="font-size: 14px;">
                                            <thead>
                                            <tr>
                                                <th rowspan="2" width="200px">Name</th>
                                                <th rowspan="2" width="60px">Level</th>
                                                <th rowspan="2" width="100px">CraftTime</th>
                                                <th rowspan="2" width="50px">RecipeType</th>
                                                @for($i = 1; $i <= 6; ++$i)
                                                    <th colspan="2" width="250px">Ingredient {{ $i }}</th>
                                                @endfor
                                            </tr>
                                            <tr>
                                                @for($i = 1; $i <= 6; ++$i)
                                                    <th width="50px">Amount</th>
                                                    <th>Name</th>
                                                @endfor
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($recipes as $recipe)
                                                <tr>
                                                    <input type="hidden" name="recipes[{{ $loop->index }}][ID]"
                                                           value="{{ $recipe->ID }}">
                                                    <td><input name="recipes[{{ $loop->index }}][Name]"
                                                               class="form-control form-control-sm" type="text"
                                                               value="{{ $recipe->Name }}"></td>
                                                    <td><input name="recipes[{{ $loop->index }}][Level]"
                                                               class="form-control form-control-sm" type="number"
                                                               step="1" value="{{ $recipe->Level }}"></td>
                                                    <td><input name="recipes[{{ $loop->index }}][CraftTime]"
                                                               class="form-control form-control-sm" type="number"
                                                               step="1" value="{{ $recipe->CraftTime }}"></td>
                                                    <td><input name="recipes[{{ $loop->index }}][recipeType]"
                                                               class="form-control form-control-sm" type="number"
                                                               step="1" value="{{ $recipe->recipeType }}"></td>

                                                    @for($i = 0; $i < 6; ++$i)
                                                        <td>
                                                            <input name="recipes[{{ $loop->index }}][components][{{ $i }}][neededCount]"
                                                                   class="form-control form-control-sm" type="number"
                                                                   step="1"
                                                                   value="{{ isset($recipe->components->toArray()[$i]) ? $recipe->components->toArray()[$i]['neededCount'] : 0 }}">
                                                        </td>
                                                        <td>
                                                            <select name="recipes[{{ $loop->index }}][components][{{ $i }}][itemID]"
                                                                    class="select2">
                                                                <option value="0"></option>
                                                                @foreach($items as $item)
                                                                    <option value="{{ $item->ID }}"
                                                                            {{ isset($recipe->components->toArray()[$i]) &&
                                                                            $recipe->components->toArray()[$i]['itemID'] == $item->ID ? 'selected' : '' }}>
                                                                        {{ $item->Name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    @endfor

                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <button class="btn btn-success" type="submit">
                                            Submit
                                        </button>
                                    </div>

                                    <br>
                                </form>
                            </div>
                            <div class="pagination-wrapper"> {!! $recipes->appends(['search' => Request::get('search'), 'filter' => Request::get('filter'), 'sort' => Request::get('sort')])->render() !!} </div>

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success font-weight-bold" id="exampleModalLongTitle">Success!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="font-weight-bold text-success">Recipes saved!</div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
