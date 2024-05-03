@extends('layouts.parent')

@section('title', 'Dashboard')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title text-center  ">Welcome <span class="fs-3 text-danger">{{ Auth::user()->name }}</span> sayang
                🥵</h5>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="bi bi-house-door"></i></a></li>
                </ol>
            </nav>
        </div>
    </div>

@endsection
