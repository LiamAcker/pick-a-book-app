@extends('master.template')

@section('title', 'Cart')

@section('body')

<div class="d-flex flex-wrap justify-content-center">
    @if ($cartHeaders == '[]')
    <h3>Cart is empty</h3>
    @endif
    @foreach ($cartHeaders as $cartHeader)
    <div class="card mb-3 mt-4 w-75">
        <div class="d-flex flex-row justify-content-betwen">
            <h3>{{$cartHeader->library->name}}</h3>
            <div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end m-4">
                    <a class="btn btn-outline-dark" type="button" href="...">Check Out</a>
                </div>
            </div>
            @foreach ($cartHeader->cartDetail as $cartDetail)
                <div class="row g-0">
                    <div class="col-md-4">
                    {{-- img size has to be changed --}}
                    <img src="{{url('storage\app\public\books\\'.$cartDetail->book->photoPath)}}" class="img-fluid rounded-start" alt="{{$cartDetail->book->title}}">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{$cartDetail->book->title}}</h5>
                            <p class="card-text">{{$cartDetail->book->author->name}}</p>
                            <p class="card-text">{{$cartDetail->book->synopsis}}</p>
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

@endsection
