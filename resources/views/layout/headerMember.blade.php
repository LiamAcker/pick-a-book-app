<nav class="navbar navbar-expand-sm navbar-dark bg-dark position-sticky sticky-top px-3">
    <div class="container-fluid d-flex flex-row justify-content-between align-items-center">
        <a class="navbar-brand fw-semibold  text-white" href="{{route('home')}}">PickABook</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{Route::is('home')? 'active' : ''}}" aria-current="page" href="{{route('home')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{Route::is('books')? 'active' : ''}}" href="/books">Books</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{Route::is('category')? 'active' : ''}}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Categories
                    </a>
                    <ul class="dropdown-menu bg-dark">
                        @foreach ($categories as $category)
                            <li><a class="dropdown dropdown-item text-white" href="/category/{{$category->name}}">{{$category->name}}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{Route::is('cart')? 'active' : ''}}" href="{{route('cart')}}">Cart</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{Route::is('pickup')? 'active' : ''}}" href="{{route('pickup')}}">Pick Up</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{Route::is('history')? 'active' : ''}}" href="{{route('history')}}">History</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{Route::is('profile')? 'active' : ''}}" href="{{route('profile')}}">Profile</a>
                </li>
            </ul>
            <form class="m-0" role="logout" action="/logout" method="post">
                @csrf
                <button class="btn btn-outline-danger" type="submit">Logout</button>
            </form>
        </div>
    </div>
</nav>

<style>
    .dropdown-item:hover{
        /* display: inline; */
        background-color:darkgray;
    }
</style>
