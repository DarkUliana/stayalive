<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="{{ $restorableObject->name or ''}}">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

{{--<div class="card">--}}
    {{--<div class="card-header"><h5>Top List Items</h5></div>--}}
    {{--<div class="card-body">--}}
        {{--<div class="table-responsive">--}}
            {{--<table class="table table-bordered" id="topTable">--}}
                {{--<tr>--}}
                    {{--<th>Item</th>--}}
                    {{--<th>Count</th>--}}
                    {{--<th>--}}
                        {{--<button id="addTopListItem" type="button" class="btn btn-success">Add</button>--}}
                    {{--</th>--}}
                {{--</tr>--}}
                {{--@isset($restorableObject)--}}
                    {{--@foreach($topListItems as $objectItem)--}}
                        {{--@include('admin.restorable-objects.item', ['arrayName' => 'topListItems'])--}}
                    {{--@endforeach--}}
                {{--@endisset--}}
            {{--</table>--}}
        {{--</div>--}}
    {{--</div>--}}

{{--</div>--}}
<br>
<br>
<div class="card">
    <div class="card-header"><h5>Items List</h5></div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="bottomTable">
                <tr>
                    <th>Item</th>
                    <th>Count</th>
                    <th>
                        <button id="addBottomListItem" type="button" class="btn btn-success">Add</button>
                    </th>
                </tr>
                @isset($restorableObject)
                    @foreach($bottomListItems as $objectItem)
                        @include('admin.restorable-objects.item', ['arrayName' => 'bottomListItems'])
                    @endforeach
                @endisset
            </table>
        </div>
    </div>
</div>
<br>
<br>
<div class="card">
    <div class="card-header">Shipstuffs</div>
    <div class="card-body">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                @foreach($shipstuffs as $i)
                    <a class="nav-item nav-link {{ $loop->first ? 'active' : ''}}"
                       href="#floorIndex-{{ $i->floorIndex }}" role="tab"
                       data-toggle="tab" aria-controls="floorIndex-{{ $i->floorIndex }}"
                       aria-selected="{{ $loop->first ? 'true' : 'false'}}">{{ $i->floorIndex }}</a>
                @endforeach
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            @foreach($shipstuffs as $floor)


                <div role="tabpanel" class="tab-pane fade {{ $loop->first ? 'show active' : ''}}"
                     id="floorIndex-{{ $floor->floorIndex }}"
                     aria-labelledby="floorIndex-{{ $floor->floorIndex }}-tab">
                    <br>

                    <div class="table-responsive" id="ship-table">
                        <table class="table table-ship">
                            @foreach($floor->defaultItems as $array)
                                <tr>
                                    @foreach($array as $item)
                                        @include('admin.restorable-objects.cell')
                                    @endforeach
                                </tr>

                            @endforeach
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>


<br/>
<br/>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
