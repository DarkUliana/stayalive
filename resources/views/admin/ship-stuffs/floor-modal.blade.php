<!-- Modal -->
<div class="modal fade" id="ship-modal" tabindex="-1" role="dialog" aria-labelledby="ship-modalTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ship-modalTitle">Floor index {{ $floor->floorIndex }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @if($create)
                <form method="POST" action="{{ url('/ship-stuff') }}" accept-charset="UTF-8" class="form-horizontal"
                      enctype="multipart/form-data">
            @else
                <form method="POST" action="{{ url('/ship-stuff/' . $floor->ID) }}" accept-charset="UTF-8"
                      class="form-horizontal" enctype="multipart/form-data">
                    {{ method_field('PATCH') }}
            @endif
                    {{ csrf_field() }}
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="deckWidth" class="col-md-4 control-label">{{ 'deckWidth' }}</label>
                            <div class="col-md-6">
                                <input type="hidden" name="floorIndex" value="{{ $floor->floorIndex }}">
                                <input type="number" step="1"
                                       class="form-control form-control-sm"
                                       name="deckWidth"
                                       value="{{ $floor->deckWidth }}">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
        </div>
    </div>
</div>