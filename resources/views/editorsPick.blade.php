@extends('layout.fromNewPopularEditors')

@section('title', 'Editor\'s Pick')

@section('pageTitle', 'Editor\'s Pick')

@section('content')
    @include('layout.bookEditorsCard')
@endsection

@section('pagination')
    {{$books_editorsPick->withQueryString()->links()}}
@endsection
