@extends('layout.fromNewPopularEditors')

@section('title', 'Popular Books')

@section('pageTitle', 'Popular Books')

@section('content')
    @include('layout.bookPopularCard')
@endsection

@section('pagination')
    {{$books_popular->withQueryString()->links()}}
@endsection
