@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">mobs-loot {{ $loot->ID }}</div>
                    <div class="card-body">

                        <a href="{{ url('mobs-loot') }}" title="Back">
                            <button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                                Back
                            </button>
                        </a>
                        <a href="{{ url('mobs-loot/' . $loot->ID . '/edit') }}" title="Edit mobs-loot">
                            <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"
                                                                      aria-hidden="true"></i> Edit
                            </button>
                        </a>

                        <form method="POST" action="{{ url('admin/mobs-loot' . '/' . $loot->ID) }}"
                              accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete mobs-loot"
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
                                    <td>{{ $loot->ID }}</td>
                                </tr>
                                <tr>
                                    <th> Key</th>
                                    <td> {{ $loot->key }} </td>
                                </tr>
                                <tr>
                                    <th> MinRandomSize</th>
                                    <td> {{ $loot->minRandomSize }} </td>
                                </tr>
                                <tr>
                                    <th> MaxRandomSize</th>
                                    <td> {{ $loot->maxRandomSize }} </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th>Item</th>
                                    <th>MinAmount</th>
                                    <th>MaxAmount</th>
                                    <th>Chance</th>
                                </tr>
                                @foreach($loot->loot as $item)
                                    <tr>
                                        <td>{{ $item->item->Name }}</td>
                                        <td> {{ $item->minAmount }} </td>
                                        <td> {{ $item->maxAmount }} </td>
                                        <td> {{ $item->chance }} </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
