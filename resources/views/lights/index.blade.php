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
                        <button type="button" dusk="add" class="btn btn-round btn-primary card-header-button-inline" data-toggle="modal" data-target="#lightsAdd">
                            <i class="fas fa-plus"></i>
                        </button>
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
