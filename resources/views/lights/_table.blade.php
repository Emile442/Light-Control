<table class="table">
    <thead class="text-primary">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Groups Associate</th>
            <th>networkId</th>
            <th class="text-right">Actions</th>
        </tr>
    </thead>
    <tbody id="table-lights">
    @foreach($lights as $light)
        <tr class="light-list" id="light-{{ $light->id }}" data-id="{{ $light->id }}">
            <td><i class="far fa-lightbulb light-state" id="light-state-{{ $light->id }}"></i></td>
            <td>{{ $light->name }}</td>
            <td>
                @foreach($light->groups as $group)
                    <span class="badge badge-secondary">{{ $group->name }}</span>
                @endforeach
            </td>
            <td>{{ $light->networkId }}</td>
            <td class="text-right">
                <button type="button" class="btn btn-round btn-light-change-state" id="light-button-{{ $light->id }}" data-id="{{ $light->id }}"><span><i class="fas fa-spinner fa-spin"></i></span></button>
                <a href="{{ route('lights.edit', $light) }}" class="btn btn-round btn-secondary" dusk="edit-{{ $light->id }}"><i class="fas fa-edit"></i></a>
                <a href="{{ route('lights.destroy', $light) }}" class="btn btn-round btn-danger" dusk="delete-{{ $light->id }}" data-method="delete" data-confirm="Are you sure you want to delete {{ $light->name }} ?"><i class="fas fa-trash"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
