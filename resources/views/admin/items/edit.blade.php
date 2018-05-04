<div class="col-md-3" id="itemBlade">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header"><strong>Edit item #{{ $item->ID }}</strong></div>
        <div class="card-body" id="itemBody">

            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form method="POST" action="{{ url('/items/' . $item->ID) }}" accept-charset="UTF-8" class="form-horizontal"
                  enctype="multipart/form-data">
                {{ method_field('PATCH') }}
                {{ csrf_field() }}

                @include ('admin.items.form', ['submitButtonText' => 'Update'])

            </form>

        </div>
    </div>
</div>

