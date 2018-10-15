<div class="form-group {{ $errors->has('key') ? 'has-error' : ''}}">
    <label for="key" class="col-md-4 control-label">{{ 'Key' }}</label>
    <div class="col-md-6">
        <input id="objectKey" class="form-control" name="key" type="text" id="key" value="{{ $lootobject->key or ''}}"
               required>
        {!! $errors->first('key', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <label for="collections" class="col-md-4 control-label">{{ 'Collections' }}</label>
    <div class="col-md-6">
        <select id="objectCollections" name="collections[]" multiple>
            @foreach($collections as $collection)
                <option name="collections[]" value="{{ $collection->ID }}"
                        {{ isset($lootobject) && in_array($collection->ID, $lootobject->collections->pluck('lootCollectionID')->toArray()) ? 'selected' : '' }}>
                    {{ $collection->name }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="card collections-card">
    <div class="card-header">Collections</div>
    <div class="card-body">
        @foreach($lootobject->collections as $collection)
            <div class="card">
                <div class="card-header">{{ $collection->collection->name }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ url('/loot-collections/' . $collection->collection->ID) }}"
                          accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}
                        @include('admin.loot-collections.form', ['submitButtonText' => 'Update', 'lootcollection' => $collection->collection])
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
