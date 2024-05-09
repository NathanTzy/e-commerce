@extends('layouts.parent')

@section('title', 'user')
@section('content')
<h1>Halooo {{ Auth::user()->name }}</h1>

@endsection
