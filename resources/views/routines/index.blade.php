@extends('layouts.app')

@section('title', 'Routines')


@section('content')
    <div class="panel-header panel-header-sm"></div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header card-header-inline">
                        <h5 class="card-title">Routines</h5>
                        <button type="button" class="btn btn-round btn-primary card-header-button-inline" data-toggle="modal" data-target="#routinesAdd">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <div class="card-body ">
                        @include('layouts._flash')
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                <tr>
                                    <th>Name</th>
                                    <th>Groups</th>
                                    <th>State</th>
                                    <th>Exec At</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($routines as $k => $routine)
                                    <tr>
                                        <td>{{ $routine->name }}</td>
                                        <td>
                                            @foreach($routine->groups as $group)
                                                <span class="badge badge-secondary">{{ $group->name }}</span>
                                            @endforeach
                                        </td>
                                        <td><span class="badge badge-{{ $routine->state ? 'success' : 'danger' }}">{{ $routine->state ? 'On' : 'Off' }}</span></td>
                                        <td>{{ $routine->exec }}</td>
                                        <td>
                                            <a href="{{ route('routines.edit', $routine) }}" class="btn btn-round btn-secondary"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('routines.destroy', $routine) }}" class="btn btn-round btn-danger" data-method="delete" data-confirm="Are you sure to want to delete {{ $routine->name }} ?"><i class="fa fa-trash"></i></a>
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

    @include('routines._new')
@endsection
