<tr>
    <td></td>
    <td>
        <form method="POST" action="{{ url('/languages') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
            {{ csrf_field() }}

            @include ('admin.languages.form', ['submitButtonText' => 'Create'])

        </form>
    </td>
    <td>
        <button type="submit" class="btn btn-danger btn-sm deleteEmptyLanguage" title="Delete language" style="margin-left: 59px;">
            <i class="fa fa-trash-o" aria-hidden="true"></i>
            Delete
        </button>
    </td>
</tr>