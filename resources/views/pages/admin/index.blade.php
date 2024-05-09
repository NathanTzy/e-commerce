@extends('layouts.parent')

@section('title', 'Dashboard')

@section('content')
    <div class="section dashboard">
        <div class="card info-card customers-card">
            <div class="card-body">
                <h5 class="card-title text-center fs-4">Haloooo <span
                        class="fs-1 text-danger fw-bold">{{ Auth::user()->name }}</span> Sayang 🥵</h5>

                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <div class="ps-3">
                        <h6>{{ Auth::user()->role }}</h6>
                        <p class="text-danger">{{ Auth::user()->email }}</p> 
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="section dashboard">
        <div class="row">
            <div class="col-md-4">
                <!-- Sales Card -->
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title text-center fs-3">Category</h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-cart"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $category }}</h6>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- End Sales Card -->
            </div>

            <div class="col-md-4"> <!-- Sales Card -->
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title text-center fs-3">Product</h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-cart-check-fill"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $product }}</h6>
                            </div>
                        </div>
                    </div>

                </div><!-- End Sales Card -->
            </div>

            <div class="col-md-4"> <!-- Sales Card -->
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title text-center fs-3">User</h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-person"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $user }}</h6>
                            </div>
                        </div>
                    </div>

                </div><!-- End Sales Card -->
            </div>
        </div>
    </div>


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
                                    Email
                                </th>
                                <th>
                                    Role
                                </th>
                                <th>
                                    Reset Password
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $row)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>{{ $row->name }}</td>
                                    <td>
                                        {{ $row->email }}
                                    </td>
                                    <td>{{ $row->role }}</td>
                                    <td>
                                        <form action="{{ route('admin.reset-password', $row->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-warning text-white">
                                                <i class="bi bi-pencil-square"></i>
                                                Reset Password
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->

                </div>
            </div>

        </div>
    </div>


@endsection
