@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('admin.sidebar')
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Shop articles</div>
                    <div class="card-body">
                        <a href="{{ url('/shop-articles/create') }}" class="btn btn-success btn-sm"
                           title="Add New shop-article">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/shop-articles') }}" accept-charset="UTF-8"
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
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>
                                        <div class="row">
                                            <div class="col-md-8">ShopID</div>
                                            <div class="col-md-2">
                                                <div class="sort">
                                                    <a href="{{ url('/shop-articles?sort=shopID&type=asc') }}"><span
                                                                class="octicon octicon-chevron-up up"></span></a><a
                                                            href="{{ url('/shop-articles?sort=shopID&type=desc') }}"><span
                                                                class="octicon octicon-chevron-down down"></span></a>
                                                </div>
                                            </div>
                                            <div class="col-md-2"></div>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="row">
                                            <div class="col-md-8">Category</div>
                                            <div class="col-md-2">
                                                <div class="sort">
                                                    <a href="{{ url('/shop-articles?sort=shopItemCategory&type=asc') }}"><span
                                                                class="octicon octicon-chevron-up up"></span></a><a
                                                            href="{{ url('/shop-articles?sort=shopItemCategory&type=desc') }}"><span
                                                                class="octicon octicon-chevron-down down"></span></a>
                                                </div>
                                            </div>
                                            <div class="col-md-2"></div>
                                        </div>
                                    </th>
                                    <th>
                                        <div class="row">
                                            <div class="col-md-8">Price</div>
                                            <div class="col-md-2">
                                                <div class="sort">
                                                    <a href="{{ url('/shop-articles?sort=price&type=asc') }}"><span
                                                                class="octicon octicon-chevron-up up"></span></a><a
                                                            href="{{ url('/shop-articles?sort=price&type=desc') }}"><span
                                                                class="octicon octicon-chevron-down down"></span></a>
                                                </div>
                                            </div>
                                            <div class="col-md-2"></div>
                                        </div>
                                    </th>
                                    <th>inGold</th>
                                    <th>onSale</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($shopArticles as $item)
                                    <tr>
                                        <td>{{$item->ID }}</td>
                                        <td  @if($item->hot) style="color: #4CC552; font-weight: bold" @endif>{{ $item->shopID }}</td>
                                        <td>{{ $categories[$item->shopItemCategory] }}</td>

                                        <td>{{ $item->price }}</td>
                                        <td>
                                            @if($item->inGold)
                                                <span class="octicon octicon-database" style="color: #FFC100"></span>
                                            @else
                                                <span class="fa fa-money" style="color: #2ca02c"></span>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ url('/shop-articles/' . $item->ID) }}"
                                                  accept-charset="UTF-8" class="form-horizontal"
                                                  enctype="multipart/form-data">

                                                <input class="onSale" type="checkbox" name="onSale"
                                                       @if($item->onSale) checked @endif>

                                            </form>
                                        </td>
                                        <td>

                                            {{--<a href="{{ url('/shop-articles/' . $item->ID) }}" title="View shop-article"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>--}}
                                            <a href="{{ url('/shop-articles/' . $item->ID . '/edit') }}"
                                               title="Edit shop-article">
                                                <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"
                                                                                          aria-hidden="true"></i> Edit
                                                </button>
                                            </a>

                                            <form method="POST" action="{{ url('/shop-articles' . '/' . $item->ID) }}"
                                                  accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                        title="Delete shop-article"
                                                        onclick="return confirm(&quot;Confirm delete?&quot;)"><i
                                                            class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $shopArticles->appends(['search' => Request::get('search'), 'sort' => Request::get('sort'), 'type' => Request::get('type')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
