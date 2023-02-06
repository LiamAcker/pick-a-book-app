@extends('master.template')

@section('title', 'Books By Author')

@section('body')
    <div class="d-flex flex-wrap justify-content-center">
        <div class="card my-5 w-75 pt-4 pb-5 align-items-center">
            <h1 class="mb-4">About {{$name}}</h1>
            <div class="row align-items-center" style="width: 800px;">
                <div class="col-md-4 px-1">
                    <img src="{{url('storage\app\public\images\authors\\'.$author->photoPath)}}" class="img-fluid rounded" alt="{{$author->photoPath}}">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">Born</h5>
                        <p class="card-text">{{$author->birthPlace}}, {{$author->birthDate}}</p>
                        <h5 class="card-title">Biography</h5>
                        <p class="card-text">{{$author->biography}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card container-fluid mt-3 w-75 pb-3 mb-3" style="background-color: light">
        <h1  class="m-4 text-center">Books By {{$name}}</h1>
        <div class="m-4">
           <div class="d-flex flex-wrap m-4 justify-content-center">
                @if ($books == '[]')
                    <h3>No Book Found...</h3>
                @endif
                <div class='d-flex flex-row m-1 row row-cols-3 g-3 justify-content-center'>
                    @include('layout.bookCard')
                </div>
            </div>
        </div>
    </div>
@endsection
