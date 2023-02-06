@extends('layout.fromBookDetailAdminMember')

@section('stock-count')
    <p class="card-text">Stock  : {{$stock}}</p>
@endsection

@section('details')
    <form action="/add-book/{{$book->id}}" method="post">
        @csrf
        <select class="form-select" aria-label="Default select example" name='library'>
            {{-- error when no library was chosen --}}
            <option selected disabled value="0">Choose Available Library</option>
            @foreach ($book->bookLibrary as $bl)
                @if ($bl->stock >= 1)
                    <option value="{{$bl->libraryId}}">{{$bl->library->name}} - {{$bl->stock}} book(s) remaining</option>
                @endif
            @endforeach
        </select>
        @if ($errors->any())
            <p class="text-warning">{{$errors->first()}}</p>
        @endif
        <button class="btn btn-outline-dark col-6 mt-4" type="submit">Add To Cart</button>
    </form>
@endsection
