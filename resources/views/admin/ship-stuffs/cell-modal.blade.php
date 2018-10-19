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
            <form class="cell-form">
                <div class="modal-body">
                    <div class="form-group}">
                        <label for="cellType" class="col-md-4 control-label">{{ 'cellType' }}</label>
                        <div class="col-md-6">
                            <input type="hidden" name="ID" value="{{ $item->ID }}">
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
                    <div class="form-group">
                        <label for="dir" class="col-md-4 control-label">{{ 'Direction' }}</label>
                        <div class="col-md-6">
                            <select class="form-control form-control-sm"
                                    name="dir">
                                @foreach($directions as $direction)
                                    <option value="{{ $direction->index }}" {{ $direction->index == $item->dir ? 'selected' : '' }}>{{ $direction->name }}</option>
                                @endforeach
                            </select>
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