@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">recipe {{ $recipe->ID }}</div>
                    <div class="card-body">

                        <a href="{{ url('/recipes') }}" title="Back">
                            <button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                                Back
                            </button>
                        </a>
                        <a href="{{ url('/recipes/' . $recipe->ID . '/edit') }}" title="Edit recipe">
                            <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"
                                                                      aria-hidden="true"></i> Edit
                            </button>
                        </a>

                        <form method="POST" action="{{ url('admin/recipes' . '/' . $recipe->ID) }}"
                              accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete recipe"
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
                                    <td>{{ $recipe->ID }}</td>
                                </tr>
                                <tr>
                                    <th> Name</th>
                                    <td> {{ $recipe->Name }} </td>
                                </tr>
                                <tr>
                                    <th> RecipeType</th>
                                    <td> {{ $recipe->recipeType }} </td>
                                </tr>
                                <tr>
                                    <th> CraftTime</th>
                                    <td> {{ $recipe->CraftTime }} </td>
                                </tr>
                                <tr>
                                    <th> Level</th>
                                    <td> {{ $recipe->Level }} </td>
                                </tr>
                                <tr>
                                    <th> Price</th>
                                    <td> {{ $recipe->price }} </td>
                                </tr>
                                <tr>
                                    <th> tmpComponentsSize</th>
                                    <td> {{ $recipe->tmpComponentsSize }} </td>
                                </tr>
                                <tr>
                                    <th> componentsSize</th>
                                    <td> {{ $recipe->componentsSize }} </td>
                                </tr>
                                <tr>
                                    <th> tmpBuildingsSize</th>
                                    <td> {{ $recipe->tmpBuildingsSize }} </td>
                                </tr>
                                <tr>
                                    <th> Type</th>
                                    <td> {{ $recipe->Type }} </td>
                                </tr>
                                <tr>
                                    <th> InStack</th>
                                    <td> {{ $recipe->InStack }} </td>
                                </tr>
                                <tr>
                                    <th> Components</th>
                                    <td>
                                        @foreach($recipe->components as $component)
                                            {{$component->neededCount}}
                                            {{$component->item->Name}}&nbsp;
                                            <br>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th> Technologies</th>
                                    <td>
                                        @foreach($recipe->technologies as $technology)
                                            {{$technology->technology->name}}
                                            <br>
                                        @endforeach
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
