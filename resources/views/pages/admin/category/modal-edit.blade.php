<div class="modal fade" id="editModalCategory{{ $row->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Category <span class="fw-bold text-danger">{{ $row->name }}</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.category.update', $row->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="col-12">
                        <label for="inputNanme4" class="form-label text-danger">Name the category</label>
                        <input type="text" class="form-control" id="categoryName" name="name" value="{{ $row->name }}">
                    </div>
                    <div class="col-12 mt-3">
                        <label for="inputNanme4" class="form-label text-danger">Upload image</label>
                        <input type="file" class="form-control" id="imageCategory" name="image">
                    </div>
                    <div class="col-12">
                        <img src="#" alt="categoryImage" id="preview-logo" class="visually-hidden img-thumbnail">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
