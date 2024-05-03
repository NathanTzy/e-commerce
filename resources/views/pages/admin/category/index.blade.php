@extends('layouts.parent')

@section('title', 'category')


@section('content')

    <h5 class="card-title fs-1">Category</h5>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Product</a></li>
            <li class="breadcrumb-item "><a href="#">Category</a></li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body">

            <!-- Basic Modal -->
            <div class="d-flex justify-content-around">
                <button type="button" class="btn btn-danger mt-3" data-bs-toggle="modal" data-bs-target="#createModalCategory">
                    <i class="bi bi-plus"> Category</i>
                </button>
            </div>
            @include('pages.admin.category.modal-create')
            <!-- End Basic Modal-->

            <section class="section mt-4">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="card p-5">
                            <div class="card-body">
                                <!-- Table with stripped rows -->
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th>
                                                No
                                            </th>
                                            <th>
                                                Name
                                            </th>
                                            <th>
                                                Image
                                            </th>
                                            <th>
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($category as $row)
                                            <tr>
                                                <td><p class="bg-danger text-center text-white rounded-5">{{ $loop->iteration }}</p></td>
                                                <td>{{ $row->name }}</td>
                                                <td><img src="{{ url('storage/category/', $row->image) }}"  alt="{{ $row->name }}" class="w-25 rounded-2">
                                                </td>
                                                <td class="d-flex justify-content-evenly">
                                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModalCategory{{ $row->id }}">
                                                        <i class="bi bi-pencil text-white"></i>
                                                    </button>
                                                    @include('pages.admin.category.modal-edit')
                                                    <form action="{{ route('admin.category.destroy', $row->id) }}" method="post" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger" type="submit">
                                                            <i class="bi bi-trash text-white"></i>
                                                        </button>
                                                    </form>

                                                </td>
                                            </tr>
                                        @empty
                                            <tr> 
                                                <td colspan="4" class="text-center fs-2 fw-bold text-danger">Empty, No
                                                    Items Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <!-- End Table with stripped rows -->

                            </div>
                        </div>

                    </div>
                </div>
            </section>
        </div>
    </div>

@endsection

@push('script')
    <script src="text/javascript">
        ;

        function($) {
            function readURL(input) {
                var $prev = $('preview-logo')

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $prev.attr('src', e.target.result)
                    }
                    reader.readAsDataURL(input.files[0]);
                    $prev.attr('class', '')
                } else {
                    $prev.attr('class', 'visually-hidden')
                }
            }
            $('#image').on('change', function() {
                readURL(this);
            });
        }(jQuerry);
    </script>
@endpush
