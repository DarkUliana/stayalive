<div class="modal fade" id="ship-modal" tabindex="-1" role="dialog" aria-labelledby="ship-modalTitle"
     aria-hidden="true" data-id="{{ $item->ID }}">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ship-modalTitle">Cell index {{ $item->cellIndex }}
                    @if($last)
                        <i class="fa fa-trash deleteCell"></i>
                    @endif
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="cell-form">
                    {{ csrf_field() }}
                    <div class="form-group}">
                        <label for="cellType" class="col-md-4 control-label">{{ 'cellType' }}</label>
                        <div class="col-md-6">
                            <select class="form-control form-control-sm"
                                    name="cellType">
                                @foreach($cellTypes as $type)
                                    <option value="{{ $type->index }}" {{ $type->index == $item->cellType ? 'selected' : '' }}>{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="technologyType" class="col-md-4 control-label">{{ 'technologyType' }}</label>
                        <div class="col-md-6">
                            <select class="form-control form-control-sm"
                                    name="technologyType">
                                @foreach($technologyTypes as $type)
                                    <option value="{{ $type->index }}" {{ $type->index == $item->technologyType ? 'selected' : '' }}>{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="techLevel" class="col-md-4 control-label">{{ 'techLevel' }}</label>
                        <div class="col-md-6">
                            <input type="number" step="1"
                                   class="form-control form-control-sm"
                                   name="techLevel"
                                   value="{{ $item->techLevel }}">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>