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

    <div class="form-group">
        <label for="public">Public</label>
        <select name="public" id="public" class="form-control">
            <option value="0" {{ old('public', $group->public) == 0 ? 'selected' : '' }}>No</option>
            <option value="1" {{ old('public', $group->public) == 1 ? 'selected' : '' }}>Yes</option>
        </select>
    </div>

    <button class="btn btn-round btn-primary" type="submit">Submit</button>
</form>
