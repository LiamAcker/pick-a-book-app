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
            <li class="nav-item">
                <a class="nav-link {{Route::is('manageBook')? 'active' : ''}}" href="/manageBook">Manage Book</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{Route::is('manageOrder')? 'active' : ''}}" href="/manageOrder">Manage Order</a>
            </li>
            <li class="nav-item {{Route::is('profile')? 'active' : ''}}">
                <a class="nav-link" href="{{route('profile')}}">Profile</a>
            </li>
        </ul>
        <form class="m-0" role="logout" action="/logout" method="post">
            @csrf
            <button class="btn btn-outline-danger" type="submit">Logout</button>
        </form>
        </div>
    </div>
</nav>
