@extends('master.template')

@section('title', 'Register')

@section('body')
    <form action="/register" method="post">
        @csrf
            <div class='d-flex flex-column align-items-center rounded my-4 py-4 container-fluid' style="width: 600px; background-color: bisque">
            <h1 class="text-center my-3">Register</h1>
            <div class="col-md-6 mb-4 w-75">
                <label for="nik" class="form-label">NIK</label>
                <input type="number" class="form-control" name='nik' id="nik" placeholder="(16 digits)" value="{{old('nik')}}">
            </div>
            <div class="col-md-6 mb-4 w-75">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name='name' id="name" placeholder="Your Name" value="{{old('name')}}">
            </div>
            <div class="col-md-6 mb-4 w-75">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name='email' id="email" placeholder="example@mail.com" value="{{old('email')}}">
            </div>
            <div class="col-md-6 mb-4 w-75">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name='password' id="password" placeholder="(min 5 letters)">
            </div>
            <div class="col-md-6 mb-4 w-75">
                <label for="confirmed" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name='confirmed' id="confirmed" placeholder="(min 5 letters)">
            </div>
            <div class="col-md-6 mb-4 w-75">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" name='address' id="address" placeholder="(min 5 letters)"></textarea>
            </div>
            <div class="col-md-6 mb-4 w-75">
                <label for="number" class="form-label">Phone Number</label>
                <input type="number" class="form-control" name='number' id="number" placeholder="(10-14 digits)" value="{{old('number')}}">
            </div>
            @if ($errors->any())
                <p class="text-center text-danger">{{$errors->first()}}</p>
            @endif
            <div class="d-flex flex-column align-items-center">
                <button type="submit" class="btn btn-dark mb-3">Register</button>
                <p class="text-center">Already have an account? <a class="text-decoration-none text-reset" href="{{route('login')}}"><u>Login now!</u></a></p>
            </div>
        </div>
    </form>
@endsection
