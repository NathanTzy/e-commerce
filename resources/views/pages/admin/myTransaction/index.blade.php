@extends('layouts.parent')

@section('title', 'My Transaction')
@section('content')
    <h5 class="card-title fs-1">My Transaction</h5>
    <nav>
        <ol class="breadcrumb">
            @if (Auth::user()->role == 'admin')
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            @else
                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
            @endif
            <li class="breadcrumb-item"><a href="#">Transaction</a></li>
            <li class="breadcrumb-item "><a href="#">My Transaction</a></li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-body">
            <div class="card-title">Transaction List <i class="bi bi-cart-fill"></i></div>
            <!-- Active Table -->
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Account</th>
                        <th scope="col">Reciever Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Status</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($myTransaction as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ auth()->user()->name }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->email }}</td>
                            <td>{{ $row->phone }}</td>
                            <td>
                                @if ($row->status = 'EXPIRED')
                                    <span class="badge bg-danger">{{ $row->status }}</span>
                                @elseif ($row->status = 'PENDING')
                                    <span class="badge bg-warning">{{ $row->status }}</span>
                                @elseif ($row->status = 'SETTLEMENT')
                                    <span class="badge bg-info">{{ $row->status }}</span>
                                @else
                                    <span class="badge bg-success">{{ $row->status }}</span>
                                @endif
                            </td>
                            <td>{{ number_format($row->total_price) }}</td>
                            @if (Auth::user()->role == 'admin')
                                <td><a href="{{ route('admin.myTransaction.show', $row->name) }}"
                                        class="btn btn-info text-white">Detail</a></td>
                            @else
                            <td><a href="{{ route('user.myTransaction.show',$row->name) }}" class="btn btn-info text-white">Detail</a></td>
                            @endif

                        </tr>
                    @empty
                    @endforelse

                </tbody>
            </table>
            <!-- End Active Table -->
        </div>
    </div>

@endsection
