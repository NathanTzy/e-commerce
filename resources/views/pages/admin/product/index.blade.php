@extends('layouts.parent')

@section('title', 'product')


@section('content')
    <h5 class="card-title fs-1">Data Product</h5>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">Product</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">Data Product</a></li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body">

            <!-- Basic Modal -->
            <div class="d-flex justify-content-around">
                <button type="button" class="btn btn-danger mt-3" data-bs-toggle="modal"
                    data-bs-target="#createModalProduct">
                    <i class="bi bi-plus"> Product</i>
                </button>
            </div>
            @include('pages.admin.product.modal-create')
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
                                                Category
                                            </th>
                                            <th>
                                                Price
                                            </th>
                                            <th>
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($product as $row)
                                            <tr>
                                                <td>
                                                    <p class="bg-danger text-center text-white rounded-5">
                                                        {{ $loop->iteration }}</p>
                                                </td>
                                                <td>{{ $row->name }}</td>
                                                <td>{{ $row->category->name }}</td>
                                                <td>{{ number_format($row->price) }}</td>
                                                <td class="d-flex justify-content-evenly">
                                                    <button class="btn btn-warning" data-bs-toggle="modal"
                                                        data-bs-target="#editModalProduct{{ $row->id }}">
                                                        <i class="bi bi-pencil text-white"></i>
                                                    </button>
                                                    <a href="{{ route('admin.product.gallery.index', $row->id) }}" class="btn btn-info"><i
                                                            class="bi bi-card-image text-white"></i></a>
                                                    @include('pages.admin.product.modal-edit')
                                                    <form action="{{ route('admin.product.destroy', $row->id) }}"
                                                        method="post" class="d-inline">
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
