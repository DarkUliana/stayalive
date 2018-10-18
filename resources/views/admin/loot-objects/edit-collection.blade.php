<div class="card" data-id="{{ $collection->lootCollectionID }}">
    <div class="card-header">{{ $collection->collection->name }}</div>
    <div class="card-body">
        <form class="lootCollectionForm" method="POST"
              action="{{ url('/loot-collections/' . $collection->collection->ID) }}"
              accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
            {{ method_field('PATCH') }}
            {{ csrf_field() }}
            @include('admin.loot-collections.form', ['submitButtonText' => 'Update', 'lootcollection' => $collection->collection])
        </form>
    </div>
</div>
