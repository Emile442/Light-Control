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
                                    <th>Groups Associate</th>
                                    <th>networkId</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                                </thead>
                                <tbody id="table-lights">
                                @foreach($lights as $light)
                                    <tr class="light-list" id="light-{{ $light->id }}" data-id="{{ $light->id }}">
                                        <td><i class="fa fa-lightbulb-o light-state" id="light-state-{{ $light->id }}"></i></td>
                                        <td>{{ $light->name }}</td>
                                        <td>
                                            @foreach($light->groups as $group)
                                                <span class="badge badge-secondary">{{ $group->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>{{ $light->networkId }}</td>
                                        <td class="text-right">
                                            <button type="button" class="btn btn-round btn-light-change-state" id="light-button-{{ $light->id }}" data-id="{{ $light->id }}"><span><i class="fa fa-spinner fa-spin"></i></span></button>
                                            <a href="{{ route('lights.edit', $light) }}" class="btn btn-round btn-secondary"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('lights.destroy', $light) }}" class="btn btn-round btn-danger" data-method="delete" data-confirm="Are you sure you want to delete {{ $light->name }} ?"><i class="fa fa-trash"></i></a>
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

    @include('lights._new')
@endsection
