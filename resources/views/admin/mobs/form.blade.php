<table class="table table-bordered table-responsive-sm">
    @include('admin.mobs.fields')
</table>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
