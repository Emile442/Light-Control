<div class="modal fade" id="groupsAdd" tabindex="-1" role="dialog" aria-labelledby="groupsAddModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Group</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                @include('groups._form', ['group' => new \App\Group()])
            </div>
        </div>
    </div>
</div>
