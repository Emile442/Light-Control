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
                        <button type="button" class="btn btn-round btn-primary card-header-button-inline" data-toggle="modal" data-target="#import">
                            <i class="fas fa-plus"></i> Import
                        </button>
                    </div>
                    <div class="card-body ">
                        @include('layouts._flash')
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                <tr>
                                    <th>networkId</th>
                                    <th>Name</th>
                                </tr>
                                </thead>
                                <tbody id="network-table">

                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center" id="loader">
                            <div class="loader"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="importModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Network Importer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('network.import') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="lights">Lights</label>
                            <select name="lights[]" id="lights" class="form-control" multiple>
                            </select>
                        </div>

                        <button class="btn btn-round btn-primary" type="submit">Import</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script type="application/javascript">
        $(document).ready(function() {
            let api_token = $('meta[name=api-token]').attr('content')
            $.get(`/api/v1/network?api_token=${api_token}`, function(data) {
                for (const item in data) {
                    $("#network-table").append(`
                        <tr>
                            <td>${item}</td>
                            <td>${data[item].name}</td>
                        </tr>
                    `);
                    $("#lights").append(`
                        <option value="${item}">${data[item].name}</option>
                    `)
                }
            }).fail(function(response) {
                response.responseJSON.errors.forEach(function (item) {
                    new Noty({
                        type: 'error',
                        theme: 'mint',
                        layout: 'topRight',
                        text: item,
                        closeWith: ['click', 'button'],
                        timeout: 3000
                    }).show();
                })
                $('#loader').html('<div class="alert alert-danger">Unable to get the network</div>');
            }).done(function () {
                $('#loader').remove()
            });



        })
    </script>
@endsection
