@extends('master.template')

@section('title', 'Pick Up')

@section('body')

<div class="d-flex flex-wrap justify-content-center">
    @if ($summary == NULL)
        <h3 class="mt-4">No Order to Pick-Up</h3>
    @else
    <div class="card mb-3 mt-4 w-75">
    <p class="m-4">Order Book Summary - {{$summary->library->name}}</p>
    <div class="d-flex flex-wrap justify-content-center">
        @foreach ($summary->orderDetail as $orderDetail)
            <div class="card mb-3 mt-4 w-75 p-4">
                <div class="d-flex flex-row justify-content-between align-items-center">
                    <div class="col-md-4">
                    <img style="max-height:15rem; max-width:8rem; width:auto; height:auto;" src="{{url('storage\app\public\images\books\\'.$orderDetail->book->photoPath)}}" class="bookimage img-fluid rounded ms-4" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{$orderDetail->book->title}}</h5>
                            <p class="card-text">{{$orderDetail->book->ISBN}}</p>
                            @php
                                $date = Carbon::now()->format('d M Y');
                                $returnDate = Carbon::now()->addDays(30)->format('d M Y');
                            @endphp
                            <small class="text-muted">Borrow date: {{$date}}</small>
                            <br>
                            <small class="text-muted">Return date: {{$returnDate}}</small>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>
    @if ($summary != NULL)
    <form action="/pickup/confirm/{{$summary->id}}" method="post">
        @csrf
        <div class="m-4">
            <p>Choose pick-up method</p>
            @if ($errors->any())
                    <p class="text-warning">{{$errors->first()}}</p>
                @endif
            <div>
                <input type="radio" onclick="javascript:pickupCheck();" class="btn-check" name="options" id="self" autocomplete="off">
                <label class="btn btn-outline-secondary" for="self">Self Pick-Up</label>

                <input type="radio" onclick="javascript:pickupCheck();" class="btn-check" name="options" id="courier" autocomplete="off">
                <label class="btn btn-outline-secondary" for="courier">Courier Pick-Up</label>
                <br>
                <br>
                <div id="ifSelf" style="display:none">
                Please pick-up the book within 24 hour.
                <br>
                The Library Address is as below:
                <br>
                {{$summary->library->address}}
                </div>
                <div id="ifCourier" style="display:none">
                Choose your Courier (Payment Method Available only COD)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="courier" id="JNE" value='JNE'>
                        <label class="form-check-label" for="JNE">
                            JNE express
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="courier" id="Gojek" value='Gojek'>
                        <label class="form-check-label" for="Gojek">
                            Gojek instant
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="courier" id="Grab" value='Grab'>
                        <label class="form-check-label" for="Grab">
                            Grab instant
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="courier" id="Cepat" value='Si Cepat'>
                        <label class="form-check-label" for="Cepat">
                            Si Cepat
                        </label>
                    </div>
                </div>
            </div>
        </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end m-4">
                <button id='confirmOrderButton' class="btn btn-outline-success" disabled type="submit">Confirm Order</button>
            </div>
            @endif
        </div>
    </form>
</div>

<script type="text/javascript">
    function pickupCheck() {
        if (document.getElementById('self').checked) {
            document.getElementById('self').value = "Self Pick-Up";
            document.getElementById('ifSelf').style.display = 'block';
            document.getElementById('confirmOrderButton').disabled = false;

        } else{
            document.getElementById('ifSelf').style.display = 'none';
            // document.getElementById('self').value = 0;
        }

        if (document.getElementById('courier').checked) {
            document.getElementById('courier').value = "Courier";
            document.getElementById('ifCourier').style.display = 'block';
            document.getElementById('confirmOrderButton').disabled = false;
        } else{
            // document.getElementById('courier').value = 0;
            document.getElementById('ifCourier').style.display = 'none';
        }
    }
</script>

<style>
    .bookimage{
        width: 100%;
        height: 30vw;
        object-fit: cover;
    }
</style>

@endsection
