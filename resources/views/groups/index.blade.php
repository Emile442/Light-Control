@extends('layouts.app')


@section('title', "List of groups")

@section('content')
    <div class="panel-header panel-header-sm"></div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header card-header-inline">
                        <h5 class="card-title">All groups</h5>
                        <button type="button" class="btn btn-round btn-primary card-header-button-inline" data-toggle="modal" data-target="#groupsAdd">
                            <i class="fas fa-plus"></i>
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
                                        <tr class="{{ $group->public ? 'table-info' : '' }}">
                                            <td>{{ $group->id }}</td>
                                            <td>{{ $group->name }}</td>
                                            <td>
                                                @foreach($group->lights as $light)
                                                    <span class="badge badge-secondary">{{ $light->name }}</span>
                                                @endforeach
                                            </td>
                                            <td class="text-right">
                                                @if($group->lights->count())
                                                    <button type="button" class="btn btn-round btn-group-change-state btn-success" data-id="{{ $group->id }}" data-state="1"><span></span>On</button>
                                                    <button type="button" class="btn btn-round btn-group-change-state" data-id="{{ $group->id }}" data-state="0"><span></span>Off</button>
                                                @endif
                                                <a href="{{ route('groups.edit', $group) }}" class="btn btn-round btn-secondary"><i class="fas fa-edit"></i></a>
                                                <a href="{{ route('groups.destroy', $group) }}" class="btn btn-round btn-danger" data-method="delete" data-confirm="Are you sure you want to delete {{ $group->name }}?"><i class="fas fa-trash"></i></a>
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

    @include('groups._new')

@endsection
