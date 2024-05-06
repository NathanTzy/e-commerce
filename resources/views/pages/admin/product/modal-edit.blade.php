<div class="modal fade" id="editModalProduct{{ $row->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Category <span class="fw-bold text-danger">{{ $row->name }}</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.product.update', $row->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="col-12">
                        <label for="inputNanme4" class="form-label text-danger">Name the product</label>
                        <input type="text" class="form-control" id="productName" name="name"
                            value="{{ $row->name }}">
                    </div>
                    <div class="col-12 mt-3">
                        <label for="inputNanme4" class="form-label text-danger">Set price</label>
                        <input type="number" class="form-control" id="productPrice" name="price"
                            value="{{ $row->price }}">
                    </div>
                    <div class="col-12 mt-3">
                        <label for="inputNanme4" class="form-label text-danger">Description</label>
                        <textarea id="editor" name="description">{{ $row->content }}</textarea>
                    </div>
                    <div class="col-12 mt-3">
                        <label for="inputNanme4" class="form-label text-danger">Select category</label>
                        <select class="form-select" name="category_id" aria-label="Default select example">
                            <option selected value="{{$row->category->id}}">{{$row->category->name}}</option>
                            <option disabled>--Select Category--</option>
                            @foreach ($category as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>

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

{{-- PAKE ID!!! --}}
{{-- CKEditor --}}
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .then(editor => {
            console.log(editor);
        })
        .catch(error => {
            console.error(error);
        });
</script>
