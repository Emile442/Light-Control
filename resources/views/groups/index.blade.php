@extends('layouts.app')


@section('title', "List of groups")

@section('content')
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header card-header-inline">
                        <h5 class="card-title">All groups</h5>
                        <button type="button" class="btn btn-round btn-primary card-header-button-inline" data-toggle="modal" data-target="#groupsAdd">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <div class="card-body ">
                        @include('layouts._flash')
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Associate Lights</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($groups as $group)
                                        <tr>
                                            <td>{{ $group->id }}</td>
                                            <td>{{ $group->name }}</td>
                                            <td>
                                                @foreach($group->lights as $light)
                                                    <span class="badge badge-secondary">{{ $light->name }}</span>
                                                @endforeach
                                            </td>
                                            <td class="text-right">
                                                <a href="{{ route('groups.edit', $group) }}" class="btn btn-round btn-secondary"><i class="fa fa-edit"></i></a>
                                                <a href="{{ route('groups.destroy', $group) }}" class="btn btn-round btn-danger" data-method="delete" data-confirm="Are you sure to want to delete {{ $group->name }}?"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="groupsAdd" tabindex="-1" role="dialog" aria-labelledby="groupsAddModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Group</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-close"></i></span>
                    </button>
                </div>
                <form action="{{ route('groups.store') }}" method="post" id="newGroupsForm">
                    {{ csrf_field() }}
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="name" >Name</label>
                                <input type="text" name="name" id="name" class="form-control" autocomplete="off" required>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-round btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-round btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
