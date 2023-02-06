@extends('master.template')

@section('title', 'Add New Book to Library')

@section('body')
    <script type="text/javascript">
        $(function() {
            $(".chzn-select").chosen();
        });
    </script>
    <form enctype="multipart/form-data" method="POST" action='/addToLibrary'>
        @csrf
        @yield('method_field')
        <div class="d-flex flex-column align-items-center container-fluid justify-content-center">
            <h1 class="text-center my-3">Add New Book to Library</h1>
            <div class="col-md-6 mb-4">
                <label for="isbn" class="form-label">ISBN</label>
                <select class="chzn-select form-select" aria-label="Default select example" name='isbn'>
                    @foreach ($books as $book)
                        <option value="{{$book->ISBN}}">{{$book->ISBN}} - {{$book->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 mb-4">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" class="form-control" name='stock' id="stock" placeholder=">0" @yield('stockValue')>
            </div>
            @if ($errors->any())
                <p class="text-center text-danger">{{$errors->first()}}</p>
            @endif
            <div class="d-flex flex-row justify-content-between mb-4">
                <button type="submit" class="btn btn-dark mx-2">Add to Library</button>
                <a class="btn btn-outline-dark" href="{{route('manageBook')}}">Back</a>
            </div>
        </div>
    </form>
@endsection
