@extends('master.template')

@section('title', 'History')

@section('body')
    <h1 class="d-flex flex-wrap justify-content-center mt-4">History</h1>
    <div class="d-flex flex-wrap justify-content-center my-2">
        @foreach ($orders as $order)
            {{-- ketika status masih order confirmed / belom atur pickup, maka gak masuk di history --}}
            {{-- kalo pickup method confirmed = sudah atur pickup, tapi blm diaccept sama admin --}}
            @if ($order->statusId != 1)
            <div class="card my-3 px-4 w-75">
                <div class="card-body">
                    @php
                        $date = Carbon::parse($order->date)->format('d M Y');
                        $returnDate = Carbon::parse($date)->addDays(30)->format('d M Y');
                        $dateForId = Carbon::parse($order->date)->format('Ymd');
                    @endphp
                    <h5 class="fw-bold mt-3">Order #{{$dateForId}}-{{$order->id}}</h5>
                    <h5 class="fw-bold mt-3">{{$order->library->name}} - {{$date}} - Return by {{$returnDate}}</h5>

                    @foreach ($order->orderDetail as $orderDetail)
                        <li>{{$orderDetail->book->title}} - {{$orderDetail->book->ISBN}}</li>
                    @endforeach
                    <h5 class="fw-bold mt-3">Status: {{$order->status->status}}</h5>
                    <h5 class="fw-bold mt-3">Pick-Up method: {{$order->courier->name}}</h5>
                </div>
            </div>
            @endif
        @endforeach
    </div>
@endsection
