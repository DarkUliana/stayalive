@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">diary-storage-note {{ $diaryStorageNote->ID }}</div>
                    <div class="card-body">

                        <a href="{{ url('/diary-storage-notes' . getQueryParams(request())) }}" title="Back">
                            <button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                                Back
                            </button>
                        </a>
                        <a href="{{ url('/diary-storage-notes/' . $diaryStorageNote->ID . '/edit') }}"
                           title="Edit diary-storage-note">
                            <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o"
                                                                      aria-hidden="true"></i> Edit
                            </button>
                        </a>

                        <form method="POST" action="{{ url('diary-storage-notes' . '/' . $diaryStorageNote->ID) }}"
                              accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete diary-storage-note"
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
                                    <td>{{ $diaryStorageNote->ID }}</td>
                                </tr>
                                <tr>
                                    <th> NoteID</th>
                                    <td> {{ $diaryStorageNote->noteID }} </td>
                                </tr>
                                <tr>
                                    <th> NoteSubject</th>
                                    <td> {{ $diaryStorageNote->noteSubject }} </td>
                                </tr>
                                <tr>
                                    <th> NoteImage</th>
                                    <td> {{ $diaryStorageNote->noteImage }} </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
