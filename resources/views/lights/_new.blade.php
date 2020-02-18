<div class="modal fade" id="lightsAdd" tabindex="-1" role="dialog" aria-labelledby="lightsAddModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Light</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-close"></i></span>
                </button>
            </div>
            <form action="{{ route('lights.store') }}" method="post">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" >Name</label>
                        <input type="text" name="name" id="name" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="networkId" >networkId</label>
                        <input type="number" name="networkId" id="networkId" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="group_id" >Group</label>
                        <select name="group_id" id="group_id" class="form-control">
                            @foreach(\App\Group::all() as $group)
                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                            @endforeach
                        </select>
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
