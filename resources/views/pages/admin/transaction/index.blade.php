@extends('layouts.parent')

@section('title', 'Transaction')
@section('content')
    <h5 class="card-title fs-1">My Transaction</h5>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#">Transaction</a></li>
            <li class="breadcrumb-item "><a href="#">Transaction</a></li>
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
                        <th scope="col">Payment Url</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaction as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $row->user->name }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->email }}</td>
                            <td>{{ $row->phone }}</td>
                            @if ($row->payment_url == 'null')
                                <span>NULL</span>
                            @else
                                <td><a href="{{ $row->payment_url }}" target="blank">MIDTRANS</a></td>
                            @endif
                            <td>{{ number_format($row->total_price) }}</td>
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
                        </tr>
                    @empty
                    @endforelse

                </tbody>
            </table>
            <!-- End Active Table -->
        </div>
    </div>

@endsection
