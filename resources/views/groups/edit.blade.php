@extends('layouts.app')


@section('title', "Edit Group: {$group->name}")

@section('content')
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header card-header-inline">
                        <h5 class="card-title">Edit Group: {{ $group->name }}</h5>
                    </div>
                    <div class="card-body ">
                        @include('layouts._flash')
                        <form action="{{ route('groups.update', $group) }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="put"/>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $group->name) }}" autocomplete="off" required>
                            </div>

                            <button class="btn btn-round btn-primary" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
