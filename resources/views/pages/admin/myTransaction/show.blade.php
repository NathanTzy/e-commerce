@extends('layouts.parent')

@section('title', 'My Transaction')
@section('content')
    <h5 class="card-title fs-1">Transaction History</h5>
    <nav>
        <ol class="breadcrumb">
            @if (Auth::user()->role == 'admin')
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            @else
                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
            @endif
            <li class="breadcrumb-item"><a href="#">Transaction</a></li>
            <li class="breadcrumb-item "><a href="#">Transaction History</a></li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Position</th>
                        <th scope="col">Age</th>
                        <th scope="col">Start Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Brandon Jacob</td>
                        <td>Designer</td>
                        <td>28</td>
                        <td>2016-05-25</td>
                    </tr>
                </tbody>
            </table>
            <!-- End Table with hoverable rows -->
        </div>
    </div>
@endsection