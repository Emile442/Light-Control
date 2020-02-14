@extends('layouts.app')


@section('title', "Edit Light: {$light->name}")

@section('content')
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header card-header-inline">
                        <h5 class="card-title">Edit Light: {{ $light->name }}</h5>
                    </div>
                    <div class="card-body ">
                        @include('layouts._flash')
                        <form action="{{ route('lights.update', $light) }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="put"/>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $light->name) }}" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label for="networkId">networkId</label>
                                <input type="number" class="form-control" name="networkId" id="networkId" value="{{ old('networkId', $light->networkId) }}" autocomplete="off" required>
                            </div>

                            <div class="form-group">
                                <label for="group_id" >Group</label>
                                <select name="group_id" id="group_id" class="form-control">
                                    @foreach(\App\Group::all() as $group)
                                        <option value="{{ $group->id }}" {{ old('group_id', $light->group_id) == $group->id ? 'selected' : '' }}>{{ $group->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button class="btn btn-round btn-primary" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
