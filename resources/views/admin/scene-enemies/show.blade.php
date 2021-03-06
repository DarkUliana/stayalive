@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">SceneEnemy {{ $sceneenemy->ID }}</div>
                    <div class="card-body">

                        <a href="{{ url('/scene-enemies') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/scene-enemies/' . $sceneenemy->ID . '/edit') }}" title="Edit SceneEnemy"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                        <form method="POST" action="{{ url('scene-enemies' . '/' . $sceneenemy->ID) }}" accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete SceneEnemy" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                        </form>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $sceneenemy->ID }}</td>
                                    </tr>
                                    <tr><th> SceneName </th><td> {{ $sceneenemy->sceneName }} </td></tr><tr><th> AreaKey </th><td> {{ $sceneenemy->areaKey }} </td></tr><tr><th> EnemyType </th><td> {{ $sceneenemy->enemyType }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
