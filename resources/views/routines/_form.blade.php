<form action="{{ $routine->id ? route('routines.update', $routine) : route('routines.store') }}" method="post">
    <div data-modal="routinesAdd" id="modal-error"></div>
    @if($routine->id)
        <input type="hidden" name="_method" value="put"/>
    @endif
    @include('layouts._form-errors')
    {{ csrf_field() }}
    <div class="form-group">
        <label for="name" >Name</label>
        <input type="text" name="name" id="name" class="form-control" autocomplete="off" value="{{ old('name', $routine->name) }}" required>
    </div>
    <div class="form-group">
        <label for="groups" >Groups</label>
        <input type="text" class="form-control groups" name="groups" placeholder="Associate Groups" id="groups" autocomplete="off" value="{{ old('groups', $routine->groupsList) }}" data-url="{{ route('api.groups.index') }}" required>
    </div>
    <div class="form-group">
        <label for="state" >Sate</label>
        <select name="state" id="state" class="form-control">
            <option value="0" {{ old('state', $routine->state) == 0 ? 'selected' : '' }}>Off</option>
            <option value="1" {{ old('state', $routine->state) == 1 ? 'selected' : '' }}>On</option>
        </select>
    </div>
    <div class="form-group">
        <label for="exec_at" >Exec At</label>
        <input type="text" id="exec_at" name="exec_at" class="form-control js-time-picker" value="{{ old('exec_at', $routine->exec) }}">
    </div>

    <button class="btn btn-round btn-primary" type="submit">Submit</button>
</form>

@section('js')
    <script type="application/javascript">
        $(document).ready(function() {
            let input = document.getElementById("groups"),
                tagify = new Tagify(input, {whitelist: $('#groups').val().split(','), enforceWhitelist: true}),
                controller;

            tagify.on('input', onInput)

            function onInput(e){
                let value = e.detail.value;
                tagify.settings.whitelist.length = 0; // reset the whitelist

                controller && controller.abort();
                controller = new AbortController();

                tagify.loading(true).dropdown.hide.call(tagify)

                fetch('/api/groups?term=' + value, {signal:controller.signal})
                    .then(RES => RES.json())
                    .then(function(whitelist){
                        tagify.settings.whitelist.splice(0, whitelist.length, ...whitelist)
                        tagify.loading(false).dropdown.show.call(tagify, value);
                    })
            }
        });
    </script>
@endsection

