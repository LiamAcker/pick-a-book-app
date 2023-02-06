@extends('master.template')

@section('title', 'Manage Order')

@section('body')
    <div class='align-items-center p-5'>
        <table class="table">
            <thead class="table-dark justify-content-center text-center">
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Member</th>
                    <th scope="col">Book Title</th>
                    <th scope="col">Method</th>
                    <th scope="col">Borrow Date</th>
                    <th scope="col">Return Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $ctr = 0;
                @endphp
                @foreach ($orders as $order)
                    @foreach ($order->orderDetail as $orderDetail)
                        @php
                            $ctr+=1;
                        @endphp
                        <tr>
                            <th scope="row" class="text-center align-middle">{{$ctr}}</th>
                            <td class="align-middle text-center">{{$order->user->name}}</td>
                            <td class="align-middle text-center">{{$orderDetail->book->title}}</td>

                            <td class="align-middle text-center">{{($order->courier != null)? $order->courier->name : "Not Specified Yet"}}</td>
                            @php
                                $date = Carbon::parse($order->date)->format('d M Y');
                                $returnDate = Carbon::parse($date)->addDays(30)->format('d M Y');
                            @endphp
                            <td class="align-middle text-center">{{$date}}</td>
                            <td class="align-middle text-center">{{$returnDate}}</td>
                            <td class="text-center align-middle" style="max-width: 250px;">
                                @if ($order->statusId == 1)
                                    <span class="text-primary p-1">{{$order->status->status}}</span>
                                @elseif ($order->statusId == 2)
                                    <span class="text-secondary p-1">{{$order->status->status}}</span>
                                @elseif ($order->statusId == 3)
                                    <span class="text-dark p-1">{{$order->status->status}}</span>
                                @elseif ($order->statusId == 4)
                                    <span class="text-success p-1">{{$order->status->status}}</span>
                                @endif
                            </td>
                            <td class="text-center d-flex justify-content-center align-middle py-3">
                                <a href="/orderDetail/{{$orderDetail->orderHeaderId}}/{{$orderDetail->bookId}}" class="btn btn-outline-dark me-2">View Detail</a>
                                <form action="/manageOrder/updateStatus/{{$order->id}}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-dark {{($order->statusId == 2 || $order->statusId == 3)? '' : 'disabled'}}">Update Status</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
