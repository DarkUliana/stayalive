@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('admin.sidebar', ['sidebarClass' => 'col-md-2 offset-md-1'])

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Shipstuffs</div>
                    <div class="card-body">
                        <div class="btn btn-success btn-sm" id="addNewFloor"
                             title="Add New ShipStuff">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add new floor
                        </div>

                        <form method="GET" action="{{ url('/ship-stuffs') }}" accept-charset="UTF-8"
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

                                    <form method="POST" action="{{ url('/ship-stuff' . '/' . $floor->ID) }}"
                                          accept-charset="UTF-8" style="display:inline">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm(&quot;Confirm delete?&quot;)"><i
                                                    class="fa fa-trash-o" aria-hidden="true"></i> Delete floor
                                        </button>
                                    </form>


                                    <button type="submit" class="btn btn-warning btn-sm editFloor" data-id="{{ $floor->ID }}"><i
                                                class="fa fa-trash-o" aria-hidden="true"></i> Edit floor
                                    </button>


                                    <button type="submit" class="btn btn-success btn-sm addNewCell" data-width="{{ $floor->deckWidth }}"
                                    data-floor-id="{{ $floor->ID }}"><i
                                                class="fa fa-plus" aria-hidden="true"></i> Add cell
                                    </button>
                                    <br/>
                                    <br/>
                                    <div class="table-responsive" id="ship-table">
                                        <table class="table table-ship">
                                            @foreach($floor->items as $array)
                                                <tr>
                                                    @foreach($array as $item)
                                                        @include('admin.ship-stuffs.cell')
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
            </div>
        </div>
    </div>
    <div class="ajax-background"></div>
@endsection
