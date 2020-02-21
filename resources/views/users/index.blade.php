@extends('layouts.app')

@section('title', 'Users')


@section('content')
    <div class="panel-header panel-header-sm"></div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header card-header-inline">
                        <h5 class="card-title">Users</h5>
                        <button type="button" class="btn btn-round btn-primary card-header-button-inline" data-toggle="modal" data-target="#usersAdd">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <div class="card-body ">
                        @include('layouts._flash')
                        <div class="typeahead__container">
                            <div class="typeahead__field">
                                <div class="typeahead__query">
                                    <input class="users_search" name="users_search[query]" placeholder="Search.." autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <a href="{{ route('users.edit', $user) }}" class="btn btn-round btn-secondary"><i class="fas fa-edit"></i></a>
                                                <a href="{{ route('users.destroy', $user) }}" class="btn btn-round btn-danger" data-method="delete" data-confirm="Are you sure to want to delete {{ $user->name }} ?"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {!! $users->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('users._new')
@endsection

