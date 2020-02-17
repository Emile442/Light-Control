@extends('layouts.app')

@section('title', 'Network')


@section('content')
    <div class="panel-header panel-header-sm"></div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header card-header-inline">
                        <h5 class="card-title">Network</h5>
                    </div>
                    <div class="card-body ">
                        @if(is_null($deconzLights))
                            <div class="alert alert-warning">
                                <span><b> Warning - </b> Connection problem with the bridge</span>
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                <tr>
                                    <th>networkId</th>
                                    <th>Name</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($deconzLights)
                                    @foreach($deconzLights as $k => $light)
                                        <tr>
                                            <td>{{ $k }}</td>
                                            <td>{{ $light->name }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
