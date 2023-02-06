@extends('master.template')

@section('title', 'Cart')

@section('body')
    <div class="d-flex flex-wrap justify-content-center">
        @if ($cartHeaders == '[]')
            <h3 class="mt-4">Cart is empty</h3>
        @endif
        @if ($errors->any())
            <p class="text-warning pt-3">{{$errors->first()}}</p>
        @endif
        @foreach ($cartHeaders as $cartHeader)
            <div class="card mb-3 mt-4 w-75 p-4">
                <div class="d-flex flex-row justify-content-between align-items-center">
                    <h3 class="m-4">{{$cartHeader->library->name}}</h3>
                    <form action="/cart/checkout/{{$cartHeader->library->id}}" method="post">
                        @csrf
                        <button class="btn btn-outline-dark justify-content-end m-4" type="submit">Check Out</button>
                    </form>
                </div>
                @foreach ($cartHeader->cartDetail as $cartDetail)
                    <div class="row border rounded m-3 align-items-center">
                        <div class="col-md-4 p-3">
                            <img style="max-height:20rem; max-width:10rem; width:auto; height:auto;" src="{{url('storage\app\public\images\books\\'.$cartDetail->book->photoPath)}}" class="bookimage img-fluid rounded ms-4" alt="{{$cartDetail->book->title}}">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{$cartDetail->book->title}}</h5>
                                <p class="card-text">{{$cartDetail->book->author->name}}</p>
                                <p class="card-text">Weight: {{$cartDetail->book->weight}}</p>
                                <div class="d-grid gap-2 d-md-flex">
                                    <form method="post" action="/cart/delete/{{$cartHeader->libraryId}}/{{$cartDetail->bookId}}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">Remove from Cart</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>

    <style>
        .bookimage{
            width: 100%;
            height: 30vw;
            object-fit: cover;
        }
    </style>

@endsection
