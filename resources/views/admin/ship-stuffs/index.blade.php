@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('admin.sidebar', ['sidebarClass' => 'col-md-2 offset-md-1'])

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Shipstuffs</div>
                    <div class="card-body">
                        <a href="{{ url('/ship-stuffs/create') }}" class="btn btn-success btn-sm"
                           title="Add New ShipStuff">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

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

                                    <form method="POST" action="{{ url('/ship-stuffs' . '/' . $floor->ID) }}"
                                          accept-charset="UTF-8" style="display:inline">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm(&quot;Confirm delete?&quot;)"><i
                                                    class="fa fa-trash-o" aria-hidden="true"></i> Delete floor
                                        </button>
                                    </form>
                                    <button type="submit" class="btn btn-success btn-sm"><i
                                                class="fa fa-plus" aria-hidden="true"></i> Add cell
                                    </button>
                                    <br/>
                                    <br/>
                                    <div class="table-responsive">
                                        <table class="table table-ship">
                                            @foreach($floor->items as $array)
                                                <tr>
                                                    @foreach($array as $item)
                                                        <td>
                                                            <div class="box">
                                                                <div class="box-inner">
                                                                    <form>
                                                                        <span class="font-weight-bold">{{ $item->cellIndex }}</span>
                                                                        <span class="icons">
                                                                            <i class="fa fa-trash deleteCell"></i>
                                                                            <i class="fa fa-save saveCell"></i>
                                                                        </span>

                                                                        <select class="form-control form-control-sm"
                                                                                name="cellType">
                                                                            @foreach($cellTypes as $type)
                                                                                <option value="{{ $type->index }}" {{ $type->index == $item->cellType ? 'selected' : '' }}>{{ $type->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        <select class="form-control form-control-sm"
                                                                                name="technologyType">
                                                                            @foreach($technologyTypes as $type)
                                                                                <option value="{{ $type->index }}" {{ $type->index == $item->technologyType ? 'selected' : '' }}>{{ $type->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        <input type="number" step="1"
                                                                               class="form-control form-control-sm"
                                                                               name="techLevel"
                                                                               value="{{ $item->techLevel }}">
                                                                    </form>

                                                                </div>
                                                            </div>
                                                        </td>


                                                    @endforeach

                                                </tr>

                                            @endforeach


                                        </table>
                                    </div>
                                </div>


                                {{--<tr>--}}
                                {{--<td>{{ $loop->iteration or $item->ID }}</td>--}}
                                {{--<td>{{ $item->floorIndex }}</td><td>{{ $item->deckWidth }}</td>--}}
                                {{--<td>--}}
                                {{--<a href="{{ url('/ship-stuffs/' . $item->ID) }}" title="View ShipStuff"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>--}}
                                {{--<a href="{{ url('/ship-stuffs/' . $item->ID . '/edit') }}" title="Edit ShipStuff"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>--}}

                                {{--<form method="POST" action="{{ url('/ship-stuffs' . '/' . $item->ID) }}" accept-charset="UTF-8" style="display:inline">--}}
                                {{--{{ method_field('DELETE') }}--}}
                                {{--{{ csrf_field() }}--}}
                                {{--<button type="submit" class="btn btn-danger btn-sm" title="Delete ShipStuff" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>--}}
                                {{--</form>--}}
                                {{--</td>--}}
                                {{--</tr>--}}
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
