<form action="{{ $user->id ? route('users.update', $user) : route('users.store') }}" method="post">
    <div data-modal="usersAdd" id="modal-error"></div>
    @if($user->id)
        <input type="hidden" name="_method" value="put"/>
    @endif
    @include('layouts._form-errors')
    {{ csrf_field() }}
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $user->name) }}" autocomplete="off" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" id="email" value="{{ old('email', $user->email) }}" autocomplete="off" required>
    </div>

    <hr>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" id="password" autocomplete="off" {{ $user->id ? '' : 'required' }}>
    </div>

    <div class="form-group">
        <label for="password_confirm">Password Confirmation</label>
        <input type="password" class="form-control" name="password_confirm" id="password_confirm" autocomplete="off" {{ $user->id ? '' : 'required' }}>
    </div>

    <button class="btn btn-round btn-primary" type="submit">Submit</button>
</form>
