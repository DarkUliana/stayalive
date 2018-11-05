@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Edit technology #{{ $technology->ID }}</div>
                    <div class="card-body">
                        <a href="{{ url()->previous() }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form method="POST" action="{{ url('/technologies/' . $technology->ID) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('admin.technologies.form', ['submitButtonText' => 'Update'])

                        </form>

                        <div class="card recipe-card">
                            <div class="card-header">Recipe</div>
                            <div class="card-body">
                                <form method="POST" action="{{ url('/recipes/' . ($recipe ? $recipe->ID : '')) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                                    {{ $recipe ? method_field('PATCH') : '' }}
                                    {{ csrf_field() }}

                                    <input type="hidden" name="itemID" value="{{ $technology->ID }}">
                                    <div class="form-group {{ $errors->has('Name') ? 'has-error' : ''}}">
                                        <label for="Name" class="col-md-4 control-label">{{ 'Name' }}</label>
                                        <div class="col-md-6">
                                            <input class="form-control" name="Name" type="text" id="Name" value="{{ $recipe->Name or $technology->name}}">
                                            {!! $errors->first('Name', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>

                                    <input type="hidden" name="recipeType" value="5">

                                    <div class="form-group {{ $errors->has('CraftTime') ? 'has-error' : ''}}">
                                        <label for="CraftTime" class="col-md-4 control-label">{{ 'Crafttime' }}</label>
                                        <div class="col-md-6">
                                            <input class="form-control" name="CraftTime" type="number" id="CraftTime" value="{{ $recipe->CraftTime or ''}}">
                                            {!! $errors->first('CraftTime', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('Level') ? 'has-error' : ''}}">
                                        <label for="Level" class="col-md-4 control-label">{{ 'Level' }}</label>
                                        <div class="col-md-6">
                                            <input class="form-control" name="Level" type="number" id="Level" value="{{ $recipe->Level or ''}}">
                                            {!! $errors->first('Level', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
                                        <label for="price" class="col-md-4 control-label">{{ 'price' }}</label>
                                        <div class="col-md-6">
                                            <input class="form-control" name="price" type="number" id="price" value="{{ $recipe->price or ''}}">
                                            {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>

                                            <input class="form-control" name="Type" type="hidden" id="Type" value="{{ $recipe->Type or 'CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null'}}">

                                    <div class="form-group {{ $errors->has('InStack') ? 'has-error' : ''}}">
                                        <label for="InStack" class="col-md-4 control-label">{{ 'Instack' }}</label>
                                        <div class="col-md-6">
                                            <input class="form-control" name="InStack" type="number" id="InStack" value="{{ $recipe->InStack or ''}}">
                                            {!! $errors->first('InStack', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>

                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Item</th>
                                            <th>Needed Count</th>

                                            <th>
                                                <button id="addComponent" type="button" class="btn btn-success">Add</button>
                                            </th>
                                        </tr>

                                        @isset($recipe)
                                            <?php $counter = 0; ?>
                                            @foreach($recipe->components as $component)
                                                @include('admin.recipes.component')
                                                <?php ++$counter ?>
                                            @endforeach
                                        @endisset
                                    </table>
                                    <div class="form-group">
                                        <label for="technologies" class="col-md-4 control-label">Technologies</label>
                                        <div class="col-md-6">
                                            <select id="technologies" name="technologies[]" multiple="multiple">
                                                @foreach ($technologies as $technology):
                                                <option value="{{$technology->ID}}"
                                                        @if(isset($selectedTechnologies) && in_array($technology->ID, $selectedTechnologies))selected="selected"@endif>
                                                    {{$technology->name}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-offset-4 col-md-4">
                                            <input class="btn btn-primary" type="submit" value="{{ $recipe ? 'Update' : 'Create' }}">
                                        </div>
                                    </div>

                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
