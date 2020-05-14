@extends('layouts.app')


@section('title', "List of lights")

@section('content')
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="row card-header">
                        <div class="col-md-3">
                            <h5 class="card-title">All lights</h5>
                        </div>
                        <div class="col-md-9">
                            <div class="float-right">
                                <button type="button" dusk="add" class="btn btn-round btn-primary " data-toggle="modal" data-target="#lightsAdd">
                                    <i class="fas fa-plus pr-2"></i> Ajout Manuel
                                </button>
                                <a href="{{ route('network.index') }}" class="btn btn-round btn-primary ">
                                    <i class="now-ui-icons design_vector pr-2"></i> Ajout Automatique
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body ">
                        @include('layouts._flash')
                        @if($lights->count() == 0)
                            <div class="alert alert-info">
                                <span><b> Info - </b> No Lights registered</span>
                            </div>
                        @endif
                        <div class="table-responsive">
                            <lights-table></lights-table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('lights._new')
@endsection
