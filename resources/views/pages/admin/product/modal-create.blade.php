<div class="modal fade" id="createModalProduct" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="col-12">
                        <label for="inputNanme4" class="form-label text-danger">Name the product</label>
                        <input type="text" class="form-control" id="productName" name="name"
                            value="{{ old('name') }}">
                    </div>
                    <div class="col-12 mt-3">
                        <label for="inputNanme4" class="form-label text-danger">Set price</label>
                        <input type="number" class="form-control" id="productPrice" name="price">
                    </div>
                    <div class="col-12 mt-3">
                        <label for="productName" class="form-label text-danger">Product Description</label>
                        <input type="text" class="form-control" id="productName" name="description"
                            value="{{ old('description') }}">
                    </div>
                    <div class="col-12 mt-3">
                        <label for="inputNanme4" class="form-label text-danger">Select category</label>
                        <select class="form-select" name="category_id">
                            <option selected>🗿🥔🥕</option>
                            @foreach ($category as $row)
                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                            @endforeach
                        </select>
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
