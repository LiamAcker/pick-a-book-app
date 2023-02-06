@extends('master.template')

@section('body')
    <form enctype="multipart/form-data" @yield('method') @yield('action')>
        @csrf
        @yield('method_field')
        <div class="d-flex flex-column align-items-center container-fluid justify-content-center">
            <h1 class="text-center my-3">@yield('pageTitle')</h1>
            <div class="col-md-6 mb-4">
                <label for="isbn" class="form-label">ISBN</label>
                <input type="text" class="form-control" name='isbn' id="isbn" placeholder="ISBN" @yield('isbnValue')>
            </div>
            <div class="col-md-6 mb-4">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" name='title' id="title" placeholder="Title" @yield('titleValue')>
            </div>
            <div class="col-md-6 mb-4">
                <label for="synopsis" class="form-label">Synopsis</label>
                <textarea class="form-control" name='synopsis' id="synopsis" placeholder="(min 5 letters)">@yield('synopsisValue')</textarea>
            </div>
            <div class="col-md-6 mb-4">
                <label for="publishedYear" class="form-label">Published Year</label>
                <input type="number" class="form-control" name='publishedYear' id="publishedYear" placeholder="(4 digits)" @yield('publishedYearValue')>
            </div>
            @yield('stockValue')
            <div class="col-md-6 mb-4">
                <label for="author" class="form-label">Author</label>
                <select class="form-select" aria-label="Default select example" name='author'>
                    @yield('authorOption')
                </select>
            </div>
            <div class="col-md-6 mb-4">
                <label for="language" class="form-label">Language</label>
                <select class="form-select" aria-label="Default select example" name='language'>
                    @yield('languageOption')
                </select>
            </div>
            @yield('categoryOption')
            <div class="col-md-6 mb-4">
                <label for="publisher" class="form-label">Publisher</label>
                <select class="form-select" aria-label="Default select example" name='publisher'>
                    @yield('publisherOption')
                </select>
            </div>
            <div class="col-md-6 mb-4">
                <label for="weight" class="form-label">Weight</label>
                <input type="number" class="form-control" name='weight' id="weight" placeholder=">0" @yield('weightValue')>
            </div>
            @yield('insertImage')
            @if ($errors->any())
                <p class="text-center text-danger">{{$errors->first()}}</p>
            @endif
            <div class="d-flex flex-row justify-content-between mb-4">
                @yield('button')
                <a class="btn btn-outline-dark" href="{{route('manageBook')}}">Back</a>
            </div>
        </div>
    </form>
@endsection
