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
                        <button type="button" class="btn btn-round btn-primary card-header-button-inline" dusk="add" data-toggle="modal" data-target="#groupsAdd">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <div class="card-body ">
                        @include('layouts._flash')
                        @if($groups->count() == 0)
                            <div class="alert alert-info">
                                <span><b> Info - </b> No Groups registered</span>
                            </div>
                        @endif
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
                                                    <group-button id="{{ $group->id }}"></group-button>
                                                @endif
                                                <a href="{{ route('groups.edit', $group) }}" class="btn btn-round btn-secondary"><i class="fas fa-edit"></i></a>
                                                <a href="{{ route('groups.destroy', $group) }}" class="btn btn-round btn-danger" dusk="delete-{{ $group->id }}" data-method="delete" data-confirm="Are you sure you want to delete {{ $group->name }} ?"><i class="fas fa-trash"></i></a>
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
