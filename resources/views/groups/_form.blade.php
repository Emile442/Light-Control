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
        <label for="lights" >Lights</label>
        <input type="text" class="form-control groups" name="lights" placeholder="Associate Lights" id="lights" autocomplete="off" value="{{ old('lights', $group->lightsList) }}" data-url="{{ route('api.lights.index') }}" required>
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

@section('js')
    <script type="application/javascript">
        $(document).ready(function() {
            let input = document.getElementById("lights"),
                api_token = $('meta[name=api-token]').attr('content'),
                tagify = new Tagify(input, {whitelist: $('#lights').val().split(','), enforceWhitelist: true}),
                controller;

            tagify.on('input', onInput)

            function onInput(e){
                let value = e.detail.value;
                tagify.settings.whitelist.length = 0; // reset the whitelist

                controller && controller.abort();
                controller = new AbortController();

                tagify.loading(true).dropdown.hide.call(tagify)

                fetch(`/api/v1/lights/search?api_token=${api_token}&term=${value}`, {signal:controller.signal})
                    .then(RES => RES.json())
                    .then(function(whitelist){
                        tagify.settings.whitelist.splice(0, whitelist.length, ...whitelist)
                        tagify.loading(false).dropdown.show.call(tagify, value);
                    })
            }
        });
    </script>
@endsection
