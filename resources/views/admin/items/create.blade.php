<div class="col-md-3" id="itemBlade">
    <div class="card">
        <div class="card-header"><strong>Create New item</strong></div>
        <div class="card-body" id="itemBody">

            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form method="POST" action="{{ url('/items') }}" accept-charset="UTF-8" class="form-horizontal"
                  enctype="multipart/form-data">
                {{ csrf_field() }}

                @include ('admin.items.form')

            </form>

        </div>
    </div>
</div>

