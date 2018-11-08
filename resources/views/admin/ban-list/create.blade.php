<div class="modal fade" id="addPlayerModalCenter" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Select player</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ url('/ban-list') }}" accept-charset="UTF-8"
                  class="form-horizontal" enctype="multipart/form-data">
                <div class="modal-body">


                    {{ csrf_field() }}
                    <select id="ban" name="playerID">
                        @foreach($players as $player)
                            <option value="{{ $player->ID }}"><span
                                        class="font-weight-bold">{{ $player->Name }}</span> {{$player->ID }}
                            </option>
                        @endforeach
                    </select>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>