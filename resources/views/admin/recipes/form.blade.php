<div class="form-group">
    <label for="item" class="col-md-4 control-label">Item</label>
    <div class="col-md-6">
        <select id="item" name="itemID">
            @foreach ($items as $item):
            <option value="{{$item->ID}}"
                    @if(isset($recipe) && $item->ID == $recipe->ItemID) selected="selected" @endif>
                {{$item->Name}}
            </option>
            @endforeach
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
        <input class="form-control" name="recipeType" type="number" id="recipeType"
               value="{{ $recipe->recipeType or ''}}">
        {!! $errors->first('recipeType', '<p class="help-block">:message</p>') !!}
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
<div class="form-group {{ $errors->has('tmpComponentsSize') ? 'has-error' : ''}}">
    <label for="tmpComponentsSize" class="col-md-4 control-label">{{ 'Tmpcomponentssize' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="tmpComponentsSize" type="number" id="tmpComponentsSize"
               value="{{ $recipe->tmpComponentsSize or ''}}">
        {!! $errors->first('tmpComponentsSize', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('componentsSize') ? 'has-error' : ''}}">
    <label for="componentsSize" class="col-md-4 control-label">{{ 'Componentssize' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="componentsSize" type="number" id="componentsSize"
               value="{{ $recipe->componentsSize or ''}}">
        {!! $errors->first('componentsSize', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('tmpBuildingsSize') ? 'has-error' : ''}}">
    <label for="tmpBuildingsSize" class="col-md-4 control-label">{{ 'Tmpbuildingssize' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="tmpBuildingsSize" type="number" id="tmpBuildingsSize"
               value="{{ $recipe->tmpBuildingsSize or ''}}">
        {!! $errors->first('tmpBuildingsSize', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('BuildingsSize') ? 'has-error' : ''}}">
    <label for="BuildingsSize" class="col-md-4 control-label">{{ 'Buildingssize' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="BuildingsSize" type="number" id="BuildingsSize"
               value="{{ $recipe->BuildingsSize or ''}}">
        {!! $errors->first('BuildingsSize', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('Type') ? 'has-error' : ''}}">
    <label for="Type" class="col-md-4 control-label">{{ 'Type' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="Type" type="text" id="Type" value="{{ $recipe->Type or ''}}">
        {!! $errors->first('Type', '<p class="help-block">:message</p>') !!}
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