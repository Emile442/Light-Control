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
                        @include('lights._form')
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
