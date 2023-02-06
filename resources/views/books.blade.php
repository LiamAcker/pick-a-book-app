@extends('master.template')

@section('title', 'Books')

@section('body')
    <h1 class='text-center p-5'>Browse All Books</h1>
    <form class="d-flex mx-3" action="/search" method="get">
        <input class="form-control me-2" type="search" placeholder="Search book name" aria-label="Search" name="q">
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
    <div class='d-flex flex-row m-1 row row-cols-4 g-4 justify-content-center'>
        @include('layout.bookCard')
    </div>
    <div class="m-5 d-flex justify-content-center">
        {{$books->withQueryString()->links()}}
    </div>
@endsection
