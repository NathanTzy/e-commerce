@extends('layouts.parent')

@section('title', 'user')
@section('content')
<h1>Halooo {{ Auth::user()->name }} Pukimak</h1>

@endsection
