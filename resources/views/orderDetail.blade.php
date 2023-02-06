@extends('master.template')

@section('title', 'Order Detail')

@section('body')
    <div class="d-flex flex-wrap justify-content-center my-2">
        <div class="card my-2 w-75 p-2">
            <div class="card-body">
                @php
                    $date = Carbon::parse($order->date)->format('d M Y');
                    $dateForId = Carbon::parse($order->date)->format('Ymd');
                    $returnDate = Carbon::parse($date)->addDays(30)->format('d M Y');
                @endphp
                <h1 class="text-center">Order #{{$dateForId}}-{{$order->orderHeaderId}}</h1>
                <h5>Member ID: {{$order->orderHeader->memberId}}</h5>
                <h5>Member Name: {{$order->orderHeader->user->name}}</h5>
                <h5>Library ID: {{$order->orderHeader->libraryId}}</h5>
                <h5>Library Name: {{$order->orderHeader->library->name}}</h5>
                <h5>Book ISBN: {{$order->book->ISBN}}</h5>
                <h5>Book Title: {{$order->book->title}}</h5>
                @if ($order->orderHeader->courier != null)
                    <h5>Delivery Method: {{($order->orderHeader->courier != null)? $order->orderHeader->courier->name : "Not Specified Yet"}}</h5>
                    {{-- <h5>Courier ID: {{$order->orderHeader->courierId}}</h5>
                    <h5>Courier Name: {{$order->orderHeader->courier->name}}</h5> --}}
                @endif
                <h5>Borrow date: {{$date}}</h5>
                <h5>Return date: {{$returnDate}}</h5>
                <h5>Status ID: {{$order->orderHeader->statusId}}</h5>
                <h5>Status Name: {{$order->orderHeader->status->status}}</h5>
                <div class="text-center">
                    <a type="submit" class='btn btn-dark mt-3' href="{{route('manageOrder')}}">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
