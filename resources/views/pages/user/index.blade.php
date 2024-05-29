@extends('layouts.parent')

@section('title', 'user')
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
                    <h5 class="card-title text-center fs-3">PENDING</h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-cart"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $pending }}</h6>
                        </div>
                    </div>
                </div>

            </div>
            <!-- End Sales Card -->
        </div>

        <div class="col-md-4"> <!-- Sales Card -->
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title text-center fs-3">SETTLEMENT</h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-cart-check-fill"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $settlement }}</h6>
                        </div>
                    </div>
                </div>

            </div><!-- End Sales Card -->
        </div>

        <div class="col-md-4"> <!-- Sales Card -->
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title text-center fs-3">EXPIRED</h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-x"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $expired }}</h6>
                        </div>
                    </div>
                </div>

            </div><!-- End Sales Card -->
        </div>
        <div class="col-md-4"> <!-- Sales Card -->
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title text-center fs-3">Success</h5>

                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-check"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $success }}</h6>
                        </div>
                    </div>
                </div>

            </div><!-- End Sales Card -->
        </div>
    </div>
</div>


@endsection
