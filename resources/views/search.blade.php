@extends('master.template')

@section('title', 'Search')

@section('body')

<div class="card container-fluid mt-3 w-75 pb-3 mb-3" style="background-color: light">
    <h1  class="m-4">Search Result</h1>
    <div class="m-4">
        <div class="d-flex flex-wrap m-4">
            @if ($data == '[]')
                <h3>No Book Found...</h3>
            @endif
            @foreach ($data as $book)
                <div class="card m-2 p-1" style="width: 10rem;">
                    <img src="{{url('storage\app\public\books\\'.$book->photoPath)}}" class="card-img-top" alt="...">
                    <div class="bookcard card-body">
                        <h5 class="card-title">{{$book->title}}</h5>
                        <p class="card-text text-muted">{{$book->author->name}}</p>
                    </div>
                    <a href="/bookDetail/{{$book->id}}" class="booksbtn btn btn-outline-dark">Book Detail</a>
                </div>
            @endforeach
        </div>
    </div>
</div>


<style>
    .booksbtn{
        opacity: 0;
    }
    .bookcard:hover + .booksbtn, .booksbtn:hover{
        opacity: 100;
        transition: .3s;
    }
    .below-carousel{
        border-radius:50%;
        background-color:black
    }
    .below-carousel{
        /* outline:black;
        border: 1px solid black; */
        border-radius:50%;
        background-color:black
    }
</style>

@endsection
