@foreach ($books_popular as $book)
    <div class='bookoutline card m-2 p-1 zoom-in' style="width: 16rem">
        <img src="{{url('storage\app\public\images\books\\'.$book->photoPath)}}" class="bookimage card-img-top rounded" alt="{{$book->title}}">
        <div class="bookcard card-body">
            <h5 class="card-title">{{$book->title}}</h5>
            <span class='card-subtitle mb-2 text-muted'>{{$book->author->name}}</span>
        </div>
        <a href="/bookDetail/{{$book->id}}" class="booksbtn btn btn-outline-dark">Book Detail</a>
    </div>
@endforeach

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
        border-radius:50%;
        background-color:black
    }
    .bookimage{
        width: 100%;
        height: 30vw;
        object-fit: cover;
    }
</style>
