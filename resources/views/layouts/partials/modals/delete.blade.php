<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog">
    <form action="" method="post" id="form-modal">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">
                        <span id="title"></span>
                    </h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="body-text"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                </div>
            </div>
        </div>
    </form>
</div>