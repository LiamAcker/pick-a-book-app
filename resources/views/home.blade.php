@extends('master.template')

@section('title', 'Home')

@section('body')
    <!-- commercials -->
    <div id="carouselAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselAutoplaying" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselAutoplaying" data-bs-slide-to="1" aria-label="Slide 2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{asset('images/commercial_1.jpeg')}}" class="bookimage d-block w-100" style="height: 325px; object-fit: cover; position: relative;">
            </div>
            <div class="carousel-item">
                <img src="{{asset('images/commercial_2.jpeg')}}" class="bookimage d-block w-100" style="height: 325px; object-fit: cover; position: relative;">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselAutoplaying" data-bs-slide="prev"></button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselAutoplaying" data-bs-slide="next"></button>
    </div>

    <!-- new release -->
    <div class="card container-fluid mt-3 w-75 pb-5" style="background-color: light">
        <h1 class="text-center mt-3">New Release</h1>
        <div class='d-flex flex-row m-1 row row-cols-3 g-3 justify-content-center'>
            @include('layout.bookCard')
        </div>
        <div class="d-flex justify-content-center mt-4">
            <a href="{{route('newRelease')}}" class="btn btn-dark">See More Recommendations</a>
        </div>
    </div>

    <!-- popular -->
    <div class="card container-fluid mt-3 w-75 pb-5" style="background-color: light">
        <h1 class="text-center mt-3">Popular Books</h1>
        <div class='d-flex flex-row m-1 row row-cols-3 g-3 justify-content-center'>
            @include('layout.bookPopularCard')
        </div>
        <div class="d-flex justify-content-center mt-4">
            <a href="{{route('popularBooks')}}" class="btn btn-dark">See More Recommendations</a>
        </div>
    </div>

    <!-- editors pick -->
    <div class="card container-fluid mt-3 w-75 pb-5" style="background-color: light">
        <h1 class="text-center mt-3">Editor's Pick</h1>
        <div class='d-flex flex-row m-1 row row-cols-3 g-3 justify-content-center'>
            @include('layout.bookEditorsCard')
        </div>
        <div class="d-flex justify-content-center mt-4">
            <a href="{{route('editorsPick')}}" class="btn btn-dark">See More Recommendations</a>
        </div>
    </div>

    <!-- authors -->
    <div class="card container-fluid mt-3 w-75 pb-3 mb-3" style="background-color: light">
        <h1 class="text-center mt-3">Best Author 2023</h1>
        <div class="d-flex flex-row m-1 justify-content-center">
            @foreach ($authors as $author)
                <a class="btn btn-outline-{{$colours[$loop->index%5]}} mx-1" href="/BooksBy/{{$author->name}}">{{$author->name}}</a>
            @endforeach
        </div>
    </div>
@endsection
