<div class="modal fade" id="lightsAdd" tabindex="-1" role="dialog" aria-labelledby="lightsAddModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Light</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                @include('lights._form', ['light' => new \App\Light()])
            </div>
        </div>
    </div>
</div>
