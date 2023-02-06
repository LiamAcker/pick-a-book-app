@extends('master.template')

@section('body')
    <h1 class='text-center p-5'>@yield('pageTitle')</h1>
    <div class='d-flex flex-row m-1 pb-2 row row-cols-4 g-4 justify-content-center'>
        @yield('content')
    </div>
    <div class="my-2 d-flex justify-content-center">
        @yield('pagination')
    </div>
    <div class="d-flex flex-row justify-content-center mb-4">
        <a class="btn btn-outline-dark" href="{{route('home')}}">Back</a>
    </div>
@endsection
