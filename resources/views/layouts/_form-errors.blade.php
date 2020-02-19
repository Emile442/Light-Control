@if (count($errors) > 0)
    <div class="alert alert-danger form-error">
        <strong>Warning</strong> Some fields are not filled correctly.
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
