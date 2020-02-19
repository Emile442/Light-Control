<form action="{{ $group->id ? route('groups.update', $group) : route('groups.store') }}" method="post">
    <div data-modal="groupsAdd" id="modal-error"></div>
    @if($group->id)
        <input type="hidden" name="_method" value="put"/>
    @endif
    @include('layouts._form-errors')
    {{ csrf_field() }}
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $group->name) }}" autocomplete="off" required>
    </div>

    <button class="btn btn-round btn-primary" type="submit">Submit</button>
</form>
