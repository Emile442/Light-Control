<div class="modal fade" id="routinesAdd" tabindex="-1" role="dialog" aria-labelledby="routinesAddModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Routines</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                @include('routines._form', ['routine' => new \App\Routine()])
            </div>
        </div>
    </div>
</div>
