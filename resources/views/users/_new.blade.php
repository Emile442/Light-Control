<div class="modal fade" id="usersAdd" tabindex="-1" role="dialog" aria-labelledby="usersAddModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Users</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-close"></i></span>
                </button>
            </div>
            <div class="modal-body">
                @include('users._form', ['user' => new \App\User()])
            </div>
        </div>
    </div>
</div>
