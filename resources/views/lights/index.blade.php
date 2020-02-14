@extends('layouts.app')


@section('title', "List of lights")

@section('content')
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header card-header-inline">
                        <h5 class="card-title">All lights</h5>
                        <button type="button" class="btn btn-round btn-primary card-header-button-inline" data-toggle="modal" data-target="#lightsAdd">
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
                                    <th>Group Associate</th>
                                    <th>networkId</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($lights as $light)
                                    <tr>
                                        <td><i class="fa fa-lightbulb-o {{ $light->state ? "text-warning" : "" }}"></i></td>
                                        <td>{{ $light->name }}</td>
                                        <td>{{ $light->group->name }}</td>
                                        <td>{{ $light->networkId }}</td>
                                        <td class="text-right">
                                            <a href="{{ route('lights.edit', $light) }}" class="btn btn-round btn-secondary"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('lights.destroy', $light) }}" class="btn btn-round btn-danger" data-method="delete" data-confirm="Are you sure to want to delete {{ $light->name }}?"><i class="fa fa-trash"></i></a>
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

    <div class="modal fade" id="lightsAdd" tabindex="-1" role="dialog" aria-labelledby="lightsAddModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Light</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-close"></i></span>
                    </button>
                </div>
                <form action="{{ route('lights.store') }}" method="post">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name" >Name</label>
                            <input type="text" name="name" id="name" class="form-control" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="networkId" >networkId</label>
                            <input type="number" name="networkId" id="networkId" class="form-control" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="group_id" >Group</label>
                            <select name="group_id" id="group_id" class="form-control">
                                @foreach(\App\Group::all() as $group)
                                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                                @endforeach
                            </select>
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
