<div class="modal fade" id="updateModal{{ $row->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $row->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <label for="status" class="col-form-label">Select status</label>
                    <form action="{{ route('admin.transaction.update', $row->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <select class="form-select" aria-label="Default select example" name="status">
                            <option selected>Open this select menu</option>
                            <option value="PENDING">PENDING</option>
                            <option value="SETTLEMENT">SETTLEMENT</option>
                            <option value="EXPIRED">EXPIRED</option>
                            <option value="SUCCESS">SUCCESS</option>
                        </select>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div><!-- End Basic Modal-->
