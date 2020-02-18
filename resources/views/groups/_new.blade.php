<div class="modal fade" id="groupsAdd" tabindex="-1" role="dialog" aria-labelledby="groupsAddModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Group</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-close"></i></span>
                </button>
            </div>
            <form action="{{ route('groups.store') }}" method="post" id="newGroupsForm">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" >Name</label>
                        <input type="text" name="name" id="name" class="form-control" autocomplete="off" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-round btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-round btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
