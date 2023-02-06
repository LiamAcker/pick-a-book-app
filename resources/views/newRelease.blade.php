@extends('layout.fromNewPopularEditors')

@section('title', 'New Release')

@section('pageTitle', 'New Release')

@section('content')
    @include('layout.bookCard')
@endsection

@section('pagination')
    {{$books->withQueryString()->links()}}
@endsection
