@extends('layouts.parent')

@section('title', 'product')


@section('content')

    <h5 class="card-title fs-1">{{ $product->name }} image</h5>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">Product</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">Data Product</a></li>
            <li class="breadcrumb-item "><a href="{{ route('admin.product.gallery.index', ['product']) }}">Product gallery</a></li>
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
                    <tr>
                        <td>1</td>
                        <td><img src="#" alt="gambar"></td>
                        <td><a href="" class="btn btn-primary"><i class="bi bi-eye"></i></a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection
