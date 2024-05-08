@extends('layouts.parent')

@section('title', 'product')


@section('content')
    <a href="{{ route('admin.product.index') }}" class="btn-btn-pirmary">
        <i class="bi bi-arrow-left"></i>
        Back</a>
    <h5 class="card-title fs-1">{{ $product->name }} image</h5>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">Product</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">Data Product</a></li>
            <li class="breadcrumb-item "><a href="{{ route('admin.product.gallery.index', ['product']) }}">Product
                    gallery</a>
            </li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-center mt-3">
                <!-- Basic Modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
                    <i class="bi bi-plus"> Image</i>
                </button>
                @include('pages.admin.product.gallery.modal-create')
                <!-- End Basic Modal-->
            </div>

            <table class="table">
                <thead>
                    <th>
                        <tr>
                            <td>No</td>
                            <td>Image</td>
                            <td>Action</td>
                        </tr>
                    </th>
                </thead>
                <tbody>
                    @forelse ($product->product_galleries as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img src="{{ url('storage/product/gallery/', $row->image) }}" alt="" srcset=""
                                    class="w-25"></td>
                            <td>

                                <form action="{{ route('admin.product.gallery.destroy', [$product->id, $row->id]) }}"
                                    method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i>
                                        Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <td colspan="3" class="text-center fs-1 text-danger fw-bold">Empty</td>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
