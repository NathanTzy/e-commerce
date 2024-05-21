@extends('pages.frontEnd.parent.parent')

@section('content')
    <!-- START: BREADCRUMB -->
    <section class="bg-gray-100 py-8 px-4">
        <div class="container mx-auto">
            <ul class="breadcrumb">
                <li>
                    <a href="#">Home</a>
                </li>
                <li>
                    <a href="#" aria-label="current-page">{{ $categories->name }}</a>
                </li>
            </ul>
        </div>
    </section>
    <!-- END: BREADCRUMB -->

    <!-- START: COMPLETE YOUR ROOM -->
    <section class="bg-gray-100 px-4 py-16">
        <div class="container mx-auto">
            <div class="flex flex-start mb-4">
                <h3 class="text-2xl capitalize font-semibold">
                    Complete your room <br class="" />with what we designed
                </h3>
            </div>
            <div class="flex overflow-x-auto flex-wrap mb-4 -mx-3">
                @foreach ($product as $row)
                    <div class="px-3 flex-none" style="width: 320px">
                        <div class="rounded-xl p-4 pb-8 relative bg-white">
                            <div class="rounded-xl overflow-hidden card-shadow w-full h-36">
                                <img src="{{ url('$row->image') }}"
                                    class="w-full h-full object-cover object-center" />
                            </div>
                            <h5 class="text-lg font-semibold mt-4">{{ $row->name }}</h5>
                            <a href="{{ route('detail.product', $row->slug) }}" class="stretched-link">
                                <!-- fake children -->
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- END: COMPLETE YOUR ROOM -->
@endsection
