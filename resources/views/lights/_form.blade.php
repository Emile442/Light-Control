<form action="{{ $light->id ? route('lights.update', $light) : route('lights.store') }}" method="post">
    <div data-modal="lightsAdd" id="modal-error"></div>
    @if($light->id)
        <input type="hidden" name="_method" value="put"/>
    @endif
    @include('layouts._form-errors')
    {{ csrf_field() }}
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $light->name) }}" autocomplete="off" required>
    </div>
    <div class="form-group">
        <label for="networkId">networkId</label>
        <input type="number" class="form-control" name="networkId" id="networkId" value="{{ old('networkId', $light->networkId) }}" autocomplete="off" required>
    </div>

    <button class="btn btn-round btn-primary" type="submit" id="lightSubmit">Submit</button>
</form>
