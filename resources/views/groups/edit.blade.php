@extends('layouts.app')


@section('title', "Edit Group: {$group->name}")

@section('content')
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card ">
                    <div class="card-header card-header-inline">
                        <h5 class="card-title">Edit Group: {{ $group->name }}</h5>
                    </div>
                    <div class="card-body ">
                        @include('groups._form')
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header card-header-inline">
                        <h5 class="card-title">Associate Lights</h5>
                    </div>
                    <div class="card-body ">
                        <table class="table">
                            @foreach($group->lights as $light)
                                <tr>
                                    <td>{{ $light->name }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
