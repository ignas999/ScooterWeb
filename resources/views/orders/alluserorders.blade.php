@extends('components.layout')
@section('content')
    
<h1 class="bold center">Užsakymų istorija</h1>

<div class="orderform">

    @foreach ($orders as $order)

    <div class="orderbox">
    <p> {{ 'Užsakymo Numeris: ' . $order->order_id }}</p>
    <div>
    <p> {{ 'Būsena: ' . $order->status->name }}</p>
    @if ($order->status_id == 9 )
        <form action={{"/cancelorder/".$order->order_id }} method="POST">
            @csrf
            <button class="cancelorder">Atšaukti užsakymą</button>
        </form>
    @endif

    <p> {{ 'Kelionės Kaina: ' . $order->amount .'eur'}}</p>
    <p> {{ 'Transportas: ' . $order->transport->name}}</p>
    <p> {{ 'Užsakymo data: ' . $order->start_date }}</p>
            </div>

            
            </div>
        
    

@endforeach
</div>
<div class="pagination">
{{ $orders->links() }}
</div>
@endsection