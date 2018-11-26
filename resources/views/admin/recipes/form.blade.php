<div class="form-group">
    <label for="item" class="col-md-4 control-label">Item</label>
    <div class="col-md-6">
        <select id="item" name="itemID">
            @if(isset($recipe) && $recipe->recipeType == 5)
                @foreach ($technologies as $item):
                <option value="{{$item->ID}}"
                        @if($item->ID == $recipe->ItemID) selected="selected" @endif>
                    {{$item->name}}
                </option>
                @endforeach
            @else
                @foreach ($items as $item):
                <option value="{{$item->ID}}"
                        @if(isset($recipe) && $item->ID == $recipe->ItemID) selected="selected" @endif>
                    {{$item->Name}}
                </option>
                @endforeach
            @endif

        </select>
    </div>
</div>
<div class="form-group {{ $errors->has('Name') ? 'has-error' : ''}}">
    <label for="Name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="Name" type="text" id="Name" value="{{ $recipe->Name or ''}}">
        {!! $errors->first('Name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('recipeType') ? 'has-error' : ''}}">
    <label for="recipeType" class="col-md-4 control-label">{{ 'Recipetype' }}</label>
    <div class="col-md-6">
        <select class="form-control" name="recipeType" id="recipeType">
            @foreach($recipeTypes as $type)
                <option value="{{ $type->index }}" {{ (isset($recipe) && $recipe->recipeType == $type->index) ? 'selected' : '' }}>{{ $type->name }}</option>
            @endforeach
        </select>
    </div>
</div>
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
<div class="form-group">
    <label for="classType" class="col-md-4 control-label">{{ 'classType' }}</label>
    <div class="col-md-6">
        <select class="form-control" name="classTypeID">
            @foreach($classTypes as $class)
                <option value="{{ $class->ID }}"
                        {{ (isset($recipe) && $recipe->classTypeID == $class->ID) ? 'selected' : '' }}>
                    {{ $class->type }}</option>
            @endforeach
        </select>
    </div>
</div>
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


{{--<div class="form-group">--}}
{{--<label for="components" class="col-md-4 control-label">Recipe Components</label>--}}
{{--<div class="col-md-6">--}}
{{--<select id="components" name="components[]" multiple="multiple">--}}
{{--@foreach ($items as $item):--}}
{{--<option value="{{$item->ID}}" @if(isset($selectedItems) && in_array($item->ID, $selectedItems))selected="selected"@endif>--}}
{{--{{$item->Name}}--}}
{{--</option>--}}
{{--@endforeach--}}
{{--</select>--}}
{{--</div>--}}
{{--</div>--}}
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
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>